<?php include 'module/default.php';?>
<?php 
	$title = "greeting";
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
			
			<section class="greet greet-intro">
				<h2>안녕하세요. 저희는 EveryWEAR입니다.</h2>

				<div class="greet-box">

					<p>Beyond Wearing, EveryWEAR</p>
					<p>EveryWEAR은 지속 가능한 발전이 주목받고 있으며, 개발도상국과 선진국의 협력을 통한 발전이 강조되고 있는 21세기 국제 사회에 기여하기 위한, 적정기술 무역 태스크포스팀입니다. 비즈쿨 사업을 바탕으로, 국내에 존재하고 있는 많은 공동체들과 협력하여, 폐 의류를 기부 형태로 개발도상국에 수출하는 형태의 적정기술 무역, 공정 무역을 통하여, 버려지는 폐의류들로부터 발생하는 환경적 문제는 물론, 경제적 가치와 사회적 가치를 창출하는, 지속 가능한 발전에 적합한 시스템을 점차 구축하고 있습니다.</p>
					<p>EveryWEAR는 1차적으로 스리랑카와 몽골에 해당 사업을 실제로 시험적으로 실시할 예정입니다. 그리고 구체적인 방안과 로드맵을 통하여, 지속 가능한 발전과 국제 사회에 대한 기여라는 팀의 모토에 걸맞는 아웃풋을 만들기 위하여 계속하여 노력하고 있겠습니다.</p>
					<p>&nbsp;</p>
					<p>EveryWEAR은 옷만이 아니라, 다른 필요 없는 생활필수품들은 물론, 영화, 드라마, 음악, KPOP 등을 통하여 대한민국의 문화 역시 함께 개발도상국에게 전달하고, 지원하는 활동을 계획중입니다.</p>
				</div>
			</section>

			<section class="greet greet-president">
				<h2>EveryWEAR은 왜 만들어졌을까요?</h2>

				<p>안녕하세요, EveryWEAR Team의 팀장 강정규입니다.</p>
				<p>저희 EveryWEAR Team은 현재 대전광역시 서구에 위치하고 있는</p>
				<p>서대전고등학교에 재학중인 6명의 학생들로 이루어진 팀입니다.</p>
				<p>&nbsp;</p>
				<p>저희는 대한민국의 학생으로서 평소에 옷을 많이 사는 반면에, 입는 옷은 한정적이고, 실제 집에만 두고 </p>
				<p>안 입는 옷들이 많은 점을 항상 인지하고 있었습니다. 이러한 사실을 바탕으로 하여, 옷이 없어 청결하지 못한 바닥이나 강력한 햇빛으로 인하여 여러 불편함을 겪고 있는 제3세계의 친구들, 동생들에게 나눠주는 것이 위에서 언급한, 평소에 안 입는 옷의 활용도를 최대화시킬 수 있는 방법이라고 생각을 하게 되었습니다.</p>
				<p>&nbsp;</p>
				<p>그래서 저희 팀이 만든 것이 바로 EveryWEAR입니다.</p>
				<p>&nbsp;</p>
				<p>EveryWEAR는 여러분이 평소에 입지 않는 옷들을 기부받아, 이를 모아 제3세계에 있는 여러 아이들, 친구들에게 보내드립니다. 그리고, 투명한 기부의 과정을 위하여 여러분이 기부하신 옷이 현재 어떠한 과정을 통하여 운송되고 있는지, 어떠한 곳으로 가고 있는지, 그리고 그 옷들이 실제로 도착을 하였는지 등을 직접 알려드립니다.</p>
				<p>&nbsp;</p>
				<p>여러분께서 기쁜 마음으로 보내주신 옷들이, 얼마나 많은 도움과 사랑의 표시가 될 수 있는지를 직접 보여드리도록 하겠습니다.</p>
				<p>&nbsp;</p>
				<p>이상,</p>
				<p>여러분의 선행을, 실감하실 수 있도록 하는 EveryWEAR이었습니다.</p>
				<img src="/image/main.<?=$imgExtention; ?>" alt="EveryWEAR Logo">
				<p>&nbsp;</p>
				<p>Transcending Wear, Everywhere, EveryWEAR.</p>
				<p>Jeonggyu Kang, Chief of the EveryWEAR Team.</p>
				<p>-2018.6.10-</p>
			</section>

		</div>
	<?php if (!$pjax): ?></div>
	<?php include 'module/footer.set.php'; ?>
</body>
</html><?php endif ?>