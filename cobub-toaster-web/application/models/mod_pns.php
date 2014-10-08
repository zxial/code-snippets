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
 * @filesource	connection model for pns of Cobub Toaster
 */


class mod_pns extends CI_Model {
	private $server;
	
	function mod_pns(){
		parent::__construct ();
		$this->load->database ();
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
		$res = $this->db->get()->row();
		$this->server['server_add'] = $res->server_add;
		$this->server['server_port'] = $res->server_port;
		return $res;
	}
	
	//serverversion
	function pns_serverversion(){
		$method = 'serverversion';
		return $this->curl_wrap($method, '');
	}
	
	//app-size
	function pns_app_size($appid,$online){
		$method = 'app-size';
		$data = 'online='.$online.'&'.
            'appid='.$appid.'';
		return $this->curl_wrap($method, $data);
	}
	
	
	//wrapper for curl
	//for the HTTP interface, refer to http://dev.cobub.com/docs/cobub-toaster/
	
	function curl_wrap($method, $postdata){

		$url =  'http://'.$this->server['server_add'].':'.$this->server['server_port'].'/'.$method;
		//echo $url;
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
		
		$http_return = curl_exec ( $curl );
		
		$result = array(
				'http_code' => curl_getinfo($curl,CURLINFO_HTTP_CODE),
				'json_return' => json_decode($http_return),
				'http_raw' => $http_return,
				'curl_errno' => curl_errno($curl)
				);
		
		curl_close ( $curl );
		return $result;
		
	}
}

?>