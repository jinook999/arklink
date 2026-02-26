<?php
defined("BASEPATH") OR exit("No direct script access allowed");

class Advisor extends ADMIN_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("Statistics_model");
	}

	public function analysis_all() {
		$get = $this->input->get(null, true);
		$get_data = $cond = [];
		$cond['s'] = $get['startDate'] ? $get['startDate'] : date('Y-m-d');
		$cond['e'] = $get['endDate'] ? $get['endDate'] : date('Y-m-d');
		$result = $this->Statistics_model->get_all($cond);
		$type = $get['type'] ? $get['type'] : 'hour';
		$hour = $day = $week = $month = [];
		foreach($result as $key => $value) {
			$hour[date('G', strtotime($value['reg_date']))][] = $value['reg_date'];
			$day[date('j', strtotime($value['reg_date']))][] = $value['reg_date'];
			$week[date('w', strtotime($value['reg_date']))][] = $value['reg_date'];
			$month[date('n', strtotime($value['reg_date']))][] = $value['reg_date'];
		}

		$get_data['hours'] = json_encode($this->result($hour));
		$get_data['days'] = json_encode($this->result($day));
		$get_data['weeks'] = json_encode($this->result($week));
		$get_data['months'] = json_encode($this->result($month));
		$get_data['hour_max'] = $this->get_numbers(max($this->result($hour)));
		$get_data['day_max'] = $this->get_numbers(max($this->result($day)));
		$get_data['week_max'] = $this->get_numbers(max($this->result($week)));
		$get_data['month_max'] = $this->get_numbers(max($this->result($month)));
		//$count = $this->Statistics_model->count_all();
		$today = $yesterday = $this_month = [];
		foreach($count as $key => $value) {
			if(date('Y-m-d', strtotime($value['reg_date'])) == date('Y-m-d')) {
				$today[] = $value['reg_date'];
			}

			if(date('Y-m-d', strtotime($value['reg_date'])) == date('Y-m-d', strtotime('-1 day'))) {
				$yesterday[] = $value['reg_date'];
			}

			if(date('Y-m', strtotime($value['reg_date'])) == date('Y-m')) {
				$this_month[] = $value['reg_date'];
			}
		}

		$origin = new DateTime(date('Y-m-d', strtotime($count[0]['reg_date'])));
		$target = new DateTime(date('Y-m-d'));
		$interval = $origin->diff($target);

		$get_data['total'] = count($count);
		$get_data['average'] = count($count) / $interval->days;
		$get_data['today'] = count($today);
		$get_data['yesterday'] = count($yesterday);
		$get_data['this_month'] = count($this_month);
		$get_data['average_this_month'] = count($this_month) / date('j');

		$this->set_view('admin/advisor/analysis_all', $get_data);
	}

	public function analysis_route() {
		try {
			$get = $this->input->get(null, true);
			$get_data = $cond = [];
			$cond['name'] = 'referer';
			$cond['site'] = $get['advisorEngine'];
			$cond['s'] = $get['startDate'] ? $get['startDate'] : date('Y-m-d');
			$cond['e'] = $get['endDate'] ? $get['endDate'] : date('Y-m-d');

			$this->load->library('pagination');
			$limit = 10;
			$per_page = $get['per_page'] ? $get['per_page'] : 1;
			$offset = ($per_page - 1) * $limit;

			$get_data = $this->Statistics_model->get_data($cond, $limit, $offset);

			$get_total = $this->Statistics_model->get_route_total($cond);
			$config = [
				'total_rows' => count($get_total),
				'per_page' => $limit,
				'first_url' => '?type='.$get['type'].'&startDate='.$cond['s'].'&endDate='.$cond['e'].'&advisorEngine='.$cond['site'],
				'suffix' => '&type='.$get['type'].'&startDate='.$cond['s'].'&endDate='.$cond['e'].'&advisorEngine='.$cond['site'],
			];

			$this->pagination->initialize($config);
			$get_data['pagination'] = $this->pagination->create_links();
			$get_data['offset'] = $offset;

			$host = [];
			foreach($get_data['list'] as $key => $value) {
				$url = parse_url($value['referer']);
				$host[$url['host']][] = $value['cnt'];
			}

			$get_data['limit'] = $limit;
			$get_data['host'] = $host;
			$this->set_view('admin/advisor/analysis_route', $get_data);
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	public function analysis_device() {
		try {
			$get_data = $cond = [];
			$cond['name'] = $this->input->get("type", true) ? $this->input->get("type", true) : "os";
			$cond['s'] = $this->input->get("startDate", true) ? $this->input->get("startDate", true) : date('Y-m-d');
			$cond['e'] = $this->input->get("endDate", true) ? $this->input->get("endDate", true) : date('Y-m-d');
			$get_data = $this->Statistics_model->get_data($cond);
			$this->set_view("admin/advisor/analysis_device", $get_data);
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	public function analysis_keyword() {
		try {
			$get_data = $cond = [];
			$cond['name'] = "keyword";
			$cond['site'] = $this->input->get("advisorEngine", true);
			$cond['s'] = $this->input->get("startDate", true) ? $this->input->get("startDate", true) : date('Y-m-d');
			$cond['e'] = $this->input->get("endDate", true) ? $this->input->get("endDate", true) : date('Y-m-d');
			$get_data = $this->Statistics_model->get_data($cond);
			$this->set_view("admin/advisor/analysis_keyword", $get_data);
		} catch(Exception $e) {
			msg($e->getMessage(), -1);
		}
	}

	private function result($array) {
		array_walk($array, function(&$value, $key) {
			$value = count($value);
		});

		return $array;
	}

	private function get_numbers($num) {
		$result = [];
		if($num < 10) {
			$result['step'] = 1;
			$result['max'] = 10;
		} else {
			$n = ceil($num / 10);
			$nn = 10 - (int)substr($n, -1);
			//echo $num, ";;", $n, ";;", $nn, "\n";
			$result['step'] = $n + $nn;
			$result['max'] = $num + ($n + $nn);
			/*
			$result['step'] = ($result['max'] / 10) + $last;
			$result['max'] = ($num % 10 == 0) ? $num + 10 : $num + 10 - ($num % 10);
			$last = 10 - (int)substr(($result['max'] / 10), -1);
			*/
		}

		return $result;
	}

	public function remove_all() {
		if($this->Statistics_model->remove_all()) {
			msg("모든 통계 데이터가 초기화되었습니다.", "analysis_all");
		}
	}
}