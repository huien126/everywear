<?php include 'module/default.php';?>
<?php 
	$title = "Order";

	include 'module/loginService.php';
?>
<?php if (!$pjax): ?>
<!DOCTYPE html>
<html <?=$htmlAttribute; ?>>
<?php include 'module/head.set.php'; ?>
<body>
	<?php include 'module/header.set.php'; ?>
	<div id="root"><?php endif ?>
		<div class="container" data-html-title="<?=$title; ?>">
			<h2>기부 양식 작성</h2>
			<p>기부를 하기 위하여 서류작업이 필요합니다. 다음의 양식을 채워주세요.</p>

			<div class="donation_order_container">
			  <form action="/donation/order/submit" method="post" id="donation_order">
			  <div class="row">
			    <div class="col wid-25">
			      <label for="donation_name">이름</label>
			    </div>
			    <div class="col wid-75">
			      <input type="text" id="donation_name" name="donation_name" placeholder="Your name.." required>
			    </div>
			  </div>
			  <div class="row">
			    <div class="col wid-25">
			      <label for="HM">기부의류 수량</label>
			    </div>
			    <div class="col wid-75">
			      <input type="number" id="HM" name="howMany" placeholder="[input] 벌" required>
			    </div>
			  </div>
			  <div class="row">
			    <div class="col wid-25">
			      <label for="support_monny">기부금액</label>
			    </div>
			    <div class="col wid-75">
			      <input type="number" id="support_monny" name="support_monny" placeholder="[input] KRW" required>
			    </div>
			  </div>
			  <div class="row">
			    <div class="col wid-25">
			      <label for="thing_type">종류</label>
			    </div>
			    <div class="col wid-75">
			      <select id="thing_type" name="thing_type" required>
			        <option value="type_top">상의</option>
			        <option value="type_bottom">하의</option>
			        <option value="type_unknown">기타(모자 등)</option>
			      </select>
			    </div>
			  </div>
			  <div class="row">
			    <div class="col wid-25">
			      <label for="detail">세부</label>
			    </div>
			    <div class="col wid-75">
			      <textarea id="detail" name="detail" placeholder="저희에게 이 옷에 대하여 자세히 설명해 주실 수 있나요?&#13;&#10;Ex. 옷의 소재, 사이즈, 내의 구분 등" required></textarea>
			    </div>
			  </div>
			  <div class="row">
			    <input type="submit" value="제출">
			  </div>
			  </form>
			</div>
		</div>
	<?php if (!$pjax): ?></div>
	<?php include 'module/footer.set.php'; ?>
</body>
</html><?php endif ?>