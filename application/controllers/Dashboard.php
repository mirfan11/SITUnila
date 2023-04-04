<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('email') == NULL) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
			redirect('auth');
		}

		if ($this->session->userdata('role_id') == 2) {
			die;
		}
		$this->load->library('pagination');
		$this->load->library('form_validation');
		$this->load->model('Sit_model');
		date_default_timezone_set('Asia/Jakarta');
		$this->Sit_model->checkRekrutmen();
		$this->Sit_model->checkPeriodeMonev();
		$this->Sit_model->getNotification($this->session->userdata('id_user'));
	}

	public function index()
	{
		$data['nama_user'] = $this->session->userdata('nama');
		$role = ['Inkubator', 'User', 'Pendamping', 'Mentor', 'Coach'];
		$data['role'] = $role[$this->session->userdata('role_id') - 1];
		if ($this->session->userdata('role_id') == 1) {
			$data['tenantGrafik'] = $this->db->get_where('tenant', ['status' => 5])->result_array();
		} elseif ($this->session->userdata('role_id') == 3) {
			$data['tenantGrafik'] = $this->db->get_where('tenant', ['pendamping' => $this->session->userdata('id_user'), 'status' => 5])->result_array();
		} elseif ($this->session->userdata('role_id') == 5) {
			$monev = $this->db->get_where('monev', ['coach' => $this->session->userdata('nama')])->result_array();
			$id_tenant = [];
			for ($i = 0; $i < count($monev); $i++) {
				$id_tenant[$i] = $monev[$i]['id_tenant'];
			}
			$this->db->where_in('id_tenant', array_unique($id_tenant));
			$this->db->where('status', 5);
			$data['tenantGrafik'] = $this->db->get('tenant')->result_array();
		}
		if ($this->session->userdata('role_id') == 1) {
			$this->db->where_in('status', [4, 5, 6]);
			$tenant = $this->db->get('tenant')->result_array();
			$coach = count($this->db->get_where('user', ['role_id' => 5])->result_array());
			$mentor = count($this->db->get_where('user', ['role_id' => 4])->result_array());
			$pendamping = count($this->db->get_where('user', ['role_id' => 3])->result_array());
			$training = count($this->db->get('kelas_training')->result_array());
			$coaching = count($this->db->get('kelas_coaching')->result_array());
			$kelas = $training + $coaching;
			$data['info'] = [
				'tenant' => count($tenant),
				'coach' => $coach,
				'mentor' => $mentor,
				'pendamping' => $pendamping,
				'kelas' => $kelas
			];
		}

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/index', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function getGrafikTenant($id_tenant)
	{
		$monev = $this->db->get_where('monev', ['id_tenant' => $id_tenant])->result_array();

		$data['tanggal'] = [];
		$data['nilai'] = [];

		for ($i = 0; $i < count($monev); $i++) {
			$explodeTanggal = explode("-", $monev[$i]['tanggal_dikirim']);
			$data['tanggal'][$i] = $explodeTanggal[1] . "-" . $explodeTanggal[0];
			$data['nilai'][$i] = (int)$monev[$i]['nilai_coach'] + (int)$monev[$i]['nilai_inkubator'];
		}

		echo json_encode($data);
	}

	public function profile($id_user)
	{
		$data['user'] = $this->db->get_where('user', ['id_user' => $id_user])->row_array();

		// if ($this->session->userdata('role_id') == 4) {
		// 	$tempKeahlian = explode(';', $data['user']['keahlian']);
		// 	$data['keahlian'] = json_encode($tempKeahlian);
		// }

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
			'required' => 'Tolong masukkan nama!'
		]);
		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email',
			[
				'valid_email' => 'Tolong masukkan email dengan benar!',
				'required' => 'Tolong masukkan email!'
			]
		);
		$this->form_validation->set_rules('telepon', 'Telepon', 'required|trim|numeric|min_length[6]', [
			'required' => 'Tolong masukkan nomor telepon!',
			'numeric' => 'Tolong masukkan nomor telepon dengan benar!',
			'min_length' => 'Tolong masukkan nomor telepon dengan benar!'
		]);
		$this->form_validation->set_rules('tempatLahir', 'Tempat Lahir', 'required|trim', [
			'required' => 'Tolong masukkan tempat lahir!'
		]);
		$this->form_validation->set_rules('tanggalLahir', 'Tanggal Lahir', 'required|trim', [
			'required' => 'Tolong masukkan tanggal lahir!'
		]);
		$this->form_validation->set_rules('pendidikan', 'Pendidikan Terakhir', 'required|trim', [
			'required' => 'Tolong masukkan pendidikan terakhir!'
		]);
		$this->form_validation->set_rules('kelamin', 'Jenis Kelamin', 'required', [
			'required' => 'Tolong masukkan jenis kelamin!'
		]);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
			'required' => 'Tolong masukkan alamat!'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside');
			$this->load->view('dashboard/profile', $data);
			$this->load->view('templates/dashboardfoot');
		} else {
			if ($this->session->userdata('role_id') == 4) {
				$countKeahlian = count($this->input->post('keahlian'));
				$keahlian = $this->input->post('keahlian');
				$pushKeahlian = '';

				for ($i = 0; $i < $countKeahlian; $i++) {
					if ($i == $countKeahlian - 1) {
						$pushKeahlian .= $keahlian[$i];
					} else {
						$pushKeahlian .= $keahlian[$i] . ';';
					}
				}

				$data = [
					'email' => htmlspecialchars($this->input->post('email', true)),
					'nama' => $this->input->post('nama'),
					'telepon' => $this->input->post('telepon'),
					'tempat_lahir' => $this->input->post('tempatLahir'),
					'tanggal_lahir' => $this->input->post('tanggalLahir'),
					'pendidikan' => $this->input->post('pendidikan'),
					'jenis_kelamin' => $this->input->post('kelamin'),
					'alamat' => $this->input->post('alamat'),
					'keahlian' => $pushKeahlian
				];
			} else {
				$data = [
					'email' => htmlspecialchars($this->input->post('email', true)),
					'nama' => $this->input->post('nama'),
					'telepon' => $this->input->post('telepon'),
					'tempat_lahir' => $this->input->post('tempatLahir'),
					'tanggal_lahir' => $this->input->post('tanggalLahir'),
					'pendidikan' => $this->input->post('pendidikan'),
					'jenis_kelamin' => $this->input->post('kelamin'),
					'alamat' => $this->input->post('alamat')
				];
			}

			$this->db->set($data);
			$this->db->where('id_user', $id_user);
			$this->db->update('user');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data anda sudah diperbarui!</div>');
			redirect('dashboard/profile/' . $id_user);
		}
	}

	public function notifikasi()
	{
		$data['user'] = $this->db->get_where('user', ['id_user' => $this->session->userdata('id_user')])->row_array();
		$this->db->order_by('id_notifikasi', 'DESC');
		$data['notif'] = $this->db->get_where('notifikasi', ['id_user' => $this->session->userdata('id_user')])->result_array();
		$this->pagination->initialize($this->Sit_model->pagination(count($data['notif']), 'dashboard/notifikasi', 10));

		$data['start'] = $this->uri->segment(3);
		$this->db->order_by('id_notifikasi', 'DESC');
		$data['notif'] = $this->db->get_where('notifikasi', ['id_user' => $this->session->userdata('id_user')], 10, $data['start'])->result_array();

		$i = 0;
		foreach ($data['notif'] as $nt) {
			if ($nt['status'] == 0) {
				$i++;
			}
		}
		$data['countNotif'] = $i;

		if ($this->session->userdata('role_id') == 1) {
			for ($j = 0; $j < count($data['notif']); $j++) {
				if ($data['notif'][$j]['jenis'] == 'kontak-admin') {
					$user = $this->db->get_where('user', ['id_user' => $data['notif'][$j]['pengirim']])->row_array();
					$data['notif'][$j]['id_pengirim'] = $data['notif'][$j]['pengirim'];
					$data['notif'][$j]['pengirim'] = $user['nama'];
				}
			}
		}

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/notifikasi', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function kontakUser()
	{
		$pesan = $this->input->post('pesan');
		$this->Sit_model->sendNotification('kontak-user', $this->input->post('submitReply'), 'Inkubator', $pesan);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" style="font-size: 14px;">Pesan telah terkirim!</div>');
		redirect('dashboard/notifikasi');
	}

	public function readAll($id_user)
	{
		$this->db->set('status', 1);
		$this->db->where('id_user', $id_user);
		$this->db->update('notifikasi');
	}

	public function pushNewNotification()
	{
		$jenis = $this->input->post('jenisNotif');
		$tenant = $this->input->post('tenant');
		if ($jenis == 'enroll') {
			$kelas = $this->input->post('kelas');
			$this->Sit_model->sendNotification($jenis, $tenant, 'Inkubator', $kelas);
		} elseif ($jenis == 'umum') {
			$role = ['Inkubator', 'User', 'Pendamping', 'Mentor', 'Coach'];
			$pengirim = $this->session->userdata('nama') . " - " . $role[$this->session->userdata('role_id') - 1];
			$isi = $this->input->post('isi');
			$btnSubmit = explode(";", $this->input->post('btnSubmit'));
			$countlink = explode(':', $btnSubmit[0]);
			$countfile = explode(':', $btnSubmit[1]);
			$allLink = '';
			$allFile = '';

			if ($countlink[1] != 0) {
				$link = $this->input->post('link');
				for ($i = 0; $i < (int)$countlink[1]; $i++) {
					if ($i + 1 == (int)$countlink[1]) {
						$allLink .= $link[$i];
					} else {
						$allLink .= $link[$i] . '{separatorLink}';
					}
				}
			}

			$isi .= '{separatorIsi}' . $allLink;

			if ($countfile[1] != 0) {
				$nama_file = $_FILES['file']['name'];
				for ($i = 0; $i < (int)$countfile[1]; $i++) {
					if ($i + 1 == (int)$countlink[1]) {
						$allFile .= $nama_file[$i];
					} else {
						$allFile .= $nama_file . '{separatorLink}';
					}
				}
			}

			$isi .= '{separatorIsi}' . $allFile;

			$this->Sit_model->sendNotification($jenis, $tenant, $pengirim, $isi);
		}
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" style="font-size: 14px;">Notifikasi telah terkirim!</div>');
		redirect('dashboard/notifikasi');
	}

	public function load_tenant($role_id, $jenis, $add)
	{
		if ($jenis == 'enroll') {
			if ($add == 'training') {
				$data['tenant'] = $this->db->get_where('tenant', ['status' => 4])->result_array();
				$data['kelas'] = $this->db->get('kelas_training')->result_array();
			} else if ($add == 'coaching') {
				$data['tenant'] = $this->db->get_where('tenant', ['status' => 5])->result_array();
				$data['kelas'] = $this->db->get('kelas_coaching')->result_array();
			}
		} elseif ($jenis == 'umum') {
			$status = [4, 5];
			$this->db->where_in('status', $status);
			$this->db->order_by('nama_tenant', 'ASC');
			$data['tenant'] = $this->db->get('tenant')->result_array();
		}
		echo json_encode($data);
	}

	public function rekrutmen()
	{
		if ($this->session->userdata('search') == NULL) {
			$this->db->where_in('status', [0, 1, 2, 3]);
			$this->db->order_by('id_tenant', 'DESC');
			$totalTenant = $this->db->get('tenant')->result_array();
			$data['rekrutmen'] = $this->db->get('rekrutmen')->result_array();

			$this->pagination->initialize($this->Sit_model->pagination(count($totalTenant), 'dashboard/rekrutmen', 5));

			$data['start'] = $this->uri->segment(3);
			$this->db->where_in('status', [0, 1, 2, 3]);
			$this->db->order_by('id_tenant', 'DESC');
			$data['tenant'] = $this->db->get('tenant', 5, $data['start'])->result_array();

			for ($j = 0; $j < count($data['tenant']); $j++) {
				$data['tenant'][$j]['nomor'] = $j + 1 + $data['start'];
			}
		} else {
			$key = $this->session->userdata('search');
			$queryTenant = "SELECT * FROM tenant WHERE status IN (0,1,2,3) AND nama_tenant LIKE '%$key%' ORDER BY id_tenant DESC";

			$data['tenant'] = $this->db->query($queryTenant)->result_array();
			$data['rekrutmen'] = $this->db->get('rekrutmen')->result_array();
			for ($j = 0; $j < count($data['tenant']); $j++) {
				$data['tenant'][$j]['nomor'] = $j + 1;
			}
			$this->session->unset_userdata('search');
		}

		$i = 0;
		foreach ($data['rekrutmen'] as $rekrutmen) {
			if ($rekrutmen['status'] == 0) {
				$tanggalRekrutmen = $rekrutmen['awal_rekrutmen'] . " s/d " . $rekrutmen['akhir_rekrutmen'];
				$i++;
			}
		}

		if ($i > 0) {
			$data['status'] = '<div><span class="p-1 text-dark" style="font-size: 14px;">Tanggal dibuka rekrutmen : ' . $tanggalRekrutmen . '</span><span class="p-1 bg-success" style="color: white; border-radius: 5px; font-size: 14px; float : right;">Status Pendaftaran : Dibuka</span></div>';
		} else {
			$data['status'] = '<p class="p-1 bg-danger" style="color: white; border-radius: 5px; font-size: 14px; float : right;">Status Pendaftaran : Ditutup</p>';
		}

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/rekrutmen/index', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function pembukaanRekrutmen()
	{
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');

		if ($awal == "" || $akhir == "") {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert" style="font-size: 14px;">Tolong isi data periode dengan lengkap!</div>');
			redirect('dashboard/rekrutmen');
		}

		$data = [
			'awal_rekrutmen' => $awal,
			'akhir_rekrutmen' => $akhir,
			'status' => 0
		];

		$this->db->insert('rekrutmen', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert" style="font-size: 14px;">Jadwal pembukaan rekrutmen berhasil ditambahkan!</div>');
		redirect('dashboard/rekrutmen');
	}

	public function hapusTenant($id)
	{
		$data_usaha = $this->db->get_where('data_usaha', ['id_tenant' => $id])->row_array();
		$data_usaha2 = $this->db->get_where('data_usaha2', ['id_tenant' => $id])->row_array();
		$path = './assets/dokumen/';
		$path2 = './assets/image/';

		if ($data_usaha2 != NULL) {
			unlink($path . 'presentasi/' . $data_usaha2['presentasi']);
			unlink($path . 'profile/' . $data_usaha2['profile']);
			$this->db->where('id_tenant', $id);
			$this->db->delete('data_usaha2');
			$this->db->where('id_tenant', $id);
			$this->db->delete('penilaian2');
		}

		$explodeAset = explode(",", $data_usaha['aset']);
		if ($explodeAset[0] != "Tidak ada") {
			for ($i = 0; $i < count($explodeAset) - 1; $i++) {
				unlink($path2 . 'foto_aset/' . $explodeAset[$i]);
			}
		}

		$explodePerjanjian = explode(",", $data_usaha['perjanjian_usaha']);
		if ($explodePerjanjian[0] != "Tidak ada") {
			for ($i = 0; $i < count($explodePerjanjian) - 1; $i++) {
				unlink($path2 . 'foto_perjanjian_usaha/' . $explodePerjanjian[$i]);
			}
		}

		$explodeSertifikat = explode(",", $data_usaha['sertifikat_produk']);
		if ($explodeSertifikat[0] != "Tidak ada") {
			for ($i = 0; $i < count($explodeSertifikat) - 1; $i++) {
				unlink($path2 . 'foto_sertifikat/' . $explodeSertifikat[$i]);
			}
		}

		$explodeGambar = explode(",", $data_usaha['foto_produk']);
		for ($i = 0; $i < count($explodeGambar) - 1; $i++) {
			unlink($path2 . 'foto_produk/' . $explodeGambar[$i]);
		}

		$this->db->where('id_tenant', $id);
		$this->db->delete('data_usaha');
		$this->db->where('id_tenant', $id);
		$this->db->delete('penilaian1');
		$this->db->where('id_tenant', $id);
		$this->db->delete('tenant');
		redirect('dashboard/rekrutmen');
	}

	public function penilaianTenant1($id)
	{
		$data['tenant'] = $this->db->get_where('tenant', ['id_tenant' => $id])->row_array();
		$data['data_usaha'] = $this->db->get_where('data_usaha', ['id_tenant' => $id])->row_array();
		$data['user_tenant'] = $this->db->get_where('user', ['id_user' => $data['tenant']['id_user']])->row_array();

		$explodeAset = explode(",", $data['data_usaha']['aset']);
		if ($explodeAset[0] != "Tidak ada") {
			for ($i = 0; $i < count($explodeAset) - 1; $i++) {
				$temp = explode(".", $explodeAset[$i]);
				if (end($temp) == 'pdf') {
					$data['aset'][$i] = '<iframe class="col-12" src="' . base_url('assets/image/foto_aset/') . $explodeAset[$i] . '" style="min-height: 480px;"></iframe><br>';
				} else {
					$data['aset'][$i] = '<img src="' . base_url('assets/image/foto_aset/') . $explodeAset[$i] . '" alt="' . $explodeAset[$i] . '" class="img-fluid mr-2" style="max-width: 200px;">';
				}
			}
		}

		$explodePerjanjian = explode(",", $data['data_usaha']['perjanjian_usaha']);
		if ($explodePerjanjian[0] != "Tidak ada") {
			for ($i = 0; $i < count($explodePerjanjian) - 1; $i++) {
				$temp = explode(".", $explodePerjanjian[$i]);
				if (end($temp) == 'pdf') {
					$data['perjanjian'][$i] = '<iframe class="col-12 my-3" src="' . base_url('assets/image/foto_perjanjian_usaha/') . $explodePerjanjian[$i] . '" style="min-height: 480px;"></iframe><br>';
				} else {
					$data['perjanjian'][$i] = '<img src="' . base_url('assets/image/foto_perjanjian_usaha/') . $explodePerjanjian[$i] . '" alt="' . $explodePerjanjian[$i] . '" class="img-fluid mr-2" style="max-width: 200px;">';
				}
			}
		}

		$explodeSertifikat = explode(",", $data['data_usaha']['sertifikat_produk']);
		if ($explodeSertifikat[0] != "Tidak ada") {
			for ($i = 0; $i < count($explodeSertifikat) - 1; $i++) {
				$temp = explode(".", $explodeSertifikat[$i]);
				if (end($temp) == 'pdf') {
					$data['sertifikat'][$i] = '<iframe class="col-12 my-3" src="' . base_url('assets/image/foto_sertifikat/') . $explodeSertifikat[$i] . '" style="min-height: 480px;"></iframe><br>';
				} else {
					$data['sertifikat'][$i] = '<img src="' . base_url('assets/image/foto_sertifikat/') . $explodeSertifikat[$i] . '" alt="' . $explodeSertifikat[$i] . '" class="img-fluid mr-2 mt-3" style="max-width: 200px;">';
				}
			}
		}

		$data['gambar'] = explode(",", $data['data_usaha']['foto_produk']);
		$data['jumlah_gambar'] = count($data['gambar']);
		$explodeSumberUsaha = explode(';', $data['data_usaha']['sumber_usaha']);
		$data['sumberUsaha'] = [];
		$data['nominalSumberUsaha'] = [];

		for ($i = 0; $i < count($explodeSumberUsaha); $i++) {
			$explodeTmp = explode(':', $explodeSumberUsaha[$i]);
			$data['sumberUsaha'][$i] = $explodeTmp[0];
			$data['nominalSumberUsaha'][$i] = $explodeTmp[1];
		}

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/rekrutmen/penilaian-tenant-1', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function submitPenilaian1($id)
	{
		$namaNilaiTambahan = $this->input->post('namaPenilaian');
		$nilaiTambahan = $this->input->post('penilaian');
		$countNNTambahan = count($namaNilaiTambahan);
		$countnilaiTambahan = count($nilaiTambahan);

		$nilaiTambahanAkhir = '';
		$nilaiTotal = 0;
		for ($i = 0; $i < $countNNTambahan; $i++) {
			$nilaiTambahanAkhir .= $namaNilaiTambahan[$i] . "(delimiterPenilaian)" . $nilaiTambahan[$i] . ";";
			$nilaiTotal = $nilaiTotal + $nilaiTambahan[$i];
		}

		$status = $nilaiTotal / $countnilaiTambahan;

		$data = [
			'id_tenant' => $id,
			'nilai' => $nilaiTambahanAkhir,
			'total' => $nilaiTotal
		];

		$this->db->insert('penilaian1', $data);
		$this->db->where('id_tenant', $id);
		if ($status >= 3) {
			$this->db->set('status', 2);
		} else {
			$this->db->set('status', 0);
		}
		$this->db->update('tenant');

		$this->Sit_model->sendNotification('penilaian-tenant1', $id, '', '');
		redirect('dashboard/rekrutmen');
	}

	public function penilaianTenant2($id)
	{
		$data['countTenant'] = $this->db->get_where('data_usaha2', ['id_tenant' => $id])->row_array();
		if ($data['countTenant'] == NULL) {
			$this->session->set_userdata('penilaian', 'belum');
			redirect('dashboard/rekrutmen');
		}

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/rekrutmen/penilaian-tenant-2', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function submitPenilaian2($id)
	{
		$namaNilaiTambahan = $this->input->post('namaPenilaian');
		$nilaiTambahan = $this->input->post('penilaian');
		$countNNTambahan = count($namaNilaiTambahan);
		$countnilaiTambahan = count($nilaiTambahan);

		$nilaiTambahanAkhir = '';
		$nilaiTotal = 0;
		for ($i = 0; $i < $countNNTambahan; $i++) {
			$nilaiTambahanAkhir .= $namaNilaiTambahan[$i] . " " . $nilaiTambahan[$i] . ";";
			$nilaiTotal = $nilaiTotal + $nilaiTambahan[$i];
		}

		$status = $nilaiTotal / $countnilaiTambahan;

		$data = [
			'id_tenant' => $id,
			'nilai' => $nilaiTambahanAkhir,
			'total' => $nilaiTotal
		];

		$this->db->insert('penilaian2', $data);
		$this->db->where('id_tenant', $id);
		if ($status >= 3) {
			$this->db->set('status', 3);
		} else {
			$this->db->set('status', 0);
		}
		$this->db->update('tenant');

		$this->Sit_model->sendNotification('penilaian-tenant2', $id, '', '');
		redirect('dashboard/rekrutmen');
	}

	public function kontrakTenant($id)
	{
		$data['tenant'] = $this->db->get_where('tenant', ['id_tenant' => $id])->row_array();
		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/rekrutmen/kontrak-tenant', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function verifikasiKontrak($id)
	{
		$this->db->where('id_tenant', $id);
		$this->db->set('status', 4);
		$this->db->update('tenant');

		$this->Sit_model->sendNotification('verifikasi-kontrak', $id, '', '');
		redirect('dashboard/kontrakTenant/' . $id);
	}

	public function tenant()
	{
		if ($this->session->userdata('search') == NULL) {
			$this->db->where_in('status', [4, 5, 6]);
			if ($this->session->userdata('role_id') == 3) {
				$this->db->where('pendamping', $this->session->userdata('id_user'));
			}
			$this->db->order_by('id_tenant', 'DESC');
			$countTenant = $this->db->get('tenant')->result_array();
			$data['pendamping'] = $this->db->get_where('user', ['role_id' => 3])->result_array();
			$data['kelas'] = $this->db->get('kelas_training')->result_array();

			$this->pagination->initialize($this->Sit_model->pagination(count($countTenant), 'dashboard/tenant', 5));

			$data['start'] = $this->uri->segment(3);
			$this->db->where_in('status', [4, 5, 6]);
			if ($this->session->userdata('role_id') == 3) {
				$this->db->where('pendamping', $this->session->userdata('id_user'));
			}
			$this->db->order_by('id_tenant', 'DESC');
			$data['tenant'] = $this->db->get('tenant', 5, $data['start'])->result_array();

			for ($j = 0; $j < count($data['tenant']); $j++) {
				$data['tenant'][$j]['nomor'] = $j + 1 + $data['start'];
			}
		} else {
			$key = $this->session->userdata('search');
			if ($this->session->userdata('role_id') == 3) {
				$id_pendamping  = $this->session->userdata('id_user');
				$queryTenant = "SELECT * FROM tenant WHERE status IN (4,5,6) AND pendamping = '$id_pendamping' AND nama_tenant LIKE '%$key%' ORDER BY id_tenant DESC";
			} else {
				$queryTenant = "SELECT * FROM tenant WHERE status IN (4,5,6) AND nama_tenant LIKE '%$key%' ORDER BY id_tenant DESC";
			}
			$data['tenant'] = $this->db->query($queryTenant)->result_array();
			$data['kelas'] = $this->db->get('kelas_training')->result_array();
			for ($j = 0; $j < count($data['tenant']); $j++) {
				$data['tenant'][$j]['nomor'] = $j + 1;
			}
			$this->session->unset_userdata('search');
		}
		$i = 0;
		foreach ($data['tenant'] as $tenant) {
			$temp = $this->db->get_where('enroll_kelas_training', ['id_tenant' => $tenant['id_tenant']])->row_array();

			if ($temp != NULL) {
				$data['tenant'][$i]['progress'] = $temp['progress'];
			} else {
				$data['tenant'][$i]['progress'] = 0;
			}

			if ($tenant['pendamping'] == "") {
				$data['tenant'][$i]['pendamping'] = "Belum Ada";
			} else {
				$pendamping = $this->db->get_where('user', ['id_user' => $tenant['pendamping']])->row_array();
				$data['tenant'][$i]['pendamping'] = $pendamping['nama'];
			}
			$i++;
		}

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/tenant/index', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function search()
	{
		$key = $this->input->post('search');
		$page = $this->input->post('btnSearch');
		$this->session->set_userdata('search', $key);
		redirect('dashboard/' . $page);
	}

	public function detailTenant($id)
	{
		$data['tenant'] = $this->db->get_where('tenant', ['id_tenant' => $id])->row_array();
		$data['data_usaha'] = $this->db->get_where('data_usaha', ['id_tenant' => $id])->row_array();
		$data['data_usaha2'] = $this->db->get_where('data_usaha2', ['id_tenant' => $id])->row_array();
		$data['user_tenant'] = $this->db->get_where('user', ['id_user' => $data['tenant']['id_user']])->row_array();

		$explodeAset = explode(",", $data['data_usaha']['aset']);
		if ($explodeAset[0] != "Tidak ada") {
			for ($i = 0; $i < count($explodeAset) - 1; $i++) {
				$temp = explode(".", $explodeAset[$i]);
				if (end($temp) == 'pdf') {
					$data['aset'][$i] = '<iframe class="col-12" src="' . base_url('assets/image/foto_aset/') . $explodeAset[$i] . '" style="min-height: 480px;"></iframe><br>';
				} else {
					$data['aset'][$i] = '<img src="' . base_url('assets/image/foto_aset/') . $explodeAset[$i] . '" alt="' . $explodeAset[$i] . '" class="img-fluid mr-2" style="max-width: 200px;">';
				}
			}
		}

		$explodePerjanjian = explode(",", $data['data_usaha']['perjanjian_usaha']);
		if ($explodePerjanjian[0] != "Tidak ada") {
			for ($i = 0; $i < count($explodePerjanjian) - 1; $i++) {
				$temp = explode(".", $explodePerjanjian[$i]);
				if (end($temp) == 'pdf') {
					$data['perjanjian'][$i] = '<iframe class="col-12 my-3" src="' . base_url('assets/image/foto_perjanjian_usaha/') . $explodePerjanjian[$i] . '" style="min-height: 480px;"></iframe><br>';
				} else {
					$data['perjanjian'][$i] = '<img src="' . base_url('assets/image/foto_perjanjian_usaha/') . $explodePerjanjian[$i] . '" alt="' . $explodePerjanjian[$i] . '" class="img-fluid mr-2" style="max-width: 200px;">';
				}
			}
		}

		$explodeSertifikat = explode(",", $data['data_usaha']['sertifikat_produk']);
		if ($explodeSertifikat[0] != "Tidak ada") {
			for ($i = 0; $i < count($explodeSertifikat) - 1; $i++) {
				$temp = explode(".", $explodeSertifikat[$i]);
				if (end($temp) == 'pdf') {
					$data['sertifikat'][$i] = '<iframe class="col-12 my-3" src="' . base_url('assets/image/foto_sertifikat/') . $explodeSertifikat[$i] . '" style="min-height: 480px;"></iframe><br>';
				} else {
					$data['sertifikat'][$i] = '<img src="' . base_url('assets/image/foto_sertifikat/') . $explodeSertifikat[$i] . '" alt="' . $explodeSertifikat[$i] . '" class="img-fluid mr-2 mt-3" style="max-width: 200px;">';
				}
			}
		}

		$data['gambar'] = explode(",", $data['data_usaha']['foto_produk']);
		$data['jumlah_gambar'] = count($data['gambar']);
		$explodeSumberUsaha = explode(';', $data['data_usaha']['sumber_usaha']);
		$data['sumberUsaha'] = [];
		$data['nominalSumberUsaha'] = [];

		for ($i = 0; $i < count($explodeSumberUsaha); $i++) {
			$explodeTmp = explode(':', $explodeSumberUsaha[$i]);
			$data['sumberUsaha'][$i] = $explodeTmp[0];
			$data['nominalSumberUsaha'][$i] = $explodeTmp[1];
		}

		$penilaian1 = $this->db->get_where('penilaian1', ['id_tenant' => $id])->row_array();
		$penilaian2 = $this->db->get_where('penilaian2', ['id_tenant' => $id])->row_array();
		$data['penilaian1'] = [];
		$data['penilaian2'] = [];
		if ($penilaian1 != NULL) {
			$tempPenilaian1 = explode(';', $penilaian1['nilai']);
			for ($i = 0; $i < count($tempPenilaian1) - 1; $i++) {
				$explode = explode('(delimiterPenilaian)', $tempPenilaian1[$i]);
				$data['penilaian1'][$i]['penilaian'] = $explode[0];
				$data['penilaian1'][$i]['nilai'] = $explode[1];
			}
		}

		if ($penilaian2 != NULL) {
			$tempPenilaian2 = explode(';', $penilaian2['nilai']);
			for ($i = 0; $i < count($tempPenilaian2) - 1; $i++) {
				$explode = explode('(delimiterPenilaian)', $tempPenilaian2[$i]);
				$data['penilaian2'][$i]['penilaian'] = $explode[0];
				$data['penilaian2'][$i]['nilai'] = $explode[1];
			}
		}

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/tenant/detail', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function editPendamping()
	{
		$id_tenant = $this->input->post('submitEditPendamping');
		$pendamping = $this->input->post('pendamping');

		$this->db->where('id_tenant', $id_tenant);
		$this->db->set('pendamping', $pendamping);
		$this->db->update('tenant');
		redirect('dashboard/tenant');
	}

	public function praInkubasi()
	{
		$this->form_validation->set_rules(
			'nama',
			'Nama',
			'required|trim',
			[
				'required' => 'Tolong masukkan nama kelas!'
			]
		);

		$this->form_validation->set_rules(
			'enroll',
			'Enroll Key',
			'required|trim|is_unique',
			[
				'required' => 'Tolong masukkan enroll key!',
				'is_unique' => 'Enroll key telah terdaftar!'
			]
		);
		if ($this->session->userdata('search') == NULL) {
			$data['tenant'] = $this->db->get_where('tenant', ['status' => 4])->result_array();
			$data['kelas'] = $this->db->get('kelas_training')->result_array();

			$this->pagination->initialize($this->Sit_model->pagination(count($data['kelas']), 'dashboard/praInkubasi', 12));

			$data['start'] = $this->uri->segment(3);
			$this->db->order_by('id_kelas_training', 'DESC');
			$data['kelas'] = $this->db->get('kelas_training', 12, $data['start'])->result_array();
		} else {
			$key = $this->session->userdata('search');
			$queryTenant = "SELECT * FROM kelas_training WHERE nama_kelas LIKE '%$key%' ORDER BY id_kelas_training DESC";
			$data['kelas'] = $this->db->query($queryTenant)->result_array();
			$this->session->unset_userdata('search');
		}

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside');
			$this->load->view('dashboard/pra-inkubasi/index', $data);
			$this->load->view('templates/dashboardfoot');
		} else {
			$data = [
				'nama_kelas' => $this->input->post('nama'),
				'enroll_key' => $this->input->post('enroll')
			];

			$this->db->insert('kelas_training', $data);
			redirect('dashboard/praInkubasi');
		}
	}

	public function editKelasPraInkubasi()
	{
		$id_kelas = $this->input->post('id_kelas');
		$kelas = $this->db->get_where('kelas_training', ['id_kelas_training' => $id_kelas])->row_array();
		$data = [
			'nama' => $kelas['nama_kelas'],
			'enroll' => $kelas['enroll_key']
		];

		echo json_encode($data);
	}

	public function pushEditKelasPrainkubasi()
	{
		$id_kelas = $this->input->post('id_kelas');
		$nama = $this->input->post('nama');
		$enroll = $this->input->post('enroll');
		$kelas = $this->db->get_where('kelas_training', ['enroll_key' => $enroll])->row_array();
		$i = 0;

		if (strlen($nama) == 0) {
			$data['nama'] = 'Tolong isi nama kelas!';
			$i++;
		} else {
			$data['nama'] = '';
		}

		if (strlen($enroll) == 0) {
			$data['enroll'] = 'Tolong isi enroll key!';
			$i++;
		} elseif ($kelas != NULL && $kelas['id_kelas_training'] != $id_kelas) {
			$data['enroll'] = 'Enroll key telah terdaftar';
			$i++;
		} else {
			$data['enroll'] = '';
		}


		if ($i > 0) {
			$data['indikator'] = 'salah';
		} else {
			$edit = [
				'nama_kelas' => $nama,
				'enroll_key' => $enroll
			];
			$this->db->set($edit);
			$this->db->where('id_kelas_training', $id_kelas);
			$this->db->update('kelas_training');
		}

		echo json_encode($data);
	}

	public function detailPraInkubasi($id)
	{
		$data['kelas'] = $this->db->get_where('kelas_training', ['id_kelas_training' => $id])->row_array();
		$data['pertemuan'] = $this->db->get_where('pertemuan_kelas', ['id_kelas' => $id, 'jenis' => 'training'])->result_array();
		$data['detail'] = $this->db->get_where('detail_kelas', ['id_kelas' => $id])->result_array();
		$data['enroll'] = $this->db->get_where('enroll_kelas_training', ['id_kelas' => $id])->result_array();

		$i = 0;
		foreach ($data['pertemuan'] as $dp) {
			if (strpos($dp['deskripsi'], "\n") !== FALSE) {
				$explode = explode("\n", $dp['deskripsi']);
				$data['pertemuan'][$i]['deskripsi'] = '';
				foreach ($explode as $ex) {
					$data['pertemuan'][$i]['deskripsi'] .= $ex . "<br>";
				}
			}
			$i++;
		}

		$i = 0;
		foreach ($data['enroll'] as $er) {
			$data['tenant'][$i] = $this->db->get_where('tenant', ['id_tenant' => $er['id_tenant']])->row_array();
			$i++;
		}

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/pra-inkubasi/detail', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function detailUserPraInkubasi()
	{
		$id = $this->input->post('pilihTenant');
		$data['tenant'] = $this->db->get_where('tenant', ['id_tenant' => $id])->row_array();
		$data['dataKelas'] = $this->Sit_model->dataKelasTraining($id);
		$data['progress'] = $this->Sit_model->persenProgressPraInkubasi($id);
		$data['enroll'] = $this->db->get_where('enroll_kelas_training', ['id_kelas' => $data['dataKelas']['kelas']['id_kelas_training']])->result_array();

		$i = 0;
		$data['selectTenant'][$i] = $this->db->get_where('tenant', ['id_tenant' => $id])->row_array();
		$i++;


		foreach ($data['enroll'] as $er) {
			$temp = $this->db->get_where('tenant', ['id_tenant' => $er['id_tenant']])->row_array();
			if ($temp['id_tenant'] != $id) {
				$data['selectTenant'][$i] = $temp;
				$i++;
			}
		}

		$j = 0;

		foreach ($data['dataKelas']['detail'] as $dt) {
			$progressKelas = $this->db->get_where('progress_kelas', ['id_tenant' => $id, 'id_detail_kelas' => $dt['id_detail_kelas']])->row_array();

			if ($progressKelas['status'] == 0) {
				$progressKelas['status'] = '';
			} else {
				$progressKelas['status'] = 'checked';
			}

			$data['dataKelas']['detail'][$j]['progress'] = $progressKelas['status'];
			$j++;
		}

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/pra-inkubasi/detail-user', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function videoPraInkubasi($id)
	{
		$data['detailKelas'] = $this->db->get_where('detail_kelas', ['id_detail_kelas' => $id])->row_array();
		$data['kelas'] = $this->db->get_where('kelas_training', ['id_kelas_training' => $data['detailKelas']['id_kelas']])->row_array();
		$linkExplode = explode('(linkDelimiter)', $data['detailKelas']['deskripsi']);
		$data['detailKelas']['deskripsi'] = $linkExplode[1];

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/pra-inkubasi/video', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function tugasPraInkubasi($id)
	{
		$data['id_tenant'] = '';
		$data['detailKelas'] = $this->db->get_where('detail_kelas', ['id_detail_kelas' => $id])->row_array();
		$data['kelas'] = $this->db->get_where('kelas_training', ['id_kelas_training' => $data['detailKelas']['id_kelas']])->row_array();
		$data['kontenKelas'] = explode("(assignmentDelimiter)", $data['detailKelas']['deskripsi']);

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/pra-inkubasi/tugas', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function tugasUserPraInkubasi($id, $id_tenant)
	{
		$data['id_tenant'] = $id_tenant;
		$data['detailKelas'] = $this->db->get_where('detail_kelas', ['id_detail_kelas' => $id])->row_array();
		$data['kelas'] = $this->db->get_where('kelas_training', ['id_kelas_training' => $data['detailKelas']['id_kelas']])->row_array();
		$data['kontenKelas'] = explode("(assignmentDelimiter)", $data['detailKelas']['deskripsi']);
		$data['progress'] = $this->db->get_where('progress_kelas', ['id_detail_kelas' => $id, 'id_tenant' => $id_tenant])->row_array();
		$data['jawaban'] = $this->db->get_where('jawaban', ['id_progress_kelas' => $data['progress']['id_progress_kelas']])->row_array();
		if ($data['jawaban'] != NULL) {
			$data['countJawaban'] = count($data['jawaban']);
		} else {
			$data['countJawaban'] = 0;
		}

		$this->form_validation->set_rules(
			'nilai',
			'Nilai',
			'required|trim',
			[
				'required' => 'Tolong masukkan nilai!'
			]
		);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside');
			$this->load->view('dashboard/pra-inkubasi/tugas', $data);
			$this->load->view('templates/dashboardfoot');
		} else {
			$nilai = $this->input->post('nilai');

			$this->db->set('nilai', $nilai);
			$this->db->where('id_jawaban', $data['jawaban']['id_jawaban']);
			$this->db->update('jawaban');

			$dataProgress = [
				'id_detail_kelas' => $id,
				'id_tenant' => $id_tenant
			];

			$this->db->set('status', 1);
			$this->db->where($dataProgress);
			$this->db->update('progress_kelas');

			redirect('dashboard/tugasUserPraInkubasi/' . $id . '/' . $id_tenant);
		}
	}

	public function pagePraInkubasi($id)
	{
		$data['detailKelas'] = $this->db->get_where('detail_kelas', ['id_detail_kelas' => $id])->row_array();
		$data['kontenKelas'] = explode("(pageDelimiter)", $data['detailKelas']['deskripsi']);
		$data['kelas'] = $this->db->get_where('kelas_training', ['id_kelas_training' => $data['detailKelas']['id_kelas']])->row_array();
		if (!isset($data['kontenKelas'][2])) {
			$data['kontenKelas'][2] = '';
		}

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/pra-inkubasi/page', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function buatPertemuanTraining($id)
	{
		$kelas = $this->db->get_where('kelas_training', ['id_kelas_training' => $id])->row_array();
		$pertemuan = $this->db->get_where('pertemuan_kelas', ['id_kelas' => $id, 'jenis' => 'training'])->result_array();
		$namaPertemuan = $kelas['nama_kelas'] . " " . (count($pertemuan) + 1);

		$data = [
			'id_kelas' => $id,
			'nama' => $namaPertemuan,
			'jenis' => 'training',
			'status' => 0
		];
		$this->db->insert('pertemuan_kelas', $data);
		$tenant = [];
		$temp = $this->db->get_where('enroll_kelas_training', ['id_kelas' => $id])->result_array();
		for ($i = 0; $i < count($temp); $i++) {
			$tenant[$i] = $temp[$i]['id_tenant'];
		}

		$this->Sit_model->sendNotification('pertemuan', $tenant, 'System', $kelas['nama_kelas']);
		redirect('dashboard/detailPraInkubasi/' . $id);
	}

	public function editPertemuanPraInkubasi($id_kelas, $id_pertemuan)
	{
		$data['kelas'] = $this->db->get_where('kelas_training', ['id_kelas_training' => $id_kelas])->row_array();
		$data['pertemuan'] = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $id_pertemuan])->row_array();
		$data['assignment'] = $this->db->get_where('detail_kelas', ['id_kelas' => $id_kelas, 'id_pertemuan_kelas' => $id_pertemuan, 'jenis' => 'assignment'])->result_array();
		$data['link'] = $this->db->get_where('detail_kelas', ['id_kelas' => $id_kelas, 'id_pertemuan_kelas' => $id_pertemuan, 'jenis' => 'link'])->result_array();
		$data['feedback'] = $this->db->get_where('detail_kelas', ['id_kelas' => $id_kelas, 'id_pertemuan_kelas' => $id_pertemuan, 'jenis' => 'feedback'])->result_array();
		$data['dokumen'] = $this->db->get_where('detail_kelas', ['id_kelas' => $id_kelas, 'id_pertemuan_kelas' => $id_pertemuan, 'jenis' => 'dokumen'])->result_array();



		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside');
			$this->load->view('dashboard/pra-inkubasi/edit-detail', $data);
			$this->load->view('templates/dashboardfoot');
		} else {
			$tenant = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $id])->row_array();
			$nama = $this->input->post('nama');
			$deskripsi = $this->input->post('deskripsi');

			$data = [
				'nama' => $nama,
				'deskripsi' => $deskripsi
			];

			$this->db->set($data);
			$this->db->where('id_pertemuan_kelas', $id);
			$this->db->update('pertemuan_kelas');

			redirect('dashboard/detailPraInkubasi/' . $tenant['id_kelas']);
		}
	}

	public function editDetailPertemuan($id_detail_kelas, $jenis)
	{
		$detail_kelas = $this->db->get_where('detail_kelas', ['id_detail_kelas' => $id_detail_kelas])->row_array();
		$pertemuan = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $detail_kelas['id_pertemuan_kelas']])->row_array();
		if ($jenis == 'assignment') {
			$nama = $this->input->post('nama');
			$deskripsi = $this->input->post('deskripsi');
			$deskripsiAkhir = $nama . "(assignmentDelimiter)" . $deskripsi;
			$temp = $_FILES['dokumen']['name'];

			if ($temp != NULL) {
				$path = './assets/dokumen/kelas/dokumen/';
				if ($detail_kelas['file'] != '') {
					$oldFile = unlink($path . $detail_kelas['file']);
				}

				$dokumen = explode(".", $temp);
				$newfilename = round(microtime(true)) . '_Assignment_' . $nama . '.' . end($dokumen);
				$tmp = $_FILES['dokumen']['tmp_name'];

				if (move_uploaded_file($tmp, $path . $newfilename)) {
					$file = $path . $newfilename;
				}
			} else {
				$newfilename = $detail_kelas['file'];
			}


			$data = [
				'deskripsi' => $deskripsiAkhir,
				'file' => $newfilename
			];

			$this->db->where('id_detail_kelas', $id_detail_kelas);
			$this->db->update('detail_kelas', $data);

			if ($pertemuan['jenis'] == 'training') {
				redirect('dashboard/tugasPraInkubasi/' . $id_detail_kelas);
			} elseif ($pertemuan['jenis'] == 'coaching') {
				redirect('dashboard/tugasInkubasi/' . $id_detail_kelas);
			}
		} elseif ($jenis == 'link') {
			$nama = $this->input->post('nama');
			$link = $this->input->post('link');

			$linkExplode1 = explode('https://youtu.be/', $link);
			$linkExplode2 = explode('https://www.youtube.com/watch?v=', $link);

			if (count($linkExplode1) > 1) {
				$link = $linkExplode1[1];
			} elseif (count($linkExplode2) > 1) {
				$link = $linkExplode2[1];
			} else {
				$link = '';
			}

			$data = [
				'deskripsi' => $nama . '(linkDelimiter)' . $link,
			];

			$this->db->where('id_detail_kelas', $id_detail_kelas);
			$this->db->update('detail_kelas', $data);

			if ($pertemuan['jenis'] == 'training') {
				redirect('dashboard/videoPraInkubasi/' . $id_detail_kelas);
			} elseif ($pertemuan['jenis'] == 'coaching') {
				redirect('dashboard/videoInkubasi/' . $id_detail_kelas);
			}
		} elseif ($jenis == 'dokumen') {
			$tempNama = $this->input->post('nama');
			$nama = str_replace(' ', '_', $tempNama);
			$temp = $_FILES['dokumen']['name'];

			if ($temp != NULL) {
				$path = './assets/dokumen/kelas/dokumen/';
				unlink($path . $detail_kelas['file']);
				$dokumen = explode(".", $temp);
				$newfilename = round(microtime(true)) . '_' . $nama . '.' . end($dokumen);

				$tenant = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $this->input->post('submit')])->row_array();

				$tmp = $_FILES['dokumen']['tmp_name'];

				if (move_uploaded_file($tmp, $path . $newfilename)) {
					$file = $path . $newfilename;
				}
			} else {
				die;
				$newfilename = $detail_kelas['file'];
			}

			$data = [
				'deskripsi' => $tempNama,
				'file' => $newfilename
			];

			$this->db->where('id_detail_kelas', $id_detail_kelas);
			$this->db->update('detail_kelas', $data);

			if ($pertemuan['jenis'] == 'training') {
				redirect('dashboard/detailPraInkubasi/' . $detail_kelas['id_kelas']);
			} elseif ($pertemuan['jenis'] == 'coaching') {
				redirect('dashboard/inkubasiDetail/' . $detail_kelas['id_kelas']);
			}
		} elseif ($jenis == 'feedback') {
			$this->db->where('id_detail_kelas', $id_detail_kelas);
			$this->db->set('deskripsi', $this->input->post('feedback'));
			$this->db->update('detail_kelas');

			if ($pertemuan['jenis'] == 'training') {
				redirect('dashboard/detailPraInkubasi/' . $detail_kelas['id_kelas']);
			} elseif ($pertemuan['jenis'] == 'coaching') {
				redirect('dashboard/inkubasiDetail/' . $detail_kelas['id_kelas']);
			}
		}
	}

	public function hapusDetailPertemuan($id_detail_kelas, $jenis)
	{
		$detail = $this->db->get_where('detail_kelas', ['id_detail_kelas' => $id_detail_kelas])->row_array();
		if ($jenis == 'assignment' || $jenis == 'dokumen') {
			$path = './assets/dokumen/kelas/dokumen/';
			unlink($path . $detail['file']);
		}

		$this->db->where('id_detail_kelas', $id_detail_kelas);
		$this->db->delete('progress_kelas');

		$this->db->where('id_detail_kelas', $id_detail_kelas);
		$this->db->delete('detail_kelas');
	}

	public function hapusPertemuan($id_pertemuan)
	{
		$pertemuan = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $id_pertemuan])->row_array();
		$detail_kelas = $this->db->get_where('detail_kelas', ['id_pertemuan_kelas' => $id_pertemuan, 'id_kelas' => $pertemuan['id_kelas']])->result_array();

		if ($detail_kelas != NULL) {
			for ($i = 0; $i < count($detail_kelas); $i++) {
				$id_detail = $detail_kelas[$i]['id_detail_kelas'];

				$this->db->where('id_detail_kelas', $id_detail);
				$this->db->delete('progress_kelas');

				$this->db->where('id_detail_kelas', $id_detail);
				$this->db->delete('detail_kelas');
			}
		}

		$this->db->where('id_pertemuan_kelas', $id_pertemuan);
		$this->db->delete('pertemuan_kelas');
		if ($pertemuan['jenis'] == 'training') {
			redirect('dashboard/detailPraInkubasi/' . $pertemuan['id_kelas']);
		} elseif ($pertemuan['jenis'] == 'coaching') {
			redirect('dashboard/inkubasiDetail/' . $pertemuan['id_kelas']);
		}
	}

	public function editPagePraInkubasi($id)
	{
		$data['pertemuan'] = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $id])->row_array();
		$data['kelas'] = $this->db->get_where('kelas_training', ['id_kelas_training' => $data['pertemuan']['id_kelas']])->row_array();

		$this->form_validation->set_rules(
			'nama',
			'Nama',
			'required|trim',
			[
				'required' => 'Tolong masukkan nama page!'
			]
		);

		$this->form_validation->set_rules(
			'deskripsi',
			'deskripsi',
			'required|trim',
			[
				'required' => 'Tolong masukkan deskripsi page!'
			]
		);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside');
			$this->load->view('dashboard/pra-inkubasi/edit-page', $data);
			$this->load->view('templates/dashboardfoot');
		} else {
			$tenant = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $id])->row_array();
			$nama = $this->input->post('nama');
			$deskripsi = $this->input->post('deskripsi');

			$data = [
				'nama' => $nama,
				'deskripsi' => $deskripsi
			];

			$this->db->set($data);
			$this->db->where('id_pertemuan_kelas', $id);
			$this->db->update('pertemuan_kelas');

			redirect('dashboard/detailPraInkubasi/' . $tenant['id_kelas']);
		}
	}

	public function submitTugasPraInkubasi()
	{
		$tenant = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $this->input->post('submit')])->row_array();

		$this->form_validation->set_rules(
			'nama',
			'Nama',
			'required|trim',
			[
				'required' => 'Tolong masukkan nama assignment!'
			]
		);

		$this->form_validation->set_rules(
			'deskripsi',
			'deskripsi',
			'required|trim',
			[
				'required' => 'Tolong masukkan deskripsi assignment!'
			]
		);

		if ($this->form_validation->run() == false) {
			redirect('dashboard/detailPraInkubasi/' . $tenant['id_kelas']);
		} else {
			$nama = $this->input->post('nama');
			$deskripsi = $this->input->post('deskripsi');
			$deskripsiAkhir = $nama . "(assignmentDelimiter)" . $deskripsi;
			$temp = $_FILES['dokumen']['name'];
			if ($temp != NULL) {
				$dokumen = explode(".", $temp);
				$newfilename = round(microtime(true)) . '_Assignment_' . $nama . '.' . end($dokumen);
				$path = './assets/dokumen/kelas/dokumen/';
				$tmp = $_FILES['dokumen']['tmp_name'];

				if (move_uploaded_file($tmp, $path . $newfilename)) {
					$file = $path . $newfilename;
				}
			} else {
				$newfilename = '';
			}


			$data = [
				'id_kelas' => $tenant['id_kelas'],
				'id_pertemuan_kelas' => $this->input->post('submit'),
				'jenis' => 'assignment',
				'deskripsi' => $deskripsiAkhir,
				'file' => $newfilename
			];

			$this->db->insert('detail_kelas', $data);
			$this->Sit_model->pushNewProgressTraining($tenant['id_kelas'], $this->input->post('submit'));

			$id_tenant = [];
			$temp2 = $this->db->get_where('enroll_kelas_training', ['id_kelas' => $tenant['id_kelas']])->result_array();
			$kelas = $this->db->get_where('kelas_coaching', ['id_kelas_coaching' => $tenant['id_kelas']])->row_array();
			for ($i = 0; $i < count($temp2); $i++) {
				$id_tenant[$i] = $temp2[$i]['id_tenant'];
			}

			$this->Sit_model->sendNotification('assignment', $id_tenant, 'System', $kelas['nama_kelas']);
			redirect('dashboard/detailPraInkubasi/' . $tenant['id_kelas']);
		}
	}

	public function submitDokumenPraInkubasi()
	{
		$tempNama = $this->input->post('nama');
		$nama = str_replace(' ', '_', $tempNama);
		$temp = $_FILES['dokumen']['name'];
		$dokumen = explode(".", $temp);
		$newfilename = round(microtime(true)) . '_' . $nama . '.' . end($dokumen);

		$tenant = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $this->input->post('submit')])->row_array();

		$path = './assets/dokumen/kelas/dokumen/';
		$tmp = $_FILES['dokumen']['tmp_name'];

		if (move_uploaded_file($tmp, $path . $newfilename)) {
			$file = $path . $newfilename;
		}

		$data = [
			'id_kelas' => $tenant['id_kelas'],
			'id_pertemuan_kelas' => $this->input->post('submit'),
			'jenis' => 'dokumen',
			'deskripsi' => $tempNama,
			'file' => $newfilename
		];

		$this->db->insert('detail_kelas', $data);
		$this->Sit_model->pushNewProgressTraining($tenant['id_kelas'], $this->input->post('submit'));
		redirect('dashboard/detailPraInkubasi/' . $tenant['id_kelas']);
	}

	public function submitLinkPraInkubasi()
	{
		$tenant = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $this->input->post('submit')])->row_array();
		$nama = $this->input->post('nama');
		$link = $this->input->post('link');

		$linkExplode1 = explode('https://youtu.be/', $link);
		$linkExplode2 = explode('https://www.youtube.com/watch?v=', $link);

		if (count($linkExplode1) > 1) {
			$link = $linkExplode1[1];
		} elseif (count($linkExplode2) > 1) {
			$link = $linkExplode2[1];
		} else {
			$link = '';
		}

		$data = [
			'id_kelas' => $tenant['id_kelas'],
			'id_pertemuan_kelas' => $this->input->post('submit'),
			'jenis' => 'link',
			'deskripsi' => $nama . '(linkDelimiter)' . $link,
			'file' => ''
		];

		$this->db->insert('detail_kelas', $data);
		$this->Sit_model->pushNewProgressTraining($tenant['id_kelas'], $this->input->post('submit'));

		redirect('dashboard/detailPraInkubasi/' . $tenant['id_kelas']);
	}

	public function submitFeedbackPraInkubasi()
	{
		$tenant = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $this->input->post('submit')])->row_array();

		$data = [
			'id_kelas' => $tenant['id_kelas'],
			'id_pertemuan_kelas' => $this->input->post('submit'),
			'jenis' => 'feedback',
			'deskripsi' => $this->input->post('feedback'),
			'file' => ''
		];

		$this->db->insert('detail_kelas', $data);
		$this->Sit_model->pushNewProgressTraining($tenant['id_kelas'], $this->input->post('submit'));
		redirect('dashboard/detailPraInkubasi/' . $tenant['id_kelas']);
	}

	public function inkubasi()
	{
		$data['tenant'] = $this->db->get_where('tenant', ['status' => 4])->result_array();
		if ($this->session->userdata('search') == NULL) {
			if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 3) {
				$data['kelas'] = $this->db->get('kelas_coaching')->result_array();
				$data['coach'] = $this->db->get_where('user', ['role_id' => 5])->result_array();

				$this->pagination->initialize($this->Sit_model->pagination(count($data['kelas']), 'dashboard/inkubasi', 12));

				$data['start'] = $this->uri->segment(3);
				$this->db->order_by('id_kelas_coaching', 'DESC');
				$data['kelas'] = $this->db->get('kelas_coaching', 12, $data['start'])->result_array();
			} elseif ($this->session->userdata('role_id') == 5) {
				$data['kelas'] = $this->db->get_where('kelas_coaching', ['coach' => $this->session->userdata('id_user')])->result_array();

				$this->pagination->initialize($this->Sit_model->pagination(count($data['kelas']), 'dashboard/inkubasi', 12));

				$data['start'] = $this->uri->segment(3);
				$this->db->order_by('id_kelas_coaching', 'DESC');
				$data['kelas'] = $this->db->get_where('kelas_coaching', ['coach' => $this->session->userdata('id_user')], 12, $data['start'])->result_array();
			}
		} else {
			if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 3) {
				$key = $this->session->userdata('search');
				$queryTenant = "SELECT * FROM kelas_coaching WHERE nama_kelas LIKE '%$key%' ORDER BY id_kelas_coaching DESC";
				$data['kelas'] = $this->db->query($queryTenant)->result_array();
				$data['coach'] = $this->db->get_where('user', ['role_id' => 5])->result_array();
				$this->session->unset_userdata('search');
			} elseif ($this->session->userdata('role_id') == 5) {
				$key = $this->session->userdata('search');
				$id_coach = $this->session->userdata('id_user');
				$queryTenant = "SELECT * FROM kelas_coaching WHERE nama_kelas LIKE '%$key%' AND coach = $id_coach ORDER BY id_kelas_coaching DESC";
				$data['kelas'] = $this->db->query($queryTenant)->result_array();
				$this->session->unset_userdata('search');
			}
		}


		$this->form_validation->set_rules(
			'nama',
			'Nama',
			'required|trim',
			[
				'required' => 'Tolong masukkan nama kelas!'
			]
		);

		$this->form_validation->set_rules(
			'enroll',
			'Enroll Key',
			'required|trim|is_unique',
			[
				'required' => 'Tolong masukkan enroll key!',
				'is_unique' => 'Enroll key telah terdaftar!'
			]
		);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside');
			$this->load->view('dashboard/inkubasi/index', $data);
			$this->load->view('templates/dashboardfoot');
		} else {

			if ($this->session->userdata('role_id') == 1 || $this->session->userdata('role_id') == 3) {
				$data = [
					'nama_kelas' => $this->input->post('nama'),
					'enroll_key' => $this->input->post('enroll'),
					'coach' => $this->input->post('coach')
				];
			} elseif ($this->session->userdata('role_id') == 5) {
				$data = [
					'nama_kelas' => $this->input->post('nama'),
					'enroll_key' => $this->input->post('enroll'),
					'coach' => $this->session->userdata('id_user')
				];
			}

			$this->db->insert('kelas_coaching', $data);
			redirect('dashboard/inkubasi');
		}
	}

	public function editKelasInkubasi()
	{
		$id_kelas = $this->input->post('id_kelas');
		$kelas = $this->db->get_where('kelas_coaching', ['id_kelas_coaching' => $id_kelas])->row_array();
		$data = [
			'nama' => $kelas['nama_kelas'],
			'enroll' => $kelas['enroll_key']
		];

		echo json_encode($data);
	}

	public function pushEditKelasInkubasi()
	{
		$id_kelas = $this->input->post('id_kelas');
		$nama = $this->input->post('nama');
		$enroll = $this->input->post('enroll');
		$kelas = $this->db->get_where('kelas_coaching', ['enroll_key' => $enroll])->row_array();
		$i = 0;

		if (strlen($nama) == 0) {
			$data['nama'] = 'Tolong isi nama kelas!';
			$i++;
		} else {
			$data['nama'] = '';
		}

		if (strlen($enroll) == 0) {
			$data['enroll'] = 'Tolong isi enroll key!';
			$i++;
		} elseif ($kelas != NULL && $kelas['id_kelas_coaching'] != $id_kelas) {
			$data['enroll'] = 'Enroll key telah terdaftar';
			$i++;
		} else {
			$data['enroll'] = '';
		}


		if ($i > 0) {
			$data['indikator'] = 'salah';
		} else {
			$edit = [
				'nama_kelas' => $nama,
				'enroll_key' => $enroll
			];
			$this->db->set($edit);
			$this->db->where('id_kelas_coaching', $id_kelas);
			$this->db->update('kelas_coaching');
		}

		echo json_encode($data);
	}

	public function inkubasiDetail($id)
	{
		$data['kelas'] = $this->db->get_where('kelas_coaching', ['id_kelas_coaching' => $id])->row_array();
		$data['pertemuan'] = $this->db->get_where('pertemuan_kelas', ['id_kelas' => $id, 'jenis' => 'coaching'])->result_array();
		$data['enroll'] = $this->db->get_where('enroll_kelas_coaching', ['id_kelas' => $id, 'status' => 0])->result_array();

		$data['detail'] = [];

		$i = 0;
		foreach ($data['pertemuan'] as $dp) {
			$temp = $this->db->get_where('detail_kelas', ['id_kelas' => $dp['id_kelas'], 'id_pertemuan_kelas' => $dp['id_pertemuan_kelas']])->result_array();
			$data['detail'] = array_merge($data['detail'], $temp);
			if (strpos($dp['deskripsi'], "\n") !== FALSE) {
				$explode = explode("\n", $dp['deskripsi']);
				$data['pertemuan'][$i]['deskripsi'] = '';
				foreach ($explode as $ex) {
					$data['pertemuan'][$i]['deskripsi'] .= $ex . "<br>";
				}
			}
			$i++;
		}

		$i = 0;
		foreach ($data['enroll'] as $er) {
			if ($this->session->userdata('role_id') == 1) {
				$data['tenant'][$i] = $this->db->get_where('tenant', ['id_tenant' => $er['id_tenant']])->row_array();
			} elseif ($this->session->userdata('role_id') == 3) {
				$temp = $this->db->get_where('tenant', ['id_tenant' => $er['id_tenant'], 'pendamping' => $this->session->userdata('id_user')])->row_array();
				if ($temp != NULL) {
					$data['tenant'][$i] = $temp;
				}
			}
			$i++;
		}

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/inkubasi/detail', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function riwayatInkubasi()
	{
		if ($this->session->userdata('search') == NULL) {
			if ($this->session->userdata('role_id') == 3) {
				$this->db->where('pendamping', $this->session->userdata('id_user'));
			}
			$this->db->order_by('id_tenant', 'DESC');
			$data['tenant'] = $this->db->get_where('tenant', ['status' => 6])->result_array();

			$this->pagination->initialize($this->Sit_model->pagination(count($data['tenant']), 'dashboard/riwayatInkubasi', 5));

			$data['start'] = $this->uri->segment(3);
			if ($this->session->userdata('role_id') == 3) {
				$this->db->where('pendamping', $this->session->userdata('id_user'));
			}
			$this->db->order_by('id_tenant', 'DESC');
			$data['tenant'] = $this->db->get_where('tenant', ['status' => 6], 5, $data['start'])->result_array();

			for ($j = 0; $j < count($data['tenant']); $j++) {
				$data['tenant'][$j]['nomor'] = $j + 1 + $data['start'];
			}
		} else {
			$key = $this->session->userdata('search');
			if ($this->session->userdata('role_id') == 3) {
				$id_pendamping  = $this->session->userdata('id_user');
				$queryTenant = "SELECT * FROM tenant WHERE status = 6 AND pendamping = '$id_pendamping' AND nama_tenant LIKE '%$key%' ORDER BY id_tenant DESC";
			} else {
				$queryTenant = "SELECT * FROM tenant WHERE status = 6 AND nama_tenant LIKE '%$key%' ORDER BY id_tenant DESC";
			}
			$data['tenant'] = $this->db->query($queryTenant)->result_array();
			for ($j = 0; $j < count($data['tenant']); $j++) {
				$data['tenant'][$j]['nomor'] = $j + 1;
			}
			$this->session->unset_userdata('search');
		}

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/tenant/riwayat', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function detailUserInkubasi($id)
	{
		$id_tenant = $this->input->get('pilihTenant');
		$data['dataKelas'] = $this->Sit_model->dataKelasCoaching($id, $id_tenant);
		$data['progress'] = $this->Sit_model->persenProgressInkubasi($id, $id_tenant);
		$data['enroll'] = $this->db->get_where('enroll_kelas_coaching', ['id_kelas' => $id])->result_array();

		$i = 0;
		$data['selectTenant'][$i] = $this->db->get_where('tenant', ['id_tenant' => $id_tenant])->row_array();
		$i++;

		foreach ($data['enroll'] as $er) {
			$temp = $this->db->get_where('tenant', ['id_tenant' => $er['id_tenant']])->row_array();
			if ($temp['id_tenant'] != $id_tenant) {
				$data['selectTenant'][$i] = $temp;
				$i++;
			}
		}

		$j = 0;

		foreach ($data['dataKelas']['detail'] as $dt) {
			$progressKelas = $this->db->get_where('progress_kelas', ['id_tenant' => $id_tenant, 'id_detail_kelas' => $dt['id_detail_kelas']])->row_array();

			if ($progressKelas['status'] == 0) {
				$progressKelas['status'] = '';
			} else {
				$progressKelas['status'] = 'checked';
			}

			$data['dataKelas']['detail'][$j]['progress'] = $progressKelas['status'];
			$j++;
		}

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/inkubasi/detail-user', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function lulusInkubasi($id_tenant)
	{
		$monev = $this->db->get_where('monev', ['id_tenant' => $id_tenant, 'status' => 2])->row_array();

		if ($monev == NULL) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger mt-3" role="alert" style="font-size: 14px;">Usaha Tenant belum ini menyelesaikan seluruh proses inkubasi!</div>');
			redirect('dashboard/detailTenant/' . $id_tenant);
		} else {
			$data = [
				'waktu_selesai' => date('Y-m-d'),
				'status' => 6
			];
			$this->db->set($data);
			$this->db->where('id_tenant', $id_tenant);
			$this->db->update('tenant');
			redirect('dashboard/riwayatInkubasi');
		}
	}

	public function buatPertemuanCoaching($id)
	{
		$kelas = $this->db->get_where('kelas_coaching', ['id_kelas_coaching' => $id])->row_array();
		$pertemuan = $this->db->get_where('pertemuan_kelas', ['id_kelas' => $id, 'jenis' => 'coaching'])->result_array();
		$namaPertemuan = $kelas['nama_kelas'] . " " . (count($pertemuan) + 1);

		$data = [
			'id_kelas' => $id,
			'nama' => $namaPertemuan,
			'jenis' => 'coaching',
			'status' => 0
		];
		$this->db->insert('pertemuan_kelas', $data);

		$tenant = [];
		$temp = $this->db->get_where('enroll_kelas_coaching', ['id_kelas' => $id])->result_array();
		for ($i = 0; $i < count($temp); $i++) {
			$tenant[$i] = $temp[$i]['id_tenant'];
		}
		$role = ['Inkubator', 'User', 'Pendamping', 'Mentor', 'Coach'];
		$user = $this->session->userdata('nama') . ' - ' . $role[$this->session->userdata('role_id') - 1];

		$this->Sit_model->sendNotification('pertemuan', $tenant, $user, $kelas['nama_kelas']);
		redirect('dashboard/inkubasiDetail/' . $id);
	}

	public function editPertemuanInkubasi($id_kelas, $id_pertemuan)
	{
		$data['kelas'] = $this->db->get_where('kelas_coaching', ['id_kelas_coaching' => $id_kelas])->row_array();
		$data['pertemuan'] = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $id_pertemuan])->row_array();
		$data['assignment'] = $this->db->get_where('detail_kelas', ['id_kelas' => $id_kelas, 'id_pertemuan_kelas' => $id_pertemuan, 'jenis' => 'assignment'])->result_array();
		$data['link'] = $this->db->get_where('detail_kelas', ['id_kelas' => $id_kelas, 'id_pertemuan_kelas' => $id_pertemuan, 'jenis' => 'link'])->result_array();
		$data['feedback'] = $this->db->get_where('detail_kelas', ['id_kelas' => $id_kelas, 'id_pertemuan_kelas' => $id_pertemuan, 'jenis' => 'feedback'])->result_array();
		$data['dokumen'] = $this->db->get_where('detail_kelas', ['id_kelas' => $id_kelas, 'id_pertemuan_kelas' => $id_pertemuan, 'jenis' => 'dokumen'])->result_array();



		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside');
			$this->load->view('dashboard/inkubasi/edit-detail', $data);
			$this->load->view('templates/dashboardfoot');
		} else {
			$tenant = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $id])->row_array();
			$nama = $this->input->post('nama');
			$deskripsi = $this->input->post('deskripsi');

			$data = [
				'nama' => $nama,
				'deskripsi' => $deskripsi
			];

			$this->db->set($data);
			$this->db->where('id_pertemuan_kelas', $id);
			$this->db->update('pertemuan_kelas');

			redirect('dashboard/inkubasiDetail/' . $tenant['id_kelas']);
		}
	}

	public function videoInkubasi($id)
	{
		$data['detailKelas'] = $this->db->get_where('detail_kelas', ['id_detail_kelas' => $id])->row_array();
		$data['kelas'] = $this->db->get_where('kelas_coaching', ['id_kelas_coaching' => $data['detailKelas']['id_kelas']])->row_array();
		$linkExplode = explode('(linkDelimiter)', $data['detailKelas']['deskripsi']);
		$data['detailKelas']['deskripsi'] = $linkExplode[1];

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/inkubasi/video', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function tugasInkubasi($id)
	{
		$data['id_tenant'] = '';
		$data['detailKelas'] = $this->db->get_where('detail_kelas', ['id_detail_kelas' => $id])->row_array();
		$data['kelas'] = $this->db->get_where('kelas_coaching', ['id_kelas_coaching' => $data['detailKelas']['id_kelas']])->row_array();
		$data['kontenKelas'] = explode("(assignmentDelimiter)", $data['detailKelas']['deskripsi']);

		$this->form_validation->set_rules(
			'nilai',
			'Nilai',
			'required|trim',
			[
				'required' => 'Tolong masukkan nilai!'
			]
		);

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/inkubasi/tugas', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function tugasUserInkubasi($id, $id_tenant)
	{
		$data['id_tenant'] = $id_tenant;
		$data['detailKelas'] = $this->db->get_where('detail_kelas', ['id_detail_kelas' => $id])->row_array();
		$data['kelas'] = $this->db->get_where('kelas_coaching', ['id_kelas_coaching' => $data['detailKelas']['id_kelas']])->row_array();
		$data['kontenKelas'] = explode("(assignmentDelimiter)", $data['detailKelas']['deskripsi']);
		$data['progress'] = $this->db->get_where('progress_kelas', ['id_detail_kelas' => $id, 'id_tenant' => $id_tenant])->row_array();
		$data['jawaban'] = $this->db->get_where('jawaban', ['id_progress_kelas' => $data['progress']['id_progress_kelas']])->row_array();
		if ($data['jawaban'] != NULL) {
			$data['countJawaban'] = count($data['jawaban']);
		} else {
			$data['countJawaban'] = 0;
		}

		$this->form_validation->set_rules(
			'nilai',
			'Nilai',
			'required|trim',
			[
				'required' => 'Tolong masukkan nilai!'
			]
		);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside');
			$this->load->view('dashboard/inkubasi/tugas', $data);
			$this->load->view('templates/dashboardfoot');
		} else {
			$nilai = $this->input->post('nilai');

			$this->db->set('nilai', $nilai);
			$this->db->where('id_jawaban', $data['jawaban']['id_jawaban']);
			$this->db->update('jawaban');

			$dataProgress = [
				'id_detail_kelas' => $id,
				'id_tenant' => $id_tenant
			];

			$this->db->set('status', 1);
			$this->db->where($dataProgress);
			$this->db->update('progress_kelas');

			redirect('dashboard/tugasUserInkubasi/' . $id . '/' . $id_tenant);
		}
	}

	public function pageInkubasi($id)
	{
		$data['detailKelas'] = $this->db->get_where('detail_kelas', ['id_detail_kelas' => $id])->row_array();
		$data['kontenKelas'] = explode("(pageDelimiter)", $data['detailKelas']['deskripsi']);
		$data['kelas'] = $this->db->get_where('kelas_coaching', ['id_kelas_coaching' => $data['detailKelas']['id_kelas']])->row_array();
		if (!isset($data['kontenKelas'][2])) {
			$data['kontenKelas'][2] = '';
		}

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/inkubasi/page', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function editPageInkubasi($id)
	{
		$data['pertemuan'] = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $id])->row_array();
		$data['kelas'] = $this->db->get_where('kelas_coaching', ['id_kelas_coaching' => $data['pertemuan']['id_kelas']])->row_array();

		$this->form_validation->set_rules(
			'nama',
			'Nama',
			'required|trim',
			[
				'required' => 'Tolong masukkan nama page!'
			]
		);

		$this->form_validation->set_rules(
			'deskripsi',
			'deskripsi',
			'required|trim',
			[
				'required' => 'Tolong masukkan deskripsi page!'
			]
		);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside');
			$this->load->view('dashboard/inkubasi/edit-page', $data);
			$this->load->view('templates/dashboardfoot');
		} else {
			$tenant = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $id])->row_array();
			$nama = $this->input->post('nama');
			$deskripsi = $this->input->post('deskripsi');

			$data = [
				'nama' => $nama,
				'deskripsi' => $deskripsi
			];

			$this->db->set($data);
			$this->db->where('id_pertemuan_kelas', $id);
			$this->db->update('pertemuan_kelas');

			redirect('dashboard/inkubasiDetail/' . $tenant['id_kelas']);
		}
	}

	public function submitTugasInkubasi()
	{
		$tenant = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $this->input->post('submit')])->row_array();

		$this->form_validation->set_rules(
			'nama',
			'Nama',
			'required|trim',
			[
				'required' => 'Tolong masukkan nama assignment!'
			]
		);

		$this->form_validation->set_rules(
			'deskripsi',
			'deskripsi',
			'required|trim',
			[
				'required' => 'Tolong masukkan deskripsi assignment!'
			]
		);

		if ($this->form_validation->run() == false) {
			redirect('dashboard/inkubasiDetail/' . $tenant['id_kelas']);
		} else {
			$temp = $_FILES['dokumen']['name'];
			if ($temp != NULL) {
				$dokumen = explode(".", $temp);
				$newfilename = round(microtime(true)) . '.' . end($dokumen);
				$path = './assets/dokumen/kelas/dokumen/';
				$tmp = $_FILES['dokumen']['tmp_name'];

				if (move_uploaded_file($tmp, $path . $newfilename)) {
					$file = $path . $newfilename;
				}
			} else {
				$newfilename = '';
			}

			$nama = $this->input->post('nama');
			$deskripsi = $this->input->post('deskripsi');
			$deskripsiAkhir = $nama . "(assignmentDelimiter)" . $deskripsi;

			$data = [
				'id_kelas' => $tenant['id_kelas'],
				'id_pertemuan_kelas' => $this->input->post('submit'),
				'jenis' => 'assignment',
				'deskripsi' => $deskripsiAkhir,
				'file' => $newfilename
			];

			$this->db->insert('detail_kelas', $data);
			$this->Sit_model->pushNewProgressCoaching($tenant['id_kelas'], $this->input->post('submit'));

			$id_tenant = [];
			$temp2 = $this->db->get_where('enroll_kelas_coaching', ['id_kelas' => $tenant['id_kelas']])->result_array();
			$kelas = $this->db->get_where('kelas_coaching', ['id_kelas_coaching' => $tenant['id_kelas']])->row_array();
			for ($i = 0; $i < count($temp2); $i++) {
				$id_tenant[$i] = $temp2[$i]['id_tenant'];
			}
			$role = ['Inkubator', 'User', 'Pendamping', 'Mentor', 'Coach'];
			$user = $this->session->userdata('nama') . ' - ' . $role[$this->session->userdata('role_id') - 1];

			$this->Sit_model->sendNotification('assignment', $id_tenant, $user, $kelas['nama_kelas']);
			redirect('dashboard/inkubasiDetail/' . $tenant['id_kelas']);
		}
	}

	public function submitLinkInkubasi()
	{
		$tenant = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $this->input->post('submit')])->row_array();
		$nama = $this->input->post('nama');
		$link = $this->input->post('link');

		$linkExplode1 = explode('https://youtu.be/', $link);
		$linkExplode2 = explode('https://www.youtube.com/watch?v=', $link);

		if (count($linkExplode1) > 1) {
			$link = $linkExplode1[1];
		} elseif (count($linkExplode2) > 1) {
			$link = $linkExplode2[1];
		} else {
			$link = '';
		}

		$data = [
			'id_kelas' => $tenant['id_kelas'],
			'id_pertemuan_kelas' => $this->input->post('submit'),
			'jenis' => 'link',
			'deskripsi' => $nama . '(linkDelimiter)' . $link,
			'file' => ''
		];

		$this->db->insert('detail_kelas', $data);
		$this->Sit_model->pushNewProgressCoaching($tenant['id_kelas'], $this->input->post('submit'));
		redirect('dashboard/inkubasiDetail/' . $tenant['id_kelas']);
	}

	public function submitFeedbackInkubasi()
	{
		$tenant = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $this->input->post('submit')])->row_array();

		$data = [
			'id_kelas' => $tenant['id_kelas'],
			'id_pertemuan_kelas' => $this->input->post('submit'),
			'jenis' => 'feedback',
			'deskripsi' => $this->input->post('feedback'),
			'file' => ''
		];

		$this->db->insert('detail_kelas', $data);
		$this->Sit_model->pushNewProgressCoaching($tenant['id_kelas'], $this->input->post('submit'));

		redirect('dashboard/inkubasiDetail/' . $tenant['id_kelas']);
	}

	public function submitDokumenInkubasi()
	{
		$tempNama = $this->input->post('nama');
		$nama = str_replace(' ', '_', $tempNama);
		$temp = $_FILES['dokumen']['name'];
		$dokumen = explode(".", $temp);
		$newfilename = round(microtime(true)) . '_' . $nama . '.' . end($dokumen);

		$tenant = $this->db->get_where('pertemuan_kelas', ['id_pertemuan_kelas' => $this->input->post('submit')])->row_array();

		$path = './assets/dokumen/kelas/dokumen/';
		$tmp = $_FILES['dokumen']['tmp_name'];

		if (move_uploaded_file($tmp, $path . $newfilename)) {
			$file = $path . $newfilename;
		}

		$data = [
			'id_kelas' => $tenant['id_kelas'],
			'id_pertemuan_kelas' => $this->input->post('submit'),
			'jenis' => 'dokumen',
			'deskripsi' => $tempNama,
			'file' => $newfilename
		];

		$this->db->insert('detail_kelas', $data);
		$this->Sit_model->pushNewProgressCoaching($tenant['id_kelas'], $this->input->post('submit'));
		redirect('dashboard/inkubasiDetail/' . $tenant['id_kelas']);
	}

	public function penilaianMonev()
	{
		$this->Sit_model->checkPeriodeMonev();
		$this->db->order_by('id_rekrutmen', 'DESC');
		$data['rekrutmen'] = $this->db->get_where('rekrutmen', ['status' => 1])->result_array();
		$data['periode_monev'] = $this->db->get('periode_monev')->result_array();
		$i = 0;
		foreach ($data['periode_monev'] as $pm) {
			if ($pm['status'] == 0) {
				$periodeMonev = $pm['awal'] . ' s/d ' . $pm['akhir'];
				$tempRekrutmen = $this->db->get_where('rekrutmen', ['id_rekrutmen' => $pm['id_rekrutmen']])->row_array();
				$periodeRekrutmen = $tempRekrutmen['awal_rekrutmen'] . ' s/d ' . $tempRekrutmen['akhir_rekrutmen'];
				$i++;
			}
		}

		if ($i > 0) {
			$data['status'] = '<span class="p-1 bg-success" style="color: white; border-radius: 5px; font-size: 14px; float : right;">Status Upload Monev : Dibuka</span>';
			$data['periodeMonev'] = '<span class="p-1" style="color: black; font-size: 14px;">Periode upload monev : ' . $periodeMonev . '</span>';
			$data['periodeRekrutmen'] = '<span class="p-1" style="color: black; font-size: 14px;">Periode rekrutmen : ' . $periodeRekrutmen . '</span>';
		} else {
			$data['status'] = '<p class="p-1 bg-danger" style="color: white; border-radius: 5px; font-size: 14px; float : right;">Status Upload Monev : Ditutup</p>';
			$data['periodeMonev'] = '';
			$data['periodeRekrutmen'] = '';
		}

		if ($this->session->userdata('search') == NULL) {
			if ($this->session->userdata('role_id') == 1) {
				$countMonev = $this->db->get('monev')->result_array();
				$this->pagination->initialize($this->Sit_model->pagination(count($countMonev), 'dashboard/penilaianMonev', 5));

				$data['start'] = $this->uri->segment(3);
				$this->db->order_by('id_monev', 'DESC');
				$data['monev'] = $this->db->get('monev', 5, $data['start'])->result_array();
			} elseif ($this->session->userdata('role_id') == 3) {
				$id_tenant = $this->Sit_model->getIdTenantPendamping($this->session->userdata('id_user'));
				$this->db->where_in('id_tenant', $id_tenant);
				$countMonev = $this->db->get('monev')->result_array();

				$this->pagination->initialize($this->Sit_model->pagination(count($countMonev), 'dashboard/riwayatInkubasi', 5));

				$data['start'] = $this->uri->segment(3);
				$this->db->where_in('id_tenant', $id_tenant);
				$this->db->order_by('id_monev', 'DESC');
				$data['monev'] = $this->db->get('monev', 5, $data['start'])->result_array();
			} elseif ($this->session->userdata('role_id') == 5) {
				$countMonev = $this->db->get_where('monev', ['coach' => $this->session->userdata('nama')])->result_array();

				$this->pagination->initialize($this->Sit_model->pagination(count($countMonev), 'dashboard/riwayatInkubasi', 5));

				$data['start'] = $this->uri->segment(3);
				$this->db->order_by('id_monev', 'DESC');
				$data['monev'] = $this->db->get_where('monev', ['coach' => $this->session->userdata('nama')], 5, $data['start'])->result_array();
			}
			$i = 0;
			if (count($data['monev']) != NULL) {
				foreach ($data['monev'] as $monev) {
					$tenant = $this->db->get_where('tenant', ['id_tenant' => $monev['id_tenant']])->row_array();
					$data['monev'][$i]['id_tenant'] = $tenant['nama_tenant'];
					$data['monev'][$i]['nomor'] = $i + 1 + $data['start'];

					if ($monev['nilai_coach'] == "") {
						$data['monev'][$i]['nilai_coach'] = "Belum Ada";
					}

					if ($monev['nilai_inkubator'] == "") {
						$data['monev'][$i]['nilai_inkubator'] = "Belum Ada";
					}

					if ($monev['nilai_coach'] != "" && $monev['nilai_inkubator'] != "") {
						$data['monev'][$i]['nilai_total'] = (int)$monev['nilai_inkubator'] + (int)$monev['nilai_coach'];
						$temp = $data['monev'][$i]['nilai_total'];
					}
					$pendamping = $this->db->get_where('user', ['id_user' => $tenant['pendamping']])->row_array();
					if ($pendamping != NULL) {
						$data['monev'][$i]['pendamping'] = $pendamping['nama'];
					} else {
						$data['monev'][$i]['pendamping'] = '';
					}
					$i++;
				}
			}
		} else {
			$data['monev'] = [];
			$key = strtolower($this->session->userdata('search'));
			$this->session->unset_userdata('search');
			if ($this->session->userdata('role_id') == 1) {
				$this->db->order_by('id_monev', 'DESC');
				$monev = $this->db->get('monev')->result_array();
			} elseif ($this->session->userdata('role_id') == 3) {
				$id_tenant = $this->Sit_model->getIdTenantPendamping($this->session->userdata('id_user'));

				$this->db->where_in('id_tenant', $id_tenant);
				$this->db->order_by('id_monev', 'DESC');
				$monev = $this->db->get('monev')->result_array();
			} elseif ($this->session->userdata('role_id') == 5) {
				$this->db->order_by('id_monev', 'DESC');
				$monev = $this->db->get_where('monev', ['coach' => $this->session->userdata('nama')])->result_array();
			}
			$i = 0;
			if (count($monev) != NULL) {
				foreach ($monev as $mn) {
					$tenant = $this->db->get_where('tenant', ['id_tenant' => $mn['id_tenant']])->row_array();
					$tempNama = strtolower($tenant['nama_tenant']);
					$explode = explode($key, $tempNama);
					if (count($explode) > 1) {
						$data['monev'][$i] = $mn;
						$data['monev'][$i]['id_tenant'] = $tenant['nama_tenant'];
						$data['monev'][$i]['nomor'] = $i + 1;

						if ($mn['nilai_coach'] == "") {
							$data['monev'][$i]['nilai_coach'] = "Belum Ada";
						}

						if ($mn['nilai_inkubator'] == "") {
							$data['monev'][$i]['nilai_inkubator'] = "Belum Ada";
						}

						if ($mn['nilai_coach'] != "" && $mn['nilai_inkubator'] != "") {
							$data['monev'][$i]['nilai_total'] = (int)$mn['nilai_inkubator'] + (int)$mn['nilai_coach'];
							$temp = $data['monev'][$i]['nilai_total'];
						}
						$pendamping = $this->db->get_where('user', ['id_user' => $tenant['pendamping']])->row_array();
						if ($pendamping != NULL) {
							$data['monev'][$i]['pendamping'] = $pendamping['nama'];
						} else {
							$data['monev'][$i]['pendamping'] = '';
						}
						$i++;
					}
				}
			}
		}

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/penilaian-monev/index', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function bukaMonev()
	{
		$id_rekrutmen = $this->input->post('periode');
		$awal = $this->input->post('awal');
		$akhir = $this->input->post('akhir');

		if ($awal == "" || $akhir == "") {
			$this->session->set_flashdata('message', '<div class="alert alert-danger mt-3" role="alert" style="font-size: 14px;">Tolong isi data periode dengan lengkap!</div>');
			redirect('dashboard/penilaianMonev');
		}

		$data = [
			'id_rekrutmen' => $id_rekrutmen,
			'awal' => $awal,
			'akhir' => $akhir,
			'status' => 1
		];

		$this->db->insert('periode_monev', $data);
		$this->session->set_flashdata('message', '<div class="alert alert-success mt-3" role="alert" style="font-size: 14px;">Jadwal pembukaan upload monev berhasil ditambahkan!</div>');
		redirect('dashboard/penilaianMonev');
	}

	public function formPenilaianMonev($id)
	{
		$data['monev'] = $this->db->get_where('monev', ['id_monev' => $id])->row_array();
		$data['tenant'] = $this->db->get_where('tenant', ['id_tenant' => $data['monev']['id_tenant']])->row_array();
		$data['penilaian_monev'] = $this->db->get_where('penilaian_monev', ['id_monev' => $id])->row_array();
		$enroll = $this->db->get_where('enroll_kelas_coaching', ['id_tenant' => $data['monev']['id_tenant']])->result_array();
		$data['coach'] = [];
		for ($i = 0; $i < count($enroll); $i++) {
			$this->db->select('coach');
			$kelas = $this->db->get_where('kelas_coaching', ['id_kelas_coaching' => $enroll[$i]['id_kelas']])->row_array();
			$user = $this->db->get_where('user', ['id_user' => $kelas['coach']])->row_array();
			$data['coach'][$i] = $user['nama'];
		}

		$data['coach'] = json_encode(array_unique($data['coach']));

		if ($data['penilaian_monev'] == NULL) {
			$data2 = ['id_monev' => $id];
			$this->db->insert('penilaian_monev', $data2);
			redirect('dashboard/formPenilaianMonev/' . $id);
		} else {
			$data['data_nilai'] = [];
			$nama_penilaian = "";
			$nilai = "";
			$keterangan = "";
			if ($this->session->userdata('role_id') == 1 && $data['penilaian_monev']['penilaian_inkubator'] != "") {
				$explode_penilaian = explode('(delimiter)', $data['penilaian_monev']['penilaian_inkubator']);
				for ($i = 0; $i < count($explode_penilaian) - 1; $i++) {
					$explode_data_penilaian = explode(';', $explode_penilaian[$i]);
					$nama_penilaian .= "'" . $explode_data_penilaian[0] . "',";
					$nilai .= "'" . $explode_data_penilaian[1] . "',";
					$keterangan .= "'" . $explode_data_penilaian[2] . "',";
				}

				$data3 = [
					'nama_penilaian' => $nama_penilaian,
					'nilai' => $nilai,
					'keterangan' => $keterangan
				];

				$data['data_nilai'] = $data3;
				$data['countNilai'] = count($explode_penilaian) - 1;
			} elseif ($this->session->userdata('role_id') == 5 && $data['penilaian_monev']['penilaian_coach'] != "") {
				$explode_penilaian = explode('(delimiter)', $data['penilaian_monev']['penilaian_coach']);
				for ($i = 0; $i < count($explode_penilaian) - 1; $i++) {
					$explode_data_penilaian = explode(';', $explode_penilaian[$i]);
					$nama_penilaian .= "'" . $explode_data_penilaian[0] . "',";
					$nilai .= "'" . $explode_data_penilaian[1] . "',";
					$keterangan .= "'" . $explode_data_penilaian[2] . "',";
				}

				$data3 = [
					'nama_penilaian' => $nama_penilaian,
					'nilai' => $nilai,
					'keterangan' => $keterangan
				];

				$data['data_nilai'] = $data3;
				$data['countNilai'] = count($explode_penilaian) - 1;
			} else {
				$data['data_nilai'] = "";
				$data['countNilai'] = 10;
			}
		}

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/penilaian-monev/nilai', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function submitPenilaianMonev($id)
	{
		$namaPenilaian = $this->input->post('namaPenilaian');
		$penilaian = $this->input->post('penilaian');
		$keterangan = $this->input->post('keterangan');

		$dataPenilaian = '';
		$totalNilai = 0;

		for ($i = 0; $i < count($namaPenilaian); $i++) {
			$dataPenilaian .= $namaPenilaian[$i] . ';' . $penilaian[$i] . ';' . $keterangan[$i] . '(delimiter)';
			$totalNilai = $totalNilai + $penilaian[$i];
		}
		$nilaiAkhir = ($totalNilai / (5 * $i)) * 50;
		$nilaiAkhirExplode = explode(".", $nilaiAkhir);

		if ($this->session->userdata('role_id') == 1) {
			$coach = $this->input->post('coach');
			$monev = $this->db->get_where('monev', ['id_monev' => $id])->row_array();

			if ($monev['nilai_coach'] == "") {
				$data1 = [
					'nilai_inkubator' => $nilaiAkhirExplode[0],
					'coach' => $coach
				];
			} else {
				$totalNilaiAkhir = $monev['nilai_coach'] + $nilaiAkhir;

				if ($totalNilaiAkhir >= 50) {
					$status = 2;
				} else {
					$status = 1;
				}

				$data1 = [
					'nilai_inkubator' => $nilaiAkhirExplode[0],
					'tanggal_penilaian' => date('Y-m-d'),
					'coach' => $coach,
					'status' => $status

				];
			}

			$this->db->set('penilaian_inkubator', $dataPenilaian);
			$this->db->where('id_monev', $id);
			$this->db->update('penilaian_monev');

			$this->db->set($data1);
			$this->db->where('id_monev', $id);
			$this->db->update('monev');

			redirect('dashboard/penilaianMonev');
		} else {
			$monev = $this->db->get_where('monev', ['id_monev' => $id])->row_array();
			$totalNilaiAkhir = $monev['nilai_inkubator'] + $nilaiAkhir;

			if ($totalNilaiAkhir >= 50) {
				$status = 2;
			} else {
				$status = 1;
			}

			$data1 = [
				'nilai_coach' => $nilaiAkhirExplode[0],
				'tanggal_penilaian' => date('Y-m-d'),
				'status' => $status
			];

			$this->db->set('penilaian_coach', $dataPenilaian);
			$this->db->where('id_monev', $id);
			$this->db->update('penilaian_monev');

			$this->db->set($data1);
			$this->db->where('id_monev', $id);
			$this->db->update('monev');

			$this->Sit_model->sendNotification('monev', $monev['id_tenant'], 'System', 'nilai');
			redirect('dashboard/penilaianMonev');
		}
	}

	public function hapusMonev($id_monev)
	{
		$monev = $this->db->get_where('monev', ['id_monev' => $id_monev])->row_array();
		$penilaian_monev = $this->db->get_where('penilaian_monev', ['id_monev' => $id_monev])->row_array();

		if (count($penilaian_monev) >= 1) {
			$this->db->where('id_penilaian_monev', $penilaian_monev['id_penilaian_monev']);
			$this->db->delete('penilaian_monev');
		}

		$this->db->where('id_monev', $id_monev);
		$this->db->delete('monev');
		redirect('dashboard/penilaianMonev');
	}

	public function masterData()
	{
		$role_id = [1, 3, 4, 5];
		$this->db->where_in('role_id', $role_id);
		$count = $this->db->get('user')->result_array();

		$this->pagination->initialize($this->Sit_model->pagination(count($count), 'dashboard/masterData', 10));

		$data['start'] = $this->uri->segment(3);
		$this->db->where_in('role_id', $role_id);
		$this->db->order_by('id_user', 'DESC');
		$data['user'] = $this->db->get('user', 10, $data['start'])->result_array();

		for ($i = 0; $i < count($data['user']); $i++) {
			$data['user'][$i]['nomor'] = $i + 1 + $data['start'];
			if ($data['user'][$i]['role_id'] == 1) {
				$data['user'][$i]['role_id'] = 'Inkubator';
			} elseif ($data['user'][$i]['role_id'] == 3) {
				$data['user'][$i]['role_id'] = 'Pendamping';
			} elseif ($data['user'][$i]['role_id'] == 4) {
				$data['user'][$i]['role_id'] = 'Mentor';
			} elseif ($data['user'][$i]['role_id'] == 5) {
				$data['user'][$i]['role_id'] = 'Coach';
			}
		}

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
			'required' => 'Tolong masukkan nama!'
		]);

		$this->form_validation->set_rules(
			'email',
			'Email',
			'required|trim|valid_email|is_unique[user.email]',
			[
				'is_unique' => 'Email sudah terdaftar!',
				'valid_email' => 'Tolong masukkan email dengan benar!',
				'required' => 'Tolong masukkan email!'
			]
		);

		$this->form_validation->set_rules('role', 'Role', 'required', [
			'required' => 'Tolong masukkan role!'
		]);

		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]', [
			'required' => 'Tolong masukkan password!',
			'min_length' => 'Password terlalu pendek!'
		]);

		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]', [
			'required' => 'Tolong masukkan tulis ulang password!',
			'matches' => 'Password tidak sama!'
		]);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/dashboardhead');
			$this->load->view('templates/dashboardside');
			$this->load->view('dashboard/master-data/index', $data);
			$this->load->view('templates/dashboardfoot');
		} else {
			$data = [
				'email' => $this->input->post('email'),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'nama' => $this->input->post('nama'),
				'role_id' => $this->input->post('role')
			];

			$this->db->insert('user', $data);
			redirect('dashboard/masterData');
		}
	}

	public function editMasterData($id)
	{
		$nama = $this->input->post('namaEdit');
		$email = $this->input->post('emailEdit');
		$role = $this->input->post('roleEdit');
		$password = $this->input->post('passwordEdit1');

		if ($nama == NULL || $email == NULL || $role == NULL || $password == NULL) {
			die;
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tolong isi data ubah dengan benar!</div>');
			redirect('dashboard/masterData');
		} else {

			$data = [
				'email' => $email,
				'password' => password_hash($password, PASSWORD_DEFAULT),
				'nama' => $nama,
				'role_id' => $role
			];

			$this->db->where('id_user', $id);
			$this->db->update('user', $data);
			redirect('dashboard/masterData');
		}
	}

	public function deleteMasterData($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete('user');

		redirect('dashboard/masterData');
	}

	public function coachingLog()
	{
		if ($this->session->userdata('search') == NULL) {
			if ($this->session->userdata('role_id') == 1) {
				$countCL = $this->db->get('coaching_log')->result_array();

				$this->pagination->initialize($this->Sit_model->pagination(count($countCL), 'dashboard/coachingLog', 5));

				$data['start'] = $this->uri->segment(3);
				$this->db->order_by('id_coaching_log', 'DESC');
				$data['coachingLog'] = $this->db->get('coaching_log', 5, $data['start'])->result_array();
			} elseif ($this->session->userdata('role_id') == 3) {
				$id_tenant = $this->Sit_model->getIdTenantPendamping($this->session->userdata('id_user'));
				$this->db->where_in('id_tenant', $id_tenant);
				$countCL = $this->db->get('coaching_log')->result_array();

				$this->pagination->initialize($this->Sit_model->pagination(count($countCL), 'dashboard/coachingLog', 5));

				$data['start'] = $this->uri->segment(3);
				$this->db->where_in('id_tenant', $id_tenant);
				$this->db->order_by('id_coaching_log', 'DESC');
				$data['coachingLog'] = $this->db->get('coaching_log', 5, $data['start'])->result_array();
			} elseif ($this->session->userdata('role_id') == 5) {
				$countCL = $this->db->get('coaching_log')->result_array();
				$coachingLog = [];
				$data['coachingLog'] = [];
				$j = 0;
				foreach ($countCL as $cl) {
					$coach = explode(", ", $cl['coach']);
					if (in_array($this->session->userdata('nama'), $coach)) {
						$coachingLog[$j] = $cl;
						$j++;
					}
				}

				$this->pagination->initialize($this->Sit_model->pagination($j, 'dashboard/coachingLog', 5));

				$data['start'] = $this->uri->segment(3);
				$data['coachingLog'] = array_splice($coachingLog, $data['start'], $data['start'] + 5);
			}
			$i = 0;
			foreach ($data['coachingLog'] as $cl) {
				$data['coachingLog'][$i]['nomor'] = $i + 1 + $data['start'];
				$tenant = $this->db->get_where('tenant', ['id_tenant' => $cl['id_tenant']])->row_array();
				$data['coachingLog'][$i]['nama_tenant'] = $tenant['nama_tenant'];
				$i++;
			}
		} else {
			$data['coachingLog'] = [];
			$key = strtolower($this->session->userdata('search'));
			if ($this->session->userdata('role_id') == 1) {
				$this->db->order_by('id_coaching_log', 'DESC');
				$tempCL = $this->db->get('coaching_log')->result_array();
				$this->session->unset_userdata('search');
			} elseif ($this->session->userdata('role_id') == 3) {
				$id_tenant = $this->Sit_model->getIdTenantPendamping($this->session->userdata('id_user'));
				$this->db->where_in('id_tenant', $id_tenant);
				$this->db->where_in('id_tenant', $id_tenant);
				$this->db->order_by('id_coaching_log', 'DESC');
				$tempCL = $this->db->get('coaching_log')->result_array();
				$this->session->unset_userdata('search');
			} elseif ($this->session->userdata('role_id') == 5) {
				$countCL = $this->db->get('coaching_log')->result_array();
				$tempCL = [];
				$j = 0;
				foreach ($countCL as $cl) {
					$coach = explode(", ", $cl['coach']);
					if (in_array($this->session->userdata('nama'), $coach)) {
						$tempCL[$j] = $cl;
						$j++;
					}
				}
				$this->session->unset_userdata('search');
			}
			$i = 0;
			foreach ($tempCL as $cl) {
				$tenant = $this->db->get_where('tenant', ['id_tenant' => $cl['id_tenant']])->row_array();
				$tempNama = strtolower($tenant['nama_tenant']);
				$explode = explode($key, $tempNama);
				if (count($explode) > 1) {
					$data['coachingLog'][$i] = $cl;
					$data['coachingLog'][$i]['nomor'] = $i + 1;
					$data['coachingLog'][$i]['nama_tenant'] = $tenant['nama_tenant'];
					$i++;
				}
			}
		}

		for ($i = 0; $i < count($data['coachingLog']); $i++) {

			$data['coachingLog'][$i]['hasil_sebelumnya'] = $this->Sit_model->strlenCL($data['coachingLog'][$i]['hasil_sebelumnya']);
			$data['coachingLog'][$i]['tujuan_ini'] = $this->Sit_model->strlenCL($data['coachingLog'][$i]['tujuan_ini']);
			$data['coachingLog'][$i]['hasil_ingin'] = $this->Sit_model->strlenCL($data['coachingLog'][$i]['hasil_ingin']);
			$data['coachingLog'][$i]['hasil_dicapai'] = $this->Sit_model->strlenCL($data['coachingLog'][$i]['hasil_dicapai']);
			$data['coachingLog'][$i]['tujuan_selanjutnya'] = $this->Sit_model->strlenCL($data['coachingLog'][$i]['tujuan_selanjutnya']);
		}

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/coaching-log/index', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function detailCoachingLog($id)
	{
		$data['coachingLog'] = $this->db->get_where('coaching_log', ['id_coaching_log' => $id])->row_array();
		$data['tenant'] = $this->db->get_where('tenant', ['id_tenant' => $data['coachingLog']['id_tenant']])->row_array();

		$this->load->view('templates/dashboardhead');
		$this->load->view('templates/dashboardside');
		$this->load->view('dashboard/coaching-log/detail', $data);
		$this->load->view('templates/dashboardfoot');
	}

	public function submitFeedbackCoachingLog()
	{
		$id = $this->input->post('submit');
		$feedback = $this->input->post('feedback');

		$this->db->set('feedback', $feedback);
		$this->db->where('id_coaching_log', $id);
		$this->db->update('coaching_log');
		redirect('dashboard/coachingLog');
	}

	public function getFeedbackCL($id)
	{
		$data = $this->db->get_where('coaching_log', ['id_coaching_log' => $id])->row_array();

		echo json_encode($data['feedback']);
	}

	public function hapusCoachingLog($id)
	{
		$cl = $this->db->get_where('coaching_log', ['id_coaching_log' => $id])->row_array();
		if ($cl['dokumen'] != '') {
			$path = './assets/dokumen/coaching_log/';
			unlink($path . $cl['dokumen']);
		}
		$this->db->where('id_coaching_log', $id);
		$this->db->delete('coaching_log');
		redirect('dashboard/coachingLog');
	}
}
