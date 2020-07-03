<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	function __construct() {
      parent::__construct();
			if(!isset($this->session->usuario_logado['usuario_admin']) || ($this->session->usuario_logado['usuario_admin'] != true))
			{
				$this->session->set_flashdata('erro','Acesso negado!');
				redirect('/entrar');
			}

			$this->load->model('usuario_model');
  }

	public function index()
	{
		$data['usuarios'] = $this->usuario_model->get_usuarios();
		$this->load->view('header',$data);
		$this->load->view('usuario-gerencia');
		$this->load->view('footer');
	}

	public function cadastrar()
	{
		if($this->input->post('acao'))
		{
			$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
	    $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
			$this->form_validation->set_rules('senha', 'senha', 'trim|required|min_length[6]|max_length[20]');

	    if ($this->form_validation->run() == TRUE) {

				$data = array(
					'id_empresa' =>'0',
					'status' =>'1',
					'nome' 	=> $this->input->post('nome'),
					'email' => $this->input->post('email'),
					'senha' => $this->input->post('senha'),
				);

				if($this->usuario_model->get_qtd_usuario_by_email($this->input->post('email'))==0)
				{
					$this->usuario_model->cad_usuario($data);
					$this->session->set_flashdata('sucesso', 'O usuário <b>'.$this->input->post('nome').'</b> foi cadastrado com sucesso.');
					redirect('/usuario', 'refresh');
				}
				else{
					$this->session->set_flashdata('erro', 'Já existe um usuário cadastrado com este e-mail.');
				}
	    }
		}
		$this->load->view('header');
		$this->load->view('usuario-cad');
		$this->load->view('footer');
	}

	public function alterar($id = 0)
	{
		if($id ==0)
		{
			redirect('/usuario', 'refresh');
		}

		if($this->input->post('acao'))
		{
			$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
	    $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
			$this->form_validation->set_rules('senha', 'senha', 'trim|required|min_length[6]|max_length[20]');

	    if ($this->form_validation->run() == TRUE) {

				$data = array(
					'nome' 	=> $this->input->post('nome'),
					'email' => $this->input->post('email'),
					'senha' => $this->input->post('senha'),
				);

				if($this->usuario_model->get_qtd_usuario_by_email_another_id($this->input->post('email'), $this->input->post('id'))==0)
				{
					$this->usuario_model->altera_usuario($this->input->post('id'), $data);
					$this->session->set_flashdata('sucesso', 'O usuário <b>'.$this->input->post('nome').'</b> foi alterado com sucesso.');
					redirect('/usuario', 'refresh');
				}
				else{
					$this->session->set_flashdata('erro', 'Já existe um usuário cadastrado com este e-mail.');
				}
	    }
		}

		$data['usuario'] = $this->usuario_model->get_usuario_by_id($id);
		$this->load->view('header',$data);
		$this->load->view('usuario-altera');
		$this->load->view('footer');
	}

	public function deletar($id = 0)
	{
		if($id ==0)
		{
			redirect('/usuario', 'refresh');
		}
		$usuario = $this->usuario_model->get_usuario_by_id($id);
		if($usuario[0]->padrao == 1)
		{
			$this->session->set_flashdata('erro', 'Este usuário não pode ser apagado.');
			redirect('/usuario', 'refresh');
		}
		elseif($usuario[0]->id == $this->session->usuario_logado['usuario_id'])
		{
			$this->session->set_flashdata('erro', 'Você não pode apagar seu próprio usuário.');
			redirect('/usuario', 'refresh');
		}
		else
		{
			$usuario = $this->usuario_model->get_usuario_by_id($id);
			$this->usuario_model->deleta_usuario($id);
			$this->session->set_flashdata('sucesso', 'O usuário <b>'.@$usuario[0]->nome.'</b> foi apagado com sucesso!');
			redirect('/usuario', 'refresh');

		}
	}

}
