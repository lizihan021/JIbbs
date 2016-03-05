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
        $this->form_validation->set_rules('text', $this->input->post('display'), $this->input->post('rules'));
		
		
		if ($this->form_validation->run() == FALSE)
        {
            //form failed
            echo validation_errors();
        }
        else
        {
            //form success
			echo 'success';
		}
		//echo $this->input->post('text');
	}
	
	/**
     * 检查验证码是否正确 需要输入验证码提交时验证的回调函数
     * @param   $cap 用户输入的验证码
     */
    public function captcha_check($cap)
    {
        if ($cap!=$this->session->userdata('captcha')) {
            $this->form_validation->set_message('captcha_check', '%s 输入不正确.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
	
}