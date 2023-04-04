<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct(){
		parent ::__construct();
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->model('Sit_model');
		date_default_timezone_set('Asia/Jakarta');
		$this->Sit_model->checkRekrutmen();
		$this->Sit_model->checkPeriodeMonev();
		$this->Sit_model->getNotification($this->session->userdata('id_user'));
	}

	public function index(){
		$count = $this->db->get('pengumuman')->result_array();
		$this->pagination->initialize($this->Sit_model->pagination(count($count),'home/index',5));

		$data['start']=$this->uri->segment(3);
		$this->db->order_by('id_pengumuman', 'DESC');
		$data['pengumuman']=$this->db->get('pengumuman',5,$data['start'])->result_array();

		if ($this->session->userdata('role_id') == 1) {
			$this->load->view('templates/header');
			$this->load->view('dashboard/home',$data);
			$this->load->view('templates/footer');
		}else{
			$this->load->view('templates/header');
			$this->load->view('home/index',$data);
			$this->load->view('templates/footer');
		}
	}

	public function detail($id){
		$data['pengumuman'] = $this->db->get_where('pengumuman',['id_pengumuman' => $id])->row_array();
		$this->load->view('templates/header');
		$this->load->view('home/detail', $data);
		$this->load->view('templates/footer');
	}

	public function load_pengumuman(){
		$start = $this->input->post('start');
		$this->db->order_by('id_pengumuman', 'DESC');
		$data['hasil'] = $this->db->get('pengumuman',5,$start)->result_array(); 
		echo json_encode($data);
	}

	public function tambah_pengumuman(){
		if ($this->session->userdata('role_id') != 1) {
			redirect('home');
		}

		$this->form_validation->set_rules('judul', 'Judul', 'required|trim',[
			'required' => 'Tolong masukkan judul!']
		);
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim',[
			'required' => 'Tolong masukkan deskripsi!'
		]);

		if ($this->form_validation->run()==false) {
			$this->load->view('templates/header');
			$this->load->view('dashboard/tambah-pengumuman');
			$this->load->view('templates/footer');			
		}else{
			$data=[
				'tanggal' => date('d F Y'),
				'judul' => $this->input->post('judul'),
				'deskripsi' => $this->input->post('deskripsi')
			];

			$this->db->insert('pengumuman', $data);
			redirect('home');
		}
	}

	public function edit_pengumuman($id){
		if ($this->session->userdata('role_id') != 1) {
			redirect('home');
		}

		$data['pengumuman'] = $this->db->get_where('pengumuman',['id_pengumuman' => $id])->row_array();

		$this->form_validation->set_rules('judul', 'Judul', 'required|trim',[
			'required' => 'Tolong masukkan judul!']
		);
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required|trim',[
			'required' => 'Tolong masukkan deskripsi!'
		]);

		if ($this->form_validation->run()==false) {
			$this->load->view('templates/header');
			$this->load->view('dashboard/edit-pengumuman', $data);
			$this->load->view('templates/footer');			
		}else{
			$data=[
				'judul' => $this->input->post('judul'),
				'deskripsi' => $this->input->post('deskripsi')
			];

			$this->db->where('id_pengumuman', $id);
			$this->db->update('pengumuman', $data);
			redirect('home');
		}
	}

	public function hapusPengumuman(){
		$id=$this->input->post('id');
		$this->db->where('id_pengumuman',$id);
		$this->db->delete('pengumuman');
	}
}
