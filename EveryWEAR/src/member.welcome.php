<?php include 'module/default.php';?>
<?php 
	$title = "welcome";

	$user = htmlspecialchars($_GET["member"]);
?>
<?php if (!$pjax): ?>
<!DOCTYPE html>
<html <?=$htmlAttribute; ?>>
<?php include 'module/head.set.php'; ?>
<body>
	<?php include 'module/header.set.php'; ?>
	<div id="root"><?php endif ?>
		<div class="container center" data-html-title="<?=$title; ?>">
			<h1>🙌Welcome!</h1>
			<p></p>
			<p><b><?=$user; ?>님!</b> EveryWEAR의 회원이 된것을 진심으로 환영합니다!</p>
			<p>이제 로그인하여 EveryWEAR의 서비스를 이용할 수 있습니다!</p>

			<a href="/member/login" class="pjax"><b>로그인하러가기 &rarr;</b></a>
		</div>
	<?php if (!$pjax): ?></div>
	<?php include 'module/footer.set.php'; ?>
</body>
</html><?php endif ?>