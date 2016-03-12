<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailtest extends CI_controller{

	function __construct(){
		parent::__construct();
		$this->load->model('Mail_model');
	}

	function index(){
		$a = $this->Mail_model->send(array('to'=>'liuyh615@126.com','title'=>'hi','body'=>'hi'));
	}

}