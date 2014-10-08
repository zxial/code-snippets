<?php
/**
 * Cobub Toaster Web Console 
 *
 * Cobub Toaster is an open source push solution for mobile apps
 *
 * @package		Cobub Toaster Web Console
 * @version		0.1
 * @author		Zxial
 * @license		GPL V3
 * @link		http://zxial.me/projects/cobub-toaster-web/
 * @since		Version 0.1
 * @filesource	app model
 */

class mod_apps extends CI_Model {
	function mod_apps(){
		parent::__construct ();
		$this->load->database ();
//		$this->load->helper ( 'array' );
//		$this->load->model ( 'service/utility', 'utility' );
		
	}
	function add_app($appname,$ostype,$description,$userid) {
		$data = array(
				'appname'=>$appname,
				'ostype' => $ostype,
				'description' => $description,
				'userid' => $userid,
				'appkey' => uniqid('ct',true)
		);
		
		$this->db->insert('apps',$data);

	}
	
	function get_apps($userid){
		$this->db->from ( 'apps' );
		$this->db->where ( 'userid', $userid );
		
		return $this->db->get();
		
	}
	
	function get_app_name($appid){
		$this->db->from ( 'apps' );
		$this->db->where ( 'appkey', $appid );
		
		return $this->db->get()->row()->appname;
		
	}
	
	//function get_app()
}

?>