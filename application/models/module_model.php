<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Module_Model extends CI_Model
{
		
    function __construct()
    {
        parent::__construct();
    }
	
	public function get_module_arr()
	{
		$query = $this->db->get('bbs_module');
		$modules = $query->result_array();
        foreach ($modules as $module)
		{
            $data[$module['id']] = $module['name_ch'];
        }
        return $data;
	}
}