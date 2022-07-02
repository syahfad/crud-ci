<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_welcome', 'model');
		$this->load->helper('url');
		$this->load->library('session');
	}
	public function index($id = false)
	{
		if ($id === false) {
			$data['home_post'] = $this->model->read();
			$this->load->view('header');
			$this->load->view('home', $data);
			$this->load->view('footer');
		} else {
			$data['post'] = $this->model->read($id);
			$this->load->view('header');
			$this->load->view('post', $data);
			$this->load->view('footer');
		}
	}
	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Name', 'required[max_length[30]');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('header');
			$this->load->view('create');
			$this->load->view('footer');
		} else {
			$id = uniqid('item', true);

			$config['upload_path'] = "upload/post";
			$config['allowed_types'] = 'png|jpg|jpeg';
			$config['max_size'] = '10000';
			$config['file_ext_tolower'] = true;
			$config['file_name'] = str_replace('.', '_', $id);

			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('image')) {
				$this->session->set_flashdata('error', $this->upload->display_errors());
				redirect('welcome/index');
			} else {
				$filename = $this->upload->data('file_name');
				$this->model->create($id, $filename);
				redirect();
			}
		}
	}
	public function update($id)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Name', 'required[max_length[30]');
		$this->form_validation->set_rules('description', 'Description', 'required');

		if ($this->form_validation->run() == false) {
			$data['post'] = $this->model->read($id);
			$this->load->view('header');
			$this->load->view('update', $data);
			$this->load->view('footer');
		} else {
			if ($this->input->post('file')) {
				$post = $this->model->read($id);
				$config['upload_path'] = "upload/post";
				$config['allowed_types'] = 'png|jpg|jpeg';
				$config['max_size'] = '10000';
				$config['file_ext_tolower'] = true;
				$config['overwrite'] = true;
				$config['file_name'] = $post->filename;

				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('image')) {
					$this->session->set_flashdata('error', $this->upload->display_errors());
					redirect('welcome/index', $id);
				} else {
					$this->model->update($id);
					redirect();
				}
			} else {
				$this->model->update($id);
				redirect();
			}
		}
	}
	public function delete($id)
	{
		$post = $this->model->read($id);
		$this->model->delete($id);
		unlink('upload/post' . $post->filename);
		redirect('');
	}
	public function deleteAll()
	{
		$this->model->deleteAll();
		redirect('');
	}
}
