<?php /* Template_ 2.2.8 2025/09/18 17:19:44 /gcsd33_arklink/www/data/skin/respon_default/outline/nav.html 000003237 */ 
$TPL_cfg_menu_1=empty($TPL_VAR["cfg_menu"])||!is_array($TPL_VAR["cfg_menu"])?0:count($TPL_VAR["cfg_menu"]);?>
<div id="header" class="">
	<div class="header_cont">
		<h1 class="hd_logo"><a href="/" title="Logo"><img src="/data/skin/respon_default/images/skin/hd_logo.svg" alt="<?php echo $TPL_VAR["cfg_site"]["compName"]?>"></a></h1>
		<div class="hd_right">
<?php if(isset($TPL_VAR["cfg_menu"])){?>
			<ul class="hd_lnb">
<?php if($TPL_cfg_menu_1){foreach($TPL_VAR["cfg_menu"] as $TPL_V1){?>
<?php if($TPL_V1["use"]=='y'){?>
				<li class="<?php if($TPL_VAR["on"]!=''){?><?php if($TPL_VAR["on"]==$TPL_V1["name"]){?>on <?php }?><?php }else{?><?php if($TPL_VAR["lm"]["name"]==$TPL_V1["name"]){?>on <?php }?><?php }?><?php if(strpos($TPL_V1["url"],'/goods/')> - 1){?><?php if(strpos($TPL_V1["url"],substr($TPL_VAR["req"]["cate"], 0, 3))> - 1){?> on<?php }?><?php }?>">
					<a href="<?php echo $TPL_V1["url"]?>"<?php if(strpos($TPL_V1["url"],'http://')=== 0||strpos($TPL_V1["url"],'https://')=== 0){?> target="_blank"<?php }?>><?php echo $TPL_V1["name"]?></a>
<?php if(isset($TPL_V1["menu"])){?>
						<ul class="hd_lnb_dep2">
<?php if(is_array($TPL_R2=$TPL_V1["menu"])&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
<?php if($TPL_V2["use"]=='y'){?>
							<li class="dep2"><a href="<?php echo $TPL_V2["url"]?>"><?php echo $TPL_V2["name"]?></a></li>
<?php }?>
<?php }}?>
						</ul>
<?php }?>
					</li>
<?php }else{?>
					<li class="hd_lnb_dep1_li"><a href="<?php echo $TPL_V1["url"]?>" class="dep1_a"<?php if(strpos($TPL_V1["url"],'http://')=== 0||strpos($TPL_V1["url"],'https://')=== 0){?> target="_blank"<?php }?>><?php echo $TPL_V1["name"]?></a></li>
<?php }?>
<?php }}?>
			</ul>	
<?php }?>
			<div class="all_cate">
				<a class="menu-trigger" href="#"><span></span><span></span><span></span></a>	
			</div>
		</div>
	</div>
</div>
<aside id="aside">
    <div class="utility">
        <a href="" class="close_btn" title="닫기">
            <span></span>
            <span></span>
        </a>
    </div>
    <div class="main_w_custom">
<?php if(isset($TPL_VAR["cfg_menu"])){?>
		<ul class="gnb">
<?php if($TPL_cfg_menu_1){foreach($TPL_VAR["cfg_menu"] as $TPL_V1){?>
<?php if($TPL_V1["use"]=='y'){?>
			<li class="<?php if($TPL_VAR["on"]!=''){?><?php if($TPL_VAR["on"]==$TPL_V1["name"]){?>on <?php }?><?php }else{?><?php if($TPL_VAR["lm"]["name"]==$TPL_V1["name"]){?>on <?php }?><?php }?><?php if(strpos($TPL_V1["url"],'/goods/')> - 1){?><?php if(strpos($TPL_V1["url"],substr($TPL_VAR["req"]["cate"], 0, 3))> - 1){?> on<?php }?><?php }?>">
				<a href="<?php echo $TPL_V1["url"]?>"<?php if(strpos($TPL_V1["url"],'http://')=== 0||strpos($TPL_V1["url"],'https://')=== 0){?> target="_blank"<?php }?>><?php echo $TPL_V1["name"]?></a>
<?php if(isset($TPL_V1["menu"])){?>
				<ul class="dep02">
<?php if(is_array($TPL_R2=$TPL_V1["menu"])&&!empty($TPL_R2)){foreach($TPL_R2 as $TPL_V2){?>
<?php if($TPL_V2["use"]=='y'){?>
					<li><a href="<?php echo $TPL_V2["url"]?>"><?php echo $TPL_V2["name"]?></a></li>
<?php }?>
<?php }}?>
				</ul>
<?php }?>
			</li>
<?php }?>
<?php }}?>
		</ul>
<?php }?>
    </div>
</aside>