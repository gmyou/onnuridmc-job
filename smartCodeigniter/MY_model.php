<?php 

/**
* application/core/MY_Model.php
*/
class MY_Model extends CI_Model {
	
	protected $TABLE_NAME;
	protected $HISTORY_TABLE_NAME;
	protected $PK_NAME;
	protected $HISTORY_PK_NAME;
	
	function __construct()
	{
		parent::__construct();
	}
	
	private function _setMyWhere($obj) {
		if (@$obj['where'])
			$this->db->where($obj['where']);
		if (@$obj['in'])
			foreach ($obj['in'] as $key=>$value) {
				$this->db->where_in($key, $value);
			}
		if (@$obj['like'])
			foreach ($obj['like'] as $key=>$value) {
				$this->db->like($key, $value, NULL, false);
			}
		if (@$obj['string'])
			$this->db->where($obj['string']);
	}
	
	function getCountByObject($obj=null) {
	
		$this->db->from($this->TABLE_NAME);
			
		if ($obj) $this->_setMyWhere($obj);
		
		$result = $this->db->count_all_results();

		return $result;
	
	}
	
	function getPKByObject($obj=null) {
	
		$this->db->select($this->PK_NAME);
		$this->db->from($this->TABLE_NAME);
			
		if ($obj) $this->_setMyWhere($obj);
		
		$result = $this->db->get()->row_array();

		return $result;
	
	}

	/**
	 * 
	 * @param array $obj
	 * @return row_array
	 */
	function getInfoByObject($obj) {
		
		$this->db->from($this->TABLE_NAME);
		 
		if (@$obj['where'])
			$this->db->where($obj['where']);
		if (@$obj['in'])
			foreach ($obj['in'] as $key=>$value) {
				$this->db->where_in($key, $value);
			}
		if (@$obj['not_in'])
			foreach ($obj['not_in'] as $key=>$value) {
				$this->db->where_not_in($key, $value);
			}
		
		$result = $this->db->get()->row_array();

		return $result;
		
	}

	/**
	 * 
	 * @param array $obj
	 * @return result_array
	 */
	function getListsByObject($obj) {
		
		$this->db->from($this->TABLE_NAME);
		 
		if (@$obj['where'])
			$this->db->where($obj['where']);
		if (@$obj['in'])
			foreach ($obj['in'] as $key=>$value) {
				$this->db->where_in($key, $value);
			}
		if (@$obj['not_in'])
			foreach ($obj['not_in'] as $key=>$value) {
				$this->db->where_not_in($key, $value);
			}
		
		$result = $this->db->get()->result_array();

		return $result;
		
	}
	
	function getInfoByIndex($idx) {
	
		$this->db->from($this->TABLE_NAME);
		$this->db->where($this->PK_NAME, $idx);
	
		$result = $this->db->get()->row_array();

		return $result;
	
	}
	
	/**
	 * 
	 * @param object $obj
	 * @param int, array $idx
	 * @return int $affected_rows
	 */
	function /*void*/ updateInfoByIndex(/*object*/$obj, /*int, array*/$idx) {
		$idx = (is_array($idx))? implode($idx, ','): $idx;
		$idx = array_map( 'intval', explode(',', $idx ) );
		
		$this->db->where_in($this->PK_NAME, $idx);
		$this->db->update($this->TABLE_NAME, $obj);

		return ($this->db->affected_rows()==0)? 1: $this->db->affected_rows();
	
	}

	/**
	 *
	 * @param object $obj
	 * @param int, array $idx
	 * @return int $affected_rows
	 */
	function /*void*/ updateInfoByIndexNotEscape(/*object*/$obj, /*int, array*/$idx) {
		$idx = (is_array($idx))? implode($idx, ','): $idx;
		$idx = array_map( 'intval', explode(',', $idx ) );
	
		$this->db->where_in($this->PK_NAME, $idx);
	
		foreach($obj AS $key=>$val) {
			$this->db->set($key, $val, false);
		}
	
		$this->db->update($this->TABLE_NAME);
	
		return ($this->db->affected_rows()==0)? 1: $this->db->affected_rows();
	
	}

	/**
	 * 
	 * @param object $obj
	 * @param int, array $idx
	 * @return int $affected_rows
	 */
	function /*void*/ updateHistoryInfoByIndex(/*object*/$obj, /*int, array*/$idx) {
		$idx = (is_array($idx))? implode($idx, ','): $idx;
		$idx = array_map( 'intval', explode(',', $idx ) );
		
		$this->db->where_in($this->HISTORY_PK_NAME, $idx);
		$this->db->update($this->HISTORY_TABLE_NAME, $obj);

		return ($this->db->affected_rows()==0)? 1: $this->db->affected_rows();
	
	}
	
	/**
	 * 
	 * @param unknown $data
	 * @param unknown $obj
	 * @return number
	 */
	function /*void*/ updateInfoByObject(/*object*/$data, /*object*/$obj) {
		
		$this->db->where($obj);
		$this->db->update($this->TABLE_NAME, $data);

		return ($this->db->affected_rows()==0)? 1: $this->db->affected_rows();
	
	}
	
	/**
	 *
	 * @param object $obj
	 * @param int $idx
	 * @return void
	 */
	function /*void*/ deleteInfoByIndex(/*int, array*/$idx) {
		$idx = (is_array($idx))? implode($idx, ','): $idx;
		$idx = array_map( 'intval', explode(',', $idx ) );
		
		$this->db->where_in($this->PK_NAME, $idx);
		$this->db->delete($this->TABLE_NAME);
	}
	
	/**
	 *
	 * @param object $obj
	 * @return void
	 */
	function /*void*/ deleteInfoByObject(/*object*/$obj) {
		$this->db->where($obj);
		$this->db->delete($this->TABLE_NAME);

		return $this->db->affected_rows();
	}
	
	/**
	 *
	 * @param object $obj
	 * @param int $idx
	 * @return int $insert_id
	 */
	function insertInfoByObject($obj) {
	
		$this->db->insert($this->TABLE_NAME, $obj);
		
		return $this->db->insert_id();
		
	}
	
	/**
	 *
	 * @param object $obj
	 * @param int $idx
	 * @return int $insert_id
	 */
	function insertHistoryInfoByObject($obj) {
	
		$this->db->insert($this->HISTORY_TABLE_NAME, $obj);
		
		return $this->db->insert_id();
		
	}
	
	/**
	 *
	 * @param object $obj
	 * @param int $idx
	 * @return int $insert_id
	 */
	function insertInfoBatchByObject($obj) {
	
		$this->db->insert_batch($this->TABLE_NAME, $obj);
		
		return count($obj);
		
	}
	
	/**
	 * 
	 * @param unknown $idx
	 */
	function getInfoIndex($idx) {
		 
		$this->db->from($this->TABLE_NAME);
		$this->db->where($this->PK_NAME, $idx);
		 
		$result = $this->db->get()->row_array();
    	
    	return $result;
		 
	}
	
	/**
	 * 
	 * @param unknown $idx
	 */
	function getHistoryInfoIndex($idx) {
		 
		$this->db->from($this->HISTORY_TABLE_NAME);
		$this->db->where($this->HISTORY_PK_NAME, $idx);
		 
		$result = $this->db->get()->row_array();
    	
    	return $result;
		 
	}
}

?>