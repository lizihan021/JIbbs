<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Text_Validation extends CI_Controller 
{
	public function __construct()
    {
        parent::__construct();
		$this->load->database();
    }
	
	public function index()
	{
		$this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('text', '用户名', $this->input->post('rules'));
		
		
		if ($this->form_validation->run() == FALSE)
        {
            //form failed
            echo validation_errors();
        }
        else
        {
            //form success
			echo 'true';
		}
		//echo $this->input->post('text');
	}
	
}