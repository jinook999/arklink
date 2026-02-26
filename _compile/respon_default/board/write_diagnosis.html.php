<?php /* Template_ 2.2.8 2026/01/12 10:38:08 /gcsd33_arklink/www/data/skin/respon_default/board/write_diagnosis.html 000041374 */ ?>
<form name="frm" id="frm" action="/board/board_write" target="ifr_processor" method="POST">
    <fieldset>
        <legend>게시글 작성</legend>
        <input type="hidden" name="write_userid" value="<?php echo $TPL_VAR["board_view"]['board_view']['userid']?>" />
        <input type="hidden" name="code" value="<?php echo $TPL_VAR["board_info"]['code']?>" />
        <input type="hidden" name="mode" value="<?php echo $TPL_VAR["board_info"]['mode']?>" />
        <input type="hidden" name="no" value="<?php echo $TPL_VAR["board_view"]['board_view']['no']?>" />
        <input type="hidden" name="cref" value="<?php echo $TPL_VAR["board_view"]['board_view']['cref']?>" />
        <input type="hidden" name="upload_path" value="<?php echo $TPL_VAR["board_view"]['board_view']['upload_path']?>" />
		<div class="diagnosis_cont step01">
			<!--이름-->
            <div class="item on">
                <div class="cont single">
                    <div class="sub_title">
                        <h4>이름 <em>*</em></h4>
                    </div>
                    <input type="text" name="name" id="name" value="<?php if($TPL_VAR["board_info"]['mode']=='write'||$TPL_VAR["board_info"]['mode']=='answer'){?><?php if(defined('_IS_LOGIN')){?><?php echo $TPL_VAR["member"]['name']?><?php }?><?php }else{?><?php echo $TPL_VAR["board_view"]['board_view']['name']?><?php }?>" <?php if($TPL_VAR["board_info"]['mode']=='write'||$TPL_VAR["board_info"]['mode']=='answer'){?><?php if(defined('_IS_LOGIN')){?>readonly<?php }?><?php }elseif($TPL_VAR["board_info"]['mode']=='modify'){?><?php if(defined('_IS_LOGIN')){?>readonly<?php }?><?php }?> placeholder="예) 홍길동"/>
                </div>
            </div>
			<!--이름-->
		<!--생년월일-->
		<div class="item item_birth">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex1']?> <em>*</em></h4>
                    </div>
                    <input type="text" name="ex1_kor" class="input ex_birth" value="<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']]['ex1']?>" placeholder="YYYY / MM / DD"/>
                </div>
            </div>
		<!--생년월일-->
		<!--성별-->
		<div class="item">
                <div class="cont single">
                    <div class="sub_title">
                        <h4>성별 <em>*</em></h4>
                    </div>
                    <select name="gender" id="gender">
						<option value="">선택하세요</option>
						<option value="남성" <?php if($TPL_VAR["board_view"]['board_view']['gender']=='남성'){?>selected<?php }?>>남성</option>
						<option value="여성" <?php if($TPL_VAR["board_view"]['board_view']['gender']=='여성'){?>selected<?php }?>>여성</option>
                    </select>
                </div>
            </div>
		<!--성별-->
		<!--전화번호-->
            <div class="item item_tel">
                <div class="cont single">
                    <div class="sub_title">
                        <h4>전화번호 <em>*</em></h4>
                    </div>
                    <input type="text" name="mobile" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['mobile']?>" placeholder="숫자만 입력해주세요."/>
                </div>
            </div>
			<!--전화번호-->
			<!--휴대폰 기종-->
            <div class="item phone_model">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex2']?> <em>*</em></h4>
                    </div>
					<select name="ex2_kor" id="">
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['option']['kor']['ex2']['item'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
						<option value="<?php echo $TPL_V1?>"><?php echo $TPL_V1?></option>
<?php }}?>
					</select>
                </div>
            </div>
			<!--휴대폰 기종-->
			<!--정확한 기종-->
            <div class="item">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex20']?> <em>*</em></h4>
                    </div>
                    <input type="text" name="ex20_kor" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']]['ex20']?>"/>
                </div>
            </div>
			<!--정확한 기종-->
			<!--피해일시-->
			<div class="item">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex3']?> <em>*</em></h4>
                    </div>
                    <ul class="data_list">
                        <li>
                            <div class="inp_box">
                                <dl class="sel_info">
                                    <dt><span>0000</span>.</dt>
                                    <dd class="selSwiper">
                                        <ul class="swiper-wrapper">
                                            <li class="swiper-slide"><a href="">2026</a></li>
                                            <li class="swiper-slide"><a href="">2025</a></li>
                                            <li class="swiper-slide"><a href="">2024</a></li>
                                            <li class="swiper-slide"><a href="">2023</a></li>
                                            <li class="swiper-slide"><a href="">2022</a></li>
                                            <li class="swiper-slide"><a href="">2021</a></li>
                                            <li class="swiper-slide"><a href="">2020</a></li>
                                            <li class="swiper-slide"><a href="">2019</a></li>
                                            <li class="swiper-slide"><a href="">2018</a></li>
                                            <li class="swiper-slide"><a href="">2017</a></li>
                                            <li class="swiper-slide"><a href="">2016</a></li>
                                            <li class="swiper-slide"><a href="">2015</a></li>
                                            <li class="swiper-slide"><a href="">2014</a></li>
                                            <li class="swiper-slide"><a href="">2013</a></li>
                                            <li class="swiper-slide"><a href="">2012</a></li>
                                            <li class="swiper-slide"><a href="">2011</a></li>
                                            <li class="swiper-slide"><a href="">2010</a></li>
                                        </ul>
                                    </dd>
                                </dl>
                                <dl class="sel_info">
                                    <dt><span>00</span>.</dt>
                                    <dd class="selSwiper">
                                        <ul class="swiper-wrapper">
                                            <li class="swiper-slide"><a href="">01</a></li>
                                            <li class="swiper-slide"><a href="">02</a></li>
                                            <li class="swiper-slide"><a href="">03</a></li>
                                            <li class="swiper-slide"><a href="">04</a></li>
                                            <li class="swiper-slide"><a href="">05</a></li>
                                            <li class="swiper-slide"><a href="">06</a></li>
                                            <li class="swiper-slide"><a href="">07</a></li>
                                            <li class="swiper-slide"><a href="">08</a></li>
                                            <li class="swiper-slide"><a href="">09</a></li>
                                            <li class="swiper-slide"><a href="">10</a></li>
                                            <li class="swiper-slide"><a href="">11</a></li>
                                            <li class="swiper-slide"><a href="">12</a></li>
                                        </ul>
                                    </dd>
                                </dl>
                                <dl class="sel_info">
                                    <dt><span>00</span></dt>
                                    <dd class="selSwiper">
                                        <ul class="swiper-wrapper">
                                            <li class="swiper-slide"><a href="">01</a></li>
                                            <li class="swiper-slide"><a href="">02</a></li>
                                            <li class="swiper-slide"><a href="">03</a></li>
                                            <li class="swiper-slide"><a href="">04</a></li>
                                            <li class="swiper-slide"><a href="">05</a></li>
                                            <li class="swiper-slide"><a href="">06</a></li>
                                            <li class="swiper-slide"><a href="">07</a></li>
                                            <li class="swiper-slide"><a href="">08</a></li>
                                            <li class="swiper-slide"><a href="">09</a></li>
                                            <li class="swiper-slide"><a href="">10</a></li>
                                            <li class="swiper-slide"><a href="">11</a></li>
                                            <li class="swiper-slide"><a href="">12</a></li>
                                            <li class="swiper-slide"><a href="">13</a></li>
                                            <li class="swiper-slide"><a href="">14</a></li>
                                            <li class="swiper-slide"><a href="">15</a></li>
                                            <li class="swiper-slide"><a href="">16</a></li>
                                            <li class="swiper-slide"><a href="">17</a></li>
                                            <li class="swiper-slide"><a href="">18</a></li>
                                            <li class="swiper-slide"><a href="">19</a></li>
                                            <li class="swiper-slide"><a href="">20</a></li>
                                            <li class="swiper-slide"><a href="">21</a></li>
                                            <li class="swiper-slide"><a href="">22</a></li>
                                            <li class="swiper-slide"><a href="">23</a></li>
                                            <li class="swiper-slide"><a href="">24</a></li>
                                            <li class="swiper-slide"><a href="">25</a></li>
                                            <li class="swiper-slide"><a href="">26</a></li>
                                            <li class="swiper-slide"><a href="">27</a></li>
                                            <li class="swiper-slide"><a href="">28</a></li>
                                            <li class="swiper-slide"><a href="">29</a></li>
                                            <li class="swiper-slide"><a href="">30</a></li>
                                            <li class="swiper-slide"><a href="">31</a></li>
                                        </ul>
                                    </dd>
                                </dl>
                            </div>
                        </li>
                        <li>
                            <div class="inp_box">
                                <dl class="sel_info gap">
                                    <dt><span>오전</span></dt>
                                    <dd class="selSwiper">
                                        <ul class="swiper-wrapper">
                                            <li class="swiper-slide"><a href="">오전</a></li>
                                            <li class="swiper-slide"><a href="">오후</a></li>
                                        </ul>
                                    </dd>
                                </dl>
                                <dl class="sel_info">
                                    <dt><span>00</span>:</dt>
                                    <dd class="selSwiper">
                                        <ul class="swiper-wrapper">
                                            <li class="swiper-slide"><a href="">01</a></li>
                                            <li class="swiper-slide"><a href="">02</a></li>
                                            <li class="swiper-slide"><a href="">03</a></li>
                                            <li class="swiper-slide"><a href="">04</a></li>
                                            <li class="swiper-slide"><a href="">05</a></li>
                                            <li class="swiper-slide"><a href="">06</a></li>
                                            <li class="swiper-slide"><a href="">07</a></li>
                                            <li class="swiper-slide"><a href="">08</a></li>
                                            <li class="swiper-slide"><a href="">09</a></li>
                                            <li class="swiper-slide"><a href="">10</a></li>
                                            <li class="swiper-slide"><a href="">11</a></li>
                                            <li class="swiper-slide"><a href="">12</a></li>
                                        </ul>
                                    </dd>
                                </dl>
                                <dl class="sel_info">
                                    <dt><span>00</span></dt>
                                    <dd class="selSwiper">
                                        <ul class="swiper-wrapper">
                                            <li class="swiper-slide"><a href="">00</a></li>
                                            <li class="swiper-slide"><a href="">05</a></li>
                                            <li class="swiper-slide"><a href="">10</a></li>
                                            <li class="swiper-slide"><a href="">15</a></li>
                                            <li class="swiper-slide"><a href="">20</a></li>
                                            <li class="swiper-slide"><a href="">25</a></li>
                                            <li class="swiper-slide"><a href="">30</a></li>
                                            <li class="swiper-slide"><a href="">35</a></li>
                                            <li class="swiper-slide"><a href="">40</a></li>
                                            <li class="swiper-slide"><a href="">45</a></li>
                                            <li class="swiper-slide"><a href="">50</a></li>
                                            <li class="swiper-slide"><a href="">55</a></li>
                                        </ul>
                                    </dd>
                                </dl>
                            </div>
                        </li>
                    </ul>
                    <input type="datetime-local" name="ex3_kor" class="dn flatpickr_date" value="<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']]['ex3']?>" placeholder="예) 2025.05.30 오전 14:30"/>
                </div>
            </div>
			<!--피해일시-->
			<!--sns 친구목록-->
			<div class="item step1_last sns_friend">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex4']?> <em>*</em></h4>
                    </div>
                    <select name="ex4_kor">
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['option']['kor']['ex4']['item'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
						<option value="<?php echo $TPL_V1?>"><?php echo $TPL_V1?></option>
<?php }}?>
                    </select> 
                </div>
            </div>
			<!--sns 친구목록-->
			<div class="btn_wrap">
				<a href="#" class="btn return">이전</a>
				<a href="#" class="btn btn_point">다음</a>
			</div>
        </div>
        <div class="diagnosis_cont step02">
			<!--접촉 어플-->
            <div class="item step2_first">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex5']?></h4>
                    </div>
                    <input type="text" name="ex5_kor" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']]['ex5']?>" placeholder="ex)인스타그램, 앙톡, 밤친구"/>
                </div>
            </div>
			<!--가해자 프로필 ID-->
			<div class="item">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex6']?></h4>
                    </div>
                    <input type="text" name="ex6_kor" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']]['ex6']?>" placeholder="예) abc1234(라인), aaddss(인스타그램)"/>
                </div>
            </div>
			<!--가해자 프로필 ID-->
			<!--영상 유포 여부-->
			<div class="item sns_friend iphone_before">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex7']?> </h4>
                    </div>
                    <select name="ex7_kor">
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['option']['kor']['ex7']['item'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
						<option value="<?php echo $TPL_V1?>"><?php echo $TPL_V1?></option>
<?php }}?>
                    </select> 
                </div>
            </div>
			<!--영상 유포 여부-->
			<!--아이클라우드-->
			<div class="item iphone_item">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex8']?></h4>
                    </div>
                    <select name="ex8_kor">
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['option']['kor']['ex8']['item'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
						<option value="<?php echo $TPL_V1?>"><?php echo $TPL_V1?></option>
<?php }}?>
                    </select> 
                </div>
            </div>
			<!--아이클라우드-->
			<!--피해 당시 sns 친구-->
            <div class="item sns_item sns_item01">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex17']?> <em>*</em></h4>
                    </div>
                    <input type="text" name="ex17_kor" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']]['ex17']?>"/>
                </div>
            </div>
			<!--피해 당시 sns 친구-->
			<!--의뢰인 sns 아이디-->
            <div class="item sns_item sns_item02">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex18']?> <em>*</em></h4>
                    </div>
                    <input type="text" name="ex18_kor" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']]['ex18']?>"/>
                </div>
            </div>
			<!--의뢰인 sns 아이디-->
			<!--피해 당시 휴대폰에 저장-->
            <div class="item contact_item contact_item01">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex9']?> <em>*</em></h4>
                    </div>
                    <input type="text" name="ex9_kor" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']]['ex9']?>" placeholder="예) 50개"/>
                </div>
            </div>
			<!--피해 당시 휴대폰에 저장-->
			<!--가해자로부터 받은 링크-->
            <div class="item contact_item contact_item02">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex10']?> <em>*</em></h4>
                    </div>
                    <select name="ex10_kor">
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['option']['kor']['ex10']['item'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
						<option value="<?php echo $TPL_V1?>"><?php echo $TPL_V1?></option>
<?php }}?>
                    </select> 
                </div>
            </div>
			<!--가해자로부터 받은 링크-->
			<!--링크 주소를 입력하세요.-->
            <div class="item contact_item contact_item03">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex21']?> <em>*</em></h4>
                    </div>
                    <input type="text" name="ex21_kor" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']]['ex21']?>"/>
                </div>
            </div>
			<!--링크 주소를 입력하세요.-->
			<!--초대코드-->
            <div class="item contact_item contact_item04">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex11']?> </h4>
                    </div>
                    <input type="text" name="ex11_kor" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']]['ex11']?>" placeholder="예) 2H1D, 모름"/>
                </div>
            </div>
			<!--초대코드-->
			<!--가해자의 계좌번호-->
            <div class="item">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex12']?> </h4>
                    </div>
                    <input type="text" name="ex12_kor" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']]['ex12']?>" placeholder="예) 토스뱅크 111-1111-1111 홍길동, 모름"/>
                </div>
            </div>
			<!--가해자의 계좌번호-->
			<!--의심 전화번호-->
            <div class="item">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex13']?> </h4>
                    </div>
                    <input type="text" name="ex13_kor" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']]['ex13']?>" placeholder="예) 010-1111-1111, 모름"/>
                </div>
            </div>
			<!--의심 전화번호-->
			<!--가해자 입금-->
            <div class="item">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex14']?> <em>*</em></h4>
                    </div>
                    <input type="text" name="ex14_kor" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']]['ex14']?>" placeholder="예) 없음, 1000만원, 모름"/>
                </div>
            </div>
			<!--가해자 입금-->
			<!--아크링크 경로-->
            <div class="item">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex15']?> <em>*</em></h4>
                    </div>
                    <select name="ex15_kor">
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['option']['kor']['ex15']['item'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
						<option value="<?php echo $TPL_V1?>"><?php echo $TPL_V1?></option>
<?php }}?>
                    </select> 
                </div>
            </div>
			<!--아크링크 경로-->
			<!--키워드-->
            <div class="item">
                <div class="cont single">
                    <div class="sub_title">
                        <h4><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex16']?> <em>*</em></h4>
                    </div>
                    <input type="text" name="ex16_kor" class="input" value="<?php echo $TPL_VAR["board_view"]['board_view']['extraFieldInfo'][$TPL_VAR["cfg_site"]['language']]['ex16']?>" placeholder="예) 라인영통사기, 핸드폰 해킹 등등.."/>
                </div>
            </div>
			<!--키워드-->
			
            <div class="item last_item">
                <div class="cont">
                    <p class="noti">※ 파일을 보유하고 있지 않을 경우, 하단의 파일 업로드 과정을 생략 하셔도 됩니다. <br>※ 악성 파일 대용량 업로드는 <a href="https://www.dropbox.com/request/BoVxAh85m6RfUVCQD5HC" target="_blank" class="under_line">드롭박스</a>를 이용해주세요.</p>
					<div class="add_wrap">
						<!--악성 파일 업로드-->
						<dl class="add_desc">
							<dt><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex25']?></dt>
							<dd>
								<ul class="inp_list">
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['option']['kor']['ex25']['item'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
									<li>
										<label><input type="radio" name="ex25_kor" value="<?php echo $TPL_V1?>"><?php echo $TPL_V1?></label>
									</li>
<?php }}?>
								</ul>
								<div class="file_wrap">
									<input type="file" name="ex26_kor">
									<input type="hidden" name="ex26_kor_oname" value="">
									<input type="hidden" name="ex26_kor_fname" value="">
									<input type="hidden" name="ex26_kor_type" value="diagnosis">
									<input type="hidden" name="ex26_kor_size" value="20">
									<input type="hidden" name="ex26_kor_folder" value="/upload/board/diagnosis">
									<input type="text" placeholder="파일첨부" class="inp_name" readonly>
									<a href="#" class="btn btn_md">파일 선택</a>
								</div>			
							</dd>
						</dl>
						<!--악성 파일 업로드-->
						<!--대화 내용 업로드-->
						<dl class="add_desc">
							<dt><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex27']?></dt>
							<dd>
								<ul class="inp_list">
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['option']['kor']['ex27']['item'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
									<li>
										<label><input type="radio" name="ex27_kor" value="<?php echo $TPL_V1?>"><?php echo $TPL_V1?></label>
									</li>
<?php }}?>
								</ul>
								<div class="file_wrap">
									<input type="file" name="ex28_kor">
									<input type="hidden" name="ex28_kor_oname" value="">
									<input type="hidden" name="ex28_kor_fname" value="">
									<input type="hidden" name="ex28_kor_type" value="diagnosis">
									<input type="hidden" name="ex28_kor_size" value="20">
									<input type="hidden" name="ex28_kor_folder" value="/upload/board/diagnosis">
									<input type="text" placeholder="파일첨부" class="inp_name" readonly>
									<a href="#" class="btn btn_md">파일 선택</a>
								</div>
							</dd>
						</dl>
						<!--대화 내용 업로드-->
						<!--방문 기록 업로드-->
						<dl class="add_desc">
							<dt><?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']]['ex29']?></dt>
							<dd>
								<ul class="inp_list">
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['option']['kor']['ex29']['item'])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_V1){?>
									<li>
										<label><input type="radio" name="ex29_kor" value="<?php echo $TPL_V1?>"><?php echo $TPL_V1?></label>
									</li>
<?php }}?>
								</ul>
								<div class="file_wrap">
									<input type="file" name="ex30_kor">
									<input type="hidden" name="ex30_kor_oname" value="">
									<input type="hidden" name="ex30_kor_fname" value="">
									<input type="hidden" name="ex30_kor_type" value="diagnosis">
									<input type="hidden" name="ex30_kor_size" value="20">
									<input type="hidden" name="ex30_kor_folder" value="/upload/board/diagnosis">
									<input type="text" placeholder="파일첨부" class="inp_name" readonly>
									<a href="#" class="btn btn_md">파일 선택</a>
								</div>
							</dd>
						</dl>
						<!--방문 기록 업로드-->
					</div>
					<div class="policy_cont">
						<label><input type="checkbox" name="nonMember"/><em>(필수)</em> <?php echo $TPL_VAR["terms"]['nonMember']['title']?></label>
						<div class="area_box">
							<textarea cols="30" rows="5" align="left" class="" title="개인정보 수집항목 동의"><?php echo $TPL_VAR["terms"]['nonMember']['text']?></textarea>								
						</div>
					</div>
                </div>
            </div>
			<div class="btn_wrap">
				<a href="#" class="btn return">이전</a>
				<a href="#" class="btn btn_point btn_next">다음</a>
				<button type="button" class="btn btn_point btn_submit" onclick="Common_Board.board_write(this.form); return false;">제출하기</button>
			</div>
        </div>
		<div class="dn">
			<div><input type="text" name="title" id="title" value="피해 진단 문의합니다." /><label for="title" class="dn">제목</label></div>
			<div class="edit-box" style="width:100%;"><textarea name="content" id="contents" style="height:320px" title="내용을 입력하세요." >피해 진단 문의합니다. <?php echo $TPL_VAR["board_view"]['board_view']['content']?></textarea></div>
<?php if(($TPL_VAR["board_info"]['mode']=='write'||$TPL_VAR["board_info"]['mode']=='answer')&&!defined('_IS_LOGIN')){?>
			<input type="password" name="password" id="password" value="1234"/><label for="password" class="dn">게시글 비밀번호</label>
<?php }elseif($TPL_VAR["board_info"]['mode']=='modify'&&!$TPL_VAR["board_view"]['board_view']['userid']){?>
            <input type="password" name="password" id="password" value="<?php echo $TPL_VAR["board_view"]['board_view']['password']?>" readonly /><label for="password" class="dn">게시글 비밀번호</label>
<?php }?>
		</div>
    </fieldset>
</form>
<script type="text/javascript" src="<?php echo $TPL_VAR["js"]?>/js/common_board.js"></script>
<script type="text/javascript" src="/lib/smarteditor2-master/workspace/static/js/service/HuskyEZCreator.js" charset="utf-8"></script>
<script>
	var Common_Board = new common_board({
		code : "<?php echo $TPL_VAR["board_info"]['code']?>",
		no : "<?php echo $TPL_VAR["board_view"]['board_view']['no']?>",
		is_login : "<?php echo defined('_IS_LOGIN')?>"
	});

	$(function() {
		$("form[name='frm']").validate({
			rules : {
				title : {required : true},
<?php if($TPL_VAR["board_info"]['yn_mobile']=='y'){?>mobile : {required : false, phoneValid : false},<?php }?>
<?php if($TPL_VAR["board_info"]['yn_email']=='y'){?>email : {required : false, email : false},<?php }?>
<?php if($TPL_VAR["board_info"]['yn_video']=='y'){?>video_url : {required : true, regUrlType : true},<?php }?>
				name : {required : false},
				gender : {required : true},
<?php if($TPL_VAR["board_info"]['mode']!='modify'){?>
				password : {required : true, rangelength : [4, 20]},
<?php }?>
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!='index_'){?>//메인에서 에디터 적용금지
<?php if($TPL_VAR["board_info"]["yn_editor"]==="y"){?>
				content : {editorRequired : {depends : function(){return !getSmartEditor("contents")}}},
<?php }else{?>
				content: "required",
<?php }?>
<?php }?>
				file : {},
				nonMember : {required : {depends : function(){return <?php if(!defined('_IS_LOGIN')){?>true<?php }else{?>false<?php }?>}}},
				// 추가필드 rules Start
<?php if($TPL_VAR["board_info"]['extraFl']=='y'&&!empty($TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])){?>
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
						<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?> : {
							editorRequired : {
								depends : function(){
<?php if(!empty($TPL_VAR["board_info"]['extraFieldInfo']['require'][$TPL_VAR["cfg_site"]['language']][$TPL_K1])){?>
<?php if($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='editor'){?>
											return !getSmartEditor("<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>");
<?php }elseif($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='file'){?>
											if(!$("[name=<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>_fname]").val()){
												return true;
											}
<?php }elseif($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='checkbox'||$TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='radio'){?>
											if(!$("[name=<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>]:checked").val()){
												return true;
											}
<?php }else{?>
											if(!$("[name=<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>]").val()){
												return true;
											}
<?php }?>
										return false;
<?php }else{?>
<?php if($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='editor'){?>
											getSmartEditor("<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>");
<?php }?>
										return false;
<?php }?>
								}
							}
						},
<?php }}?>
<?php }?>
				// 추가필드 rules End
<?php if($TPL_VAR["board_info"]["use_captcha"]=="y"){?>
				captcha: { required: true }
<?php }?>
			}, messages : {
				title : {required : "제목을 입력해주세요."},
<?php if($TPL_VAR["board_info"]['yn_mobile']=='y'){?>mobile : {required : "휴대폰을 입력해주세요.", phoneValid : "올바른 휴대폰을 입력해주세요. ex)000-0000-0000)"},<?php }?>
<?php if($TPL_VAR["board_info"]['yn_email']=='y'){?>email : {required : "이메일을 입력해주세요.", email : "올바른 이메일을 입력해주세요."},<?php }?>
<?php if($TPL_VAR["board_info"]['yn_video']=='y'){?>video_url : {required : "동영상 주소를 입력해주세요.", regUrlType : "올바른 url을 입력해주세요."},<?php }?>
				name : {required : "작성자를 입력해주세요."},
				gender : {required : "성별을 선택해주세요."},
<?php if($TPL_VAR["board_info"]['mode']!='modify'){?>
				password : {required : "비밀번호를 입력해주세요.", rangelength: $.validator.format("비밀번호는 {0}~{1}자입니다.")},
<?php }?>
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!='index_'){?>//메인에서 에디터 적용금지
<?php if($TPL_VAR["board_info"]["yn_editor"]==="y"){?>
					content : {editorRequired : "내용을 입력해주세요."},
<?php }else{?>
					content: "내용을 입력해 주세요.",
<?php }?>
<?php }?>
				file : {},
<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!='index_'){?>//메인에서 태그 가져오지 못하는 오류 수정
				nonMember : {required : "<?php echo $TPL_VAR["terms"]['nonMember']['title']?>를 체크해주세요."},
<?php }else{?>
				nonMember : {required : "비회원 개인정보 수집항목 동의를 체크해주세요."},
<?php }?>
				// 추가필드 messages Start
<?php if($TPL_VAR["board_info"]['extraFl']=='y'&&!empty($TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])){?>
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
					<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?> : {
						editorRequired : "<?php echo $TPL_VAR["board_info"]['extraFieldInfo']['name'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]?>는 필수 항목입니다."
					},
<?php }}?>
<?php }?>
				// 추가필드 messages End
<?php if($TPL_VAR["board_info"]["use_captcha"]=="y"){?>
				captcha: { required: "자동등록방지 코드를 입력해 주세요." }
<?php }?>
			}
		});

<?php if($TPL_VAR["CI"]->uri->rsegments[ 1]!='index_'){?>//메인에서 에디터 적용금지
<?php if($TPL_VAR["board_info"]["yn_editor"]==="y"){?>attachSmartEditor("contents", "board");<?php }?>
<?php if($TPL_VAR["board_info"]['extraFl']=='y'&&!empty($TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])){?>
<?php if(is_array($TPL_R1=$TPL_VAR["board_info"]['extraFieldInfo']['use'][$TPL_VAR["cfg_site"]['language']])&&!empty($TPL_R1)){foreach($TPL_R1 as $TPL_K1=>$TPL_V1){?>
<?php if($TPL_VAR["board_info"]['extraFieldInfo']['option'][$TPL_VAR["cfg_site"]['language']][$TPL_K1]['type']=='editor'){?>
						// 추가필드 에디터 적용
						attachSmartEditor("<?php echo $TPL_K1?>_<?php echo $TPL_VAR["cfg_site"]['language']?>", "board");
<?php }?>
<?php }}?>
<?php }?>
<?php }?>
		uploadForm.init(document.frm);
		/*
		$.ajax({
			url : "/captchaRequest/get", 
			datatype : "json",
			type : "POST",
			data : {"page" : "write"},
			success : function(response, status, request){
				if(status == "success") {
					if(request.readyState == "4" && request.status == "200") {
						var result = JSON.parse(response);
						if(result.code) {
							$("#captcha_box").html(result.captcha.image);
						} else {
							alert(result.error);
						}
					}
				}
			}, error : function(request, status, error){
				alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
			}
		});
		*/
		$("#refreshCode").on("click", function() {
			$.ajax({
				url : "/captchaRequest/get", 
				datatype : "json",
				type : "POST",
				data : {"page" : "write"},
				success : function(response, status, request){
					if(status == "success") {
						if(request.readyState == "4" && request.status == "200") {
							var result = JSON.parse(response);
							if(result.code) {
								$("#captcha_box").html(result.captcha.image);
							} else {
								alert(result.error);
							}
						}
					}
				}, error : function(request, status, error){
					alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				}
			});
		});
	});

    function thumbnail_image_choice(value) {
        var file_fname = $('[name="'+value+'_fname"]').val();

        if ($('[name="'+value+'_image"]').is(":checked") === true) {
            if (file_fname == "" || typeof file_fname === "undefined")
            {
                $('[name="'+value+'_image"]').prop("checked", false);
                alert("선택된 파일이 없습니다.");
                return false;
            } else {
                if ($(".thumbnail_image:checked").length > 1) {
                    $('[name="'+value+'_image"]').prop("checked", false);
                }else {
                    $('[name="'+value+'_image"]').prop("checked", true);
                    $('[name="'+value+'_image"]').val(file_fname);
                }
            }
        }
    }
</script>