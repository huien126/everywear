<?php include 'module/default.php'; ?>
<?php
	$title = "register";
	$error_msg = "";
	$renderKeyInput = false;

	$EWUID = trim($_POST["everywearid"]);
	$EWUPW = $_POST["everywearpw"];
	$EWUPWC = $_POST["confirm"];

	if (isset($EWUID, $EWUPW, $EWUPWC) and !isset($_SESSION["EWUID"])) {
		if ($EWUPW === $EWUPWC) {
			$EWUSER = json_decode(file_get_contents("/users.json"),true);
			$isEmail = filter_var($EWUID, FILTER_VALIDATE_EMAIL);

			if (array_key_exists($EWUID, $EWUSER)) {
				$error_msg = "이미 존재하는 사용자 계정";
			} else {
				if ($isEmail) {
					if (!preg_match('/^[a-zA-Z0-9~!@#$%^&*()_+-=`]{8,16}$/', $EWUPW) || !preg_match('/\d/', $EWUPW) || !preg_match('/[a-zA-Z]/', $EWUPW)) {
						$error_msg = "비밀번호는 영문, 숫자조합의 8~16자의 문자열입니다.";
					} else {
						list($user,$host) = explode("@", $EWUID);
						if (checkdnsrr($host,"MX") || checkdnsrr($host,"A") || checkdnsrr($host, "CNAME")) {
							$renderKeyInput = true;
							$verification_key = sprintf('%06d',rand(000000,999999));

							$headers = "From: no-reply@".$_SERVER["HTTP_HOST"]."\r\n";

							mail($EWUID, "[EveryWEAR] 이메일 가입 인증 코드입니다.", "안녕하세요? EveryWEAR입니다.\n가입화면에 다음의 인증코드를 넣어주세요.\n인증코드: ".$verification_key,$headers);

							$_SESSION["KEY"] = $verification_key;
							$_SESSION["R_EWUPW"] = hash("sha256", $EWUPW);
							$_SESSION["R_EWUID"] = $EWUID;


						} else {
							$error_msg = "유효하지 않은 이메일 제공자";
						}
					}
				} else {
					$error_msg = "유효하지 않은 이메일";
				}
			}
		} else {
			//비밀번호 확인이 일치하지 않을때
			$error_msg = "비밀번호 확인이 일치하지 않습니다.";
		}
	};
	if (isset($_SESSION["EWUID"])) {
		$error_msg = "로그인 상태에서는 회원가입이 제한됩니다.";
	} else {
		if (isset($_SESSION["KEY"],$_SESSION["R_EWUID"],$_SESSION["R_EWUPW"],$_POST["key"])) {
			if ($_POST["key"] === $_SESSION["KEY"]) {
				$member = json_decode(file_get_contents("users.json"),true);
				$save = fopen("users.json", "w");

				$member[$_SESSION["R_EWUID"]] = array(
					"EWUPW" => $_SESSION["R_EWUPW"],
					"data" => array()
				);

				fwrite($save, json_encode($member));
				fclose($save);

				header("location: /member/welcome?member=".explode("@", $_SESSION["R_EWUID"])[0]);

				session_destroy();
			} else {
				$renderKeyInput = true;
				$error_msg = "일치하지 않는 인증코드";
			}
		}
	}

?>
<?php if (!$pjax): ?>
<!DOCTYPE html>
<html <?=$htmlAttribute; ?>>
<?php include 'module/head.set.php'; ?>
<body>
	<?php include 'module/header.set.php'; ?>
	<div id="root">
	<?php endif ?>
		<div class="container" data-html-title="<?=$title; ?>">
			<?php if (!$renderKeyInput): ?>
			<form method="post" id="join_frm">
			  <div class="register-form">
			    <h1>EveryWEAR Register</h1>
			    <p>Please fill in this form to create an account.</p>
			    <p class="red"><?=$error_msg; ?></p>
			    <hr>

			    <label for="everywearid"><b>Email</b></label>
			    <input type="email" placeholder="Enter Email" name="everywearid" required>

			    <label for="everywearpw"><b>Password</b></label>
			    <input type="password" placeholder="Enter Password" name="everywearpw" required>

			    <label for="confirm"><b>confirm Password</b></label>
			    <input type="password" placeholder="confirm Password" name="confirm" required>
			    <hr>

			    <p>By creating an account you agree to our <a target="_blank" href="/member/terms">Terms & Privacy</a>.</p>
			    <button type="submit" class="registerbtn">Register</button>
			  </div>

			  <div class="register-form signin">
			    <p>Already have an account? <a href="/member/login" class="pjax">Sign in</a>.</p>
			  </div>
			</form><?php endif ?>
			<?php if ($renderKeyInput): ?>
			<form method="post" id="join_frm">
			  <div class="register-form">
			    <h1>EveryWEAR Register</h1>
			    <p>Please fill in this form to create an account.</p>
			    <p class="green">귀하의 이메일로 6자리의 인증번호를 보냈습니다.<br>회원가입을 완료하기 위하여 인증번호를 입력하세요!</p>
			    <p class="red"><?=$error_msg; ?></p>
			    <hr>
			    <label for="key"><b>verification key</b></label>
			    <input type="number" maxlength="6" minlength="6" placeholder="code" name="key" required>
			    <hr>

			    <p>By creating an account you agree to our <a target="_blank" href="/member/terms">Terms & Privacy</a>.</p>
			    <button type="submit" class="registerbtn">Register</button>
			  </div>
			</form>
			<?php endif ?>
		</div>
		

	<?php if (!$pjax): ?></div>
	<?php include 'module/footer.set.php'; ?>
</body>
</html><?php endif ?>