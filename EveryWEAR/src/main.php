<?php include 'module/default.php';?>
<?php 
	$title = "main";
?>
<?php if (!$pjax): ?>
<!DOCTYPE html>
<html <?=$htmlAttribute; ?>>
<?php include 'module/head.set.php'; ?>
<body>
	<?php if ($_SERVER["HTTP_REFERER"] === "https://everywear0512.wixsite.com/everywear") { ?><div id="From_OldVersion" style="padding: 5px;background: #0275d8;text-align: center;color: white;">EveryWEAR: 이전버전에서 오셨군요! 아직 서비스가 정식 오픈되지 않습니다!<br>하지만 더 빠르게 EveryWEAR을 이용할 수 있습니다!</div><?php } ?>
	<?php include 'module/header.set.php'; ?>
	
	<div id="root"><?php endif ?>
		<!-- Default Index Contents -->
		<div class="container" data-html-title="<?=$title; ?>">
			<section class="s1" data-animation="fadeInLeft">
				<h1>Transcending wear,<br>Everywhere, EveryWEAR.</h1>
				<h2>이제 입지 않는 옷도 기부할 수 있습니다!</h2>
				<p>EveryWEAR는 안 입는 옷을 모아 제3세계의 여러 사람들에게 기부합니다.</p>
				<p>안 입는 옷은 수송과정을 거쳐 개발도상국의 사람들에게 도착합니다.</p>
				<p>여러분께서 기쁜마음으로 기부하신 옷들, 저희가 안전하게 보내드리겠습니다.</p>
				<p>EveryWEAR는 이를 해결하기 위해 옷이 전달되는 과정을 알 수 있는 안심기부서비스를 제공합니다.</p>
				<p>생활 속의 작은 것들이, 얼마나 큰 힘이 되고 좋은 영향을 주는지 직접 알 수 있게 해 드리겠습니다. </p>
				<p>이제 평소에 안 입는 옷들은, EveryWEAR에게 맡겨주십시오.</p>
			</section>
			<section class="s2 center">
				<h1>被를 초월하여 모두가 옷을 입게끔, <br>저희는 EveryWEAR 입니다.</h1>
				<p>안 입는 옷을 기부하시면,</p>
				<p>운송자가 운송 정보를 실시간으로 알려드립니다.</p>
				<p>안 입는 옷이 수혜자에게 도착했는지도 확인할 수 있습니다.</p>
				<p>​여러분이, 이 세상에 얼마나 큰 도움이 되는지 직접 느껴보세요.</p>

				<div class="s2-container">
					<div class="s2-image">
						<img src="/image/d544e5d6f3d69070c216ecd20c52bfd0.<?=$imgExtention; ?>" alt="heart">
						<p>Sharing love</p>
					</div>
					<div class="s2-image">
						<img src="/image/cee669206d384f74881218c44d891aa7.<?=$imgExtention; ?>" alt="location">
						<p>Transport Information</p>
					</div>
					<div class="s2-image">
						<img src="/image/0a94ce6c5b8ac5e0c76a0e20711a6a68.<?=$imgExtention; ?>" alt="transporter">
						<p>Transporter</p>
					</div>
					<div class="s2-image">
						<img src="/image/d543d1fa3575447b9f4de776bdef9932.<?=$imgExtention; ?>" alt="A person who appreciates">
						<p>The Thankfuls</p>
					</div>
				</div>
			</section>
		</div>
	<?php if (!$pjax): ?></div>
	<?php include 'module/footer.set.php'; ?>
</body>
</html><?php endif ?>