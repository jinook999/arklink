<?php /* Template_ 2.2.8 2025/11/26 15:07:15 /gcsd33_arklink/www/data/skin/respon_default/index.html 000032858 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<div id="popup_contents">
<?php $this->print_("popup_open",$TPL_SCP,1);?>

</div>
<style>
#contents_wrap{padding:0;width:100%;max-width:100%;padding:0;}
.main_quick li a.scr_top.ver_m{display: none;}
@media only screen and (max-width:1024px){
	.main_quick li a.scr_top.ver_pc{display: none;}
	.main_quick li a.scr_top.ver_m{display: flex;}
}
</style>
<div id="fullpage">
	<div id="section01" class="section">
		<!-- 메인 이미지 슬라이드 -->
		<div class="visual_wrapper" >
			<div class="main_visual">
				<ul class="visual_ul">
				</ul>
				<div class="visual_btn_wrap main_w_custom">
					<div class="visual_dots"></div>
					<button type="submit" class="prev arw"></button>
					<button type="submit" class="next arw"></button>
					<div class="play_btn_box">
						<div id="slickBtn" class="slickBtn slickPause">pause</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="section02" class="section">
		<div class="main_contact">
			<div class="main_w_custom">
			<div class="main_title" data-aos="fade-up">
				<h3>CONTACT US</h3>
			</div>
				<div class="main_board">
					<div class="board_box" data-aos="fade-up">
						<div class="title">
							<h4><a href="/board/board_list?code=inquiry">실시간 해결 문의 <span></span></a></h4>
							<div class="arw_box">
								<div class="prev swipe_arw"></div>
								<div class="next swipe_arw"></div>
							</div>
						</div>
						<div class="board_conatiner swiper-container">
<?php $this->print_("inquiry_display",$TPL_SCP,1);?>

						</div>
					</div>
					<div class="board_box" data-aos="fade-up">
						<div class="title">
							<h4><a href="/board/board_list?code=review">솔루션 진행 후기 <span></span></a></h4>
							<div class="arw_box">
								<div class="prev swipe_arw"></div>
								<div class="next swipe_arw"></div>
							</div>
						</div>
						<div class="board_conatiner swiper-container">
<?php $this->print_("review_display",$TPL_SCP,1);?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="section03" class="section">
		<div class="main_award">
			<div class="main_w_custom">
				<div class="main_title" data-aos="fade-up"><h3>Awards · Certificates</h3></div>
				<div class="award_box">
					<div class="tab" data-aos="fade-up">
						<a href="" class="on" data-tab="award">Awards</a>
						<a href="" class="" data-tab="certificate">Certificates</a>
					</div>
					<div class="cont">
						<div id="award" class="on">
<?php $this->print_("patent_display",$TPL_SCP,1);?>

						</div>
						<div id="certificate">
<?php $this->print_("cert_display",$TPL_SCP,1);?>

						</div>
					</div>
				</div>
			</div>
			
		</div>
	</div>
	<div id="section04" class="section">
		<div class="main_special">
			<div class="main_w_custom">
				<div class="main_title" data-aos="fade-up"><h3>SPECIALIST</h3></div>
				<ul class="list" data-aos="fade-up">
					<li>
						<div class="info">
							<span>CEO</span>
							<p>박민재</p>
							<ul class="bullet_list">
								<li>사이버 위협 분석 및 특허 기술 연구 · 개발</li>
								<li>디지털 범죄 예방 교육</li>
								<li>몸캠피싱 범죄 피해자 심리 연구</li>
								<li>몸캠피싱 피해 해결 솔루션 구축</li>
							</ul>
						</div>
						<div class="thumb"><img src="/data/skin/respon_default/images/skin/speciallist01.png" alt="speciallist01"></div>
					</li>
					<li>
						<div class="info">
							<span>보안 기술 팀장</span>
							<p>김진욱</p>
							<ul class="bullet_list">
								<li>악성 앱 분석 홈페이지 개발 및 보안</li>
								<li>솔루션 프로그램 유지 보수</li>
								<li>빅데이터 기반 실시간 분석 기술 개발</li>
							</ul>
						</div>
						<div class="thumb"><img src="/data/skin/respon_default/images/skin/speciallist02.png" alt="speciallist02"></div>
					</li>
					<li>
						<div class="info">
							<span>모바일 솔루션 개발 기술 자문 위원</span>
							<p>백시영</p>
							<ul class="bullet_list">
								<li>現 인하대학교 공학대학원 교수</li>
								<li>INHA University Dr. degree</li>
								<li>AI 빅데이터 응용 모바일 솔루션 업그레이드</li>
								<li>실시간 패치 프로그램 개발 기술자문</li>
							</ul>
						</div>
						<div class="thumb"><img src="/data/skin/respon_default/images/skin/speciallist03.png" alt="speciallist03"></div>
					</li>
					<li>
						<div class="info">
							<span>피해 상담 법률 전문 위원</span>
							<p>김영대</p>
							<ul class="bullet_list">
								<li>서울대학교 법학과</li>
								<li>現 부산지방법원, 수원지방법원, 서울고등법원 판사</li>
								<li>現 종합 법률사무소 '대정' 대표 변호사</li>
							</ul>
						</div>
						<div class="thumb"><img src="/data/skin/respon_default/images/skin/speciallist04.png" alt="speciallist04"></div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<div id="section05" class="section">
		<div class="main_percent">
			<div class="main_w_custom">
			<div class="main_title" data-aos="fade-up">
				<h3>Why ARKLINK?</h3>
				<p>아크링크는 의뢰인을 빠른 일상 복귀를 최우선으로 생각합니다.</p>
			</div>
				<div class="sucess_box" data-aos="fade-up">
					<dl>
						<dt>해결 성공률</dt>
						<dd>
							<div class="cnt_box" data-aos="">
								<p class="counter n-count" data-count="99.91">0</p>	
							</div>
							<span>%</span>
						</dd>
					</dl>
				</div>
				<div class="percent_box" data-aos="fade-up">
					<dl>
						<dt>월 평균 문의 건수</dt>
						<dd>
							<div class="cnt_box" data-aos="">
								<p class="counter n-count" data-count="500">0</p>	
                                <p>+</p>
							</div>
						</dd>
					</dl>
					<dl>
						<dt>누적 해결 완료 건수</dt>
						<dd>
							<div class="cnt_box" data-aos="">
								<p class="counter n-count" data-count="100,000">0</p>	
                                <p>+</p>
							</div>
						</dd>
					</dl>
					<dl>
						<dt>해결 완료 시간</dt>
						<dd>
							<div class="cnt_box" data-aos="">
								<p class="counter n-count" data-count="24">0</p>	
							</div>
							<span>시간 이내</span>
						</dd>
					</dl>
				</div>
			</div>
		</div>
		<div class="txt_slide_wrap" data-aos="fade-up">
			<div class="txt_slide">
				<p>Expert Solutions for Online Safety and Security</p>
				<p>Expert Solutions for Online Safety and Security</p>
			</div>
		</div>
	</div>
	<div id="section06" class="section">
		<div class="main_solution">
			<div class="main_w_custom">
				<div class="solution_box">
					<div class="txt_box">
					<div class="main_title" data-aos="fade-up">
						<h3>SOLUTION</h3>
					</div>
						<ul class="list ver_pc" data-aos="fade-up">
							<li class="on" data-tab="solution01">
								<div class="title">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution01.svg" alt="main_solution01"></div>
									<dl>
										<dt>Deep-Coding</dt>
										<dd>악성코드 심층 분석 및 방어기제 파훼 솔루션</dd>
									</dl>
								</div>
							</li>
							<li data-tab="solution02">
								<div class="title">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution02.svg" alt="main_solution02"></div>
									<dl>
										<dt>Data-Swapjack</dt>
										<dd>데이터셋 변조를 통한 유포 가로채기</dd>
									</dl>
								</div>
							</li>
							<li data-tab="solution03">
								<div class="title">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution03.png" alt="main_solution03"></div>
									<dl>
										<dt>Ridentify</dt>
										<dd>사회 인식 조정을 통한 인격 보호 솔루션</dd>
									</dl>
								</div>
							</li>
							<li data-tab="solution04">
								<div class="title">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution04.svg" alt="main_solution04"></div>
									<dl>
										<dt>DeterOS</dt>
										<dd>악의적 메시지 차단기제 활성화 유도</dd>
									</dl>
								</div>
							</li>
							<li data-tab="solution05">
								<div class="title">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution05.svg" alt="main_solution05"></div>
									<dl>
										<dt>Aegis</dt>
										<dd>가해자 유포 · 협박 통합 보호 솔루션</dd>
									</dl>
								</div>
							</li>
							<li data-tab="solution06">
								<div class="title">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution06.svg" alt="main_solution06"></div>
									<dl>
										<dt>Deep Scan</dt>
										<dd>불법 콘텐츠 추적 및 삭제</dd>
									</dl>
								</div>
							</li>
						</ul>
						<ul class="list ver_m" data-aos="fade-up">
							<li class="">
								<div class="title">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution01.svg" alt="main_solution01"></div>
									<dl>
										<dt>Deep-Coding</dt>
										<dd>악성코드 심층 분석 및 방어기제 파훼 솔루션</dd>
									</dl>
								</div>
								<div class="solution_cont">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution01.svg" alt="main_solution01"></div>
									<div class="txt">
										<p>악성코드 심층 분석 및 방어기제 파훼 솔루션</p>
										<strong>Deep-Coding</strong>
										<span>자체 개발한 자동 심층 분석 알고리즘을 통해 악성 앱 전체를 스캔합니다. 악성 앱의 취약점을 파악하고 방어 기제를 파훼하여 솔루션을 적용합니다.</span>
										<div class="main_more_box">
											<a href="/solution/deep" class="btn_more"><span>자세히보기</span></a>
											<a href="https://drphishing.ai/" class="btn_more btn_b" target="_blank"><span>체험하러가기</span></a>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="title">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution02.svg" alt="main_solution02"></div>
									<dl>
										<dt>Data-Swapjack</dt>
										<dd>데이터셋 변조를 통한 유포 가로채기</dd>
									</dl>
								</div>
								<div class="solution_cont">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution02.svg" alt="main_solution02"></div>
									<div class="txt">
										<p>데이터셋 변조를 통한 유포 가로채기</p>
										<strong>Data-Swapjack</strong>
										<span>C&C 서버의 피해 데이터를 가상의 데이터셋으로 바꿔치기하여 유포 데이터를 가로채 빼앗아오는 듯한 현상을 유발합니다.</span>
										<div class="main_more_box">
											<a href="/solution/data" class="btn_more"><span>자세히보기</span></a>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="title">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution03.png" alt="main_solution03"></div>
									<dl>
										<dt>Ridentify</dt>
										<dd>사회 인식 조정을 통한 인격 보호 솔루션</dd>
									</dl>
								</div>
								<div class="solution_cont">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution03.png" alt="main_solution03"></div>
									<div class="txt">
										<p>사회 인식 조정을 통한 인격 보호 솔루션</p>
										<strong>Ridentify</strong>
										<span>자체 개발 안면인식 기술을 통해 타인의 시선을 재규정, 재정의하여 피해자에 대한 부적절한 시선으로부터 의뢰인의 인격을 보호합니다.</span>
										<div class="main_more_box">
											<a href="/solution/ridentify" class="btn_more"><span>자세히보기</span></a>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="title">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution04.svg" alt="main_solution04"></div>
									<dl>
										<dt>DeterOS</dt>
										<dd>악의적 메시지 차단기제 활성화 유도</dd>
									</dl>
								</div>
								<div class="solution_cont">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution04.svg" alt="main_solution04"></div>
									<div class="txt">
										<p>악의적 메시지 차단기제 활성화 유도</p>
										<strong>DeterOS</strong>
										<span>유포 대상이 피해 데이터를 수신했을 때 열람하지 않고 차단하도록 범죄심리 기반의 기술을 통해 사전에 차단기제를 활성화시킵니다.</span>
										<div class="main_more_box">
											<a href="/solution/deteros" class="btn_more"><span>자세히보기</span></a>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="title">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution05.svg" alt="main_solution05"></div>
									<dl>
										<dt>Aegis</dt>
										<dd>가해자 유포 · 협박 통합 보호 솔루션</dd>
									</dl>
								</div>
								<div class="solution_cont">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution05.svg" alt="main_solution05"></div>
									<div class="txt">
										<p>가해자 유포 · 협박 통합 보호 솔루션</p>
										<strong>Aegis</strong>
										<span>가해자의 유포 행위를 억제하고 사용 계정이 정지되도록 유도하여 피해 데이터가 확산되는 것을 지연시키거나 방지합니다.</span>
										<div class="main_more_box">
											<a href="/solution/aegis" class="btn_more"><span>자세히보기</span></a>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="title">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution06.svg" alt="main_solution06"></div>
									<dl>
										<dt>Deep Scan</dt>
										<dd>불법 콘텐츠 추적 및 삭제</dd>
									</dl>
								</div>
								<div class="solution_cont">
									<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution06.svg" alt="main_solution06"></div>
									<div class="txt">
										<p>불법 콘텐츠 추적 및 삭제</p>
										<strong>Deep Scan</strong>
										<span>기준 이미지 한 장만으로 인터넷상 원본 / 변조 이미지를 탐색하여 삭제합니다. 신원 특정 방해를 위해 편집 (모자이크 등)된 자료도 식별할 수 있습니다.</span>
										<div class="main_more_box">
											<a href="/solution/scan" class="btn_more"><span>자세히보기</span></a>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</div>
					<div class="cont ver_pc">
						<ul>
							<li class="on" id="solution01">
								<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution01.svg" alt="main_solution01"></div>
								<div class="txt">
									<p>악성코드 심층 분석 및 방어기제 파훼 솔루션</p>
									<strong>Deep-Coding</strong>
									<span>자체 개발한 자동 심층 분석 알고리즘을 통해 악성 앱 전체를 스캔합니다. <br><br class="m_br">악성 앱의 취약점을 파악하고 방어 기제를 파훼하여 솔루션을 적용합니다.</span>
									<div class="main_more_box">
										<a href="/solution/deep" class="btn_more"><span>자세히보기</span></a>
										<a href="https://drphishing.ai/" class="btn_more btn_b" target="_blank"><span>체험하러가기</span></a>
									</div>
								</div>
							</li>
							<li id="solution02">
								<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution02.svg" alt="main_solution02"></div>
								<div class="txt">
									<p>데이터셋 변조를 통한 유포 가로채기</p>
									<strong>Data-Swapjack</strong>
									<span>C&C 서버의 피해 데이터를 가상의 데이터셋으로 바꿔치기하여 <br>유포 데이터를 가로채 빼앗아오는 듯한 현상을 유발합니다.</span>
									<div class="main_more_box">
										<a href="/solution/data" class="btn_more"><span>자세히보기</span></a>
									</div>
								</div>
							</li>
							<li id="solution03">
								<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution03.png" alt="main_solution03"></div>
								<div class="txt">
									<p>사회 인식 조정을 통한 인격 보호 솔루션</p>
									<strong>Ridentify</strong>
									<span>자체 개발 안면인식 기술을 통해 타인의 시선을 재규정, 재정의하여 <br>피해자에 대한 부적절한 시선으로부터 의뢰인의 인격을 보호합니다.</span>
									<div class="main_more_box">
										<a href="/solution/ridentify" class="btn_more"><span>자세히보기</span></a>
									</div>
								</div>
							</li>
							<li id="solution04">
								<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution04.svg" alt="main_solution04"></div>
								<div class="txt">
									<p>악의적 메시지 차단기제 활성화 유도</p>
									<strong>DeterOS</strong>
									<span>유포 대상이 피해 데이터를 수신했을 때 열람하지 않고 차단하도록 <br>범죄심리 기반의 기술을 통해 사전에 차단기제를 활성화시킵니다.</span>
									<div class="main_more_box">
										<a href="/solution/deteros" class="btn_more"><span>자세히보기</span></a>
									</div>
								</div>
							</li>
							<li id="solution05" >
								<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution05.svg" alt="main_solution05"></div>
								<div class="txt">
									<p>가해자 유포 · 협박 통합 보호 솔루션</p>
									<strong>Aegis</strong>
									<span>가해자의 유포 행위를 억제하고 사용 계정이 정지되도록 유도하여 <br>피해 데이터가 확산되는 것을 지연시키거나 방지합니다.</span>
									<div class="main_more_box">
										<a href="/solution/aegis" class="btn_more"><span>자세히보기</span></a>
									</div>
								</div>
							</li>
							<li id="solution06">
								<div class="img"><img src="/data/skin/respon_default/images/skin/main_solution06.svg" alt="main_solution06"></div>
								<div class="txt">
									<p>불법 콘텐츠 추적 및 삭제</p>
									<strong>Deep Scan</strong>
									<span>기준 이미지 한 장만으로 인터넷상 원본 / 변조 이미지를 탐색하여 삭제합니다. <br><br class="m_br">신원 특정 방해를 위해 편집 (모자이크 등)된 자료도 식별할 수 있습니다.</span>
									<div class="main_more_box">
										<a href="/solution/scan" class="btn_more"><span>자세히보기</span></a>
									</div>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="section07" class="section">
		<div class="main_gallery">
			<div class="main_w_custom">
				<div class="title_box">
				<div class="main_title">
					<h3>CONTENTS</h3>
					<p>아크링크는 의뢰인을 빠른 일상 복귀를 최우선으로 생각합니다.</p>
				</div>
					<div class="arw_box">
						<div class="prev swipe_arw"></div>
						<div class="next swipe_arw"></div>
					</div>
				</div>
				<div class="gallery_box swiper-container">
<?php $this->print_("gallery_display",$TPL_SCP,1);?>

				</div>
			</div>
		</div>
	</div>
	<div id="section08" class="section fp-auto-height">
<?php $this->print_("footer",$TPL_SCP,1);?>

	</div>
</div>


<link type="text/css" rel="stylesheet" href="/data/skin/respon_default/css/fullpage.css" />
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullPage.js/3.0.8/vendors/scrolloverflow.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/fullPage.js/3.0.8/fullpage.js"></script>
<script type="text/javascript">
	var confData = JSON.parse('<?php echo json_encode($TPL_VAR["main_image_slide"]["pc"][$TPL_VAR["lang"]])?>');
		confData.files = confData.files || {};
	$(window).resize(function() {
		// 팝업 이벤트 호출
<?php if(isset($TPL_VAR["popup_list"]['popup_list'])){?>
			var winWidth = $(window).width();
<?php if(is_array($TPL_R1=$TPL_VAR["popup_list"]['popup_list'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
<?php if(get_cookie('popup_'.$TPL_V1["no"],true)!='y'){?>
					var popupWidth = 0, popupHeight = 0, popupToppx = 0, popupLeftpx = 0;
					var isMobile = false;
					var agentInitial = '';
<?php if($TPL_V1["popupform"]=="responsive"){?>
						if(winWidth >= Number(<?php echo $TPL_V1["recognition_pc"]?>)){
							popupWidth = Number(<?php echo $TPL_V1["width_responsive_pc"]?>);
							popupHeight = Number(<?php echo $TPL_V1["height_responsive_pc"]?>);
							popupToppx = Number(<?php echo $TPL_V1["toppx_responsive_pc"]?>);
							popupLeftpx = Number(<?php echo $TPL_V1["leftpx_responsive_pc"]?>);
							agentInitial = 'pc';
						} else if(winWidth >= Number(<?php echo $TPL_V1["recognition_tablet"]?>)){
							popupWidth = Number(<?php echo $TPL_V1["width_responsive_tablet"]?>);
							popupHeight = Number(<?php echo $TPL_V1["height_responsive_tablet"]?>);
							popupToppx = Number(<?php echo $TPL_V1["toppx_responsive_tablet"]?>);
							popupLeftpx = Number(<?php echo $TPL_V1["leftpx_responsive_tablet"]?>);
							agentInitial = 't';
						}else {
							popupWidth = Number(<?php echo $TPL_V1["width_responsive_mobile"]?>);
							popupHeight = Number(<?php echo $TPL_V1["height_responsive_mobile"]?>);
							popupToppx = Number(<?php echo $TPL_V1["toppx_responsive_mobile"]?>);
							popupLeftpx = Number(<?php echo $TPL_V1["leftpx_responsive_mobile"]?>);
							isMobile = true;
							agentInitial = 'm';
						}

<?php if($TPL_V1["type"]=='1'){?>
							if($('#popup_<?php echo $TPL_V1["no"]?>').length > 0){
								var popupObj = $('#popup_<?php echo $TPL_V1["no"]?>');

								if (isMobile){
									if(popupObj.css('width') != popupWidth+'px'){
										popupObj.css('width', popupWidth + '%');
									}
								}else{
									if(popupObj.css('width') != popupWidth+'px'){
										popupObj.css('width', popupWidth + 'px');
									}
								}

								/*if (isMobile){	
									if(popupObj.css('height') != popupHeight+'px'){
									}
								}else{
									if(popupObj.css('height') != popupHeight+'px'){
										popupObj.css('height', popupHeight + 'px');
									}
								}*/

								if(popupObj.css('top') != popupToppx+'px'){
									popupObj.css('top', popupToppx + 'px');
								}

								if (isMobile){
									popupObj.css('left', '50%');
									popupObj.css('height', 'auto');
								}else{
									if(popupObj.css('left') != popupLeftpx+'px'){
										popupObj.css('left', popupLeftpx + 'px');
									}
								}

								if (popupObj.hasClass('layer_pc')){
									popupObj.removeClass('layer_pc');
								}else if(popupObj.hasClass('layer_t')){
									popupObj.removeClass('layer_t');
								}else if(popupObj.hasClass('layer_m')){
									popupObj.removeClass('layer_m');
								}
								popupObj.addClass('layer_'+agentInitial);
							}
<?php }else{?>
							var popup_options = 'width='+popupWidth+',height='+popupHeight+',top='+popupToppx+',left='+popupLeftpx+',status=no,resizable=no,scrollbars=yes'; 
							var popup_html = '<?php echo addslashes(htmlspecialchars_decode($TPL_V1["content"]))?>';
							popup_html += '<div style="float:right; margin-bottom:5px; margin-right:15px;">';
							popup_html += '	<label><input type="checkbox" value="<?php echo $TPL_V1["no"]?>" onChange="opener.noShow(this);">하루 동안 보지않기</label> <a href="javascript:this.close();">닫기</a>';
							popup_html += '</div>';
							if(typeof(popup_<?php echo $TPL_V1["no"]?>) == 'object') {
								var addressHeight = popup_<?php echo $TPL_V1["no"]?>.outerHeight - popup_<?php echo $TPL_V1["no"]?>.innerHeight;//주소 표시줄 높이
								popup_<?php echo $TPL_V1["no"]?>.resizeTo(popupWidth+(popup_<?php echo $TPL_V1["no"]?>.outerWidth - popup_<?php echo $TPL_V1["no"]?>.innerWidth), popupHeight+addressHeight);
								popup_<?php echo $TPL_V1["no"]?>.moveTo(popupToppx, popupLeftpx);
								console.log(popup_options);
							}
<?php }?>
<?php }?>
<?php }?>
<?php }}?>
<?php }?>
	});
	// 메인 슬라이드 관련 소스
		$(document).ready(function($) {
<?php if($TPL_VAR["main_image_slide"]["pc"][$TPL_VAR["lang"]]["form"]=='responsive'){?>//반응형 js
				//기본 기능 정의
					// confData.responsive 가 없을경우 초기화
					confData.responsive = confData.responsive || {};
					confData.responsive.pc = confData.responsive.pc || {};
					confData.responsive.tablet = confData.responsive.tablet || {};
					confData.responsive.mobile = confData.responsive.mobile || {};
					confData.files.responsive = confData.files.responsive || {};
					var currMod = '';

					var width = $(window).width();
					var mode = 'mobile';
					if(width >= Number(confData.responsive.pc.width)){
						mode = 'pc';
					} else if(width >= Number(confData.responsive.tablet.width)){
						mode = 'tablet';
					}	
				//슬라이드 변수 
					//슬라이드 공통 변수
						var $imageSlider;
						$imageSlider = $('.visual_ul');
					//재생, 일시정지 변수 정의
						var isPause;
					//프로그래스바 사용시 변수 정의
						var visusltime = Number(confData.responsive[mode].time || 3);
						var $bar,
							tick,
							percentTime;
						$bar = $('.visual_wrapper .slider-progress .progress');
				//슬라이드 반응형 (*리사이즈시 반복재실행됨)
					function slideResize(){
						var width = $(window).width();
						var mode = 'mobile';
						if(width >= Number(confData.responsive.pc.width)){
							mode = 'pc';
						} else if(width >= Number(confData.responsive.tablet.width)){
							mode = 'tablet';
						}

					//add class active
						if((confData.responsive[mode].mode === 'fade')){
							$imageSlider.on('init',function (event, slick) {
								setTimeout(function  () {
									$(".slick-slide").eq(0).addClass("active");
								},500);
							});

							$imageSlider.on('afterChange',function  (event, slick, currentSlide) {
								$(".slick-slide").removeClass("active");
								$(this).find(".slick-slide").eq(currentSlide).addClass("active");
							});

						}
						else{
							$imageSlider.on('init',function (event, slick) {
								setTimeout(function  () {
									$(".slick-slide").eq(1).addClass("active");
								},500);
							});

							$imageSlider.on('afterChange',function  (event, slick, currentSlide) {
								$(".slick-slide").removeClass("active");
								$(this).find(".slick-slide").eq(currentSlide + 1).addClass("active");
							});
						}

						$imageSlider.on('init reInit afterChange', function (event, slick, currentSlide, nextSlide) {//currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
							var i = (currentSlide ? currentSlide : 0) + 1;
							$('.visual_wrapper').find('.slideCountItem').html('' + i + '');
							$('.visual_wrapper').find('.slideCountAll').html('0' + slick.slideCount + '');
						});//페이지 넘길때, 숫자 카운트

						if(currMod !== mode){
							if(currMod !== ''){
								$imageSlider.slick('unslick');
							}
							currMod = mode;
							$imageSlider.html(makeLiTag(mode, (confData.files.responsive[mode] || [])));
							$imageSlider.one('init', function(event, slick) { })

							$imageSlider.slick({
								vertical: (confData.responsive[mode].mode === 'vertical'),
								fade: (confData.responsive[mode].mode === 'fade'),
								// -- 아래에 추가옵션을 입력해주세요
								infinite: true,
								speed: Number(confData.responsive[mode].speed || 1000),
								autoplaySpeed: Number(confData.responsive[mode].time || 3) * 1000,
								arrows: true,
								prevArrow: $('.main_visual .prev'),
								nextArrow: $('.main_visual .next'),
								dots: true,
								appendDots: $('.visual_dots'),
								autoplay: true,//progress bar 사용시 false 값으로 두어야 오류가 없습니다. false 값이어도 progress bar 설정되어있으면 자동롤링이 됩니다. 타입B, 타입C 사용시 true로 변경
								pauseOnHover:false,
							}).on('beforeChange', function(event, slick, currentSlide, nextSlide) {
								$('.visual_wrapper').find('.slideCountItem').html(nextSlide + 1);
							});//페이지 넘길때, 숫자 카운트

							//재생, 일시정지 버튼
							$(".visual_wrapper .slickBtn").click(function() {
								$(this).toggleClass("play");
								if ($(this).hasClass("play")) {
									isPause = true;
									$(this).removeClass('slickPause').addClass('slickPlay').html('play');
									$imageSlider.slick('slickPause');
									$bar.css({
										width: 100 + "%"
									});//재생, 일시정지 버튼 작동시 프로그래스바
								} else {
									isPause = false;
									$(this).removeClass('slickPlay').addClass('slickPause').html('pause');
									$imageSlider.slick('slickPlay');
								}
							});
							//재생, 일시정지 버튼
						}
					}			
					slideResize();
				//리사이즈 슬라이드 재실행
					$(window).resize(function() {
<?php if($TPL_VAR["main_image_slide"]["pc"][$TPL_VAR["lang"]]["form"]=='responsive'){?>
							slideResize();
<?php }?>
					});
<?php }else{?>//고정형 js
				//기본 기능 정의
					// confData.fixed 가 없을경우 초기화
					confData.fixed = confData.fixed || {};
					$imageSlider.html(makeLiTag('fixed', (confData.files.fixed || [])));
				//슬라이드 적응형
					$imageSlider.slick({
						vertical: (confData.fixed.mode === 'vertical'),
						fade: (confData.fixed.mode === 'fade'),
						// -- 아래에 추가옵션을 입력해주세요
						autoplay: true,
						dots: true,
						arrows: false
					});
<?php }?>
		});

	// 메인 슬라이드 슬라이드 컷 내부
		function makeLiTag(type, file){
			var path = '/upload/main/imageSlide/<?php echo $TPL_VAR["lang"]?>/' + (['pc', 'tablet', 'mobile'].indexOf(type) > -1? 'responsive/' + type + '/' : 'fixed/');
			var li = '';
			var txt = [
                `<p><span class='txtAni'>몸캠피싱 대응 플랫폼 닥터피싱 X 아크링크</span></p>`,
                `<p><span class='txtAni'>인하대학교 X 아크링크</span></p>`,
                `<p><span class='txtAni'>마인드카페 X 아크링크</span></p>`,
                `<p><span class='txtAni'>종합법률사무소 대정 X 아크링크</span></p>`,
                `<p><span class='txtAni'>Towards Safety, Towards Freedom.</span></p>`

            ];
			    		var txt2 = [
                `<h2><div><span class='txtAni'>실시간 악성 앱 분석 기능 제공</span></div></h2>`,
				`<h2><div><span class='txtAni'>디지털 범죄 대응 기술 <br class="for_pc">연구 협약 MOU 체결</span></div></h2>`,
                `<h2><div><span class='txtAni'>몸캠피싱 피해자 <br class="for_pc">심리 지원 캠페인</span></div></h2>`,
                `<h2><div><span class='txtAni'>디지털 범죄 피해자 <br class="for_pc">법률 상담 지원</span></div></h2>`,
                `<h2><div><span class='txtAni'>아크링크가 안전한 디지털 환경과 <br class="for_pc">더 나은 내일을 연결합니다.</span></div></h2>`

            ];
			for(var i=0; i<file.length; i++) {
				var lnk = file[i].link ? file[i].link : "#";
				li += '<li class="main_bnr' + [i] + '">';
				//li += '<a href="' + lnk + '" class="link"></a>';
				li += '<div class="txt_box main_w_custom">'+ txt[i] + txt2[i];
				if(i == '0'){
					li += '<a href="https://drphishing.ai/" class="more" target="blank"><span>체험하기</span></a>';
				} else if(i == '2'){
					li += '<a href="https://center.mindcafe.co.kr/event/90249" class="more" target="blank"><span>바로가기</span></a>';
				} else {
					li += '<a href="javascript:void(0);" onclick="ChannelIO(\'show\');" class="more"><span>문의하기</span></a>';					
				}

				li += '</div>';
				li += '<div class="thumb" style="background-image:url(' + path + file[i].fname + ')"></div>';
				li += '</li>';
			}
			return li;
		}

</script>