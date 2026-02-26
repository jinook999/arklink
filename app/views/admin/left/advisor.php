<ul class="second-menu">
	<li class="on">
		<h3>통계</h3>
		<ul>
		<?php
		$sub = [
			'접속 통계' => [
				'analysis_all' => '접속자 분석',
				'analysis_route' => '접속자 경로분석',
				'analysis_device' => '접속자 환경분석',
				'analysis_keyword' => '검색키워드 분석'
			]
		];
		foreach($sub as $key => $value) :
			$title_on = array_key_exists($r2, $value) ? ' class="on"' : '';
			foreach($value as $sub_url => $sub_name) :
				$sub_active = $this->uri->rsegments[2] == $sub_url ? ' class="active"' : '';
				echo '<li'.$sub_active.'><a href="'.$sub_url.'"><em>'.$sub_name.'</em></a></li>';
			endforeach;
		endforeach;
		?>
		</ul>
	</li>
</ul>