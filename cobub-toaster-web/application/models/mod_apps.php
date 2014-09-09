<?php
/**
 * Cobub Razor
 *
 * An open source analytics for mobile applications
 *
 * @package		Cobub Razor
 * @author		WBTECH Dev Team
 * @copyright	Copyright (c) 2011 - 2012, NanJing Western Bridge Co.,Ltd.
 * @license		http://www.cobub.com/products/cobub-razor/license
 * @link		http://www.cobub.com/products/cobub-razor/
 * @since		Version 1.0
 * @filesource
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
}

?>