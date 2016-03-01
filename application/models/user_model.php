<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model
{
	
	public $validation_rules;
	
    function __construct()
    {
        parent::__construct();
		$this->$validation_rules = array
		(
			'username' => 'trim|required|alpha_dash|min_length[3]|max_length[12]|is_unique[bbs_user.username]',
			'password' => 'trim|required|min_length[6]|max_length[20]',
			'email'    => 'trim|required|valid_email|is_unique[bbs_user.email]',
			'captcha'  => 'trim|callback_captcha_check'
		);
    }
    
	
	
	
    /**
     * 用户注册
     * @param  $data  注册信息
     */
    public function register($data)
    {
    	return $this->db->insert('bbs_user', $data);
    }
    
	public function get_validation_rules($data)
	{
		return $this->$validation_rules[$data];
	}
}    
?>