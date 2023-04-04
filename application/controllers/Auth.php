<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct(){
		parent ::__construct();
		$this->load->library('form_validation');
		require APPPATH.'libraries/phpmailer/src/Exception.php';
        require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH.'libraries/phpmailer/src/SMTP.php';
	}

	public function index(){

		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email',[
			'required' => 'Tolong masukkan email!']
		);
		$this->form_validation->set_rules('password', 'Password', 'required|trim',[
			'required' => 'Tolong masukkan password!'
		]);

		if ($this->form_validation->run()==false) {
			$this->load->view('templates/header');
			$this->load->view('auth/index');
			$this->load->view('templates/footer');
		}else{
			$this->login();
		}
	}

	public function login(){
		$id=$this->input->post('email');
		$password=$this->input->post('password');

		$email=$this->db->get_where('user',['email'=>$id])->row_array();
		if($email){
			if ($email['is_active']==1) {
				if(password_verify($password, $email['password'])){
					$data=[
						'id_user' =>$email['id_user'],
						'email'=>$email['email'],
						'nama'=>$email['nama'],
						'role_id'=>$email['role_id']
					];
					if ($data['role_id']==2) {
						$this->session->set_userdata($data);
						redirect('user');
					}elseif ($data['role_id'] == 1) {
						$this->session->set_userdata($data);
						redirect('home');
					}else{
						$this->session->set_userdata($data);
						redirect('dashboard');
					}
				}else{
					$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Password salah!</div>');
					redirect('auth');
				}
			}else{
				$this->session->set_userdata('aktivasi_akun', 'belum');
				redirect('auth');
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
			redirect('auth');
		}
	}

	public function register(){

		$this->form_validation->set_rules('nama', 'Nama', 'required|trim',[
			'required' => 'Tolong masukkan nama!']);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',[
			'is_unique' => 'Email sudah terdaftar!',
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
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]',[
			'required' => 'Tolong masukkan password!',
			'min_length'=>'Password terlalu pendek!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]',[
			'required' => 'Tolong masukkan tulis ulang password!',
			'matches'=>'Password tidak sama!']);

		if ($this->form_validation->run()==false) {
			$this->load->view('templates/header');
			$this->load->view('auth/register');
			$this->load->view('templates/footer');
		}else{
			$data=[
				'email' => htmlspecialchars($this->input->post('email',true)),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'nama' => $this->input->post('nama'),
				'telepon' => $this->input->post('telepon'),
				'tempat_lahir' => $this->input->post('tempatLahir'),
				'tanggal_lahir' => $this->input->post('tanggalLahir'),
				'pendidikan' => $this->input->post('pendidikan'),
				'jenis_kelamin' => $this->input->post('kelamin'),
				'alamat' => $this->input->post('alamat'),
				'role_id' => 2,
				'is_active' => 0
			];

			$token= base64_encode(random_bytes(32));
			$user_token= [
				'email'=>htmlspecialchars($this->input->post('email',true)),
				'token'=>$token,
				'tanggal'=>time()
			];

			$this->db->insert('user', $data);
			$this->db->insert('user_token',$user_token);

			$this->sendEmail($token);

			$this->session->set_userdata('aktivasi_akun', 'belum');
			redirect('auth');
		}
	}

	public function logout(){
		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('role_id');

		redirect('home');
	}

	public function lupaPassword(){
		$this->form_validation->set_rules('email',' Email','required|trim',[
			'required' => 'Tolong masukkan email!'
		]);

		if($this->form_validation->run()==false){
			$this->load->view('templates/header');
			$this->load->view('auth/lupa-password');
			$this->load->view('templates/footer');
		}else {
			$email = $this->input->post('email');

			$user=$this->db->get_where('user',['email'=>$email])->row_array();

			if($user){
				$token= base64_encode(random_bytes(32));
				$user_token= [
					'email'=>$email,
					'token'=>$token,
					'tanggal'=>time()
				];

				$this->db->insert('user_token',$user_token);

				$this->session->set_userdata('lupa_password', 'ya');
				$this->sendEmail($token);

				$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Tolong lihat email untuk mengganti password anda.</div>');
				redirect('auth/lupaPassword');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Email tidak terdaftar!</div>');
				redirect('auth/forgotpassword');
			}
		}
	}

	private function sendEmail($token){

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
		$mail->FromName = "Admin SIT UNILA"; //nama pengirim
		$mail->addAddress($email);
		if ($this->session->userdata('lupa_password')!=NULL) {
			$mail->Subject = 'Lupa Password';
			$mail->isHTML(true);
		    $mailContent = 'Klik link berikut untuk merubah password akun anda : <a href="'.base_url().'auth/verifUbahPassword?email='.$email.'&token='.urlencode($token).'">Ubah Password</a>'; // isi email
		    $mail->Body = $mailContent;
		}else{
			$mail->Subject = 'Verifikasi Akun';
			$mail->isHTML(true);
		    $mailContent = 'Klik link berikut untuk menverifikasi akun anda : <a href="'.base_url().'auth/aktivasiAkun?email='.$email.'&token='.urlencode($token).'">Verifikasi akun</a>'; // isi email
		    $mail->Body = $mailContent;
		}

	    if(!$mail->send()){
           	echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        	die;
        }
	}

	public function aktivasiAkun(){
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user',['email'=>$email])->row_array();

		if($user){
			$user_token=$this->db->get_where('user_token',['token'=>$token])->row_array();
			if($user_token){
				$this->db->set('is_active', 1);
				$this->db->where('email', $email);
				$this->db->update('user');

				$this->db->where('token', $token);
				$this->db->delete('user_token');

				$this->session->set_userdata('aktivasi_akun', 'sudah');
				redirect('auth');
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Aktivasi akun gagal! Token salah.</div>');
				redirect('auth');
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Aktivasi akun gagal! Email salah.</div>');
				redirect('auth');
		}
	}

	public function verifUbahPassword(){
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user',['email'=>$email])->row_array();

		if($user){
			$user_token=$this->db->get_where('user_token',['token'=>$token])->row_array();
			if($user_token){
				$this->session->set_userdata('reset_email', $email);
				$this->resetPassword();
			}else{
				$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Aktivasi akun gagal! Token salah.</div>');
				redirect('auth');
			}
		}else{
			$this->session->set_flashdata('message','<div class="alert alert-danger" role="alert">Aktivasi akun gagal! Email salah.</div>');
				redirect('auth');
		}
	}

	public function resetPassword(){
		if(!$this->session->userdata('reset_email')){
			redirect('auth');
		}

		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]',[
			'required' => 'Tolong masukkan password!',
			'min_length'=>'Password terlalu pendek!'
		]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]',[
			'required' => 'Tolong masukkan tulis ulang password!',
			'matches'=>'Password tidak sama!']);

		if($this->form_validation->run()==false){
			$this->load->view('templates/header');
			$this->load->view('auth/reset-password');
			$this->load->view('templates/footer');
		}else{
			$password=password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
			$email=$this->session->userdata('reset_email');

			$this->db->set('password',$password);
			$this->db->where('email',$email);
			$this->db->update('user');

			$this->db->delete('user_token', ['email'=>$email]);

			$this->session->unset_userdata('reset_email');
			$this->session->set_flashdata('message','<div class="alert alert-success" role="alert">Password berhasil diubah.</div>');
				redirect('auth');
		}
	}
}
