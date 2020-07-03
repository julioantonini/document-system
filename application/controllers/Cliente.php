<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {
	function __construct() {
      parent::__construct();
			if(!isset($this->session->usuario_logado['usuario_admin']) || ($this->session->usuario_logado['usuario_admin'] != true))
			{
				$this->session->set_flashdata('erro','Acesso negado!');
				redirect('/entrar');
			}

			$this->load->model('cliente_model');
  }

	public function index()
	{
		$data['clientes'] = $this->cliente_model->get_clientes();
		$this->load->view('header',$data);
		$this->load->view('cliente-gerencia');
		$this->load->view('footer');
	}

	public function cadastrar()
	{

		if($this->input->post('acao'))
		{
			$this->form_validation->set_rules('empresa', 'Cliente', 'trim|required');
	    $this->form_validation->set_rules('cnpj', 'CNPJ', 'trim|required|min_length[18]');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');

	    if ($this->form_validation->run() == TRUE) {

				if($this->cliente_model->get_qtd_cliente_by_cnpj($this->input->post('cnpj'))==0)
				{
					if (!empty($_FILES['userfile']['name']))
					{
						if($this->upload() != false)
						{
							//cadastra com logotipo
							$data = array(
								'empresa' 		=> $this->input->post('empresa'),
								'cnpj' 				=> $this->input->post('cnpj'),
								'cep' 				=> $this->input->post('cep'),
								'endereco' 		=> $this->input->post('endereco'),
								'numero' 			=> $this->input->post('numero'),
								'bairro' 			=> $this->input->post('bairro'),
								'cidade' 			=> $this->input->post('cidade'),
								'estado' 			=> $this->input->post('estado'),
								'complemento'	=> $this->input->post('complemento'),
								'fone' 				=> $this->input->post('fone'),
								'status' 			=> $this->input->post('status'),
								'logotipo' 		=> $this->upload->file_name,
							);
							$this->cliente_model->cad_cliente($data);
							$this->session->set_flashdata('sucesso', 'O Cliente <b>'.$this->input->post('empresa').'</b> foi cadastrado com sucesso.');
							redirect('/cliente', 'refresh');
						}
						else
						{
							$data['erro_upload'] = $this->upload->display_errors();
						}
					}
					else
					{
						//cadastra sem logotipo
						$data = array(
							'empresa' 		=> $this->input->post('empresa'),
							'cnpj' 				=> $this->input->post('cnpj'),
							'cep' 				=> $this->input->post('cep'),
							'endereco' 		=> $this->input->post('endereco'),
							'numero' 			=> $this->input->post('numero'),
							'bairro' 			=> $this->input->post('bairro'),
							'cidade' 			=> $this->input->post('cidade'),
							'estado' 			=> $this->input->post('estado'),
							'complemento'	=> $this->input->post('complemento'),
							'fone' 				=> $this->input->post('fone'),
							'status' 			=> $this->input->post('status'),
						);
						$this->cliente_model->cad_cliente($data);
						$this->session->set_flashdata('sucesso', 'O Cliente <b>'.$this->input->post('empresa').'</b> foi cadastrado com sucesso.');
						redirect('/cliente', 'refresh');
					}

				}
				else{
					$data['erro_upload'] = 'Já existe um cliente cadastrado com este CNPJ.';
				}
	    }
		}
		$this->load->view('header', @$data);
		$this->load->view('cliente-cad');
		$this->load->view('footer');
	}

	public function alterar($id = 0)
	{
		if($id ==0)
		{
			redirect('/cliente', 'refresh');
		}
		if($this->input->post('acao'))
		{
			$this->form_validation->set_rules('empresa', 'Cliente', 'trim|required');
	    $this->form_validation->set_rules('cnpj', 'CNPJ', 'trim|required|min_length[18]');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');

	    if ($this->form_validation->run() == TRUE) {

				$data = array(
					'empresa' 		=> $this->input->post('empresa'),
					'cnpj' 				=> $this->input->post('cnpj'),
					'cep' 				=> $this->input->post('cep'),
					'endereco' 		=> $this->input->post('endereco'),
					'numero' 			=> $this->input->post('numero'),
					'bairro' 			=> $this->input->post('bairro'),
					'cidade' 			=> $this->input->post('cidade'),
					'estado' 			=> $this->input->post('estado'),
					'complemento'	=> $this->input->post('complemento'),
					'fone' 				=> $this->input->post('fone'),
					'status' 			=> $this->input->post('status'),
				);

				if($this->cliente_model->get_qtd_cliente_by_cnpj_another_id($this->input->post('cnpj'), $this->input->post('id'))==0)
				{
					$this->cliente_model->altera_cliente($this->input->post('id'), $data);
					$this->session->set_flashdata('sucesso', 'O cliente <b>'.$this->input->post('empresa').'</b> foi alterado com sucesso.');
					redirect('/cliente', 'refresh');
				}
				else{
					$this->session->set_flashdata('erro', 'Já existe um funcionário cadastrado com este CNPJ.');
				}
	    }
		}

		$data['cliente'] = $this->cliente_model->get_cliente_by_id($id);
		$this->load->view('header',$data);
		$this->load->view('cliente-altera');
		$this->load->view('footer');
	}

	public function deletar($id = 0)
	{
		if($id == 0)
		{
			redirect('/cliente', 'refresh');
		}

		$cliente = $this->cliente_model->get_cliente_by_id($id);

		$qtd_usuarios = $this->cliente_model->get_qtd_usuario_by_empresa($id);
		if($qtd_usuarios>0)
		{
			$this->session->set_flashdata('erro', 'O  cliente <b>'.$cliente[0]->empresa.'</b> possui <b>'.$qtd_usuarios.' funcionário(s)</b> cadastrado(s), apague-o(s) antes de apagar o cliente.');
			redirect('/cliente', 'refresh');
		}
		else
		{
			$qtd_documentos = $this->cliente_model->get_qtd_documentos_by_cliente($id);
			if($qtd_documentos>0)
			{
				$this->session->set_flashdata('erro', 'O  cliente <b>'.$cliente[0]->empresa.'</b> possui <b>'.$qtd_documentos.' documento(s)</b> cadastrado(s), apague-o(s) antes de apagar o cliente.');
				redirect('/cliente', 'refresh');
			}
			else
			{
				if($cliente[0]->logotipo !='img-default.jpg'){
					if(file_exists('uploads/logotipos/'.$cliente[0]->logotipo)){
						@unlink('uploads/logotipos/'.$cliente[0]->logotipo);
					}
				}
				$this->cliente_model->deleta_cliente($id);
				$this->session->set_flashdata('sucesso', 'O Cliente <b>'.$cliente[0]->empresa.'</b> foi apagado com sucesso!');
				redirect('/cliente', 'refresh');
			}
		}
	}

	public function logotipo($id)
	{
		if($id == 0)
		{
			redirect('/cliente', 'refresh');
		}

		$cliente = $this->cliente_model->get_cliente_by_id($id);
		$data['cliente'] = $cliente;

		if($this->input->post('acao'))
		{
					if (!empty($_FILES['userfile']['name']))
					{
						if($this->upload() != false)
						{
							if($cliente[0]->logotipo !='img-default.jpg'){
								if(file_exists('uploads/logotipos/'.$cliente[0]->logotipo)){
									@unlink('uploads/logotipos/'.$cliente[0]->logotipo);
								}
							}

							$data = array(
								'logotipo' 		=> $this->upload->file_name,
							);
							$this->cliente_model->altera_logotipo($cliente[0]->id, $data);
							$this->session->set_flashdata('sucesso', 'O logotipo do cliente <b>'.$cliente[0]->empresa.'</b> foi alterado com sucesso.');
							redirect('/cliente', 'refresh');
						}
						else
						{
							$data['erro_upload'] = $this->upload->display_errors();
						}
					}else{
						$data['erro_upload'] = 'Selecione uma imagem para realizar a alteração';
					}

		}
		$this->load->view('header', @$data);
		$this->load->view('cliente-logotipo');
		$this->load->view('footer');
	}

	function upload() {
		//parametriza as preferências
		$config["upload_path"] = "./uploads/logotipos/";
		$config["allowed_types"] = "gif|jpg|png";
		$config["overwrite"] = TRUE;
		$config["file_ext_tolower"] = TRUE;
		$config["encrypt_name"] = TRUE;
		$this->load->library("upload", $config);

		if ($this->upload->do_upload()) {
			$nomeorig = $config["upload_path"] . "/" . $this->upload->file_name;
			//$nomedestino = $config["upload_path"] . "/minhafoto" .  $this->upload->file_ext;
			//rename($nomeorig, $nomedestino);

			$img = WideImage::Load($nomeorig);
			$img = $img->resize(80, 80, 'outside');
			$img = $img->crop('50% - 40', '50% - 40', 80, 80);
			$img->saveToFile($nomeorig);
			$img->destroy();
			return $this->upload->file_name;
		} else {
			return  false;
		}
	}


}
