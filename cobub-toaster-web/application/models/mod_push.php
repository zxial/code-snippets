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
class mod_push extends CI_Model {
	function mod_push(){
		parent::__construct ();
		$this->load->database ();
//		$this->load->helper ( 'array' );
//		$this->load->model ( 'service/utility', 'utility' );
		
	}
	function authenticate($useremail,$password) {
		$this->db->from ( 'users' );
		$this->db->where ( 'email', $useremail );
		$this->db->where ( 'pass', $password );
		
		$query = $this->db->get ();
		$row = $query->first_row ();
		if ($query->num_rows == 1) {
			return $row;
		}
		else
			return false;
	}
}

?>