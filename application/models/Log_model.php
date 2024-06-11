<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Log_model extends CI_Model
{
   
    public function create($data)
	{
		if ($data) {
			$this->db->insert('user_log', $data);

			$id = $this->db->insert_id();
			return $id;
		
	}
  }
}

?>
