<style>
a.selected { background: #2846b2; color: #fff; }
input.category-name { width: 85% !important; }
a.current-category:not(:last-child)::after { content: ">"; padding: 10px; }
#btnRemove { background: #f00; }
</style>
<script>
$(function() {
	$("#btnSubmit").on("click", function(e) {
		e.preventDefault();
		if(!$("#categorykor").val()) {
			alert("분류명을 입력해 주세요.");
			$("#categorykor").focus();
			return false;
		}

		$("#frm").submit();
	});

	$("#btnRemove").on("click", function(e) {
		e.preventDefault();
		var selected = $(".menu_tree_top a.selected").closest("span.folder").siblings("ul.menu_tree").length;
		var sub = "";
		if(selected > 0) sub = "현재 분류를 삭제할 경우 하위 분류도 모두 삭제됩니다.\n";
		var qs = document.location.search;
		if(confirm(sub + "선택하신 분류를 삭제하시겠습니까?")) {
			$(location).attr("href", "remove_category" + qs);
		}
	});
});
</script>
<div id="contents">
	<div class="contents_wrap">
		<?php
		echo form_open('', ['name' => 'frm', 'id' => 'frm']);
		$act = $get['act'] ? $get['act'] : 'modify';
		?>
		<input type="hidden" name="act" value="<?=$act?>">
		<input type="hidden" name="category" id="currentCategory" value="<?=$get['category']?>">
		<div class="main_tit">
			<h2>상품 분류 등록</h2>
			<div class="btn_right">
				<a href="/goods/goods_list?cate=<?=$get['category']?>" class="btn point" target="_blank">미리보기</a>
				<a href="category_tree?act=new" class="btn point">1차 분류 추가</a>
				<?php
				if($get['category'] && strlen($get['category']) < 15) :
					echo '<a href="?category='.$get['category'].'&act=new" class="btn point">하위 분류 추가</a>';
				endif;

				if($get['category']) echo '<a href="#" id="btnRemove" class="btn btn_grey sel_minus">삭제</a>';

				if($get['category'] || $get['act']) :
					$text = $get['act'] ? '추가' : '수정';
				echo '<a href="#" id="btnSubmit" class="btn point new_plus">'.$text.'</a>';
				endif;
				?>
			</div>
		</div>
		<div class="sub_tit"><h3>상품 분류 등록</h3><span>분류 정보를 기입 후, 분류 등록 버튼을 눌러 신규 분류를 등록하실 수 있습니다.</span></div>
		<div class="cate_box_wrapper clear">
			<div class="table_list table_cate">
				<div class="menu_tree_box">
					<ul class="menu_tree menu_tree_top">
					<?php
					foreach($categories as $k1 => $v1) :
						$selected = $get['category'] === $v1['category'] ? ' class="selected"' : '';
					?>
						<li class="folder">
							<span class="folder open">
								<strong><a href="?category=<?=$v1['category']?>"<?=$selected?>><?=$v1['categorynm']?></a></strong>
								<div class="cate_tree_used">
								<?php
								echo $v1['yn_use'] === 'y' ? '<span class="tree_used use_o"><em>노출</em></span>' : '<span class="tree_used use_x"><em>미노출</em></span>';
								echo '<span></span>';
								echo $v1['yn_state'] === 'y' ? '<span class="tree_active use_o"><em>활성</em></span>' : '<span class="tree_active use_x"><em>비활성</em></span>';
								?>
								</div>
							</span>
							<?php
							if(!empty($v1['sub']) && is_array($v1['sub'])) :
								echo '<ul class="menu_tree">';
								foreach($v1['sub'] as $k2 => $v2) :
									$selected = $get['category'] === $v2['category'] ? ' class="selected"' : '';
							?>
								<li class="folder">
									<span class="folder open">
										<strong><a href="?category=<?=$v2['category']?>"<?=$selected?>><?=$v2['categorynm']?></a></strong>
										<div class="cate_tree_used">
										<?php
										echo $v2['yn_use'] === 'y' ? '<span class="tree_used use_o"><em>노출</em></span>' : '<span class="tree_used use_x"><em>미노출</em></span>';
										echo '<span></span>';
										echo $v2['yn_state'] === 'y' ? '<span class="tree_active use_o"><em>활성</em></span>' : '<span class="tree_active use_x"><em>비활성</em></span>';
										?>
										</div>
									</span>
									<?php
									if(!empty($v2['sub']) && is_array($v2['sub'])) :
										echo '<ul class="menu_tree">';
										foreach($v2['sub'] as $k3 => $v3) :
											$selected = $get['category'] === $v3['category'] ? ' class="selected"' : '';
									?>
										<li class="folder">
											<span class="folder open">
												<strong><a href="?category=<?=$v3['category']?>"<?=$selected?>><?=$v3['categorynm']?></a></strong>
												<div class="cate_tree_used">
												<?php
												echo $v3['yn_use'] === 'y' ? '<span class="tree_used use_o"><em>노출</em></span>' : '<span class="tree_used use_x"><em>미노출</em></span>';
												echo '<span></span>';
												echo $v3['yn_state'] === 'y' ? '<span class="tree_active use_o"><em>활성</em></span>' : '<span class="tree_active use_x"><em>비활성</em></span>';
												?>
												</div>
											</span>
											<?php
											if(!empty($v3['sub']) && is_array($v3['sub'])) :
												echo '<ul class="menu_tree">';
												foreach($v3['sub'] as $k4 => $v4) :
													$selected = $get['category'] === $v4['category'] ? ' class="selected"' : '';
											?>
												<li class="folder">
													<span class="folder open">
														<strong><a href="?category=<?=$v4['category']?>"<?=$selected?>><?=$v4['categorynm']?></a></strong>
														<div class="cate_tree_used">
														<?php
														echo $v4['yn_use'] === 'y' ? '<span class="tree_used use_o"><em>노출</em></span>' : '<span class="tree_used use_x"><em>미노출</em></span>';
														echo '<span></span>';
														echo $v4['yn_state'] === 'y' ? '<span class="tree_active use_o"><em>활성</em></span>' : '<span class="tree_active use_x"><em>비활성</em></span>';
														?>
														</div>
													</span>
													<?php
													if(!empty($v4['sub']) && is_array($v4['sub'])) :
														echo '<ul class="menu_tree">';
														foreach($v4['sub'] as $k5 => $v5) :
															$selected = $get['category'] === $v5['category'] ? ' class="selected"' : '';
													?>
													<li class="folder">
														<span class="folder open">
															<strong><a href="?category=<?=$v5['category']?>"<?=$selected?>><?=$v5['categorynm']?></a></strong>
															<div class="cate_tree_used">
															<?php
															echo $v5['yn_use'] === 'y' ? '<span class="tree_used use_o"><em>노출</em></span>' : '<span class="tree_used use_x"><em>미노출</em></span>';
															echo '<span></span>';
															echo $v5['yn_state'] === 'y' ? '<span class="tree_active use_o"><em>활성</em></span>' : '<span class="tree_active use_x"><em>비활성</em></span>';
															?>
															</div>
														</span>
													</li>
													<?php
														endforeach;
														echo '</ul>';
													endif;
													echo '</li>';
												endforeach;
												echo '</ul>';
											endif;
											echo '</li>';
										endforeach;
										echo '</ul>';
									endif;
									echo '</li>';
								endforeach;
								echo '</ul>';
							endif;
						echo '</li>';
					endforeach;
					?>
					</ul>
				</div>
			</div>

			<div class="cate_select_box">
				<div class="table_write">
					<table cellpadding="0" cellspacing="0" border="0">
						<colgroup>
							<col width="15%" />
							<col width="35%" />
							<col width="15%" />
							<col width="35%" />
						</colgroup>
						<tbody>
							<tr>
								<th scope="col" class="ta_left">
								<?php
								if($get['act'] === 'new') :
									echo $get['category'] ? '하위 분류 추가' : '1차 분류 추가';
								endif;
								if(!$get['act']) echo '위치';
								?>
								</th>
								<td colspan="3">
								<?php
								$category_code = [];
								for($i = 1; $i <= strlen($get['category']); $i++) :
									if($i % 3 === 0) :
										$j = $i;
									else :
										continue;
									endif;
									$category_code[] = substr($get['category'], 0, $j);
								endfor;

								$tmp = explode('||', $current_category);
								array_pop($tmp);
								foreach($tmp as $k => $v) :
									echo '<a href="/goods/goods_list?cate='.$category_code[$k].'" class="current-category" target="_blank">'.$v.'</a>';
								endforeach;
								?>
								</td>
							</tr>
							<tr>
								<th scope="col" class="ta_left">분류명</th>
								<td colspan="3">
									<ul class="bbs_namelist goods_namelist">
									<?php
									$c4 = ['kor' => '한국어', 'eng' => '영어', 'chn' => '중국어(간체)', 'jpn' => '일본어'];
									foreach($c4 as $key => $value) :
										$v = $get['act'] === 'new' ? '' : $dcm[$key];
										echo '<li><label for="category'.$key.'">'.$value.'</label><input type="text" name="category_'.$key.'" id="category'.$key.'" class="cate_name_input category-name" value="'.$v.'">';
									endforeach;
									?>
									</ul>
								</td>
							</tr>
							<tr>
								<th scope="col" class="ta_left">분류순서</th>
								<td><input type="text" name="sort" class="cate_name_input" value="<?=$get['act'] === 'new' ? '' : $dc['sort']?>" placeholder="숫자만 입력"/></td>
								<th scope="col" class="ta_left">접근권한</th>
								<td>
									<select name="access_auth">
										<option value="0">비회원</option>
										<?php
										foreach($member_grade as $key => $value) :
											$selected = $value['level'] === $dc['access_auth'] ? ' selected' : '';
											echo '<option value="'.$value['level'].'"'.$selected.'>'.$value['gradenm'].'('.$value['level'].')</option>';
										endforeach;
										?>
									</select>
								</td>
							</tr>
							<tr>
								<th scope="col" class="ta_left">노출상태</th>
								<td>
									<input type="radio" class="tbB-input2" name="yn_use" id="yn_use_y" value="y" checked><label for="yn_use_y">노출</label>
									<input type="radio" class="tbB-input2" name="yn_use" id="yn_use_n" value="n"<?=$dc['yn_use'] === 'n' ? ' checked' : ''?> /> <label for="yn_use_n">노출안함</label>
								</td>
								<th scope="col" class="ta_left">활성유무</th>
								<td >
									<input type="radio" class="tbB-input2" name="yn_state" id="yn_state_y" value="y" checked><label for="yn_state_y">사용</label>
									<input type="radio" class="tbB-input2" name="yn_state" id="yn_state_n" value="n"<?=$dc['yn_state'] === 'n' ? ' checked' : ''?> /> <label for="yn_state_n">사용안함</label>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="terms_privecy_box">
					<dl>
						<dt>분류를 수정하고 싶어요.</dt>
						<dd>
						이미 생성한 분류를 수정하시려면, 측면에서 "상품 분류 수정" 탭을 눌러 이동하신 후 수정 가능합니다.
						</dd>
					</dl>
					<dl>
						<dt>분류 순서를 변경할 수 있나요?</dt>
						<dd>
						수정하고자 하는 분류를 선택 후, 우측에서 "분류 순서"에 숫자를 수정해주세요.<br>
						* 숫자가 동일한 경우, 마지막 수정일 기준으로 노출 우선순위가 정해집니다.
						</dd>
					</dl>
					<dl>
						<dt>분류 "노출상태"는 어떤 기능인가요?</dt>
						<dd>
						분류 노출상태 기능은, 홈페이지에서 분류 및 분류에 속한 상품 전체를 미노출 시키는 기능입니다.<br>
						아직 홈페이지에서 노출시키고 싶지 않은 분류의 경우, "노출상태"를 "노출안함"으로 선택하세요.<br/>
						* 관리자페이지에서 상품등록 및 하위 분류 생성, 분류 설정값 수정은 가능합니다.
						</dd>
					</dl>
					<dl>
						<dt>분류 "활성유무"는 어떤 기능인가요?</dt>
						<dd>
						분류 활성유무 기능은, 홈페이지에서 해당 분류에 속한 상품의 상세페이지 진입을 제한하는 기능입니다.<br>
						홈페이지에서 분류는 노출되나, 상세페이지만 진입을 금지하고 싶은 경우, "활성유무"를 "활성안함"으로 선택하세요.<br/>
						* 관리자페이지에서 상품등록 및 하위 분류 생성, 분류 설정값 수정은 가능합니다.
						</dd>
					</dl>
				</div>
			</div>
		</div>
		<?=form_close()?>
	</div>
</div>