<?php 
	include 'module/default.php';
	include 'module/loginService.php';

	$donator = htmlspecialchars($_POST["donation_name"]); //기부자 성명
	$quantity = htmlspecialchars($_POST["howMany"]);
	$monny = htmlspecialchars($_POST["support_monny"]);
	$type = htmlspecialchars($_POST["thing_type"]);
	$detail = htmlspecialchars($_POST["detail"]);

	if (isset($donator,$quantity,$monny,$type)) {
		$ui = json_decode(file_get_contents("./users.json"),true);
		$data = json_decode(file_get_contents("./data.json"),true);
		
		$result = array(
			"D_id" => $_SESSION["EWUID"],
			"D_name" => $donator,
			"D_quantity" => $quantity,
			"D_monny" => $monny,
			"D_type" => $type,
			"D_detail" => $detail,
			"D_submit" => date("m-d H:i"),
			"D_status" => 0
		);

		array_push($ui[$_SESSION["EWUID"]]["data"], $result);
		array_push($data, $result);

		$EndD = json_encode($ui);
		$EndC = json_encode($data);
		$Editor = fopen("./users.json", "w");
		$form = fopen("./data.json", "w");
		fwrite($form, $EndC);
		fwrite($Editor, $EndD);
		fclose($Editor);
		fclose($form);

		?>
<!-- ec-if: registedDonation() -->
<script type="text/javascript">
	alert("EveryWEAR: 기부요청해주셔서 감사합니다.\n양식을 검토한후 이메일로 연락드리겠습니다.");
	window.location.replace("/findMy");
</script>



		<?php
	} else {
		header("HTTP/1.1 400 Bad Request");
		echo "400 bad request<br>";
		echo "<hr>유효하지 않은 요청입니다.";
	}
?>