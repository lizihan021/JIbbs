<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model
{
	
	private $validation_rules;
	
    function __construct()
    {
        parent::__construct();
		$this->validation_rules = array
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
    
	public function login($data)
    {
        $this->db->where('username', $data['username']);
        $query = $this->db->get('bbs_user');
        if ($query->num_rows() > 0)
		{
            $user = $query->row_array();
            if ($user['password']==$data['password'])
			{
                $this->session->set_userdata('username', $user['username']);
                //$this->session->set_userdata('uid', $user['uid']);
                //$this->session->set_userdata('group_id', $user['group_id']);
                //$this->session->set_userdata('notification', $user['notice']);
                //$this->session->set_userdata('is_active', $user['is_active']);
                //$this->session->set_userdata('avatar', $user['avatar']);
                //$this->session->set_userdata('node_follow', $user['node_follow']);
                //$this->session->set_userdata('user_follow', $user['user_follow']);
                //$this->session->set_userdata('topic_follow', $user['topic_follow']);
                return TRUE;
            }
			else
			{
                return FALSE;
            }
        }
		else
		{
            return FALSE;
        }
    }
	
	public function get_validation_rules($data)
	{
		return $this->validation_rules[$data];
	}
	
	
}    
?>