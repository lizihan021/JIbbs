<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }
	
	public function register()
	{
		$this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('username', '用户名', 'trim|required|alpha_numeric|min_length[3]|max_length[12]|is_unique[bbs_user.username]');
        $this->form_validation->set_rules('password', '密码', 'trim|required|md5');
        
        
        if ($this->form_validation->run() == FALSE)
        {
            //form failed
            //$data['cap_image']=$this->_get_cap_image();
            //$data['site_title'] = '注册';
            //$this->load->view('user_reg', $data);
        }
        else
        {
            //form success
            $data = array(
                'username' => strtolower($this->input->post('username')),
                'password' => $this->input->post('password'),
                //'email' => $this->input->post('email'),
                //'regtime' => time()
            );
            $this->user_moodel->register($data);
            //$this->user_m->login($data);
            //更新网站统计信息 注册用户
            //$this->db->set('ovalue', 'ovalue+1', FALSE)->where('oname', 'site_user_number')->update('letsbbs_option');
            //redirect();
        }
	}
	
}

?>