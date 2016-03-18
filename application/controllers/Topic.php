<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Topic extends Front_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('topic_model');
    }
	
	public function _remap($id, $method)
	{
		$data['id'] = $id;
		$query = $this->db->get_where('bbs_topic', 'id='.$id);
		if ($query->num_rows() != 1)
		{
			
		}
		else
		{
			$topic = $query->row(0, 'Topic_Obj');
			$data['site_title'] = $topic->name;
			$this->load->view('topic', $data);
		}
		
		
	}
}

?>