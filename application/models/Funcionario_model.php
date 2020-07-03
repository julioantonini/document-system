<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class funcionario_model extends CI_Model {

	function __construct() {
			parent::__construct();
	}

	function get_empresas(){
		$this->db->order_by("empresa", "asc");
		$query = $this->db->get('tbl_cliente');
		return $query->result();
	}

	function get_qtd_funcionario_by_email($email){
		$this->db->where('email', $email);
		$this->db->from('tbl_usuario');
		return $this->db->count_all_results();
	}

	function get_qtd_funcionario_by_email_another_id($email, $id){
		$this->db->where('email', $email);
		$this->db->where('id !=', $id);
		$this->db->from('tbl_usuario');
		return $this->db->count_all_results();
	}

	function get_funcionarios($id){
		$this->db->where('id_empresa', $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get('tbl_usuario');
		return $query->result();
	}

	function altera_funcionario($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('tbl_usuario', $data);
	}

	function get_cliente_by_id($id){
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_cliente');
		return $query->result();
	}

	function get_funcionario_by_id($id){
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_usuario');
		return $query->result();
	}

	function cad_funcionario($data){
		$this->db->insert('tbl_usuario', $data);
	}

	function deleta_funcionario($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_usuario');
	}
	
}
