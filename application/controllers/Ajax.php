<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller 
{
	
	public function __construct()
    {
        parent::__construct();
		//$this->load->database();
    }
	
	public function text_validation()
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
	
	public function get_preview_topic()
	{
		$this->load->model('topic_model');
		$this->load->model('user_model');
		$this->load->model('module_model');
		//$id = $this->input->get('id');
		$topic_arr = $this->topic_model->get_topic_arr(array
		(
			'module_id'   => $this->input->get('module_id'),
			'first'       => $this->input->get('first'),
			'step'        => $this->input->get('step'),
			'order_field' => $this->input->get('order_field'),
			'order'       => $this->input->get('order'),
			'key'         => $this->input->get('key')
		));
		
		if (count($topic_arr) == 0)
		{
			return;
		}
		
		$index = 0;
		foreach ($topic_arr as $topic)
		{
			$topic_str[$index++] = 
				 'user_name,'       . $this->user_model->get_user_by_id($topic->user_id)->username .
				',user_reply_name,' . $this->user_model->get_user_by_id($topic->last_reply_id)->username .
				',module_name,'     . $this->module_model->get_module_by_id($topic->module_id)->name .
				',module_id,'       . $topic->module_id .
				',topic_name,'      . $topic->name .
				',topic_id,'        . $topic->id .
				',reply_num,'       . $topic->reply_num .
				',time_ago,'        . '1s ago'
			;
		}
		echo implode('|', $topic_str);
		//print_r(serialize($data));
		//echo 'module_name,'.$id.'|module_name,'.$id.'|module_name,'.$id.'|module_name,'.$id.'';
		
	}
	
}