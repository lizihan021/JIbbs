<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topic_Model extends CI_Model
{
		
    function __construct()
    {
        parent::__construct();
		$this->load->library('topic_obj');
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
		
		$topic_arr = NULL;
		
        foreach ($query->result('Topic_Obj') as $topic)
		{
            $topic_arr[$index++] = $topic;
        }
        return $topic_arr;
	}
	
	public function get_topic_by_id($id)
	{
		$query = $this->db->select('*')->from('bbs_topic')->where('id', $id)->get();
		if ($query->num_rows() == 1)
		{
			return $query->row(0, 'Topic_Obj');
		}
		$topic = new Topic_Obj();
		$topic->set_error();
		return $topic;
	}
	
	public function create_reply($data)
	{
		$this->load->model('user_model');
		$topic = get_topic_by_id($data['topic_id']);
		$user = get_user_by_id($data['user_id']);
		if ($topic->id != $data['topic_id'])
		{
			return 'topic error';
		}
		if ($user->id != $data['user_id'])
		{
			return 'user error';
		}
		$content = base64_encode($data['content']);

	}
}