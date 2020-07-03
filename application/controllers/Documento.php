<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documento extends CI_Controller {
	function __construct() {
      parent::__construct();
			if(!isset($this->session->usuario_logado['usuario_admin']) || ($this->session->usuario_logado['usuario_admin'] != true))
			{
				$this->session->set_flashdata('erro','Acesso negado!');
				redirect('/entrar');
			}

			$this->load->model('documento_model');
  }

	public function index()
	{
		if($this->input->post('acao'))
		{
			$this->form_validation->set_rules('empresa', 'Cliente', 'trim|required');
			if ($this->form_validation->run() == TRUE) {
				$data['cliente'] = $this->documento_model->get_cliente_by_id($this->input->post('empresa'));
				$data['documentos'] = $this->documento_model->get_documentos($this->input->post('empresa'));
			}
		}
		else
		{
			if($this->session->flashdata('empresa_id')){
				$data['cliente'] = $this->documento_model->get_cliente_by_id($this->session->flashdata('empresa_id'));
				$data['documentos'] = $this->documento_model->get_documentos($this->session->flashdata('empresa_id'));
			}
		}

		$data['empresas'] = $this->documento_model->get_empresas();
		$this->load->view('header',$data);
		$this->load->view('documento-gerencia');
		$this->load->view('footer');
	}

	public function cadastrar()
	{

		if($this->input->post('acao'))
		{
			$this->form_validation->set_rules('cliente', 'Cliente', 'trim|required');
	    $this->form_validation->set_rules('categoria', 'Categoria', 'trim|required');
			$this->form_validation->set_rules('tipo', 'Tipo documento', 'trim|required');
			$this->form_validation->set_rules('nome', 'Nome do documento', 'trim|required');


	    if ($this->form_validation->run() == TRUE) {


						if (!empty($_FILES['userfile']['name']))
						{
							$file_name = $_FILES['userfile']['name'];
							$tmp = explode('.', $file_name);
							$file_ext = end($tmp);
							$file_ext = strtolower($file_ext);



							if($file_ext != "exe")
							{
								if($this->upload() != false)
								{
									//cadastra com logotipo
									$data = array(
										'id_cliente' 		=> $this->input->post('cliente'),
										'id_categoria' 	=> $this->input->post('categoria'),
										'id_tipo' 			=> $this->input->post('tipo'),
										'documento_nome'=> $this->input->post('nome'),
										'nome' 					=> $this->upload->file_name,
										'data_cad' 			=> date('Y-m-d H:i:s'),
									);
									$this->documento_model->cad_documento($data);
									$this->session->set_flashdata('empresa_id', $this->input->post('cliente'));
									$this->session->set_flashdata('sucesso', 'O documento foi <b>'.remove_tracos($this->upload->file_name).'</b> cadastrado com sucesso.');
									redirect('/documento', 'refresh');
								}
								else
								{
									$data['erro_upload'] = $this->upload->display_errors();
								}
							}
							else
							{
								$data['erro_upload'] = "O tipo de arquivo que você está tentando fazer upload não é permitido.";
							}
						}
						else
						{
							$data['erro_upload'] = 'Selecione um arquivo para realizar o cadastro.';
						}
				}
	    }

		$data['empresas'] = $this->documento_model->get_empresas();
		$data['categorias'] = $this->documento_model->get_categorias();
		$this->load->view('header', @$data);
		$this->load->view('documento-cad');
		$this->load->view('footer');
	}

	public function get_tipos($id = 0)
	{
		if($id != 0)
		{
			$tipos = $this->documento_model->get_tipo_by_categoria($id);
			echo '<option value="">Selecione</option>';
			foreach($tipos as $tipo){
				echo	'<option value="'.$tipo->id .'">'.$tipo->nome.'</option>';
			}
		}
		else
		{
			echo '<option value="" selected="selected">Selecione a categoria</option>';
		}
	}

	public function download($id = 0)
	{
		if($id == 0)
		{
			redirect('/documento', 'refresh');
		}
		$documento = $this->documento_model->get_documento_by_id($id);
		$this->load->helper('download');
		$arquivo = 'uploads/documentos/'.$documento[0]->nome;
		force_download($arquivo , NULL);
	}

	public function deletar($id = 0)
	{
		if($id == 0)
		{
			redirect('/documento', 'refresh');
		}

		$documento = $this->documento_model->get_documento_by_id($id);

		if(file_exists('uploads/documentos/'.$documento[0]->nome)){
			@unlink('uploads/documentos/'.$documento[0]->nome);
		}

		$this->documento_model->deleta_documento($id);
		$this->session->set_flashdata('empresa_id', $documento[0]->id_cliente);
		$this->session->set_flashdata('sucesso', 'O documento <b>'.remove_tracos($documento[0]->nome).'</b> foi apagado com sucesso!');
		redirect('/documento', 'refresh');
	}

	function upload() {
		//parametriza as preferências
		$config["upload_path"] = "./uploads/documentos/";
		$config["allowed_types"] = "*";
		$config["overwrite"] = FALSE;
		$config["file_ext_tolower"] = TRUE;
		$config["encrypt_name"] = FALSE;
		$config["file_name"] = remove_acentos($_FILES['userfile']['name']);
		$this->load->library("upload", $config);

		if ($this->upload->do_upload()) {

			return $this->upload->file_name;
		} else {
			return  false;
		}
	}

}
