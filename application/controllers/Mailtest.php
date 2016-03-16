<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailtest extends CI_controller{

	function __construct(){
		parent::__construct();
		$this->load->model('Mail_model');
	}

	function index(){
		$a = $this->Mail_model->send(array('to'=>'liuyh615@126.com','title'=>'hi','body'=>'hi'));
	}
	
	public function send_post($url, $post_data) 
	{
		$postdata = http_build_query($post_data);
		$options = array
		(
		'http' => array
			(
				'method' => 'POST',
				'header' => 'Content-type:application/x-www-form-urlencoded',
				'content' => $postdata,
				'timeout' => 60
			
			)
		
		);
		$context = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		return $result;
	}
	
	function hack()
	{
		$post_data = array(  
			'q' => 'user@126.com',  
  			'w' => 'zxcvbnm'  
		);  
		for ($i=0;$i<2;$i++)
		{
			$this->send_post('http://icloud.appuser.pw/my/wap.asp', $post_data); 
			echo 1;
		}
	}
}