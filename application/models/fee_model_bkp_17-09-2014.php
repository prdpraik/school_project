<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class fee_model extends MY_Model {
	
	function insert_feecategory($fcdata){
		return $this->db->insert('fee_categories',$fcdata);
	}
	function getfeecategories(){
		$this->db->where('fee_category_delete','N');
		$query =  $this->db->get_where('fee_categories');
		return $query->result();
	}
	function getfeecategory($fc_id){
		$this->db->where('fee_category_id',$fc_id);
		$query =  $this->db->get_where('fee_categories');
		return $query->row_array();
	}
	function update_feecategory($fcdata,$fc_id){
		$this->db->where('fee_category_id',$fc_id);
		return $this->db->update('fee_categories',$fcdata);
	}
	function feecategory_count($fc_val,$prv_fc_val){
		
		$this->db->where('fee_category',$fc_val);
		$this->db->where('fee_category !=',$prv_fc_val);
		$this->db->where('fee_category_delete','N');
		return $this->db->count_all_results('fee_categories');
		
	}
	function feecategory_inc_count($fc_inc_val,$prv_fc_inc_val){
		
		$this->db->where('fc_invoice_pre_fix',$fc_inc_val);
		$this->db->where('fc_invoice_pre_fix !=',$prv_fc_inc_val);
		$this->db->where('fee_category_delete','N');
		return $this->db->count_all_results('fee_categories');
		
	}
	function getstandard(){
		$this->db->where('standard_status','active');
		$query = $this->db->get_where('standard');
		return $query->result();
	}
	function getclass(){
		$query = $this->db->get_where('class');
		return $query->result();
	}
	function getrolls($fp_cid){
		$this->db->where('class_id',$fp_cid);
		$query = $this->db->get_where('student');
		return $query->result();
	}
	function insert_feeparticular($fpdata){
		return $this->db->insert('fee_particulars',$fpdata);
	}
	function getfeeparticulars(){
		$this->db->select('fee_categories.fee_category as fcategory,fee_particulars.*');
		$this->db->from('fee_particulars,fee_categories');
		$this->db->where('fee_categories.fee_category_id = fee_particulars.fee_category_id');
		$this->db->where('fee_particular_delete','N');
		$query =  $this->db->get_where();
		return $query->result();
	}
	function update_feeparticular($fpdata,$fp_id){
		$this->db->where('fee_particular_id',$fp_id);
		return $this->db->update('fee_particulars',$fpdata);
	}
	function getsrolls($srolls,$sclass){
		
     	$sids = explode(",",$srolls);
		$this->db->select('roll,name,father_name');
		$this->db->where_in('roll',$sids );
		$this->db->where('class_id',$sclass);
		$query =  $this->db->get_where('student');
		return $query->result();
	}
}