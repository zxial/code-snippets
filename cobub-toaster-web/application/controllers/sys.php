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
 * @filesource	controller of system configuration
 */

class sys extends CI_Controller {

	public function sys(){
		parent::__construct();
		$this->load->model ( 'mod_pns' );
		//$this->load->helper ( array('form', 'url') );
	}
	
	public function index()
	{
		//session_start();
		//$userid = $_SESSION['userid'];
		//$applist = $this->mod_apps->get_apps($userid);
		//$data['applist'] = $applist;
		//session_start();
				
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			//$this->load->view('user_add_app');
			$server_add = $this->input->post('server_add');
			$server_port =$this->input->post('server_port');
		
			$this->mod_pns->save_pns($server_add,$server_port);
		}
		
		$pns = $this->mod_pns->get_pns();
		$data['pns'] = $pns;
		$serverstatus = $this->mod_pns->pns_serverversion();
		if($serverstatus['curl_errno'] !=0){
			$serverstatus['json_return'] = json_decode(json_encode(array('status'=>'无法连接PNS！请检查服务器地址和端口是否正确！curl错误代码'.$serverstatus['curl_errno'],'version'=>'未知')));
			//echo 'Error! 407';
			//json_decode($json)
		}else{
			if($serverstatus['json_return']->status == 200){
				$serverstatus['json_return']->status = '系统正常';
			}else{
				$serverstatus['json_return']->status = '系统错误，错误代码：'. $serverstatus['json_return']->status;
			}
		}
		
		$data['serverstatus'] = $serverstatus;
		$this->load->view('sys',$data);
		
	}
	

}
