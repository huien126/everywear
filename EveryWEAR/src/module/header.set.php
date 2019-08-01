<div id="header">
		<div id="Logo">
			<a href="/main"><img src="/image/main.<?=$imgExtention; ?>" alt="EveryWEAR Logo"></a>
		</div>
		<div class="bg-black">
			<ul id="navigator">
				<input type="checkbox" id="menuLinker" name="isMobile.menuController()">
				<li class="li-noDeco onlyMobile">
					<label for="menuLinker">
						<div class="ico-menu">
							<div class="ico bar1"></div>
							<div class="ico bar2"></div>
							<div class="ico bar3"></div>
						</div>
						<div>Menu</div>
					</label>
				</li>
				<li class="li-noDeco stick"><a class="pjax" href="/main">메인</a></li>
				<li class="li-noDeco stick"><a class="pjax" href="/greeting">인사말</a></li>
				<li class="li-noDeco stick"><a class="pjax" href="/donation">옷 기부하기 / 후원하기</a></li>
				<li class="li-noDeco stick"><a class="pjax" href="/findMy">기부한옷 찾기</a></li>
				<?php if ($_SESSION["EWUID"]==="everywear0512@gmail.com") {?><li class="li-noDeco stick"><a class="pjax" href="/admin/standby">대기목록</a></li><?php }?>
				<li class="li-noDeco menu-right stick"><a class="pjax" id="memberLink" href="/member/log<?=$_SESSION["EWUID"]?"out":"in"?>"><?=$_SESSION["EWUID"]?"(".explode("@", $_SESSION["EWUID"])[0]."님)":""?>로그<?=$_SESSION["EWUID"]?"아웃":"인"?></a></li>
			</ul>
		</div>
	</div>
