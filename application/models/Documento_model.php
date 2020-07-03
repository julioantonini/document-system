<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class documento_model extends CI_Model {


	function __construct() {
			parent::__construct();
	}

	function get_documentos($id){
		$this->db->where('id_cliente', $id);
		$this->db->order_by("id", "desc");
		$query = $this->db->get('tbl_documento');
		return $query->result();
	}

	function get_empresas(){
		$this->db->order_by("empresa", "asc");
		$query = $this->db->get('tbl_cliente');
		return $query->result();
	}

	function get_categorias(){
		$this->db->order_by("nome", "asc");
		$query = $this->db->get('tbl_categoria');
		return $query->result();
	}

	function get_tipo_by_categoria($id){
		$this->db->where('id_categoria', $id);
		$query = $this->db->get('tbl_tipo');
		return $query->result();
	}

	function get_cliente_by_id($id){
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_cliente');
		return $query->result();
	}

	function get_documento_by_id($id){
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_documento');
		return $query->result();
	}

	function cad_documento($data){
		$this->db->insert('tbl_documento', $data);
	}

	function deleta_documento($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_documento');
	}
}
