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
 * @filesource	controller of push
 */
class push extends CI_Controller {

	public function index()
	{
		$this->load->view('user_push');
	}
}

