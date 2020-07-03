<?php

function get_estados()
{
    $ci =& get_instance();
    $ci->db->order_by("nome", "asc");
    $query = $ci->db->get('tbl_estado');
    return $query->result();
}

function get_categoria_nome($id){
  $ci =& get_instance();
  $ci->db->where('id', $id);
  $query = $ci->db->get('tbl_categoria');
  $categoria = $query->result();
  return $categoria[0]->nome;
}

function get_foto_categoria($id){
  $ci =& get_instance();
  $ci->db->where('id', $id);
  $query = $ci->db->get('tbl_categoria');
  $categoria = $query->result();
  return $categoria[0]->foto;
}

function get_tipo_nome($id){
  $ci =& get_instance();
  $ci->db->where('id', $id);
  $query = $ci->db->get('tbl_tipo');
  $tipo = $query->result();
  return $tipo[0]->nome;
}

function get_logotipo($id){
  $ci =& get_instance();
  $ci->db->where('id', $id);
  $query = $ci->db->get('tbl_cliente');
  $cliente = $query->result();
  if($id == '0'){
    return 'img-default.jpg';
  }
  else
  {
    return $cliente[0]->logotipo;
  }
}

function get_status($status){
  if($status=='0')
  {
    return "Inativo";
  }
  else{
    return "Ativo";
  }
}

function remove_acentos($variavel){
	$procurar 	= array('à','ã','â','é','ê','í','ó','ô','õ','ú','ü','ç',);
	$substituir = array('a','a','a','e','e','i','o','o','o','u','u','c',);
	$variavel = strtolower($variavel);
	$variavel	= str_replace($procurar, $substituir, $variavel);
  $ext = explode('.',$variavel);
  $variavel = $ext[0];
	$variavel = htmlentities($variavel);
  $variavel = preg_replace("/&(.)(acute|cedil|circ|ring|tilde|uml);/", "$1", $variavel);
  $variavel = preg_replace("/([^a-z0-9]+)/", "-", html_entity_decode($variavel));
  return trim($variavel, "-");
}

function remove_tracos($variavel){
  $variavel	= remove_acentos($variavel);
  return str_replace('-', ' ', $variavel);
}

function data_br($data){
  return date('d/m/Y - H:i:s', strtotime($data));
}

function get_qtds($tabela, $campo, $id){
  $ci =& get_instance();
  $ci->db->where($campo, $id);
  $ci->db->from($tabela);
  return $ci->db->count_all_results();
}
