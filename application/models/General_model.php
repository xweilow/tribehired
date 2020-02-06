<?php
class General_model extends MY_Model {

    public function __construct() {
		parent::__construct();
	}

	public function create($table, $data) {
		if($table == 'news'){
			$data['created_at'] = date('Y-m-d H:i:s');
		}
		$this->db->insert($table, $data);
        return $this->db->insert_id();
	}

	public function get($table, $id) {
		$query = $this->db->get_where($table, array('id' => $id));
	    return $query->row_array();
	}

	public function sum($table, $cond, $col) {
		$this->db->select_sum($col, 'total');
		foreach ($cond as $key => $value) {
			$this->db->where($key, $value);
		}
		$query = $this->db->get($table);
		$result = $query->row_array();
		if(isset($result['total'])){
			return $result['total'];
		}
		return 0;
	}

	public function find($table, $cond) {
		$this->db->order_by($table.'.id', 'DESC');
		$query = $this->db->get_where($table, $cond);
	    return $query->result_array();
	}

	public function first($table, $cond) {
		$this->db->order_by($table.'.id', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get_where($table, $cond);
		$result = $query->result_array();
		if(sizeof($result) > 0)
	    	return $result[0];
		return array();
	}

	public function update($table, $idOrCond, $data) {
		if(is_array($idOrCond)){
			foreach ($idOrCond as $key => $value) {
				$this->db->where($key, $value);
			}
		} else {
			$this->db->where('id', $idOrCond);
		}

		return $this->db->update($table, $data);
	}

	public function delete($table, $id) {
		$this->db->set('is_deleted', 1);
		$this->db->where('id', $id);
		return $this->db->update($table);
	}

    public function count($table, $data){
        return $this->db->get_where($table, $data)->num_rows();
    }
}
