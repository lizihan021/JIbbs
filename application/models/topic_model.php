<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topic_Model extends CI_Model
{
		
    function __construct()
    {
        parent::__construct();
		$this->load->library('topic');
    }
	
	public function get_topic_arr($data)
	{
		$data['first'] < 0 ? $data['first'] = 0 : 1;
		$data['step'] < 1 ? $data['step'] = 10 : 1;
		$data['order'] != 'desc' ? $data['order'] = 'asc' : 1;

		$this->db->select('*')->from('bbs_topic')
			->order_by($data['order_field'], $data['order'])
			->limit($data['first'], $data['step'])
			->like('name', $data['key']);
			
		if ($data['module_id'] > 0)
		{
			$this->db->where('module_id', $data['module_id']);
		}
		
		$query = $this->db->get();
		
		$index = 0;
		
        foreach ($query->result('Topic') as $topic)
		{
            $data[$index++] = $topic;
        }
        return $data;
	}
}