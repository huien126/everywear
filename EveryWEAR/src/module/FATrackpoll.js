TrackPollClient = function(map, options) {
    this.supportedVersions = [/2\..*/];
    this.poller = null;
    this.interval = 65000;
    this.endpoint = 'https://ko.flightaware.com/ajax/trackpoll.rvt';
    this.summary = false;
    this.token = null
    this.knownFlights = [];
    this.onNewFlight = function() {}
    ;
    this.onUpdatedFlight = function() {}
    ;
    this.bootstrapData = null;
    this.debugger = false;
    this.replayData = false;
    this.replay = function() {
        var times = Object.keys(this.replayData);
        var t1 = times[0];
        var thisBatch = this.replayData[t1];
        delete this.replayData[t1];
        $.each(thisBatch.flights, function(id, flightData) {
            if (thisBatch.flights[id].track !== null && thisBatch.flights[id].track.length > 1) {
                thisBatch.flights[id].track.reverse();
            }
        });
        this.pollCallback(thisBatch);
        if (times.length > 1) {
            var t2 = times[1];
            var interval = t2 - t1;
            setTimeout($.proxy(this.replay, this), interval * 1000);
        }
    }
    ;
    this.startPolling = function(pollImmediately) {
        if (typeof pollImmediately == 'undefined') {
            pollImmediately = true;
        }
        if (this.replayData) {
            return this.replay();
        }
        if (this.poller !== null) {
            return;
        }
        this.poller = setInterval($.proxy(this.poll, this), this.interval);
        if (pollImmediately) {
            if (this.bootstrapData !== null && (new Date().getTime() - this.refTime) < this.interval) {
                this.pollCallback(this.bootstrapData);
                this.bootstrapData = null;
                this.summary = true;
            } else {
                this.poll();
            }
        }
    }
    ;
    this.stopPolling = function() {
        if (this.poller !== null) {
            clearInterval(this.poller);
            this.poller = null;
        }
    }
    ;
    this.poll = function() {
        var request = $.get(this.endpoint, {
            token: this.token,
            locale: user.locale || 'en_US',
            summary: Number(this.summary)
        }, $.proxy(this.pollCallback, this), 'json');
        this.summary = true;
    }
    ;
    this._checkVersion = function(version) {
        for (var i in this.supportedVersions) {
            var spec = this.supportedVersions[i];
            var compare = false;
            if (typeof spec === 'string') {
                compare = (version === spec);
            } else if (spec instanceof RegExp) {
                compare = spec.test(version);
            }
            if (compare) {
                return true;
            }
        }
        return false;
    }
    ;
    this.pollCallback = function(resp) {
        if (typeof resp !== 'object') {
            return null;
        }
        if ('version'in resp && !this._checkVersion(resp.version)) {
            return null;
        }
        if ('trackpoll_disabled'in resp) {
            return null;
        }
        var now = FAMap.Util.getNow();
        if (this.debugger) {
            this.debugger.set('trackpoll.' + now, $.extend({}, resp));
        }
        var newFlights = [];
        var updatedFlights = [];
        $.each(resp.flights, $.proxy(function(flight_id, flightData) {
            flightData.staleness = now - flightData.timestamp;
            var baseId = flight_id.split(':')[0];
            if (this.knownFlights.indexOf(baseId) == -1) {
                if (resp.summary) {
                    this.summary = false;
                } else {
                    this.knownFlights.push(baseId);
                    newFlights.push({
                        flight_id: baseId,
                        flightData: flightData
                    })
                }
            } else {
                updatedFlights.push({
                    flight_id: baseId,
                    flightData: flightData
                });
            }
        }, this));
        this.onNewFlights(newFlights);
        this.onUpdatedFlights(updatedFlights);
        if (this.singleFlight) {
            var keys = Object.keys(resp.flights);
            if (keys.length == 1) {
                var flightData = resp.flights[keys.pop()];
                if ('unknown'in flightData && flightData.unknown || flightData.blockedForUser) {
                    this.stopPolling();
                } else if (flightData.landingTimes.actual !== null || flightData.gateArrivalTimes.actual !== null || flightData.resultUnknown || flightData.cancelled) {
                    this.interval = this.normalInterval * 2;
                    this.stopPolling();
                    this.startPolling(false);
                } else if (flightData.takeoffTimes.actual == null && flightData.gateDepartureTimes.actual == null) {
                    var etd = flightData.gateDepartureTimes.estimated || flightData.takeoffTimes.estimated || flightData.flightPlan.departure;
                    if (etd !== null && etd - FAMap.Util.getNow() > 3600) {
                        this.interval = this.normalInterval * 2;
                        this.stopPolling();
                        this.startPolling(false);
                    }
                }
            }
        }
    }
    ;
    this.init = function(map, options) {
        if (typeof trackpollGlobals === 'undefined') {
            throw ('Error: missing global config object for TrackPoll client');
        }
        if (typeof trackpollGlobals.INTERVAL == 'number') {
            this.interval = Math.max(trackpollGlobals.INTERVAL * 1000, 15000);
            this.normalInterval = this.interval;
        }
        if ('TOKEN'in trackpollGlobals) {
            this.token = trackpollGlobals.TOKEN;
        } else {
            throw ('Error: missing token for TrackPoll client');
        }
        if ('SINGLE_FLIGHT'in trackpollGlobals) {
            this.singleFlight = trackpollGlobals.SINGLE_FLIGHT;
        } else {
            this.singleFlight = false;
        }
        this.debugger = map.debugger;
        if ('replayData'in map.options && 'trackpoll'in map.options.replayData) {
            this.replayData = map.options.replayData.trackpoll;
        }
        if ('onNewFlights'in options && typeof options.onNewFlights == 'function') {
            this.onNewFlights = options.onNewFlights;
        } else {
            throw ('Error: A valid onNewFlights callback was not provided when creating a Poller instance');
        }
        if ('onUpdatedFlights'in options && typeof options.onUpdatedFlights == 'function') {
            this.onUpdatedFlights = options.onUpdatedFlights;
        } else {
            throw ('Error: A valid onUpdatedFlights callback was not provided when creating a Poller instance');
        }
        if (typeof trackpollBootstrap !== 'undefined') {
            this.bootstrapData = trackpollBootstrap;
        }
        this.startPolling();
    }
    ;
    this.init.apply(this, arguments);
}
;
TrackPollClient.prototype.refTime = new Date().getTime();
