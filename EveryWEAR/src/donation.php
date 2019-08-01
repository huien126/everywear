<?php include 'module/default.php';?>
<?php 
	$title = "donation";
?>
<?php if (!$pjax): ?>
<!DOCTYPE html>
<html <?=$htmlAttribute; ?>>
<?php include 'module/head.set.php'; ?>
<body>
	<?php include 'module/header.set.php'; ?>
	<div id="root"><?php endif ?>
		<div class="container center" data-html-title="<?=$title; ?>">
			<div class="donation-head">
				<h1 class="black">기부하기</h1>
			</div>
			<div class="donation-manual">
				<div class="donation bg-black">
					<span class="donation-point">안 입는 옷을</span><br>
					<span class="white">준비하세요.</span>
					<div class="donation-bar"></div>
					<p class="white">안 입는 옷은 최대한 깨끗하게 세탁 및 건조 한 후 보내주세요!</p>
				</div>
				<div class="donation bg-gray">
					<span class="donation-point">기부금을</span><br>
					<span class="white">보내주세요.</span>
					<div class="donation-bar"></div>
					<p class="white">안 입는 옷과 함께 기부금을<br>1000\이상 보내주세요!<br>여러분들의 기부금은 재투자를 통해 개발도상국의 의류산업 활성에 도움이 됩니다!</p>
				</div>
				<div class="donation bg-mint">
					<span class="black">택배를</span><br>
					<span class="white">보내주세요.</span>
					<div class="donation-bar"></div>
					<p class="black">옷과 기부금을 함께 넣어서<br>아래 주소로 택배를 보내주시면<br>EveryWAER가 안심기부 해드립니다!</p>
				</div>
			</div>
			<div class="donation-bottom">
				<a href="/donation/order" class="pjax">
					<button class="donation-btn white">후원하기</button>
				</a>
			</div>
		</div>
	<?php if (!$pjax): ?></div>
	<?php include 'module/footer.set.php'; ?>
</body>
</html><?php endif ?>