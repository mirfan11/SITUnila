<?php

class Sit_model extends CI_Model{

	public function pagination($count,$page,$per_page){
		$config['base_url']= 'http://localhost:8080/sit/'.$page.'/';
		$config['total_rows']=$count;
		$config['per_page']=$per_page;

		$config['full_tag_open']='<nav aria-label="Page navigation example" style="font-size:14px;"> <ul class="pagination  justify-content-center">';
		$config['full_tag_close']='</ul></nav>';

		$config['first_link']='First';
		$config['first_tag_open']='<li class="page-item">';
		$config['first_tag_close']='</li>';

		$config['last_link']='Last';
		$config['last_tag_open']='<li class="page-item">';
		$config['last_tag_close']='</li>';

		$config['next_link']='&raquo';
		$config['next_tag_open']='<li class="page-item">';
		$config['next_tag_close']='</li>';

		$config['prev_link']='&laquo';
		$config['prev_tag_open']='<li class="page-item">';
		$config['prev_tag_close']='</li>';

		$config['cur_tag_open']='<li class="page-item active"><a class="page-link" href="#" style="background-color:#5A47AB; border:none;">';
		$config['cur_tag_close']='</a></li>';

		$config['num_tag_open']='<li class="page-item">';
		$config['num_tag_close']='</li>';

		$config['attributes']=array('class'=>'page-link text-dark', 'style' => 'border: none;');

		return $config;
	}
	
	public function modalMessage($indikator){
		if ($indikator == 'pra-inkubasi') {
			$user = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
			if ($user) {
				$status = [4,5];
				$this->db->where_in('status', $status);
				$this->db->where('id_user', $user['id_user']);
				$tenantCheck = $this->db->get('tenant')->row_array();
				if ($tenantCheck == NULL) {
					$this->session->set_userdata('errorMessage', 'pra-inkubasi');
					redirect('user');
				}
			}
		} elseif($indikator == 'inkubasi') {
			$user = $this->db->get_where('user',['email' => $this->session->userdata('email')])->row_array();
			if ($user) {
				$tenantCheck = $this->db->get_where('tenant',['id_user' => $user['id_user'], 'status' => 5])->row_array();
				if ($tenantCheck == NULL) {
					$this->session->set_userdata('errorMessage', 'inkubasi');
					redirect('user');
				}
			}
		} elseif($indikator == 'rekrutmen'){
			$rekrutmen = $this->db->get_where('rekrutmen',['status' => 0])->row_array();
			if (count($rekrutmen) < 1) {
				$this->session->set_userdata('errorMessage', 'rekrutmen');
				redirect('user');
			}
		}
	}

	public function getIdInkubator(){
		$this->db->select('id_user');
		$this->db->where('role_id', 1);
		$inkubator = $this->db->get('user')->result_array();

		$data = [];
		for ($i=0; $i < count($inkubator); $i++) { 
			$data[$i] = $inkubator[$i]['id_user'];
		}

		return $data;
	}

	public function getNotification($id_user){

		$notif = count($this->db->get_where('notifikasi',['id_user' => $id_user, 'status' => 0])->result_array());
		$this->session->set_userdata('notif', $notif);
	}

	public function sendNotification($jenis, $tenant, $nama, $message){

		if($jenis == "pendaftaran-tenant"){
			$inkubator = $this->db->get_where('user',['role_id' => 1])->result_array();

			foreach ($inkubator as $in) {
				$notif = [
					'id_user' => $in['id_user'],
					'pengirim' => 'System',
					'jenis' => $jenis,
					'isi' => "User " . $nama . " melakukan pendaftaran atas nama tenant " . $tenant . ". Diharap untuk segera melakukan penilaian tahap ke-1.",
					'waktu' => date('H:i:s d-m-Y'),
					'status' => 0
				];
				$this->db->insert('notifikasi', $notif);
			}
		} elseif ($jenis == "pendaftaran-tenant2") {
			$inkubator = $this->db->get_where('user',['role_id' => 1])->result_array();

			foreach ($inkubator as $in) {
				$notif = [
					'id_user' => $in['id_user'],
					'pengirim' => 'System',
					'jenis' => $jenis,
					'isi' => "User " . $nama . " telah menambahkan berkas tahap ke-2 atas nama tenant " . $tenant . ". Diharap untuk segera melakukan penilaian tahap ke-2.",
					'waktu' => date('H:i:s d-m-Y'),
					'status' => 0
				];
				$this->db->insert('notifikasi', $notif);
			}
		} elseif ($jenis == "penilaian-tenant1") {
			$temp = $this->db->get_where('tenant',['id_tenant' => $tenant])->row_array();

			if ($temp['status'] == 2) {
				$isi = "Penilaian tahap pertama tenant dengan nama tenant " .$temp['nama_tenant']. " sudah dilakukan. Silahkan segera melakukan penginputan data tahap ke-2 pada halaman ini. <a href='".base_url('user/uploadTahap2/').$tenant."'>Klik disini untuk melanjut kehalaman input data...</a>";
			} else {
				$isi = "Penilaian tahap pertama tenant dengan nama tenant " .$temp['nama_tenant']. " sudah dilakukan. Mohon maaf, tenant anda dinyatakan tidak lulus tahap ke-1";
			}

			$notif = [
				'id_user' => $temp['id_user'],
				'pengirim' => 'System',
				'jenis' => $jenis,
				'isi' => $isi,
				'waktu' => date('H:i:s d-m-Y'),
				'status' => 0
			];
			$this->db->insert('notifikasi', $notif);
		} elseif ($jenis == "penilaian-tenant2") {
			$temp = $this->db->get_where('tenant',['id_tenant' => $tenant])->row_array();

			if ($temp['status'] == 3) {
				$isi = "Penilaian tahap kedua tenant dengan nama tenant " .$temp['nama_tenant']. " sudah dilakukan. Silahkan segera melakukan penginputan data kontrak tenant pada halaman ini. <a href='".base_url('user/uploadKontrakTenant/').$tenant."'>Klik disini untuk melanjut kehalaman kontrak tenant...</a>";
			} else {
				$isi = "Penilaian tahap pertama tenant dengan nama tenant " .$temp['nama_tenant']. " sudah dilakukan. Mohon maaf, tenant anda dinyatakan tidak lulus tahap ke-1";
			}

			$notif = [
				'id_user' => $temp['id_user'],
				'pengirim' => 'System',
				'jenis' => $jenis,
				'isi' => $isi,
				'waktu' => date('H:i:s d-m-Y'),
				'status' => 0
			];
			$this->db->insert('notifikasi', $notif);
		} elseif ($jenis == "kontrak-tenant") {
			$inkubator = $this->db->get_where('user',['role_id' => 1])->result_array();

			foreach ($inkubator as $in) {
				$notif = [
					'id_user' => $in['id_user'],
					'pengirim' => 'System',
					'jenis' => $jenis,
					'isi' => "User " . $nama . " melakukan upload kontrak atas nama tenant " . $tenant . ". Diharap untuk segera melakukan verifikasi terhadap kontrak tenant.",
					'waktu' => date('H:i:s d-m-Y'),
					'status' => 0
				];
				$this->db->insert('notifikasi', $notif);
			}
		} elseif ($jenis == "verifikasi-kontrak") {
			$temp = $this->db->get_where('tenant',['id_tenant' => $tenant])->row_array();
			$isi = "Selamat! Kontrak dengan atas nama tenant " .$temp['nama_tenant']. " sudah diverifikasi. Diharap untuk menunggu informasi selanjutnya dari Inkubator untuk enrollment key kelas Pra-Inkubasi pada halaman notifikasi.";

			$notif = [
				'id_user' => $temp['id_user'],
				'pengirim' => 'System',
				'jenis' => $jenis,
				'isi' => $isi,
				'waktu' => date('H:i:s d-m-Y'),
				'status' => 0
			];
			$this->db->insert('notifikasi', $notif);
		} elseif ($jenis == "enroll") {
			$temp = $this->db->get_where('tenant',['id_tenant' => $tenant])->row_array();
			$kelas = explode(';',$message);
			if ($temp['status'] == 4) {
				$isi = "Untuk tenant ".$temp['nama_tenant'].", silahkan bergabung kedalam kelas Pra-Inkubasi ".$kelas[0]." dengan memasukkan enroll key : ".$kelas[1];
			} else {
				$isi = "Untuk tenant ".$temp['nama_tenant'].", silahkan bergabung kedalam kelas Inkubasi ".$kelas[0]." dengan memasukkan enroll key : ".$kelas[1];
			}

			$notif = [
				'id_user' => $temp['id_user'],
				'pengirim' => $nama,
				'jenis' => $jenis,
				'isi' => $isi,
				'waktu' => date('H:i:s d-m-Y'),
				'status' => 0
			];
			$this->db->insert('notifikasi', $notif);
		} elseif ($jenis == "umum") {
			$temp = $this->db->get_where('tenant',['id_tenant' => $tenant])->row_array();
			$isi = explode('{separatorIsi}',$message);

			$notif = [
				'id_user' => $temp['id_user'],
				'pengirim' => $nama,
				'jenis' => $jenis,
				'isi' => $isi[0],
				'link' => $isi[1],
				'file' => $isi[2],
				'waktu' => date('H:i:s d-m-Y'),
				'status' => 0
			];
			$this->db->insert('notifikasi', $notif);
		} elseif ($jenis == "pertemuan") {

			for ($i=0; $i < count($tenant); $i++) {
				$temp = $this->db->get_where('tenant',['id_tenant' => $tenant[$i]])->row_array();
				$notif = [
					'id_user' => $temp['id_user'],
					'pengirim' => $nama,
					'jenis' => $jenis,
					'isi' => 'Pertemuan baru telah ditambahkan pada kelas '.$message.' yang terdaftar terhadap tenant '.$temp['nama_tenant'].'. Silahkan melakukan pengecekan di kelas yang telah diperbarui.',
					'waktu' => date('H:i:s d-m-Y'),
					'status' => 0
				];
				$this->db->insert('notifikasi', $notif);
			}
		} elseif ($jenis == "assignment") {

			for ($i=0; $i < count($tenant); $i++) {
				$temp = $this->db->get_where('tenant',['id_tenant' => $tenant[$i]])->row_array();
				$notif = [
					'id_user' => $temp['id_user'],
					'pengirim' => $nama,
					'jenis' => $jenis,
					'isi' => 'Assignment baru telah ditambahkan pada kelas '.$message.' yang terdaftar terhadap tenant '.$temp['nama_tenant'].'. Silahkan melakukan pengecekan di kelas yang telah diperbarui.',
					'waktu' => date('H:i:s d-m-Y'),
					'status' => 0
				];
				$this->db->insert('notifikasi', $notif);
			}
		} elseif ($jenis == "monev") {
			$explodeMessage = explode(';',$message);
			if ($explodeMessage[0] == "buka") {
				for ($i=0; $i < count($tenant); $i++) {
					$temp = $this->db->get_where('tenant',['id_tenant' => $tenant[$i]['id_tenant']])->row_array();
					$notif = [
						'id_user' => $temp['id_user'],
						'pengirim' => $nama,
						'jenis' => $jenis,
						'isi' => 'Form upload monev untuk tenant '.$temp['nama_tenant']. ' telah dibuka dari tanggal '.$explodeMessage[1].' sampai dengan tanggal '.$explodeMessage[2].'. Diharapkan untuk segera melakukan upload monev sebelum tanggal akhir.',
						'waktu' => date('H:i:s d-m-Y'),
						'status' => 0
					];
					$this->db->insert('notifikasi', $notif);
				}
			} else {
				$temp = $this->db->get_where('tenant',['id_tenant' => $tenant])->row_array();
				$notif = [
					'id_user' => $temp['id_user'],
					'pengirim' => $nama,
					'jenis' => $jenis,
					'isi' => 'Monev dengan nama tenant '.$temp['nama_tenant']. ' telah selesai dinilai. Hasil dari penilaian dapat dilihat di halaman detail monev.',
					'waktu' => date('H:i:s d-m-Y'),
					'status' => 0
				];
				$this->db->insert('notifikasi', $notif);

			}
		} elseif ($jenis == "enroll-in") {
			$explodeMessage = explode(';',$message);
			$temp = $this->db->get_where('tenant',['id_tenant' => $tenant])->row_array();
			if ($explodeMessage[0] == 'training') {
				$inkubator = $this->db->get_where('user',['role_id' => 1])->result_array();
				$kelas = $this->db->get_where('kelas_training',['id_kelas_training' => $explodeMessage[1]])->row_array();

				foreach ($inkubator as $in) {
					$notif = [
						'id_user' => $in['id_user'],
						'pengirim' => 'System',
						'jenis' => $jenis,
						'isi' => "User " . $nama . " melakukan enroll atas nama tenant " . $temp['nama_tenant'] . " kedalam kelas ".$kelas['nama_kelas'].".",
						'waktu' => date('H:i:s d-m-Y'),
						'status' => 0
					];
					$this->db->insert('notifikasi', $notif);
				}
			} else {
				$kelas = $this->db->get_where('kelas_coaching',['id_kelas_coaching' => $explodeMessage[1]])->row_array();

				$notif = [
					'id_user' => $kelas['coach'],
					'pengirim' => 'System',
					'jenis' => $jenis,
					'isi' => "User " . $nama . " melakukan enroll atas nama tenant " . $temp['nama_tenant'] . " kedalam kelas ".$kelas['nama_kelas'].".",
					'waktu' => date('H:i:s d-m-Y'),
					'status' => 0
				];
				$this->db->insert('notifikasi', $notif);
			}
		} elseif($jenis == 'kontak-admin'){
			$inkubator = $this->db->get_where('user',['role_id' => 1])->result_array();
			foreach ($inkubator as $in) {
				$notif = [
					'id_user' => $in['id_user'],
					'pengirim' => $nama,
					'jenis' => $jenis,
					'isi' => $message,
					'waktu' => date('H:i:s d-m-Y'),
					'status' => 0
				];
				$this->db->insert('notifikasi', $notif);
			}
		}elseif($jenis == 'kontak-user'){
			$notif = [
				'id_user' => $tenant,
				'pengirim' => $nama,
				'jenis' => $jenis,
				'isi' => $message,
				'waktu' => date('H:i:s d-m-Y'),
				'status' => 0
			];
			$this->db->insert('notifikasi', $notif);
		}
		// elseif ($jenis == "submit-assignment") {
		// 	$explodeMessage = explode(';',$message);
		// 	$temp = $this->db->get_where('tenant',['id_tenant' => $tenant])->row_array();
		// 	if ($explodeMessage[0] == 'training') {
		// 		$inkubator = $this->db->get_where('user',['role_id' => 1])->result_array();
		// 		$kelas = $this->db->get_where('kelas_training',['id_kelas_training' => $explodeMessage[1]])->row_array();

		// 		foreach ($inkubator as $in) {
		// 			$notif = [
		// 				'id_user' => $in['id_user'],
		// 				'pengirim' => 'System',
		// 				'jenis' => $jenis,
		// 				'isi' => "User " . $nama . " melakukan enroll atas nama tenant " . $temp['nama_tenant'] . " kedalam kelas ".$kelas['nama_kelas'].".",
		// 				'waktu' => date('H:i:s d-m-Y'),
		// 				'status' => 0
		// 			];
		// 			$this->db->insert('notifikasi', $notif);
		// 		}
		// 	} else {
		// 		$kelas = $this->db->get_where('kelas_coaching',['id_kelas_coaching' => $explodeMessage[1]])->row_array();

		// 		$notif = [
		// 			'id_user' => $kelas['coach'],
		// 			'pengirim' => 'System',
		// 			'jenis' => $jenis,
		// 			'isi' => "User " . $nama . " melakukan enroll atas nama tenant " . $temp['nama_tenant'] . " kedalam kelas ".$kelas['nama_kelas'].".",
		// 			'waktu' => date('H:i:s d-m-Y'),
		// 			'status' => 0
		// 		];
		// 		$this->db->insert('notifikasi', $notif);
		// 	}
		// }
	}

	public function getTenantCoaching($id_user){
		$data = $this->db->get_where('tenant',['id_user' => $id_user, 'status' => 5])->result_array();
		return $data;
	}

	public function dataKelasTraining($id){
		$dataKelas['enroll'] = $this->db->get_where('enroll_kelas_training',['id_tenant'=>$id])->row_array();
		$dataKelas['kelas'] = $this->db->get_where('kelas_training',['id_kelas_training'=>$dataKelas['enroll']['id_kelas']])->row_array();
		$dataKelas['pertemuan'] = $this->db->get_where('pertemuan_kelas',['id_kelas'=>$dataKelas['kelas']['id_kelas_training'], 'jenis' => 'training'])->result_array();
		$dataKelas['detail'] = [];

		foreach ($dataKelas['pertemuan'] as $dp) {
			$temp = $this->db->get_where('detail_kelas',['id_kelas'=>$dp['id_kelas'], 'id_pertemuan_kelas' => $dp['id_pertemuan_kelas']])->result_array();
			$dataKelas['detail'] = array_merge($dataKelas['detail'], $temp);
		}

		return $dataKelas;
	}

	public function dataKelasCoaching($id,$id_tenant){
		$dataKelas['enroll'] = $this->db->get_where('enroll_kelas_coaching',['id_tenant'=>$id_tenant, 'id_kelas' => $id])->row_array();
		$dataKelas['kelas'] = $this->db->get_where('kelas_coaching',['id_kelas_coaching'=>$id])->row_array();
		$dataKelas['pertemuan'] = $this->db->get_where('pertemuan_kelas',['id_kelas'=>$id, 'jenis' => 'coaching'])->result_array();
		$dataKelas['tenant'] = $this->db->get_where('tenant',['id_tenant' => $id_tenant])->row_array();

		$dataKelas['detail'] = [];

		foreach ($dataKelas['pertemuan'] as $dp) {
			$temp = $this->db->get_where('detail_kelas',['id_kelas'=>$dp['id_kelas'], 'id_pertemuan_kelas' => $dp['id_pertemuan_kelas']])->result_array();
			$dataKelas['detail'] = array_merge($dataKelas['detail'], $temp);
		}

		return $dataKelas;
	}

	public function persenProgressPraInkubasi($id){
		$data['enroll'] = $this->db->get_where('enroll_kelas_training',['id_tenant'=>$id])->row_array();
		$data['kelas'] = $this->db->get_where('kelas_training',['id_kelas_training'=>$data['enroll']['id_kelas']])->row_array();
		$data['pertemuan'] = $this->db->get_where('pertemuan_kelas',['id_kelas'=>$data['kelas']['id_kelas_training'], 'jenis' => 'training'])->result_array();
		$data['detail'] = $this->db->get_where('detail_kelas',['id_kelas'=>$data['kelas']['id_kelas_training']])->result_array();

		if (count($data['detail']) == 0) {
			$progress = ['0','0','0']; 
		} else {
			$progress[] = '';
			$progressTotal = 0;
			$k=0;
			foreach ($data['pertemuan'] as $pt) {
				$i=0;
				$j=0;
				$temp='';
				foreach($data['detail'] as $dt){
					$progressKelas = $this->db->get_where('progress_kelas',['id_detail_kelas'=> $dt['id_detail_kelas'], 'id_tenant' => $id])->row_array();
					if($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'dokumen'){
						if ($progressKelas['status'] == 1) {
							$j++;
						}
						$i++;
					}elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'assignment'){
						if ($progressKelas['status'] == 1) {
							$j++;
						}
						$i++;
					}elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'link'){
						if ($progressKelas['status'] == 1) {
							$j++;
						}
						$i++;
					}elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'forum'){
						if ($progressKelas['status'] == 1) {
							$j++;
						}
						$i++;
					}elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'feedback'){
						if ($progressKelas['status'] == 1) {
							$j++;
						}
						$i++;
					}elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'page'){
						if ($progressKelas['status'] == 1) {
							$j++;
						}
						$i++;
					}
				}

				$temp = explode('.',($j / $i) * 100);
				$progressTotal = $progressTotal + (($j / $i) * 100);
				$progress[$k] = $temp[0];
				$k++;
			}
			$temp2 = explode('.',($progressTotal / $k));
			$progress[$k] =  $temp2[0];
		}
		return $progress;
	}

	public function persenProgressInkubasi($id,$id_tenant){
		$data['enroll'] = $this->db->get_where('enroll_kelas_coaching',['id_tenant'=>$id_tenant])->row_array();
		$data['kelas'] = $this->db->get_where('kelas_coaching',['id_kelas_coaching'=>$id])->row_array();
		$data['pertemuan'] = $this->db->get_where('pertemuan_kelas',['id_kelas'=>$id, 'jenis' => 'coaching'])->result_array();
		$data['detail'] = [];

		foreach ($data['pertemuan'] as $dp) {
			$temp = $this->db->get_where('detail_kelas',['id_kelas'=>$dp['id_kelas'], 'id_pertemuan_kelas' => $dp['id_pertemuan_kelas']])->result_array();
			$data['detail'] = array_merge($data['detail'], $temp);
		}

		if (count($data['detail']) == 0) {
			$progress = ['0','0','0']; 
		} else {
			$progress[] = '';
			$progressTotal = 0;
			$k=0;
			foreach ($data['pertemuan'] as $pt) {
				$i=0;
				$j=0;
				$temp='';
				foreach($data['detail'] as $dt){
					$progressKelas = $this->db->get_where('progress_kelas',['id_detail_kelas'=> $dt['id_detail_kelas'], 'id_tenant' => $id_tenant])->row_array();
					if($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'dokumen'){
						if ($progressKelas['status'] == 1) {
							$j++;
						}
						$i++;
					}elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'assignment'){
						if ($progressKelas['status'] == 1) {
							$j++;
						}
						$i++;
					}elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'link'){
						if ($progressKelas['status'] == 1) {
							$j++;
						}
						$i++;
					}elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'forum'){
						if ($progressKelas['status'] == 1) {
							$j++;
						}
						$i++;
					}elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'feedback'){
						if ($progressKelas['status'] == 1) {
							$j++;
						}
						$i++;
					}elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'page'){
						if ($progressKelas['status'] == 1) {
							$j++;
						}
						$i++;
					}
				}
				$temp = explode('.',($j / $i) * 100);
				$progressTotal = $progressTotal + (($j / $i) * 100);
				$progress[$k] = $temp[0];
				$k++;
			}
			$temp2 = explode('.',($progressTotal / $k));
			$progress[$k] =  $temp2[0];
		}
		return $progress;
	}

	public function pushNewProgressTraining($id_kelas, $id_pertemuan_kelas){
		$enroll = $this->db->get_where('enroll_kelas_training',['id_kelas' => $id_kelas])->result_array();
		$detailKelas = $this->db->get_where('detail_kelas',['id_pertemuan_kelas'=> $id_pertemuan_kelas])->result_array();

		foreach ($enroll as $er) {
			foreach ($detailKelas as $dk) {
				$progress = $this->db->get_where('progress_kelas',['id_detail_kelas' => $dk['id_detail_kelas'],'id_tenant'=>$er['id_tenant']])->row_array();
				if ($progress == NULL) {
					$data = [
						'status' => 0,
						'id_detail_kelas' => $dk['id_detail_kelas'],
						'id_tenant' => $er['id_tenant']
					];

					$this->db->insert('progress_kelas', $data);
				}
			}
		}
	}

	public function pushNewProgressCoaching($id_kelas, $id_pertemuan_kelas){
		$enroll = $this->db->get_where('enroll_kelas_coaching',['id_kelas' => $id_kelas])->result_array();
		$detailKelas = $this->db->get_where('detail_kelas',['id_pertemuan_kelas'=> $id_pertemuan_kelas])->result_array();

		foreach ($enroll as $er) {
			foreach ($detailKelas as $dk) {
				$progress = $this->db->get_where('progress_kelas',['id_detail_kelas' => $dk['id_detail_kelas'],'id_tenant'=>$er['id_tenant']])->row_array();
				if ($progress == NULL) {
					$data = [
						'status' => 0,
						'id_detail_kelas' => $dk['id_detail_kelas'],
						'id_tenant' => $er['id_tenant']
					];

					$this->db->insert('progress_kelas', $data);
				}
			}
		}
	}

	public function checkRekrutmen(){
		date_default_timezone_set('Asia/Jakarta');
		$waktuNow = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
		$rekrutmen = $this->db->get('rekrutmen')->result_array();
		foreach ($rekrutmen as $rt) {
			$tempAwal = DateTime::createFromFormat('Y-m-d', $rt['awal_rekrutmen']);
			$tempAkhir = DateTime::createFromFormat('Y-m-d', $rt['akhir_rekrutmen']);
			if ($waktuNow >= $tempAwal && $tempAkhir >= $waktuNow) {
				$this->db->set('status', 0);
				$this->db->where('id_rekrutmen', $rt['id_rekrutmen']);
				$this->db->update('rekrutmen');	
			}elseif ($waktuNow < $tempAwal || $tempAkhir < $waktuNow) {
				$this->db->set('status', 1);
				$this->db->where('id_rekrutmen', $rt['id_rekrutmen']);
				$this->db->update('rekrutmen');
			}
		}
	}

	public function checkPeriodeMonev(){
		date_default_timezone_set('Asia/Jakarta');
		$waktuNow = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
		$peridode_monev = $this->db->get('periode_monev')->result_array();
		foreach ($peridode_monev as $pm) {
			$tempAwal = DateTime::createFromFormat('Y-m-d', $pm['awal']);
			$tempAkhir = DateTime::createFromFormat('Y-m-d', $pm['akhir']);
			$rekrutmen = $this->db->get_where('rekrutmen',['id_rekrutmen' => $pm['id_rekrutmen']])->row_array();
			if ($waktuNow >= $tempAwal && $tempAkhir >= $waktuNow && $pm['status'] != 0) {
				$this->db->set('status', 0);
				$this->db->where('id_periode_monev', $pm['id_periode_monev']);
				$this->db->update('periode_monev');
				$this->db->select('id_tenant');
				$this->db->where('waktu >=', $rekrutmen['awal_rekrutmen']);
				$this->db->where('waktu <=', $rekrutmen['akhir_rekrutmen']);
				$this->db->where('status', 5);
				$tenant = $this->db->get('tenant')->result_array();
				$this->sendNotification('monev', $tenant, 'System', 'buka;'.$pm['awal'].';'.$pm['akhir']);
			}elseif ($waktuNow < $tempAwal || $tempAkhir < $waktuNow) {
				$this->db->set('status', 1);
				$this->db->where('id_periode_monev', $pm['id_periode_monev']);
				$this->db->update('periode_monev');
			}
		}
	}

	public function checkUploadMonev($id_user){
		$periode_monev = $this->db->get_where('periode_monev',['status' => 0])->result_array();
		$tenant = [];

		if (count($periode_monev) > 0) {
			for ($i=0; $i < count($periode_monev); $i++) { 
				$temp[$i] = $periode_monev[$i]['id_rekrutmen'];
			}

			$this->db->where_in('id_rekrutmen', array_unique($temp));
			$rekrutmen = $this->db->get('rekrutmen')->result_array();

			for ($i=0; $i < count($rekrutmen); $i++) {
				$this->db->where('waktu >=', $rekrutmen[$i]['awal_rekrutmen']);
				$this->db->where('waktu <=', $rekrutmen[$i]['akhir_rekrutmen']);
				$this->db->where('status', 5);
				$this->db->where('id_user', $id_user);
				$temp2 = $this->db->get('tenant')->result_array();
				$tenant = array_merge($temp2, $tenant);
			}
		}

		return $tenant;
	}

	public function getIdTenantPendamping($id){
		$tenant = $this->db->get_where('tenant',['pendamping' => $id])->result_array();
		$id_tenant = [];
		for ($i=0; $i < count($tenant); $i++) { 
			$id_tenant[$i] = $tenant[$i]['id_tenant']; 
		}
		return $id_tenant;
	}

	public function strlenCL($string){
		if (strlen($string) > 100) {
			$data = substr($string, 0, 100)."...";
		} else {
			$data = $string;
		}
		return $data;
	}

	public function generateRandomString($length) {
	    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}
