<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailtest extends CI_controller{

	function __construct(){
		parent::__construct();
		$this->load->model('Mail_model');
	}

	function index(){
		echo '1';
		$a = $this->Mail_model->send('lizihan@umich.edu','hi','hi');
		echo "$a";
	}

}