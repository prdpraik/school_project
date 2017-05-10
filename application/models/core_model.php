<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Core_model extends MY_Model {

	private $database_table = 'student';

	public function __construct()
	{
		parent::__construct();
	}

	public function get_rows($filters = array(), $table = 'student')
	{
		return parent::get_rows($filters, $table);
	}

	public function get_columns($table = 'user')
	{
		return parent::get_columns($table);
	}

	public function update_table($data, $where, $table = 'student', $set='')
	{
		return parent::update_table($data, $where, $table, $set='');
	}

	public function get_count($filters = array(), $table = 'student')
	{
		return parent::get_count($filters, $table);
	}

	public function insert($data, $table = 'student')
	{
		return parent::insert($data, $table);
	}

	public function delete($where, $table = 'student')
	{
		return parent::delete($where, $table);
	}
}
/* End of file portal_model.php */
/* Location: ./application/models/designation_model.php */
