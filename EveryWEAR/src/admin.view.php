<?php include 'module/default.php';?>
<?php 
	$title = "viewAll";
	$d_data = json_decode(file_get_contents("./data.json"),true);

	include 'module/loginService.php';
	if ($_SESSION["EWUID"] !== "everywear0512@gmail.com") {
		header("HTTP/1.1 403 Forbidden");
		exit("로그인 ID를 확인하세요.<br>허가받지 아니한 ID로 들어오셨습니다.");
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
			<div class="table-users">
			   <div class="header">전체 기부 신청 목록</div>
			   
			   <table cellspacing="0">
			      <tr>
			      	 <th>신청 ID</th>
			         <th>기부신청인</th>
			         <th>후원금</th>
			         <th>기부옷 수량</th>
			         <th>기부신청일시</th>
			         <th width="230">상세정보</th>
			      </tr>
			      <?php 
			      	for ($i=count($d_data)-1; $i >= 0; $i--) { 
			      		$lenderD = $d_data[$i];
			      		echo "<tr>
			      			<td>".$lenderD["D_id"]."</td>
							<td>".$lenderD["D_name"]."</td>
							<td>".$lenderD["D_monny"]."원</td>
							<td>".$lenderD["D_quantity"]."</td>
							<td>".$lenderD["D_submit"]."</td>
							<td>".$lenderD["D_detail"]."</td>
						</tr>";
			      	}
			      ?>
			      

			   </table>
			</div>
			<style type="text/css">.header{background-color:#327a81;color:#fff;font-size:1.5em;padding:1rem;text-align:center;text-transform:uppercase}.table-users{border:1px solid #327a81;border-radius:10px;box-shadow:3px 3px 0 rgba(0,0,0,0.1);max-width:calc(100% - 2em);margin:1em auto;overflow:scroll;width:800px}table{width:100%}table td,table th{color:#2b686e;padding:10px}table td{text-align:center;vertical-align:middle}table td:last-child{font-size:.95em;line-height:1.4;text-align:left}table th{background-color:#daeff1;font-weight:300}table tr:nth-child(2n){background-color:#fff}table tr:nth-child(2n+1){background-color:#edf7f8}@media screen and (max-width: 700px){table,tr,td{display:block}td:first-child{position:absolute;top:50%;-webkit-transform:translateY(-50%);transform:translateY(-50%);width:100px}td:not(:first-child){clear:both;margin-left:100px;padding:4px 20px 4px 90px;position:relative;text-align:left}td:not(:first-child):before{color:#91ced4;content:'';display:block;left:0;position:absolute}td:nth-child(2):before{content:'Name:'}td:nth-child(3):before{content:'Email:'}td:nth-child(4):before{content:'Phone:'}td:nth-child(5):before{content:'Comments:'}tr{padding:10px 0;position:relative}tr:first-child{display:none}}@media screen and (max-width: 500px){.header{background-color:transparent;color:#fff;font-size:2em;font-weight:700;padding:0;text-shadow:2px 2px 0 rgba(0,0,0,0.1)}img{border:3px solid;border-color:#daeff1;height:100px;margin:.5rem 0;width:100px}td:first-child{background-color:#c8e7ea;border-bottom:1px solid #91ced4;border-radius:10px 10px 0 0;position:relative;top:0;-webkit-transform:translateY(0);transform:translateY(0);width:100%}td:not(:first-child){margin:0;padding:5px 1em;width:100%}td:not(:first-child):before{font-size:.8em;padding-top:.3em;position:relative}td:last-child{padding-bottom:1rem!important}tr{background-color:#fff!important;border:1px solid #6cbec6;border-radius:10px;box-shadow:2px 2px 0 rgba(0,0,0,0.1);margin:.5rem 0;padding:0}.table-users{border:none;box-shadow:none;overflow:visible}}</style>
		</div>
	<?php if (!$pjax): ?></div>
	<?php include 'module/footer.set.php'; ?>
</body>
</html><?php endif ?>