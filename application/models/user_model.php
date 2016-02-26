<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_Model extends CI_Model
{
	
    function __construct()
    {
        parent::__construct();
    }
    
    /**
     * 用户注册
     * @param  $data  注册信息
     */
    public function register($data)
    {
    	return $this->db->insert('bbs_user', $data);
    }
    

}    
?>