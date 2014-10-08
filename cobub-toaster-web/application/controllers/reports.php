<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Cobub Toaster Web Console
 *
 * Cobub Toaster is an open source push solution for mobile apps
 *
 * @package		Cobub Toaster Web Console
 * @author		Zxial
 * @copyright	Zxial
 * @license		GPL V3
 * @link		http://zxial.me/projects/cobub-toaster-web/
 * @since		Version 0.1
 * @filesource	controller of reports
 */

class reports extends CI_Controller {

	public function reports(){
		parent::__construct();
		$this->load->model ( 'mod_pns' );
		$this->load->model ( 'mod_apps' );
		$this->load->model('mod_reports');
		//$this->load->helper ( array('form', 'url') );
	}
	
	public function index()
	{

		$this->allapp();
	}
	
	public function allapp()
	{
		session_start();
		
		$userid = $_SESSION['userid'];
		$apps = $this->mod_apps->get_apps($userid);
		$data['apps'] = $apps;
		
		if($apps->num_rows()>0){
			//$appid = 'ct540ec6c2b4d718.15481746';
			//$applist = $apps->row()->appkey;
			$applist = "";
			foreach ($apps->result() as $row){
				$applist .= "'" . $row->appkey . "',";
			}
			$applist = rtrim($applist,',');
		
			$end = isset($_GET['end'])?$_GET['end']:date('y-m-d',time());
		
			$start = isset($_GET['start'])?$_GET['start']:date('y-m-d',time()- (30 * 24 * 60 * 60));
		
			$report_data = $this->mod_reports->all_app_report_day($applist,$start,$end);
		
			//echo $this->db->last_query();
			$data['app_report_data'] = $report_data;
			$data['apps'] = $apps;
		}
		
		
		$this->load->view('user_report_allapps', $data);
	}
	
	public function cron(){
		$this->mod_reports->cron_hourly(true);
		$this->mod_reports->cron_daily(true);
	}
	
	public function app()
	{
		//$this->mod_reports->cron_hourly();
		session_start();
		
		$userid = $_SESSION['userid'];
		$apps = $this->mod_apps->get_apps($userid);
		$data['apps'] = $apps;
		
		if($apps->num_rows()>0){
			//$appid = 'ct540ec6c2b4d718.15481746';
			$appid = isset($_GET['appid'])?$_GET['appid']:$apps->row()->appkey;//$_GET['appid'];
			
			$end = isset($_GET['end'])?$_GET['end']:date('y-m-d',time());
			
			$start = isset($_GET['start'])?$_GET['start']:date('y-m-d',time()- (30 * 24 * 60 * 60));
			
			$report_data = $this->mod_reports->app_report_day($appid,$start,$end);
			
			$data['appid'] = $appid;
			
			$data['cappname'] = $this->mod_apps->get_app_name($appid);
			
			$data['app_report_data'] = $report_data;
		}
		
		$this->load->view('user_report_app',$data);
	}
	public function timephase()
	{
		session_start();
		
		$userid = $_SESSION['userid'];
		$apps = $this->mod_apps->get_apps($userid);
		$data['apps'] = $apps;
		
		if($apps->num_rows()>0){
			//$appid = 'ct540ec6c2b4d718.15481746';
			$appid = isset($_GET['appid'])?$_GET['appid']:$apps->row()->appkey;//$_GET['appid'];
			
			$report_data = $this->mod_reports->app_report_hourly($appid);
			
			//echo $this->db->last_query();
			
			$data['appid'] = $appid;
			
			$data['cappname'] = $this->mod_apps->get_app_name($appid);
			
			$data['app_report_data'] = $report_data;
		}
		
		$this->load->view('user_report_timephase', $data);
	}
	
	
	public function tasks()
	{
		$this->load->view('user_report_tasks');
	}
	public function cron_hourly(){
		$this->mod_reports->cron_hourly();
	}
	public function cron_daily(){
		$this->mod_reports->cron_daily();
	}
	
	
}
