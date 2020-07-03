<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class usuario_model extends CI_Model {

	function __construct() {
			parent::__construct();
	}

	function get_usuarios(){
		$this->db->where('id_empresa', '0');
		$this->db->order_by("id", "desc");
		$query = $this->db->get('tbl_usuario');
		return $query->result();
	}

	function get_qtd_usuario_by_email($email){
		$this->db->where('email', $email);
		$this->db->from('tbl_usuario');
		return $this->db->count_all_results();
	}

	function get_qtd_usuario_by_email_another_id($email, $id){
		$this->db->where('email', $email);
		$this->db->where('id !=', $id);
		$this->db->from('tbl_usuario');
		return $this->db->count_all_results();
	}

	function altera_usuario($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('tbl_usuario', $data);
	}

	function get_usuario_by_id($id){
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_usuario');
		return $query->result();
	}

	function cad_usuario($data){
		$this->db->insert('tbl_usuario', $data);
	}

	function deleta_usuario($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_usuario');
	}
}
