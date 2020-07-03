<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class site_model extends CI_Model {
	
	function __construct() {
			parent::__construct();
	}

	function get_usuario_by_email($email){
		$this->db->where('email', $email);
		$query = $this->db->get('tbl_usuario');
		return $query->result();
	}

	function get_usuario_by_id($id){
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_usuario');
		return $query->result();
	}

	function get_tipos_by_categoria($id_categoria, $id_cliente){
		$this->db->select('tbl_tipo.id, tbl_tipo.id_categoria, tbl_tipo.nome');
		$this->db->from('tbl_tipo');
		$this->db->where('tbl_tipo.id_categoria', $id_categoria);
		$this->db->where('tbl_documento.id_cliente', $id_cliente);
		$this->db->join('tbl_documento', 'tbl_tipo.id = tbl_documento.id_tipo');
		$this->db->order_by("tbl_tipo.nome", "asc");
		$this->db->distinct();
		$query = $this->db->get();
		return $query->result();
	}

	function get_documentos_by_tipo($cliente, $tipo){
		$this->db->where('id_cliente', $cliente);
		$this->db->where('id_tipo', $tipo);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('tbl_documento');
		return $query->result();
	}

	function get_tipo_by_id($id){
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_tipo');
		return $query->result();
	}

	function get_cliente_by_id($id){
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_cliente');
		return $query->result();
	}

	function altera_senha($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('tbl_usuario', $data);
	}

	function get_documento_by_id($id){
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_documento');
		return $query->result();
	}

}
