<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent ::__construct();
		if ($this->session->userdata('email')==NULL) {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Silahkan login terlebih dahulu!</div>');
			redirect('auth');
		}
		if ($this->session->userdata('role_id')!=2) {
			die;
		}
		$this->load->model('Sit_model');
		$this->load->library('form_validation');
		$this->load->library('pagination');
		$this->Sit_model->checkRekrutmen();
		$this->Sit_model->checkPeriodeMonev();
		$this->Sit_model->getNotification($this->session->userdata('id_user'));
		date_default_timezone_set('Asia/Jakarta');
		require APPPATH.'libraries/phpmailer/src/Exception.php';
        require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH.'libraries/phpmailer/src/SMTP.php';
	}

	public function index(){
		$user_id = $this->session->userdata('id_user');
		$data['dataTenant'] = $this->db->get_where('tenant',['id_user' => $user_id])->result_array();
		$data['tenantGrafik'] = $this->db->get_where('tenant',['id_user' => $user_id, 'status' => 5])->result_array();
		$this->pagination->initialize($this->Sit_model->pagination(count($data['dataTenant']),'user/index',5));

		$data['start']=$this->uri->segment(3);
		$this->db->order_by('id_tenant', 'DESC');
		$data['dataTenant']=$this->db->get_where('tenant',['id_user' => $user_id],5,$data['start'])->result_array();

		for ($i=0; $i < count($data['dataTenant']); $i++) { 
			$data['dataTenant'][$i]['nomor'] = $i + 1 + $data['start'];
		}

		$this->load->view('templates/header');
		$this->load->view('user/index',$data);
		$this->load->view('templates/footer');
	}

	public function profile($id_user){
		$data['user'] = $this->db->get_where('user',['id_user' => $id_user])->row_array();

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim',[
			'required' => 'Tolong masukkan nama!']);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email',[
			'valid_email' => 'Tolong masukkan email dengan benar!',
			'required' => 'Tolong masukkan email!']
		);
		$this->form_validation->set_rules('telepon', 'Telepon', 'required|trim|numeric|min_length[6]',[
			'required' => 'Tolong masukkan nomor telepon!',
			'numeric' => 'Tolong masukkan nomor telepon dengan benar!',
			'min_length'=>'Tolong masukkan nomor telepon dengan benar!']);
		$this->form_validation->set_rules('tempatLahir', 'Tempat Lahir', 'required|trim',[
			'required' => 'Tolong masukkan tempat lahir!']);
		$this->form_validation->set_rules('tanggalLahir', 'Tanggal Lahir', 'required|trim',[
			'required' => 'Tolong masukkan tanggal lahir!']);
		$this->form_validation->set_rules('pendidikan', 'Pendidikan Terakhir', 'required|trim',[
			'required' => 'Tolong masukkan pendidikan terakhir!']);
		$this->form_validation->set_rules('kelamin', 'Jenis Kelamin', 'required',[
			'required' => 'Tolong masukkan jenis kelamin!'
		]);
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim',[
			'required' => 'Tolong masukkan alamat!']);

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header');
			$this->load->view('user/profile',$data);
			$this->load->view('templates/footer');
		}else{
			
			$data=[
				'email' => htmlspecialchars($this->input->post('email',true)),
				'nama' => $this->input->post('nama'),
				'telepon' => $this->input->post('telepon'),
				'tempat_lahir' => $this->input->post('tempatLahir'),
				'tanggal_lahir' => $this->input->post('tanggalLahir'),
				'pendidikan' => $this->input->post('pendidikan'),
				'jenis_kelamin' => $this->input->post('kelamin'),
				'alamat' => $this->input->post('alamat')
			];

			$this->db->set($data);
			$this->db->where('id_user', $id_user);
			$this->db->update('user');

			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data anda sudah diperbarui!</div>');
			redirect('user/profile/'.$id_user);
		}
	}

	public function kodeUbahPass(){
		$email = $this->input->post('email');
		$token = $this->db->get_where('user_token',['email' => $email])->result_array();

		if ($token != NULL) {
			$this->db->where('email', $email);
			$this->db->delete('user_token');
		}

		$data = [
			'email' => $email,
			'token' => $this->Sit_model->generateRandomString(6),
			'tanggal' => date('Y-m-d')
		];

		$email=$this->input->post('email');

		$response = false;
	    $mail = new PHPMailer\PHPMailer\PHPMailer();
	        // SMTP configuration
	    $mail->isSMTP(); 
	    $mail->Host = "tls://smtp.gmail.com"; //sesuaikan sesuai nama domain hosting/server yang digunakan
	    $mail->SMTPAuth = true;
	    $mail->Username = 'takiyagenji0721@gmail.com'; // user email
	    $mail->Password = 'genjic00l'; // password email
	    $mail->SMTPSecure = 'ssl';
	    $mail->Port     = 587;

		$mail->From = "takiyagenji0721@gmail.com"; //email pengirim
		$mail->FromName = "System SIT UNILA"; //nama pengirim
		$mail->addAddress($email);
		$mail->Subject = 'Lupa Password';
		$mail->isHTML(true);
		$mailContent = 'Berikut adalah kode verifikasi ubah password anda : '.$data['token']; // isi email
		$mail->Body = $mailContent;

	    if(!$mail->send()){
           	echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        	die;
        }

		$this->db->insert('user_token', $data);
	}

	public function verifKodeValidPass(){
		$email = $this->input->post('email');
		$code = $this->input->post('code');
		$token = $this->db->get_where('user_token',['email' => $email, 'token' => $code])->result_array();

		if ($token == NULL) {
			echo 'salah';
		} else {
			echo 'benar';
		}
	}

	public function ubahPassword($id){
		$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
		$this->db->set('password', $password);
		$this->db->where('id_user',$id);
		$this->db->update('user');
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password berhasil diubah!</div>');
		redirect('user/profile/'.$id);
	}

	public function getGrafikTenant($id_tenant){
		$monev = $this->db->get_where('monev',['id_tenant' => $id_tenant])->result_array();

		$data['tanggal'] = [];
		$data['nilai'] = [];

		for ($i=0; $i < count($monev); $i++) { 
			$explodeTanggal = explode("-",$monev[$i]['tanggal_dikirim']);
			$data['tanggal'][$i] = $explodeTanggal[1] . "-" . $explodeTanggal[0];
			$data['nilai'][$i] = (int)$monev[$i]['nilai_coach'] + (int)$monev[$i]['nilai_inkubator'];
		}

		echo json_encode($data);
	}

	public function detailTenant($id){
		$data['tenant'] = $this->db->get_where('tenant',['id_tenant' => $id])->row_array();
		$data['data_usaha'] = $this->db->get_where('data_usaha',['id_tenant'=>$id])->row_array();
		$data['data_usaha2'] = $this->db->get_where('data_usaha2',['id_tenant'=>$id])->row_array();
		$data['user_tenant'] = $this->db->get_where('user',['id_user'=>$data['tenant']['id_user']])->row_array();

		$explodeAset = explode(",", $data['data_usaha']['aset']);
		if ($explodeAset[0]!="Tidak ada") {
			for ($i=0; $i < count($explodeAset)-1; $i++) {
				$temp = explode(".",$explodeAset[$i]);
				if (end($temp) == 'pdf') {
					$data['aset'][$i] = '<iframe class="col-12" src="'.base_url('assets/image/foto_aset/').$explodeAset[$i].'" style="min-height: 480px;"></iframe><br>';
				}else{
					$data['aset'][$i] = '<img src="'.base_url('assets/image/foto_aset/').$explodeAset[$i].'" alt="'.$explodeAset[$i].'" class="img-fluid mr-2" style="max-width: 200px;">';
				}
			}
		}

		$explodePerjanjian = explode(",", $data['data_usaha']['perjanjian_usaha']);
		if ($explodePerjanjian[0]!="Tidak ada") {
			for ($i=0; $i < count($explodePerjanjian)-1; $i++) { 
				$temp = explode(".",$explodePerjanjian[$i]);
				if (end($temp) == 'pdf') {
					$data['perjanjian'][$i] = '<iframe class="col-12 my-3" src="'.base_url('assets/image/foto_perjanjian_usaha/').$explodePerjanjian[$i].'" style="min-height: 480px;"></iframe><br>';
				}else{
					$data['perjanjian'][$i] = '<img src="'.base_url('assets/image/foto_perjanjian_usaha/').$explodePerjanjian[$i].'" alt="'.$explodePerjanjian[$i].'" class="img-fluid mr-2" style="max-width: 200px;">';
				}
			}
		}

		$explodeSertifikat = explode(",", $data['data_usaha']['sertifikat_produk']);
		if ($explodeSertifikat[0]!="Tidak ada") {
			for ($i=0; $i < count($explodeSertifikat)-1; $i++) { 
				$temp = explode(".",$explodeSertifikat[$i]);
				if (end($temp) == 'pdf') {
					$data['sertifikat'][$i] = '<iframe class="col-12 my-3" src="'.base_url('assets/image/foto_sertifikat/').$explodeSertifikat[$i].'" style="min-height: 480px;"></iframe><br>';
				}else{
					$data['sertifikat'][$i] = '<img src="'.base_url('assets/image/foto_sertifikat/').$explodeSertifikat[$i].'" alt="'.$explodeSertifikat[$i].'" class="img-fluid mr-2 mt-3" style="max-width: 200px;">';
				}
			}
		}

		$data['gambar'] = explode(",", $data['data_usaha']['foto_produk']);
		$data['jumlah_gambar'] = count($data['gambar']);
		$explodeSumberUsaha = explode(';',$data['data_usaha']['sumber_usaha']);
		$data['sumberUsaha'] = [];
		$data['nominalSumberUsaha'] = [];

		for ($i = 0; $i < count($explodeSumberUsaha); $i++) {
			$explodeTmp = explode(':',$explodeSumberUsaha[$i]);
			$data['sumberUsaha'][$i] = $explodeTmp[0];
			$data['nominalSumberUsaha'][$i] = $explodeTmp[1];
		}

		$penilaian1 = $this->db->get_where('penilaian1',['id_tenant' => $id])->row_array();
		$penilaian2 = $this->db->get_where('penilaian2',['id_tenant' => $id])->row_array();
		$data['penilaian1'] = [];
		$data['penilaian2'] = [];

		if ($penilaian1 != NULL) {
			$tempPenilaian1 = explode(';',$penilaian1['nilai']);
			for($i=0; $i<count($tempPenilaian1) - 1; $i++){
				$explode = explode('(delimiterPenilaian)', $tempPenilaian1[$i]);
				$data['penilaian1'][$i]['penilaian'] = $explode[0];
				$data['penilaian1'][$i]['nilai'] = $explode[1];
			}
		} 

		if ($penilaian2 != NULL) {
			$tempPenilaian2 = explode(';',$penilaian2['nilai']);
			for($i=0; $i<count($tempPenilaian2) -1 ; $i++){
				$explode = explode('(delimiterPenilaian)', $tempPenilaian2[$i]);
				$data['penilaian2'][$i]['penilaian'] = $explode[0];
				$data['penilaian2'][$i]['nilai'] = $explode[1];
			}
		}

		$this->load->view('templates/header');
		$this->load->view('user/detail-tenant',$data);
		$this->load->view('templates/footer');
	}

	public function tambahTenant(){
		$this->Sit_model->modalMessage('rekrutmen');
		$data['dataDiri'] = $this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();

		$this->load->view('templates/header');
		$this->load->view('user/tambah-tenant',$data);
		$this->load->view('templates/footer');	
	}

	public function uploadDataTenant(){
		$temp = $this->input->post('sumberUsaha');
		$temp2 = $this->input->post('nominalSumberUsaha');
		$temp3 = '';

		if ($temp != '') {
			for ($i=0; $i < count($temp); $i++) {
				if ($i == count($temp) - 1) {
					$temp3 .= $temp[$i].':'.$temp2[$i];
				} else {
					$temp3 .= $temp[$i].':'.$temp2[$i].';';
				}
			}
		} else {
			$temp3 .= 'Pribadi:'.$this->input->post('modalAwal');
		}

		$data['dataDiri'] = $this->db->get_where('user',['email'=>$this->session->userdata('email')])->row_array();
		$dataIdUser = $data['dataDiri']['id_user'];

		$this->Sit_model->sendNotification('pendaftaran-tenant', $this->input->post('namaTenant'), $this->session->userdata('nama'), 'a');

		$dataTenant=[
			'id_user'=> $dataIdUser,
			'jenis_tenant' => $this->input->post('jenisTenant'),
			'nama_tenant' => $this->input->post('namaTenant'),
			'bidang_usaha' => $this->input->post('bidang'),
			'status' => 1,
			'waktu' => date('Y-m-d')
		];
		$this->db->insert('tenant',$dataTenant);
		$query1 = 'SELECT * FROM tenant ORDER BY id_tenant DESC';
		$data['tenant']=$this->db->query($query1)->row_array();

		$renameTenant = str_replace(" ", "_", $this->input->post('namaTenant'));

		if ($this->input->post('perjanjianUsahaRadio') == 'Ada') {
			$perjanjian1 = count($_FILES['image2']['name']);
			$perjanjian2 = $_FILES['image2']['name'];
			$perjanjian = '';
			$pathPerjanjian = './assets/image/foto_perjanjian_usaha/';

			for ($i=0; $i < $perjanjian1; $i++) {
				$tmp = $_FILES['image2']['tmp_name'][$i];
				$upload_image1 = explode(".",$perjanjian2[$i]);
				$upload_image = round(microtime(true)) . ($i+1) .'_Perjanjian-Usaha_'. $renameTenant .'.'. end($upload_image1);
				$perjanjian .= $upload_image.",";
				if(move_uploaded_file($tmp, $pathPerjanjian.$upload_image))
				{
					$file = $pathPerjanjian.$upload_image;
				}

			}
		}else{
			$perjanjian = 'Tidak ada';
		}

		if ($this->input->post('sertifikatRadio') == 'Ada') {
			$sertifikat1 = count($_FILES['image3']['name']);
			$sertifikat2 = $_FILES['image3']['name'];
			$sertifikat = '';
			$pathSertifikat = './assets/image/foto_sertifikat/';

			for ($i=0; $i < $sertifikat1; $i++) {
				$tmp = $_FILES['image3']['tmp_name'][$i];
				$upload_image1 = explode(".",$sertifikat2[$i]);
				$upload_image = round(microtime(true)) . ($i+1) .'_Sertifikat_'. $renameTenant .'.'. end($upload_image1);
				$sertifikat .= $upload_image.",";
				if(move_uploaded_file($tmp, $pathSertifikat.$upload_image))
				{
					$file = $pathSertifikat.$upload_image;
				}

			}
		}else{
			$sertifikat = 'Tidak ada';
		}

		if ($this->input->post('asetRadio') == 'Ada') {
			$aset1 = count($_FILES['image4']['name']);
			$aset2 = $_FILES['image4']['name'];
			$aset = '';
			$pathAset = './assets/image/foto_aset/';

			for ($i=0; $i < $aset1; $i++) {
				$tmp = $_FILES['image4']['tmp_name'][$i];
				$upload_image1 = explode(".",$aset2[$i]);
				$upload_image = round(microtime(true)) . ($i+1) .'_Aset_'. $renameTenant .'.'. end($upload_image1);
				$aset .= $upload_image.",";
				if(move_uploaded_file($tmp, $pathAset.$upload_image))
				{
					$file = $pathAset.$upload_image;
				}

			}
		}else{
			$aset = 'Tidak ada';
		}

		$nama_image = count($_FILES['image1']['name']);
		$nama_image2 = $_FILES['image1']['name'];
		$nama_image_semua= '';

		$path = './assets/image/foto_produk/';


		for ($i=0; $i < $nama_image; $i++) {
			$tmp = $_FILES['image1']['tmp_name'][$i];
			$upload_image1 = explode(".",$nama_image2[$i]);
			$upload_image = round(microtime(true)) . ($i+1) .'_Foto-Produk_'. $renameTenant .'.'. end($upload_image1);
			$nama_image_semua .= $upload_image.",";
			if(move_uploaded_file($tmp, $path.$upload_image))
			{
				$file = $path.$upload_image;
			}
		}

		$proposal = explode('.',$_FILES['file1']['name']);
		$tmpProposal = $_FILES['file1']['tmp_name'];
		$pathProposal = './assets/dokumen/proposal/';
		$upload_proposal = round(microtime(true)) . '_Proposal_'. $renameTenant .'.'. end($proposal);
		if(move_uploaded_file($tmpProposal, $pathProposal.$upload_proposal)){
			$file = $pathProposal.$upload_proposal;
		}


		$dataUsaha = [
			'id_tenant' => $data['tenant']['id_tenant'],
			'alamat' => $this->input->post('alamatUsaha'),
			'perjanjian_usaha' => $perjanjian,
			'sertifikat_produk' => $sertifikat,
			'mulai_usaha' => $this->input->post('mulaiUsaha'),
			'modal_awal' => $this->input->post('modalAwal'),
			'sumber_usaha' => $temp3,
			'produk_dihasilkan' => $this->input->post('produk'),
			'aset' => $aset,
			'kapasitas_produksi' => $this->input->post('produksi'),
			'omset' => $this->input->post('omset'),
			'jangkauan_pasar' => $this->input->post('jangkauan'),
			'tenaga_kerja_laki' => $this->input->post('tenagaLaki'),
			'tenaga_kerja_wanita' => $this->input->post('tenagaPerempuan'),
			'permasalahan' => $this->input->post('permasalahan'),
			'rencana_pengembangan' => $this->input->post('rencana'),
			'foto_produk' => $nama_image_semua,
			'proposal' => $upload_proposal
		];

		$this->db->insert('data_usaha',$dataUsaha);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Data tenant telah berhasil diinputkan!</div>');
		redirect('user');
	}

	public function uploadTahap2($id){
		$tenant = $this->db->get_where('tenant', ['id_tenant' => $id])->row_array();
		$data['countTenant'] = $this->db->get_where('data_usaha2',['id_tenant'=>$id])->row_array();
		if ($data['countTenant'] != NULL) {
			$this->session->set_userdata('modalMessage', 'penilaian');
			redirect('user');
		}

		$this->form_validation->set_rules('link', 'Link', 'required|trim',[
			'required' => 'Tolong masukan link youtube!']
		);

		if ($this->form_validation->run()==false) {
			$this->load->view('templates/header');
			$this->load->view('user/upload-tahap-2');
			$this->load->view('templates/footer');
		}else{
			$renameTenant = str_replace(" ", "_", $tenant['nama_tenant']);
			$upload_file1 = explode(".",$_FILES['ppt']['name']);
			$upload_file2 = explode(".",$_FILES['profile']['name']);
			$presentasi = round(microtime(true)) .'_Presentasi_'. $renameTenant .'.'. end($upload_file1);
			$profile = round(microtime(true)) .'_Profile_'. $renameTenant .'.'. end($upload_file2);
			$link = $this->input->post('link');

			$linkExplode1 = explode('https://youtu.be/',$link);
			$linkExplode2 = explode('https://www.youtube.com/watch?v=',$link);

			if(count($linkExplode1) > 1){
				$link = $linkExplode1[1];
			}elseif(count($linkExplode2) > 1){
				$link = $linkExplode2[1];
			}else{
				$link = '';
			}

			$pathPpt = './assets/dokumen/ppt/';
			$pathProfile = './assets/dokumen/profile/';
			$tmpPpt = $_FILES['ppt']['tmp_name'];
			$tmpProfile = $_FILES['profile']['tmp_name'];

			if(move_uploaded_file($tmpPpt, $pathPpt.$presentasi)){
				$file = $pathPpt.$presentasi;
			}

			if(move_uploaded_file($tmpProfile, $pathProfile.$profile)){
				$file = $pathProfile.$profile;
			}

			$data=[
				'id_tenant' => $id,
				'presentasi' => $presentasi,
				'link' => $link,
				'profile' => $profile
			];

			$this->db->insert('data_usaha2', $data);
			$this->Sit_model->sendNotification('pendaftaran-tenant2', $tenant['nama_tenant'], $this->session->userdata('nama'),'a');
			redirect('user');
		}
	}

	public function uploadKontrakTenant($id){
		$data['tenant'] = $this->db->get_where('tenant', ['id_tenant'=>$id])->row_array();
		if ($data['tenant']['kontrak']=="") {
			if ($this->input->post('submit')==NULL) {
				$this->load->view('templates/header');
				$this->load->view('user/upload-kontrak-tenant',$data);
				$this->load->view('templates/footer');
			}else{
				$renameTenant = str_replace(" ", "_", $data['tenant']['nama_tenant']);
				$upload_file1 = explode(".",$_FILES['kontrak']['name']);
				$kontrak = round(microtime(true)) .'_Kontrak-Tenant_'. $renameTenant .'.'. end($upload_file1);
				$path = './assets/dokumen/kontrak/';
				$tmp = $_FILES['kontrak']['tmp_name'];
				if(move_uploaded_file($tmp, $path.$kontrak)){
					$file = $path.$kontrak;
				}

				$this->db->where('id_tenant', $id);
				$this->db->set('kontrak', $kontrak);
				$this->db->update('tenant');

				$this->Sit_model->sendNotification('kontrak-tenant', $tenant['nama_tenant'], $this->session->userdata('nama'),'a');
				redirect('user');
			}
		}else{
			$this->load->view('templates/header');
			$this->load->view('user/upload-kontrak-tenant', $data);
			$this->load->view('templates/footer');
		}
	}

	public function notifikasi(){
		$data['user'] = $this->db->get_where('user',['id_user' => $this->session->userdata('id_user')])->row_array();
		$this->db->order_by('id_notifikasi', 'DESC');
		$data['notif'] = $this->db->get_where('notifikasi',['id_user' => $this->session->userdata('id_user')])->result_array();

		$this->pagination->initialize($this->Sit_model->pagination(count($data['notif']),'user/notifikasi',10));

		$data['start']=$this->uri->segment(3);
		$this->db->order_by('id_notifikasi', 'DESC');
		$data['notif']=$this->db->get_where('notifikasi',['id_user' => $this->session->userdata('id_user')],10,$data['start'])->result_array();
		
		$i=0;
		foreach ($data['notif'] as $nt) {
			if ($nt['status'] == 0) {
				$i++;
			}
		}
		$data['countNotif'] = $i;

		$this->load->view('templates/header');
		$this->load->view('user/notifikasi', $data);
		$this->load->view('templates/footer');
	}

	public function kontakAdmin(){
		$pesan = $this->input->post('pesan');
		$this->Sit_model->sendNotification('kontak-admin', '', $this->session->userdata('id_user'), $pesan);
		$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Pesan anda telah terkirim.</div>');
		redirect('user/notifikasi');
	}

	public function readAll($id_user){
		$this->db->set('status', 1);
		$this->db->where('id_user', $id_user);
		$this->db->update('notifikasi');
	}

	public function praInkubasi(){
		$this->Sit_model->modalMessage('pra-inkubasi');
		$id_user = $this->session->userdata('id_user');
		$query = "SELECT * FROM `tenant` WHERE id_user = $id_user AND status = 4 OR id_user = $id_user AND status = 5";
		$data['tenant'] = $this->db->query($query)->result_array();
		$i=0;
		
		foreach ($data['tenant'] as $dt) {
			$kelas = $this->db->get_where('enroll_kelas_training',['id_tenant'=>$dt['id_tenant']])->row_array();

			if ($kelas != NULL) {
				$data['kelas'][$i] = $kelas;
				$data['kelas'][$i]['nama_tenant'] = $dt['nama_tenant'];
				unset($data['tenant'][$i]);
				$i++;
			}
		}

		$this->load->view('templates/header');
		$this->load->view('user/prainkubasi/index',$data);
		$this->load->view('templates/footer');
	}

	public function enrollPraInkubasi(){
		$enroll = $this->input->post('enroll');
		$id_tenant = $this->input->post('tenant');
		$data['kelas'] = $this->db->get_where('kelas_training',['enroll_key'=>$enroll])->row_array();
		$data['pertemuan'] = $this->db->get_where('pertemuan_kelas',['id_kelas'=>$data['kelas']['id_kelas_training'], 'jenis' => 'training'])->result_array();
		$data['detail'] = $this->db->get_where('detail_kelas',['id_kelas'=>$data['kelas']['id_kelas_training']])->result_array();

		if ($data['kelas']==NULL) {
			$this->session->set_userdata('system', 'tidak ada');
			redirect('user/praInkubasi');
		}else{
			$data1 = [
				'id_kelas' => $data['kelas']['id_kelas_training'],
				'id_tenant' => $id_tenant,
				'progress' => 0
			];

			foreach ($data['detail'] as $detail) {
				$data2 = [
					'status' => 0,
					'id_detail_kelas' => $detail['id_detail_kelas'],
					'id_tenant' => $id_tenant
				];
				$this->db->insert('progress_kelas', $data2);
			}
			$this->db->insert('enroll_kelas_training', $data1);
			$this->Sit_model->sendNotification('enroll-in', $id_tenant, $this->session->userdata('nama'),'training;'.$data['kelas']['id_kelas_training']);
			redirect('user/praInkubasi');
		}
	}

	public function load_praInkubasi($id){
		$data['tenant'] = $this->db->get_where('tenant',['id_tenant'=>$id])->row_array();
		$data['dataKelas'] = $this->Sit_model->dataKelasTraining($id);

		$data['progress'] = $this->Sit_model->persenProgressPraInkubasi($id);

		$countProgress = count($data['progress']);

		if ($data['progress'][$countProgress - 1] == '100') {
			$this->db->set('status', 5);
			$this->db->where('id_tenant', $id);
			$this->db->update('tenant');
			$this->db->set('progress', $data['progress'][$countProgress - 1]);
			$this->db->where('id_tenant', $id);
			$this->db->update('enroll_kelas_training');
		}else{
			if ($data['tenant']['status'] == 5) {
				$this->db->set('status', 4);
				$this->db->where('id_tenant', $id);
				$this->db->update('tenant');
			}
			$this->db->set('progress', $data['progress'][$countProgress - 1]);
			$this->db->where('id_tenant', $id);
			$this->db->update('enroll_kelas_training');
		}

		$i=0;

		$data['satu'] = '';
		foreach ($data['dataKelas']['pertemuan'] as $dp) {
			$data['satu'] .= '<div class="boxPraInkubasi mb-3" style="border: solid 1px #D8D8D8;">';
			$data['satu'] .= '<label style="color: #5A47AB;font-size: 20px; font-weight: 600; border-bottom: solid 1px #D8D8D8; padding: 1%; background-color: #d8d8d8; margin-bottom: 0; margin-top:0;" class="col-12">'.$dp['nama'].'<span class="text-success" style="float: right; font-size:12px;">Progress : '.$data['progress'][$i].' %</span></label>';
			if(strpos($dp['deskripsi'], "\n") !== FALSE) {
				$explode = explode("\n",$dp['deskripsi']);
				$dp['deskripsi'] = '';
				foreach ($explode as $ex) {
					$dp['deskripsi'] .= $ex."<br>";
				}
			}

			$data['satu'] .= '<div class="boxDalamPraInkubasi" style="padding: 1.5%; padding-bottom: 0; padding-right: 0; background-color: white; font-size: 14px; min-height: 200px; "><p style="color: black;">'.$dp['deskripsi'].'</p>';

			foreach ($data['dataKelas']['detail'] as $dd) {
				$progressKelas = $this->db->get_where('progress_kelas',['id_detail_kelas'=> $dd['id_detail_kelas'], 'id_tenant' => $id])->row_array();

				if ($dd['id_pertemuan_kelas'] == $dp['id_pertemuan_kelas'] && $dd['jenis'] == 'dokumen') {
					$data['satu'] .= '<p><a href="'.base_url('assets/dokumen/kelas/dokumen/').$dd['file'].'" style="color: black;" download><i class="fas fa-fw fa-file-pdf mr-2"></i>'.$dd['deskripsi'].'</a> <span class="text-muted ml-1">22kb</span> <span style="float:right;"><input class="checkSelesai form-check-input" type="checkbox" value="'.$progressKelas['status'].'" data-id="'.$dd['id_detail_kelas'].'" data-value="'.$progressKelas['status'].'" data-tenant="'.$id.'" onclick="checkSudah(this)"></span></p>';
				} else if ($dd['id_pertemuan_kelas'] == $dp['id_pertemuan_kelas'] && $dd['jenis'] == 'assignment'){
					$deskripsi = $dd['deskripsi'];
					$judul = explode('(assignmentDelimiter)', $deskripsi);
					$data['satu'] .= '<p><a href="'.base_url('user/tugasPraInkubasi/').$dd['id_detail_kelas'].'/'.$id.'" class="text-decoration-none" style="color: black;"><i class="fas fa-fw fa-clipboard-list mr-2"></i></i>'. $judul[0] .'</a> <span style="float:right;"><input class="checkSelesai form-check-input" type="checkbox" value="'.$progressKelas['status'].'" data-value="'.$progressKelas['status'].'" disabled></span> </p>';
				} else if ($dd['id_pertemuan_kelas'] == $dp['id_pertemuan_kelas'] && $dd['jenis'] == 'link') {
					$judulLink = explode("(linkDelimiter)",$dd['deskripsi']);
					$data['satu'] .= '<p style="color: black;"><a href="'.base_url('user/videoPraInkubasi/').$dd['id_detail_kelas'].'" class="text-decoration-none" style="color: black;"><i class="fas fa-fw fa-link mr-2"></i></i>'.$judulLink[0].'</a> <span style="float:right;"><input class="checkSelesai form-check-input" type="checkbox" value="'.$progressKelas['status'].'" data-value="'.$progressKelas['status'].'" data-id="'.$dd['id_detail_kelas'].'" data-tenant="'.$id.'" onclick="checkSudah(this)"></span> </p>';
				}else if ($dd['id_pertemuan_kelas'] == $dp['id_pertemuan_kelas'] && $dd['jenis'] == 'forum'){
					$data['satu'] .= '<p style="color: black;"><i class="fas fa-fw fa-comments mr-2"></i></i>Forum '.$dp['nama'].'</p>';
				}else if ($dd['id_pertemuan_kelas'] == $dp['id_pertemuan_kelas'] && $dd['jenis'] == 'feedback'){
					$data['satu'] .= '<p><a class="text-decoration-none" style="color: black; cursor: pointer;" id="feedback" onclick="feedback(this)" data-judul="Feedback '.$dp['nama'].'" data-deskripsi="'.$dd['deskripsi'].'"><i class="fas fa-fw fa-bullhorn mr-2"></i>Feedback '.$dp['nama'].'</a> <span style="float:right;"><input class="checkSelesai form-check-input" type="checkbox" value="'.$progressKelas['status'].'" data-value="'.$progressKelas['status'].'" data-id="'.$dd['id_detail_kelas'].'" data-tenant="'.$id.'" onclick="checkSudah(this)"></span> </p>';
				}
			}
			$data['satu'] .='</div></div>';
			$i++;
		}
		$data['satu'] .= '</div>';
		$data['dua'] = 'Pra Inkubasi - '.$data['tenant']['nama_tenant'].'<span class="text-success" style="float: right; font-size: 15px;">Progress : '.$data['progress'][$i].' %</span>';

		echo json_encode($data);
	}

	public function check_selesai(){
		$id = $this->input->post('id');
		$value = $this->input->post('value');
		$tenant = $this->input->post('tenant');

		if ($value == 0) {
			$value = 1;
		}else{
			$value = 0;
		}

		$data=[
			'id_detail_kelas' => $id,
			'id_tenant' => $tenant
		];

		$this->db->set('status',$value);
		$this->db->where($data);
		$this->db->update('progress_kelas');
		$value = '';
	}

	public function videoPraInkubasi($id){
		$data['detailKelas'] = $this->db->get_where('detail_kelas',['id_detail_kelas' => $id])->row_array();
		$linkExplode = explode('(linkDelimiter)',$data['detailKelas']['deskripsi']);
		$data['detailKelas']['deskripsi'] = $linkExplode[1];

		$this->load->view('templates/header');
		$this->load->view('user/prainkubasi/video',$data);
		$this->load->view('templates/footer');
	}

	public function tugasPraInkubasi($id,$id_tenant){
		$data['detailKelas'] = $this->db->get_where('detail_kelas',['id_detail_kelas' => $id])->row_array();
		$data['kontenKelas'] = explode("(assignmentDelimiter)", $data['detailKelas']['deskripsi']);
		$data['progress'] = $this->db->get_where('progress_kelas',['id_detail_kelas' => $id, 'id_tenant' => $id_tenant])->row_array();
		$data['jawaban'] = $this->db->get_where('jawaban',['id_progress_kelas'=>$data['progress']['id_progress_kelas']])->row_array();

		if ($data['jawaban'] !=NULL) {
			$data['countJawaban'] = count($data['jawaban']);
		}else{
			$data['countJawaban'] = 0;
		}
		
		$this->load->view('templates/header');
		$this->load->view('user/prainkubasi/tugas',$data);
		$this->load->view('templates/footer');
	}

	public function pagePraInkubasi($id){
		$data['detailKelas'] = $this->db->get_where('detail_kelas',['id_detail_kelas' => $id])->row_array();
		$data['kontenKelas'] = explode("(pageDelimiter)", $data['detailKelas']['deskripsi']);

		$this->load->view('templates/header');
		$this->load->view('user/prainkubasi/page',$data);
		$this->load->view('templates/footer');
	}

	public function uploadAssignmentPraInkubasi($id,$id_tenant){
		$jawaban = $this->input->post('jawaban');
		$file = $_FILES['file']['name'];

		if ($jawaban == "" && $file == "") {
			$this->session->set_userdata('system', 'tidak ada');
			redirect('user/tugasPraInkubasi/'.$id.'/'.$id_tenant);
		}else{
			$progressKelas = $this->db->get_where('progress_kelas',['id_detail_kelas' => $id, 'id_tenant' => $id_tenant])->row_array();
			
			if ($file != "") {
				$dokumen = explode(".",$file);
				$newfilename = round(microtime(true)) . '.' . end($dokumen);
				$path = './assets/dokumen/kelas/dokumen/';
				$tmp = $_FILES['file']['tmp_name'];

				if(move_uploaded_file($tmp, $path.$newfilename)){
					$file = $path.$newfilename;
				}
			}else{
				$newfilename = '';
			}
			$data = [
				'id_progress_kelas' => $progressKelas['id_progress_kelas'],
				'jenis' => 'assignment',
				'deskripsi' => $jawaban,
				'dokumen' => $newfilename
			];
			$this->db->insert('jawaban', $data);
			$this->Sit_model->sendNotification('submit-assignment', $id_tenant, 'System', 'training;submit-tugas');
			redirect('user/tugasPraInkubasi/'.$id.'/'.$id_tenant);
		}

	}

	public function mentoring(){
		$this->Sit_model->modalMessage('mentoring');

		$this->load->view('templates/header');
		$this->load->view('user/mentoring/index');
		$this->load->view('templates/footer');
	}
	public function kelasMentoring(){
		$this->load->view('templates/header');
		$this->load->view('user/mentoring/kelas');
		$this->load->view('templates/footer');
	}
	public function feedbackMentoring(){
		$this->load->view('templates/header');
		$this->load->view('user/mentoring/feedback');
		$this->load->view('templates/footer');
	}

	public function inkubasi(){
		$this->Sit_model->modalMessage('inkubasi');

		$id_user = $this->session->userdata('id_user');
		$query = "SELECT * FROM `tenant` WHERE id_user = $id_user AND status = 5";
		$data['tenant'] = $this->db->query($query)->result_array();
		$i=0;
		
		foreach ($data['tenant'] as $dt) {
			$kelas = $this->db->get_where('enroll_kelas_coaching',['id_tenant'=>$dt['id_tenant']])->row_array();
			if ($kelas != NULL) {
				$data['kelas'][$i] = $kelas;
				$data['kelas'][$i]['nama_tenant'] = $dt['nama_tenant'];
				$i++;
			}
		}

		$this->load->view('templates/header');
		$this->load->view('user/inkubasi/index', $data);
		$this->load->view('templates/footer');
	}

	public function enrollInkubasi(){
		$this->Sit_model->modalMessage('inkubasi');

		$enroll = $this->input->post('enroll');
		$id_tenant = $this->input->post('tenant');
		$data['kelas'] = $this->db->get_where('kelas_coaching',['enroll_key'=>$enroll])->row_array();
		$data['pertemuan'] = $this->db->get_where('pertemuan_kelas',['id_kelas'=>$data['kelas']['id_kelas_coaching'], 'jenis' => 'coaching'])->result_array();
		$data['detail'] = $this->db->get_where('detail_kelas',['id_kelas'=>$data['kelas']['id_kelas_coaching']])->result_array();

		if ($data['kelas']==NULL) {
			$this->session->set_userdata('system', 'tidak ada');
			redirect('user/inkubasi');
		}else{
			$data1 = [
				'id_kelas' => $data['kelas']['id_kelas_coaching'],
				'id_tenant' => $id_tenant,
				'progress' => 0
			];

			foreach ($data['detail'] as $detail) {
				$data2 = [
					'status' => 0,
					'id_detail_kelas' => $detail['id_detail_kelas'],
					'id_tenant' => $id_tenant
				];
				$this->db->insert('progress_kelas', $data2);
			}
			$this->db->insert('enroll_kelas_coaching', $data1);
			$this->Sit_model->sendNotification('enroll-in', $id_tenant, $this->session->userdata('nama'),'coaching;'.$data['kelas']['id_kelas_coaching']);
			redirect('user/inkubasi');
		}
	}

	public function load_inkubasi($id){
		$data['enroll'] = $this->db->get_where('enroll_kelas_coaching',['id_tenant'=>$id])->result_array();
		$i=0;

		foreach ($data['enroll'] as $er) {
			$kelas = $this->db->get_where('kelas_coaching',['id_kelas_coaching' => $er['id_kelas']])->row_array();
			$data['kelas'][$i] = $kelas;
			$i++;
		}

		echo json_encode($data);
	}

	public function load_persenInkubasi($id,$id_tenant){
		$data['progress'] = $this->Sit_model->persenProgressInkubasi($id,$id_tenant);

		$countProgress = count($data['progress']);

		$temp = ['id_kelas' => $id, 'id_tenant' => $id_tenant];

		$this->db->set('progress', $data['progress'][$countProgress - 1]);
		$this->db->where($temp);
		$this->db->update('enroll_kelas_coaching');

		echo json_encode($data);
	}

	public function detailInkubasi($id,$id_tenant){
		$this->Sit_model->modalMessage('inkubasi');

		$data['dataKelas'] = $this->Sit_model->dataKelasCoaching($id,$id_tenant);
		$data['progress'] = $this->Sit_model->persenProgressInkubasi($id,$id_tenant);

		if ($data['dataKelas']['kelas']!=NULL) {
			$i=0;
			$j=0;
			$data['detailKelas'] = [];

			foreach ($data['dataKelas']['pertemuan'] as $pt) {
				$dataDetail = $this->db->get_where('detail_kelas',['id_kelas' => $id, 'id_pertemuan_kelas' => $pt['id_pertemuan_kelas']])->result_array();

				if(strpos($pt['deskripsi'], "\n") !== FALSE) {
					$explode = explode("\n",$pt['deskripsi']);
					$data['dataKelas']['pertemuan'][$j]['deskripsi'] = '';
					foreach ($explode as $ex) {
						$data['dataKelas']['pertemuan'][$j]['deskripsi'] .= $ex."<br>";
					}
				}
				$j++;

				foreach ($dataDetail as $dt) {
					$dataProgress = $this->db->get_where('progress_kelas',['id_detail_kelas' => $dt['id_detail_kelas'], 'id_tenant' => $id_tenant])->row_array();
					$data['detailKelas'][$i] = $dt;
					$data['detailKelas'][$i]['status'] = $dataProgress['status'];
					$i++;
				}
			}
		}

		$this->load->view('templates/header');
		$this->load->view('user/inkubasi/detail', $data);
		$this->load->view('templates/footer');
	}

	public function check_selesaiInkubasi(){
		$id = $this->input->post('id');
		$id_tenant = $this->input->post('id_tenant');
		$temp = $this->db->get_where('progress_kelas',['id_detail_kelas'=>$id, 'id_tenant' => $id_tenant])->row_array();
		$value = $temp['status'];

		if ($value == 0) {
			$value = 1;
		}else{
			$value = 0;
		}
		$data['valueSent'] = $value;
		$temp2 = ['id_detail_kelas'=>$id, 'id_tenant' => $id_tenant];

		$this->db->set('status',$value);
		$this->db->where($temp2);
		$this->db->update('progress_kelas');
		$value = '';
		echo json_encode($data);
	}

	public function tugasInkubasi($id, $id_tenant){
		$this->Sit_model->modalMessage('inkubasi');
		
		$data['detailKelas'] = $this->db->get_where('detail_kelas',['id_detail_kelas' => $id])->row_array();
		$data['kontenKelas'] = explode("(assignmentDelimiter)", $data['detailKelas']['deskripsi']);
		$data['progress'] = $this->db->get_where('progress_kelas',['id_detail_kelas' => $id, 'id_tenant' => $id_tenant])->row_array();
		$data['jawaban'] = $this->db->get_where('jawaban',['id_progress_kelas'=>$data['progress']['id_progress_kelas']])->row_array();
		if ($data['jawaban'] !=NULL) {
			$data['countJawaban'] = count($data['jawaban']);
		}else{
			$data['countJawaban'] = 0;
		}

		$this->load->view('templates/header');
		$this->load->view('user/inkubasi/tugas',$data);
		$this->load->view('templates/footer');
	}

	public function uploadAssignmentInkubasi($id,$id_tenant){
		$jawaban = $this->input->post('jawaban');
		$file = $_FILES['file']['name'];

		if ($jawaban == "" && $file == "") {
			$this->session->set_userdata('system', 'tidak ada');
			redirect('user/tugasInkubasi/'.$id.'/'.$id_tenant);
		}else{
			$progressKelas = $this->db->get_where('progress_kelas',['id_detail_kelas' => $id, 'id_tenant' => $id_tenant])->row_array();
			
			if ($file != "") {
				$dokumen = explode(".",$file);
				$newfilename = round(microtime(true)) . '.' . end($dokumen);
				$path = './assets/dokumen/kelas/dokumen/';
				$tmp = $_FILES['file']['tmp_name'];

				if(move_uploaded_file($tmp, $path.$newfilename)){
					$file = $path.$newfilename;
				}
			}else{
				$newfilename = '';
			}
			$data = [
				'id_progress_kelas' => $progressKelas['id_progress_kelas'],
				'jenis' => 'assignment',
				'deskripsi' => $jawaban,
				'dokumen' => $newfilename
			];
			$this->db->insert('jawaban', $data);
			redirect('user/tugasInkubasi/'.$id.'/'.$id_tenant);
		}
	}

	public function videoInkubasi($id){
		$this->Sit_model->modalMessage('inkubasi');
		
		$data['detailKelas'] = $this->db->get_where('detail_kelas',['id_detail_kelas' => $id])->row_array();
		$linkExplode = explode('(linkDelimiter)',$data['detailKelas']['deskripsi']);
		$data['detailKelas']['deskripsi'] = $linkExplode[1];

		$this->load->view('templates/header');
		$this->load->view('user/inkubasi/video',$data);
		$this->load->view('templates/footer');
	}

	public function pageInkubasi($id){
		$this->Sit_model->modalMessage('inkubasi');
		
		$data['detailKelas'] = $this->db->get_where('detail_kelas',['id_detail_kelas' => $id])->row_array();
		$data['kontenKelas'] = explode("(pageDelimiter)", $data['detailKelas']['deskripsi']);

		$this->load->view('templates/header');
		$this->load->view('user/inkubasi/page',$data);
		$this->load->view('templates/footer');
	}

	public function coachingLog(){
		$this->Sit_model->modalMessage('inkubasi');
		
		$this->db->order_by('id_coaching_log', 'DESC');
		$data['coachingLog'] = $this->db->get_where('coaching_log',['id_user' => $this->session->userdata('id_user')])->result_array();

		$this->pagination->initialize($this->Sit_model->pagination(count($data['coachingLog']),'user/coachingLog',5));

		$data['start']=$this->uri->segment(3);
		$this->db->order_by('id_coaching_log', 'DESC');
		$data['coachingLog']=$this->db->get_where('coaching_log',['id_user' => $this->session->userdata('id_user')],5,$data['start'])->result_array();

		$i = 0;
		foreach ($data['coachingLog'] as $cl) {
			$tenant = $this->db->get_where('tenant',['id_tenant' => $cl['id_tenant']])->row_array();
			$data['coachingLog'][$i]['nama_tenant'] = $tenant['nama_tenant'];
			$data['coachingLog'][$i]['nomor'] = $i + 1 + $data['start'];
			$i++;	
		}

		for ($i=0; $i < count($data['coachingLog']); $i++) { 
			$data['coachingLog'][$i]['hasil_sebelumnya'] = $this->Sit_model->strlenCL($data['coachingLog'][$i]['hasil_sebelumnya']);
			$data['coachingLog'][$i]['tujuan_ini'] = $this->Sit_model->strlenCL($data['coachingLog'][$i]['tujuan_ini']);
			$data['coachingLog'][$i]['hasil_ingin'] = $this->Sit_model->strlenCL($data['coachingLog'][$i]['hasil_ingin']);
			$data['coachingLog'][$i]['hasil_dicapai'] = $this->Sit_model->strlenCL($data['coachingLog'][$i]['hasil_dicapai']);
			$data['coachingLog'][$i]['tujuan_selanjutnya'] = $this->Sit_model->strlenCL($data['coachingLog'][$i]['tujuan_selanjutnya']);
		}

		$this->load->view('templates/header');
		$this->load->view('user/inkubasi/log',$data);
		$this->load->view('templates/footer');
	}

	public function getFeedbackCL($id){
		$data = $this->db->get_where('coaching_log',['id_coaching_log'=>$id])->row_array();

		echo json_encode($data['feedback']);
	}

	public function detailCoachingLog($id){
		$data['coachingLog'] = $this->db->get_where('coaching_log',['id_coaching_log' => $id])->row_array();
		$data['tenant'] = $this->db->get_where('tenant',['id_tenant' => $data['coachingLog']['id_tenant']])->row_array();

		$this->load->view('templates/header');
		$this->load->view('user/inkubasi/detail-log',$data);
		$this->load->view('templates/footer');
	}

	public function hapusCoachingLog($id){
		$cl = $this->db->get_where('coaching_log',['id_coaching_log' => $id])->row_array();
		if ($cl['dokumen'] != '') {
			$path = './assets/dokumen/coaching_log/';
			unlink($path.$cl['dokumen']);
		}
		$this->db->where('id_coaching_log', $id);
		$this->db->delete('coaching_log');
		redirect('user/coachingLog');
	}

	public function tambahCoachingLog(){
		$this->Sit_model->modalMessage('inkubasi');
		
		$data['tenant'] = $this->db->get_where('tenant',['id_user' => $this->session->userdata('id_user'), 'status'=>5])->result_array();

		$this->form_validation->set_rules('namaTenant', 'Nama Tenant', 'required|trim',[
			'required' => 'Tolong masukan nama tenant!']
		);

		$this->form_validation->set_rules('hasilSebelumnya', 'hasil sebelumnya', 'required|trim',[
			'required' => 'Tolong masukan hasil sebelumnya!']
		);

		$this->form_validation->set_rules('tujuanIni', 'tujuan tahap ini', 'required|trim',[
			'required' => 'Tolong masukan tujuan tahap ini!']
		);

		$this->form_validation->set_rules('hasilInginDicapai', 'hasil yang ingin dicapai', 'required|trim',[
			'required' => 'Tolong masukan hasil yang ingin dicapai!']
		);

		$this->form_validation->set_rules('hasilDicapai', 'hasil yang dicapai', 'required|trim',[
			'required' => 'Tolong masukan hasil yang dicapai!']
		);

		$this->form_validation->set_rules('tujuanSelanjutnya', 'tujuan selanjutnya', 'required|trim',[
			'required' => 'Tolong masukan tujuan selanjutnya!']
		);

		if ($this->form_validation->run()==false) {
			$this->load->view('templates/header');
			$this->load->view('user/inkubasi/tambah-log', $data);
			$this->load->view('templates/footer');
		}else{
			$input1 = $this->input->post('namaTenant');
			$input2 = $this->input->post('hasilSebelumnya');
			$input3 = $this->input->post('tujuanIni');
			$input4 = $this->input->post('hasilInginDicapai');
			$input5 = $this->input->post('hasilDicapai');
			$input6 = $this->input->post('tujuanSelanjutnya');

			$enroll = $this->db->get_where('enroll_kelas_coaching',['id_tenant' => $input1])->result_array();
			$id_kelas = [];
			
			for ($i=0; $i < count($enroll); $i++) { 
				$id_kelas[$i] = $enroll[$i]['id_kelas'];
			}

			$this->db->where_in('id_kelas_coaching', $id_kelas);
			$this->db->select('coach');
			$dataCoach = $this->db->get('kelas_coaching')->result_array();
			$coach = [];

			for ($i=0; $i < count($dataCoach); $i++) { 
				$tempCoach = $this->db->get_where('user',['id_user' => $dataCoach[$i]['coach']])->row_array();
				$coach[$i] = $tempCoach['nama'];
			}

			$coach = array_unique($coach);
			$pushCoach = '';

			for ($j=0; $j < count($coach); $j++) {
				if ($j == count($coach) - 1) {
					$pushCoach .= $coach[$j];
				} else {
					$pushCoach .= $coach[$j] . ', ';
				}
			}

			$data = [
				'id_tenant' => $input1,
				'id_user' => $this->session->userdata('id_user'),
				'hasil_sebelumnya' => $input2,
				'tujuan_ini' => $input3,
				'hasil_ingin' => $input4,
				'hasil_dicapai' => $input5,
				'tujuan_selanjutnya' => $input6,
				'tanggal' => date('Y-m-d'),
				'coach' => $pushCoach
			];

			$this->db->insert('coaching_log',$data);
			redirect('user/coachingLog');
		}
	}

	public function tugasCoachingLog($id_cl, $id_tenant){
		$this->Sit_model->modalMessage('inkubasi');

		$this->form_validation->set_rules('jawaban', 'jawaban', 'required|trim',[
			'required' => 'Tolong masukan jawaban anda!']
		);

		$coachingLog = $this->db->get_where('coaching_log',['id_tenant' => $id_tenant])->result_array();
		$tenant = $this->db->get_where('tenant',['id_tenant' => $id_tenant])->row_array();
		$nama_tenant = str_replace(' ', '_', $tenant['nama_tenant']);

		for ($i=0; $i < count($coachingLog); $i++) { 
			if ($coachingLog[$i]['id_coaching_log'] == $id_cl) {
				$data['cl']['jawaban'] =  $coachingLog[$i]['jawaban'];
				$data['cl']['dokumen'] =  $coachingLog[$i]['dokumen'];
				$data['ke'] = $i + 1;
			}
		}

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header');
			$this->load->view('user/inkubasi/tugas-log',$data);
			$this->load->view('templates/footer');
		} else {
			$jawaban = $this->input->post('jawaban');
			$dokumen = explode('.', $_FILES['file']['name']);
			$newfilename = 'Coaching_Log_'.$data['ke']. '_'.$nama_tenant. '.' . end($dokumen);
			$path = './assets/dokumen/coaching_log/';
			$tmp = $_FILES['file']['tmp_name'];

			if(move_uploaded_file($tmp, $path.$newfilename)){
				$file = $path.$newfilename;
			}

			$dataJ = [
				'jawaban' => $jawaban,
				'dokumen' => $newfilename
			];

			$this->db->set($dataJ);
			$this->db->where('id_coaching_log', $id_cl);
			$this->db->update('coaching_log');
			redirect('user/coachingLog');
		}
	}

	public function monev(){
		$this->Sit_model->modalMessage('monev');
		$data['uploadMonev'] = $this->Sit_model->checkUploadMonev($this->session->userdata('id_user'));

		$this->db->order_by('id_tenant','DESC');
		$data['tenant'] = $this->Sit_model->getTenantCoaching($this->session->userdata('id_user'));
		$data['tenantGrafik'] = $this->db->get_where('tenant',['id_user' => $this->session->userdata('id_user'), 'status' => 5])->result_array();
		$id_tenant =[];

		for ($i=0; $i < count($data['tenant']); $i++) { 
			$id_tenant[$i] = $data['tenant'][$i]['id_tenant'];
		}

		$this->db->where_in('id_tenant',$id_tenant);
		$data['monev'] = $this->db->get('monev')->result_array();

		$this->pagination->initialize($this->Sit_model->pagination(count($data['monev']),'user/monev',5));

		$data['start']=$this->uri->segment(3);
		$this->db->where_in('id_tenant',$id_tenant);
		$this->db->order_by('id_monev', 'DESC');
		$data['monev']=$this->db->get('monev',5,$data['start'])->result_array();

		$i = 0;
		foreach ($data['monev'] as $monev) {
			foreach ($data['tenant'] as $tenant) {
				if ($tenant['id_tenant'] == $monev['id_tenant']) {
					$data['monev'][$i]['id_tenant'] = $tenant['nama_tenant'];
				}
			}

			$data['monev'][$i]['nomor'] = $i + 1 + $data['start'];
			if ($monev['nilai_coach'] == "") {
				$data['monev'][$i]['nilai_coach'] = "Belum Ada";
			}

			if ($monev['nilai_inkubator'] == "") {
				$data['monev'][$i]['nilai_inkubator'] = "Belum Ada";
			}
			$i++;
		}

		$this->load->view('templates/header');
		$this->load->view('user/monev/index', $data);
		$this->load->view('templates/footer');
	}

	public function detailMonev($id){
		$data['monev'] = $this->db->get_where('monev',['id_monev' => $id])->row_array();
		$data['tenant'] = $this->db->get_where('tenant',['id_tenant' => $data['monev']['id_tenant']])->row_array();
		$data['penilaian_monev'] = $this->db->get_where('penilaian_monev',['id_monev' => $id])->row_array();
		$enroll = $this->db->get_where('enroll_kelas_coaching',['id_tenant' => $data['monev']['id_tenant']])->result_array();
		$data['penilaian_inkubator'] = [];
		$data['penilaian_coach'] = [];

		$pc = explode('(delimiter)',$data['penilaian_monev']['penilaian_coach']);
		$pi = explode('(delimiter)',$data['penilaian_monev']['penilaian_inkubator']);

		if ($pi != '') {
			for ($j=0; $j < count($pi)-1; $j++) {
				$tempPI = explode(';',$pi[$j]);
				$data['penilaian_inkubator'][$j]['nama_penilaian'] = $tempPI[0];
				$data['penilaian_inkubator'][$j]['nilai'] = $tempPI[1];
				$data['penilaian_inkubator'][$j]['keterangan'] = $tempPI[2];
			}
		}else{
			$data['penilaian_inkubator'] = '';
		}

		if ($pc != '') {
			for ($i=0; $i < count($pc)-1; $i++) {
				$tempPC = explode(';',$pc[$i]);
				$data['penilaian_coach'][$i]['nama_penilaian'] = $tempPC[0];
				$data['penilaian_coach'][$i]['nilai'] = $tempPC[1];
				$data['penilaian_coach'][$i]['keterangan'] = $tempPC[2];
			}
		}else{
			$data['penilaian_coach'] = '';
		}

		$this->load->view('templates/header');
		$this->load->view('user/monev/detail', $data);
		$this->load->view('templates/footer');
	}

	public function hapusMonev($id){
		$this->db->where('id_monev',$id);
		$this->db->delete('monev');
	}

	public function uploadMonev(){
		$id_tenant = $this->input->post('tenant');
		$action_plan = $_FILES['actionPlan']['name'];
		$pembukuan = $_FILES['pembukuan']['name'];

		if ($id_tenant == "" || $action_plan == "" || $pembukuan == "") {
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Tolong isi semua data input bahan monev!</div>');
			redirect('user/monev');
		}else{
			$tenant = $this->db->get_where('tenant',['id_tenant' => $id_tenant])->row_array();
			$nama_tenant = str_replace(" ", "_", $tenant['nama_tenant']);
			
			$temp1 = explode(".",$action_plan);
			$temp2 = explode(".",$pembukuan);

			$newactionplan = round(microtime(true)) . '_Action-Plan_'. $nama_tenant .'.'. end($temp1);
			$newpembukuan = round(microtime(true)) . '_Pembukuan_' . $nama_tenant .'.'.end($temp2);

			$path1 = './assets/dokumen/monev/action-plan/';
			$path2 = './assets/dokumen/monev/pembukuan/';

			$tmp1 = $_FILES['actionPlan']['tmp_name'];
			$tmp2 = $_FILES['pembukuan']['tmp_name'];

			if(move_uploaded_file($tmp1, $path1.$newactionplan)){
				$file1 = $path1.$newactionplan;
			}

			if(move_uploaded_file($tmp2, $path2.$newpembukuan)){
				$file2 = $path2.$newpembukuan;
			}

			$data = [
				'id_tenant' => $id_tenant,
				'tanggal_dikirim' => date('Y-m-d'),
				'action_file' => $newactionplan,
				'pembukuan' => $newpembukuan 
			];

			$this->db->insert('monev', $data);
			redirect('user/monev');
		}
	}
}
