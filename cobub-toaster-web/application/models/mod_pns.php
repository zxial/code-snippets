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
class mod_pns extends CI_Model {
	private $server;
	
	function mod_pns(){
		parent::__construct ();
		$this->load->database ();
//		$this->load->helper ( 'array' );
//		$this->load->model ( 'service/utility', 'utility' );
		$server=$this->get_pns();
	}
	
	function save_pns($server_add,$server_port) {
		$data = array(
				'server_add'=>$server_add,
				'server_port' => $server_port
		);
		$this->db->where('id', 1);
		$this->db->update('pns',$data);
		$this->server=$this->get_pns();

	}
	
	function get_pns(){
		$this->db->from ( 'pns' );
		$this->db->where ( 'id', 1 );
		return $this->db->get()->row();		
	}
	
	function check_pns(){
		$method = 'serververion';
		return $this->curl_wrap($method, '');
	}
	
	function curl_wrap($method, $postdata){

		$url =  'http://'.$this->server['server_add'].':'.$this->server['server_port'].'/'.$method;
		$curl = curl_init ( $url );
		curl_setopt ( $curl, CURLOPT_HEADER, 0 );
		$header = array ();
		$header [] = 'Connection: keep-alive';
		$header [] = 'User-Agent: Cobub Toaster Web Console v0.1';
		$header [] = 'Accept:text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
		$header [] = 'Accept-Language: zh-CN,zh;q=0.8';
		$header [] = 'Accept-Charset: GBK,utf-8;q=0.7,*;q=0.3';
		$header [] = 'Cache-Control:max-age=0';
		$header [] = 'Content-Type:application/x-www-form-urlencoded';
		
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Expect:'));
		curl_setopt ( $curl, CURLOPT_HTTPHEADER, $header );
		curl_setopt ( $curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ( $curl, CURLOPT_POSTFIELDS, $postdata );
		
		$result = curl_exec ( $curl );
		curl_close ( $curl );
		return $result;
	}
}

?>