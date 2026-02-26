<h2>페이지</h2>
<ul class="second-menu">
<?php
$menu1 = [
    '페이지 설정' => ['page_list', 'page_write'],
];
foreach($menu1 as $key => $value) :
    echo '<li class="on"><h3>'.$key.'</h3><ul>';
    foreach($this->_adm_menu[$r1]['low_menu'] as $v) :
        $active = $r2 === $v['segment'] ? ' class="active"' : '';
        if($this->_admin_member['userid'] !== 'superman' && in_array($v['segment'], $m2) === false) continue;
        echo '<li'.$active.'><a href="../'.$r1.'/'.$v['segment'].'"><em>'.$v['name'].'</em></a></li>';
    endforeach;
    echo '</ul></li>';
endforeach;
?>
</ul>