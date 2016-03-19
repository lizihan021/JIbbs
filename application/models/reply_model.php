<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reply_Model extends CI_Model
{
		
    function __construct()
    {
        parent::__construct();
		$this->load->library('reply_obj');
    }
	
	public function get_reply_arr($data)
	{
		$data['first'] < 0 ? $data['first'] = 0 : 1;
		$data['step'] < 1 ? $data['step'] = 10 : 1;
		$data['order'] != 'desc' ? $data['order'] = 'asc' : 1;

		$this->db->select('*')->from('bbs_reply')
			->order_by($data['order_field'], $data['order'])
			->limit($data['first'], $data['step'])
			->like('content', $data['key']);
			
		if ($data['topic_id'] > 0)
		{
			$this->db->where('topic_id', $data['topic_id']);
		}
		
		$query = $this->db->get();
		
		$index = 0;
		
		$reply_arr = NULL;
		
        foreach ($query->result('Reply_Obj') as $reply)
		{
            $reply_arr[$index++] = $reply;
        }
        return $reply_arr;
	}
}