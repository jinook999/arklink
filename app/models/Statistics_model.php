<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics_model extends CI_Model {
	public function insert($datas) {
		$this->db->insert("da_statistics", [
			'user_agent' => $datas['user_agent'],
			'platform' => $datas['platform'],
			'browser' => $datas['browser']." ".$datas['version'],
			'mobile' => $datas['mobile'],
			'robot' => $datas['robot'],
			'ip' => $datas['ip'],
			'words' => $datas['words'],
			'referer' => $datas['referer'],
			'reg_date' => $datas['reg_date']
		]);
	}

	public function get_data($cond, $limit = null, $offset = null) {
		$cols = [
			'os' => ['platform, COUNT(*) AS cnt', 'platform'],
			'browser' => ['platform, browser, COUNT(*) AS cnt', 'browser, platform'],
			'keyword' => ['words, referer, COUNT(*) AS cnt', 'words'],
			'referer' => ['referer, COUNT(*) AS cnt', 'referer']
		];

		$this->db->select($cols[$cond['name']][0])->group_by($cols[$cond['name']][1])->order_by("cnt", "DESC");
		if($cond['name'] == "keyword") $this->db->where("`words` <> ''");
		if($cond['site']) $this->db->like("referer", $cond['site']);
		if($cond['s']) $this->db->where("DATE_FORMAT(`reg_date`, '%Y-%m-%d') BETWEEN '".$cond['s']."' AND '".$cond['e']."'");
		if($cond['name'] == "referer") $this->db->limit($limit, $offset);
		$result['list'] = $this->db->get("da_statistics")->result_array();

		if($cond['name'] == "keyword") $this->db->where("`words` <> ''");
		if($cond['site']) $this->db->like("referer", $cond['site']);
		if($cond['s']) $this->db->where("DATE_FORMAT(`reg_date`, '%Y-%m-%d') BETWEEN '".$cond['s']."' AND '".$cond['e']."'");
		$result['total'] =$this->db->get("da_statistics")->result_array();
		return $result;
	}

	public function get_route_total($cond) {
		$this->db->select("referer, COUNT(*) AS cnt")->group_by("referer")->order_by("cnt", "DESC");
		$this->db->where("DATE_FORMAT(`reg_date`, '%Y-%m-%d') BETWEEN '".$cond['s']."' AND '".$cond['e']."'");
		if($cond['site']) $this->db->like("referer", $cond['site']);
		return $this->db->get("da_statistics")->result_array();
	}

	public function get_all($cond) {
		/*
		$this->db->select('reg_date');
		$this->db->where("DATE_FORMAT(`reg_date`, '%Y-%m-%d') BETWEEN '".$cond['s']."' AND '".$cond['e']."'");
		*/
		$from = $cond['s'].' 00:00:00';
		$to = $cond['e'].' 23:59:59';
		$this->db->select('reg_date');
		$this->db->where('reg_date >= "'.$from.'" AND reg_date <= "'.$to.'"');
		//return $this->db->get('da_statistics')->num_fields();
		$result = $this->db->get('da_statistics')->result_array();
		return $result;
		/*
		$query = $this->db->query('SELECT `reg_date` FROM `da_statistics` WHERE `reg_date` > "'.$from.'" AND `reg_date` < "'.$to.'"');
		//debug($this->db->last_query());
		return $query->num_fields();
		*/
	}

	public function count_total() {
		$this->db->select('reg_date');
		return $this->db->get('da_statistics')->result_array();
	}

	public function count_yesterday() {
		$yesterday = date('Y-m-d', strtotime('yesterday'));
		$from = $yesterday.' 00:00:00';
		$to = $yesterday.' 23:59:59';
		$this->db->where('reg_date >= "'.$from.'" AND reg_date <= "'.$to.'"');
		return $this->db->get('da_statistics')->num_fields();
	}

	public function count_today() {
		$from = date('Y-m-d').' 00:00:00';
		$to = date('Y-m-d').' 23:59:59';
		$this->db->where('reg_date >= "'.$from.'" AND reg_date <= "'.$to.'"');
		return $this->db->get('da_statistics')->num_fields();
	}

	public function count_this_month() {
		$from = date('Y-m').'-01 00:00:00';
		$to = date('Y-m-t').' 23:59:59';
		$this->db->where('reg_date >= "'.$from.'" AND reg_date <= "'.$to.'"');
		return $this->db->get('da_statistics')->num_fields();
	}

	public function count_all() {
		$this->db->order_by("no", "ASC");
		$this->db->get("da_statistics")->result_array();
		debug($this->db->last_query());
		exit;
	}

	public function remove_all() {
		return $this->db->truncate("da_statistics");
	}

	public function page_views($data) {
		if($data['url'] && $data['name']) {
			$this->db->order_by("no", "DESC");
			$result = $this->db->get_where("da_pageviews", ["url" => $data['url'], "ip" => $data['ip']])->result_array();
			if($result[0]['no']) {
				$sub = time() - strtotime($result[0]['visit']);
				if($sub > 86400) $this->db->insert("da_pageviews", $data);
			} else {
				$this->db->insert("da_pageviews", $data);
			}
		}
	}

	public function get_page_views($cond) {
		return $this->db->query("SELECT * FROM `da_pageviews` WHERE `visit` BETWEEN '".$cond['s']."' AND '".$cond['e']."'")->result_array();
	}

	public function get_pageviews_count($cond) {
		$result = $this->db->query("SELECT `url`, COUNT(`url`) AS cnt FROM `da_pageviews` WHERE `visit` BETWEEN '".$cond['s']."' AND '".$cond['e']."' GROUP BY `url`")->result_array();
		$data = [];
		foreach($result as $key => $value) {
			$data[$value['url']] = $value['cnt'];
		}
		return $data;
	}
}