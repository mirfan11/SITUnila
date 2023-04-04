<div class="col-10 col-sm-4 col-md-2 offset-1 offset-sm-0 offset-md-0 mb-3">
							<div class="card mb-2 mx-2" style=" border-radius: 5px; height: 100%;" onclick="window.location='<?=base_url('dashboard/detailPraInkubasi/').$kl['id_kelas_training'];?>'">
							  <img src="<?=base_url('assets/logo/gambarMentoring.png');?>" style="max-width: 70%; height: auto; margin-left: auto; margin-right: auto; display: block;" class="card-img-top mt-3">
							  <div class="card-body px-0">
							    <p style="font-weight: 400;" class="mt-2 px-2"><?=$kl['nama_kelas'];?></p>
							    <p class="card-text text-right p-1" style="font-weight: 300; font-size:14px; bottom: 0; right: 0; position: absolute;">Enroll Class : <span class="text-warning"><?=$kl['enroll_key'];?></span></p>
							  </div>
							</div>
						</div>
<?= $this->pagination->create_links();?>

$this->pagination->initialize($this->Sit_model->pagination(count($data['tenant']),'riwayatInkubasi',5));

		$data['start']=$this->uri->segment(3);
		$this->db->order_by('id_tenant', 'DESC');
		$data['tenant']=$this->db->get_where('tenant',['status' => 6],5,$data['start'])->result_array();