<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Funcionario extends CI_Controller {

	function __construct() {
      parent::__construct();
			if(!isset($this->session->usuario_logado['usuario_admin']) || ($this->session->usuario_logado['usuario_admin'] != true))
			{
				$this->session->set_flashdata('erro','Acesso negado!');
				redirect('/entrar');
			}

			$this->load->model('funcionario_model');
  }

	public function index()
	{
		if($this->input->post('acao'))
		{
			$this->form_validation->set_rules('empresa', 'Cliente', 'trim|required');
			if ($this->form_validation->run() == TRUE) {
				$data['cliente'] = $this->funcionario_model->get_cliente_by_id($this->input->post('empresa'));
				$data['funcionarios'] = $this->funcionario_model->get_funcionarios($this->input->post('empresa'));
			}
		}
		else
		{
			if($this->session->flashdata('empresa_id')){
				$data['cliente'] = $this->funcionario_model->get_cliente_by_id($this->session->flashdata('empresa_id'));
				$data['funcionarios'] = $this->funcionario_model->get_funcionarios($this->session->flashdata('empresa_id'));
			}
		}

		$data['empresas'] = $this->funcionario_model->get_empresas();
		$this->load->view('header',$data);
		$this->load->view('funcionario-gerencia');
		$this->load->view('footer');
	}

	public function cadastrar()
	{
		if($this->input->post('acao'))
		{
			$this->form_validation->set_rules('empresa', 'Cliente', 'trim|required');
			$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
	    $this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
			$this->form_validation->set_rules('senha', 'senha', 'trim|required|min_length[6]|max_length[20]');

	    if ($this->form_validation->run() == TRUE) {

				$data = array(
					'id_empresa'=> $this->input->post('empresa'),
					'nome' 			=> $this->input->post('nome'),
					'email' 		=> $this->input->post('email'),
					'fone' 			=> $this->input->post('fone'),
					'status' 		=> $this->input->post('status'),
					'senha' 		=> $this->input->post('senha'),
				);

				if($this->funcionario_model->get_qtd_funcionario_by_email($this->input->post('email'))==0)
				{
					$this->funcionario_model->cad_funcionario($data);
					$cliente = $this->funcionario_model->get_cliente_by_id($this->input->post('empresa'));
					$this->session->set_flashdata('empresa_id',$cliente[0]->id);
					$this->session->set_flashdata('sucesso', 'O funcionário <b>'.$this->input->post('nome').'</b> da empresa <b>'.$cliente[0]->empresa.'</b>, foi cadastrado com sucesso.');
					redirect('/funcionario', 'refresh');
				}
				else{
					$this->session->set_flashdata('erro', 'Já existe um funcionário cadastrado com este e-mail.');
				}
	    }
		}

		$data['empresas'] = $this->funcionario_model->get_empresas();
		$this->load->view('header',$data);
		$this->load->view('funcionario-cad');
		$this->load->view('footer');
	}

	public function alterar($id = 0)
	{
		if($id ==0)
		{
			redirect('/funcionario', 'refresh');
		}

		if($this->input->post('acao'))
		{
			$this->form_validation->set_rules('empresa', 'Cliente', 'trim|required');
			$this->form_validation->set_rules('nome', 'Nome', 'trim|required');
			$this->form_validation->set_rules('email', 'E-mail', 'trim|required|valid_email');
			$this->form_validation->set_rules('status', 'Status', 'trim|required');
			$this->form_validation->set_rules('senha', 'senha', 'trim|required|min_length[6]|max_length[20]');

	    if ($this->form_validation->run() == TRUE) {

				$data = array(
					'id_empresa'=> $this->input->post('empresa'),
					'nome' 			=> $this->input->post('nome'),
					'email' 		=> $this->input->post('email'),
					'fone' 			=> $this->input->post('fone'),
					'status' 		=> $this->input->post('status'),
					'senha' 		=> $this->input->post('senha'),
				);

				if($this->funcionario_model->get_qtd_funcionario_by_email_another_id($this->input->post('email'), $this->input->post('id'))==0)
				{
					$this->funcionario_model->altera_funcionario($this->input->post('id'), $data);
					$cliente = $this->funcionario_model->get_cliente_by_id($this->input->post('empresa'));
					$this->session->set_flashdata('empresa_id',$cliente[0]->id);
					$this->session->set_flashdata('sucesso', 'O funcionário <b>'.$this->input->post('nome').'</b>, da empresa <b>'.$cliente[0]->empresa.'</b>, foi alterado com sucesso.');
					redirect('/funcionario', 'refresh');
				}
				else{
					$this->session->set_flashdata('erro', 'Já existe um funcionário cadastrado com este e-mail.');
				}
	    }
		}

		$data['empresas'] = $this->funcionario_model->get_empresas();
		$data['funcionario'] = $this->funcionario_model->get_funcionario_by_id($id);
		$this->load->view('header',$data);
		$this->load->view('funcionario-altera');
		$this->load->view('footer');
	}

	public function deletar($id = 0)
	{
		if($id ==0)
		{
			redirect('/funcionario', 'refresh');
		}
		$funcionario = $this->funcionario_model->get_funcionario_by_id($id);
		if($funcionario[0]->padrao == 1)
		{
			$this->session->set_flashdata('erro', 'Este funcionário não pode ser apagado.');
			redirect('/funcionario', 'refresh');
		}

		else
		{
			$funcionario = $this->funcionario_model->get_funcionario_by_id($id);
			$cliente = $this->funcionario_model->get_cliente_by_id($funcionario[0]->id_empresa);
			$this->funcionario_model->deleta_funcionario($id);
			$this->session->set_flashdata('empresa_id',$funcionario[0]->id_empresa);
			$this->session->set_flashdata('sucesso', 'O funcionário <b>'.@$funcionario[0]->nome.'</b> da empresa <b>'.$cliente[0]->empresa.'</b>, foi apagado com sucesso!');
			redirect('/funcionario', 'refresh');
		}
	}

}
