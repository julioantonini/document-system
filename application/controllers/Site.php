<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {

	function __construct() {
      parent::__construct();
			$this->load->model('site_model');
  }

	public function index()
	{

		if(!isset($this->session->usuario_logado['usuario_logado']))
		{
			redirect('/entrar');
		}

		if(isset($this->session->usuario_logado['usuario_admin']) && ($this->session->usuario_logado['usuario_admin'] == true)){
			redirect('/cliente');
		}

		$data['cat_rh'] = $this->site_model->get_tipos_by_categoria(1, $this->session->usuario_logado['usuario_id_empresa']);
		$data['cat_fi'] = $this->site_model->get_tipos_by_categoria(2, $this->session->usuario_logado['usuario_id_empresa']);
		$data['cat_op'] = $this->site_model->get_tipos_by_categoria(3, $this->session->usuario_logado['usuario_id_empresa']);
		$this->load->view('header', $data);
		$this->load->view('index');
		$this->load->view('footer');
	}

	public function lista_documento($id = 0){
		if(!isset($this->session->usuario_logado['usuario_logado']))
		{
			redirect('/entrar');
		}
		if($id == 0)
		{
			redirect('/documento', 'refresh');
		}

		$data['tipo'] = $this->site_model->get_tipo_by_id($id);
		$data['documentos'] = $this->site_model->get_documentos_by_tipo($this->session->usuario_logado['usuario_id_empresa'], $id);
		$this->load->view('header', @$data);
		$this->load->view('documento-lista');
		$this->load->view('footer');

	}

	public function download($id = 0)
	{
		if(!isset($this->session->usuario_logado['usuario_logado']))
		{
			redirect('/entrar');
		}
		if($id == 0)
		{
			redirect('/entrar', 'refresh');
		}

		$documento = $this->site_model->get_documento_by_id($id);
		if(@$documento[0]->id_cliente == $this->session->usuario_logado['usuario_id_empresa'])
		{
			$this->load->helper('download');
			$arquivo = 'uploads/documentos/'.$documento[0]->nome;
			force_download($arquivo , NULL);
		}
		else
		{
			$this->session->set_flashdata('erro','Documento não encontrado.');
			redirect(base_url(), 'refresh');
		}

	}

	public function entrar()
	{
		if(isset($this->session->usuario_logado['usuario_admin']) && ($this->session->usuario_logado['usuario_admin'] == true)){
			redirect('/cliente');
		}
		if($this->input->post('acao'))
		{
			$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
			$this->form_validation->set_rules('senha', 'senha', 'trim|required|min_length[6]|max_length[20]');
			if ($this->form_validation->run() == TRUE) {
				$usuario = $this->site_model->get_usuario_by_email($this->input->post('email'));
				if(isset($usuario[0]->id))
				{
					if($usuario[0]->id_empresa == 0)
					{
						//loga admin

						if($usuario[0]->senha == $this->input->post('senha'))
						{
							$usuario = array(
											'usuario_id'  				=> $usuario[0]->id,
											'usuario_id_empresa'  => $usuario[0]->id_empresa,
											'usuario_nome'    		=> $usuario[0]->nome,
											'usuario_admin'				=> true,
											'usuario_logado' 			=> true,
							);
							$this->session->set_userdata('usuario_logado', $usuario);
							redirect(base_url(), 'refresh');
						}
						else
						{
							$data['erro'] ='<b>'.$usuario[0]->nome.'</b>, sua senha esta incorreta.';
						}
					}
					else
					{
						$empresa = $this->site_model->get_cliente_by_id($usuario[0]->id_empresa);
						if($empresa[0]->status == 1)
						{
							if($usuario[0]->status == 1)
							{
								if($usuario[0]->senha == $this->input->post('senha'))
								{
									//loga usuario normal
									$usuario = array(
									        'usuario_id'  				=> $usuario[0]->id,
													'usuario_id_empresa'  => $usuario[0]->id_empresa,
									        'usuario_nome'    		=> $usuario[0]->nome,
													'usuario_admin'				=> false,
									        'usuario_logado' 			=> true,
									);
									$this->session->set_userdata('usuario_logado', $usuario);
									redirect(base_url(), 'refresh');
								}
								else
								{
									$data['erro'] ='<b>'.$usuario[0]->nome.'</b>, sua senha esta incorreta.';
								}

							}
							else
							{
								$data['erro'] ='<b>'.$usuario[0]->nome.'</b>, seu usuário esta inativo no momento.';
							}
						}
						else
						{
							$data['erro'] ='A empresa <b>'.$empresa[0]->empresa.'</b> esta inativa no momento.';
						}
					}
				}
				else
				{
					$data['erro'] ="Usuário não encontrado.";
				}

			}

		}
		$this->load->view('login', @$data);
	}


	public function sair()
	{
		$this->session->unset_userdata('usuario_logado');
		$this->session->set_flashdata('sucesso','Logoff realizado com sucesso!');
		redirect('/entrar');
	}

	public function alterar_senha()
	{
		if(!isset($this->session->usuario_logado['usuario_logado']))
		{
			$this->session->set_flashdata('erro','Acesso negado!');
			redirect('/entrar');
		}

		$this->form_validation->set_rules('senha', 'Senha atual', 'trim|required');
		$this->form_validation->set_rules('novasenha', 'Nova senha', 'trim|required|min_length[6]|max_length[20]');
		$this->form_validation->set_rules('novasenha2', 'Repita a nova senha', 'trim|required|matches[novasenha]');
		if ($this->form_validation->run() == TRUE)
		{

			$usuario = $this->site_model->get_usuario_by_id($this->session->usuario_logado['usuario_id']);
			if($usuario[0]->senha == $this->input->post('senha'))
			{

				$data = array(
					'senha' 	=> $this->input->post('novasenha'),
				);

				$this->site_model->altera_senha($this->session->usuario_logado['usuario_id'], $data);
				$this->session->set_flashdata('sucesso','Sua senha foi alterada com sucesso!');
				redirect(base_url(), 'refresh');
			}
			else
			{
				$data['erro'] = 'Sua senha atual esta incorreta.';
			}
		}

		$this->load->view('header', @$data);
		$this->load->view('alterar-senha');
		$this->load->view('footer');

	}
}
