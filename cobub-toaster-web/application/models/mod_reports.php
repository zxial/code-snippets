<?php
/**
 * Cobub Toaster Web Console 
 *
 * Cobub Toaster is an open source push solution for mobile apps
 *
 * @package		Cobub Toaster Web Console
 * @version		0.1
 * @author		Zxial
 * @copyright	Zxial
 * @license		GPL V3
 * @link		http://zxial.me/projects/cobub-toaster-web/
 * @since		Version 0.1
 * @filesource	report model 
 */

class mod_reports extends CI_Model {
	private $server;
	
	function mod_reports(){
		parent::__construct ();
		$this->load->database ();
		$this->load->model('mod_pns');
	}
	//report of last 24 hours
	function app_report_hourly($appid){
		$this->db->from ( 'app_report_hours' );
		$this->db->where ( 'appid', $appid );
		$this->db->order_by('id','dsc');
		$this->db->limit(24);
		
		$query = $this->db->get ();
		
		return $query;
	}
	
	function app_report_day($appid,$start, $end){
		$this->db->from ( 'app_report_days' );
		$this->db->where ( 'rtime >=', $start );
		$this->db->where ( 'rtime <=', $end );
		$this->db->where ( 'appid', $appid );
		//$this->db->order_by('id','asc');
		
		$query = $this->db->get ();
		
		return $query;
		
	}
	
	function all_app_report_day($applist,$start, $end){
		
		$sql = 'SELECT rtime,SUM(onlinev) AS onlinev, SUM(allv) as allv FROM app_report_days WHERE appid IN ('. $applist.') group by rtime';
	
		$query = $this->db->query($sql);
	
		return $query;
	
	}
	
	
	function cron_hourly($test_flag = false){
		if($test_flag) 
			echo '+++++CRON HOURLY START+++++<br/>';
		
		$this->db->from ( 'apps' );
		$query = $this->db->get ();
		
		
		$curtime = date('y-m-d h:00:00',time());
		foreach ($query->result() as $row)
		{
			$appid = $row->appkey;
			
			//get the online value
			$appsize = $this->mod_pns->pns_app_size($appid,1);
			$count = $appsize['json_return']->$appid;
			
			$appsize = $this->mod_pns->pns_app_size($appid,0);
			$count1 = $appsize['json_return']->$appid;
			$data = array('appid' => $appid,
					'rtime' => $curtime,
					'onlinev' => $count?$count:0,
					'allv' => $count1?$count1:0);
			if ($test_flag) echo 'APPID:'.$appid.' JSON_RETURN:'.json_encode($data).'<br>';
			$this->db->insert('app_report_hours',$data);
			
		}
		if($test_flag)
			echo '+++++CRON HOURLY END+++++<br/>';
		
	}
	function cron_daily($test_flag = false){
		if($test_flag) 
			echo '+++++CRON DAILY START+++++<br/>';
		
		$this->db->from ( 'apps' );
		$query = $this->db->get ();
	
		$curtime = date('y-m-d 00:00:00',time());
		foreach ($query->result() as $row)
		{
			$appid = $row->appkey;
			$appsize = $this->mod_pns->pns_app_size($appid,1);
			$count = $appsize['json_return']->$appid;
			
			$appsize = $this->mod_pns->pns_app_size($appid,0);
			$count1 = $appsize['json_return']->$appid;
			$data = array('appid' => $appid,
					'rtime' => $curtime,
					'onlinev' => $count?$count:0,
					'allv' => $count1?$count1:0);
			if ($test_flag) echo 'APPID:'.$appid.' JSON_RETURN:'.json_encode($data).'<br>';
			$this->db->insert('app_report_days',$data);
	
		}
		if($test_flag)
			echo '+++++CRON DAILY END+++++<br/>';
		
	}
	
}

?>