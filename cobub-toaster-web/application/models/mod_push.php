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
 * @filesource	pus model 
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