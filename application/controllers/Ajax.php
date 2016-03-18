<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller 
{
	
	public function __construct()
    {
        parent::__construct();
		$this->load->database();
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
	
	public function get_time_delay($time_str)
	{
		$now = time();
		$past = strtotime($time_str);
		$delay = $now - $past;
		$time_data = array
		(
			'second' => $delay % 60,
			'minute' => floor($delay /= 60) % 60,
			'hour'   => floor($delay /= 60) % 24,
			'day'    => floor($delay /= 24) % 365,
			'year'   => floor($delay /= 365)
		);
		$time_result = array
		(
			'second' => '秒',
			'minute' => '分钟',
			'hour'   => '小时',
			'day'    => '天',
			'year'   => '年'
		);
		
		$result = array();
		
		foreach ($time_data as $key => $value)
		{
			if ($value > 0)
			{
				$result[$key] = $value.$time_result[$key];
			}
			else
			{
				$result[$key] = '';
			}
		}
		
		$result_str = '';
		if ($result['year'] != '')
		{
			$result_str = $result['year'].$result['day'];
		}
		else if ($result['day'] != '')
		{
			$result_str = $result['day'].$result['hour'];
		}
		else if ($result['hour'] != '')
		{
			$result_str = $result['hour'].$result['minute'];
		}
		else
		{
			$result_str = $result['minute'].$result['second'];
		}
		return $result_str.'前';
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
				',user_avatar,'     . $this->user_model->get_user_by_id($topic->user_id)->avatar .
				',module_name,'     . $this->module_model->get_module_by_id($topic->module_id)->name .
				',module_id,'       . $topic->module_id .
				',topic_name,'      . $topic->name .
				',topic_id,'        . $topic->id .
				',reply_num,'       . $topic->reply_num .
				',time_ago,'        . $this->get_time_delay($topic->UPDATE_TIMESTAMP);
			;
		}
		echo implode('|', $topic_str);
		//print_r(serialize($data));
		//echo 'module_name,'.$id.'|module_name,'.$id.'|module_name,'.$id.'|module_name,'.$id.'';
		
	}
	
}