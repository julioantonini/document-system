<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cliente_model extends CI_Model {

	function __construct() {
			parent::__construct();
	}

	function get_clientes(){
		$this->db->order_by("id", "desc");
		$query = $this->db->get('tbl_cliente');
		return $query->result();
	}

	function get_qtd_cliente_by_cnpj($cnpj){
		$this->db->where('cnpj', $cnpj);
		$this->db->from('tbl_cliente');
		return $this->db->count_all_results();
	}

	function get_qtd_cliente_by_cnpj_another_id($cnpj, $id){
		$this->db->where('cnpj', $cnpj);
		$this->db->where('id !=', $id);
		$this->db->from('tbl_cliente');
		return $this->db->count_all_results();
	}

	function altera_cliente($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('tbl_cliente', $data);
	}

	function altera_logotipo($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('tbl_cliente', $data);
	}

	function get_cliente_by_id($id){
		$this->db->where('id', $id);
		$query = $this->db->get('tbl_cliente');
		return $query->result();
	}

	function get_qtd_usuario_by_empresa($id_empresa){
		$this->db->where('id_empresa', $id_empresa);
		$this->db->from('tbl_usuario');
		return $this->db->count_all_results();
	}

	function get_qtd_documentos_by_cliente($id_cliente){
		$this->db->where('id_cliente', $id_cliente);
		$this->db->from('tbl_documento');
		return $this->db->count_all_results();
	}

	function cad_cliente($data){
		$this->db->insert('tbl_cliente', $data);
	}

	function deleta_cliente($id){
		$this->db->where('id', $id);
		$this->db->delete('tbl_cliente');
	}
}
