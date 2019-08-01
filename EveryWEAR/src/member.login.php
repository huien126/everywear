<?php include 'module/default.php';?>
<?php 
	$title = "Login";

	$EWUID = $_POST["everywearid"];
	$EWUPW = $_POST["everywearpw"];
	$error_msg = "";

	$isLogin = false;

	if (isset($_SESSION["EWUID"])) {
		$isLogin = true;
		$error_msg = explode("@", "ID:".$_SESSION["EWUID"])[0]."로 이미 로그인되어 있습니다.";
	} else {
		if (isset($EWUID, $EWUPW)) {

			$memberInfo = json_decode(file_get_contents("users.json"),true);

			if (array_key_exists($EWUID, $memberInfo)) {
				if ($memberInfo[$EWUID]["EWUPW"] === hash("sha256", $EWUPW)) {
					$_SESSION["EWUID"] = $EWUID;

					header("location: /main");
					exit();
				}
			} 
			header("location: /member/login?error=true");
		};
		if ($_GET["error"]==="true") {
			$error_msg = "ID 또는 비밀번호가 틀렸습니다.";
		}
		if (isset($_GET["notLogin"])) {
			$error_msg = "먼저 로그인하세요.";
		}
	}
	
?>
<?php if (!$pjax): ?>
<!DOCTYPE html>
<html <?=$htmlAttribute; ?>>
<?php include 'module/head.set.php'; ?>
<body>
	<?php include 'module/header.set.php'; ?>
	<div id="root"><?php endif ?>
		<div class="container" data-html-title="<?=$title; ?>">
			<div class="Login-wrapper">
				<form class="Login-form-signin" method="post">
					<h2 class="Login-form-signin-heading">EveryWEAR Login</h2>
					<input type="email" class="Login-form-control" name="everywearid" placeholder="User ID(E-mail)" required autofocus>
					<input type="password" class="Login-form-control" name="everywearpw" placeholder="User PW" required>      
					<span class="red"><?=$error_msg; ?></span>
					<button class="Login-btn" type="submit">Login</button>
					<a class="pjax" href="/member/register"><button class="Login-btn bg-mint" type="button">Register</button></a>
				</form>
			</div>
		</div>
	<?php if (!$pjax): ?></div>
	<?php include 'module/footer.set.php'; ?>
</body>
</html><?php endif ?>