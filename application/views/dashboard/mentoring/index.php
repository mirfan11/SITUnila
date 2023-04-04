<section class="home-section">
	<div class="text container-fluid px-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7;">
				<li class="breadcrumb-item" style="color: #5A47AB;">Mentoring</li>
			</ol>
		</nav>

		<div class="mx-5 mb-5 pr-5">
			<div class="head-home mt-3" style="border: solid 2px; border-color: #FBD15B;">
				<h2 class="pl-3" style="font-weight: 500; color: #5A47AB;">Mentoring</h2>
			</div>

			<a href="<?=base_url('user/tambahTenant');?>" class="text-decoration-none p-1" style="color: #5A47AB; background-color: #bfcbec; border-radius: 5px; font-size: 14px;" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-fw fa-plus-circle"></i> Tambah Kelas Mentoring</a>

			<div class="my-5" style="border: solid 1px #d8d8d8; border-radius: 2px; padding: 1%; background-color: white; min-height: 420px;">
				<div class="listBoxPraInkubasi row no-gutters p-3" style="color: #5A47AB;">
					<?php foreach ($kelas as $kl): ?>
						<div class="boxPraInkubasi col-4 col-md-2 mx-2" style="border: solid 1px #d8d8d8; border-radius: 10px; padding: 1%; cursor: pointer;" onclick="window.location='<?=base_url('dashboard/detailMentoring/').$kl['id_kelas_mentoring'];?>'">
							<img src="<?=base_url('assets/logo/gambarMentoring.png');?>" style="max-width: 70%; height: auto; margin-left: auto; margin-right: auto; display: block;">
							<p style="font-weight: 400;" class="mt-2"><?=$kl['nama_kelas'];?></p>
							<p class="text-right mt-4 mb-0" style="font-weight: 300; font-size: 14px;">Enroll Class : <span class="text-warning"><?=$kl['enroll_key'];?></span></p>
						</div>
					<?php endforeach;?>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Buat Kelas Mentoring</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="post">
				<div class="modal-body">
					<div class="form-group row">
						<label for="nama" class="col-sm-5 col-form-label">Nama Kelas</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kelas Mentoring">
							<?=form_error('nama','<small class="text-danger pl-1">','</small>');?>
						</div>
					</div>
					<?php if($this->session->userdata('role_id')==1):?>
					<div class="form-group row">
						<label for="coach" class="col-sm-5 col-form-label">Mentor</label>
						<div class="col-sm-7">
							 <select class="form-control" id="mentor" name="mentor" required>
						      <option value="">Pilih mentor</option>
						      <?php foreach($mentor as $mt):?>
						      	<option value="<?=$mt['nama'];?>"><?=$mt['nama'];?></option>
						      <?php endforeach;?>
						    </select>
						</div>
					</div>
					<?php endif;?>
					<div class="form-group row">
						<label for="enroll" class="col-sm-5 col-form-label">Enroll Key</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="enroll" name="enroll" placeholder="Buat Enroll Key">
							<?=form_error('enroll','<small class="text-danger pl-1">','</small>');?>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-dark">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>