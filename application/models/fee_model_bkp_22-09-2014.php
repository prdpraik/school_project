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
		$this->db->where('fee_category_delete','N');
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
	function getfeeparticular($fp_id){
		
		$this->db->select('fee_categories.fee_category as fcategory,fee_particulars.*');
		$this->db->from('fee_particulars,fee_categories');
		$this->db->where('fee_categories.fee_category_id = fee_particulars.fee_category_id');
		$this->db->where('fee_particular_id',$fp_id);
		$this->db->where('fee_particular_delete','N');
		$query =  $this->db->get_where();
		return $query->row_array();
		
	}
	function getfcdata(){
		$this->db->select('fee_category_id,fee_category');
		$this->db->where('fee_category_status','active');
		$this->db->where('fee_category_delete','N');
		$query =  $this->db->get_where('fee_categories');
		return $query->result();
	}
	function getfpdata($fc_id){
		$this->db->select('fee_particular_id,fee_particular_name');
		$this->db->where('fee_category_id',$fc_id);
		$this->db->where('fee_particular_status','active');
		$this->db->where('fee_particular_delete','N');
		$query =  $this->db->get_where('fee_particulars');
		return $query->result();
	}
	function insert_feeperiod($fcpdata){
		
		return $this->db->insert('fee_periods',$fcpdata);
		
	}
	function getfeeperiods(){
		
		$this->db->select('fee_categories.fee_category as fcategory,fee_particulars.fee_particular_name as fpname,fee_periods.*');
		$this->db->from('fee_periods');
		$this->db->join('fee_categories','fee_categories.fee_category_id = fee_periods.fee_period_cid');
		$this->db->join('fee_particulars','fee_particulars.fee_particular_id = fee_periods.fee_period_pid');
		$this->db->where('fee_period_delete','N');
		$query = $this->db->get();
		return $query->result();
		
	}
	function update_feeperiod($fpdata,$fp_id){
		$this->db->where('fee_period_id',$fp_id);
		return $this->db->update('fee_periods',$fpdata);
	}
	function getfeeperiod($fp_id){
		$this->db->where('fee_period_id',$fp_id);
		$query =  $this->db->get_where('fee_periods');
		return $query->row_array();
	}
	function chkparticular($fp_val,$fc_id,$prv_fp_val){
		
		$this->db->where('fee_category_id',$fc_id);
		$this->db->where('fee_particular_name',$fp_val);
		$this->db->where('fee_particular_name !=',$prv_fp_val);
		
		return $this->db->count_all_results('fee_particulars');
		
	}
	function getfeeclassdata($fc_cid){
		$this->db->select('fee_categories.fee_category,class.name cname,fee_particulars.*,');
		$this->db->from('fee_particulars');
		$this->db->join('fee_categories','fee_categories.fee_category_id = fee_particulars.fee_category_id');
		$this->db->join('class ','class.class_id  = fee_particulars.fee_particular_type_id');
		$this->db->where('fee_particular_type_id',$fc_cid);
		$query = $this->db->get();
		
		return $query->result();
	}
	function getfeealldata($fc_cid){
		$this->db->select('fee_categories.fee_category,class.name cname,fee_particulars.*,');
		$this->db->from('fee_particulars,class');
		$this->db->join('fee_categories','fee_categories.fee_category_id = fee_particulars.fee_category_id');
		//$this->db->join('class ','class.class_id  = fee_particulars.fee_particular_type_id');
		$this->db->where('fee_particular_type','fp_all');
		$this->db->where('class.class_id',$fc_cid);
		$query = $this->db->get();
		
		return $query->result();
	}
	function getfeerolldata($fc_cid,$fc_rollid){
		
		$this->db->select('fee_categories.fee_category,class.name cname,fee_particulars.*,');
		$this->db->from('fee_particulars');
		$this->db->join('fee_categories','fee_categories.fee_category_id = fee_particulars.fee_category_id');
		$this->db->join('class ','class.class_id  = fee_particulars.fee_particular_type_cid');
		$this->db->like('fee_particular_type_id',','.$fc_rollid.',');
		$this->db->where('fee_particular_type_cid',$fc_cid);
		$query = $this->db->get();
		return $query->result();
	}
	
	function getfeestandarddata($fc_cid){
		
		$this->db->select('standard_id');
		$this->db->from('class');
		$this->db->where('class_id',$fc_cid);
		$query = $this->db->get();
		
		$query_res =$query->row_array();
		
		extract($query_res); 
		
		$this->db->select('fee_categories.fee_category,class.name cname,fee_particulars.*,');
		$this->db->from('fee_particulars,class');
		$this->db->join('fee_categories','fee_categories.fee_category_id = fee_particulars.fee_category_id');
		$this->db->where('fee_particular_type_id',$standard_id);
		$this->db->where('class.class_id',$fc_cid);
		$query = $this->db->get();
		
		return $query->result();
	}
	
}