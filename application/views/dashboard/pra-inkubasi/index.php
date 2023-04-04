<section class="home-section">
	<div class="text container-fluid px-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7;">
				<li class="breadcrumb-item" style="color: #5A47AB;">Kelas</li>
				<li class="breadcrumb-item" class="text-decoration-none"  aria-current="page"><a href="<?=base_url('dashboard/praInkubasi');?>" class="text-decoration-none" style="color: #5A47AB;">Pra Inkubasi</a></li>
			</ol>
		</nav>

		<div class="mx-5 mb-5 pr-5">
			<div class="head-home mt-3" style="border: solid 2px; border-color: #FBD15B;">
				<h2 class="pl-3" style="font-weight: 500; color: #5A47AB;">Pra Inkubasi</h2>
			</div>

			<a href="<?=base_url('user/tambahTenant');?>" class="text-decoration-none p-1" style="color: #5A47AB; background-color: #bfcbec; border-radius: 5px; font-size: 14px;" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-fw fa-plus-circle"></i> Tambah Kelas Training</a>
			<form class="form-inline my-2" method="post" action="<?= base_url('dashboard/search')?>" style="float: right;">
		      <input class="form-control mr-sm-2 col-9" id="search" name="search" placeholder="Cari kelas">
		      <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit" id="submitSearch" value="praInkubasi" name="btnSearch"><i class="fas fa-fw fa-search"></i></button>
		    </form>

			<div class="my-5" style="border: solid 1px #d8d8d8; border-radius: 2px; padding: 1%; background-color: white; min-height: 420px;">
				<div class="listBoxPraInkubasi row no-gutters p-3" style="color: #5A47AB;">
					<?php foreach ($kelas as $kl): ?>
						<div class="boxPraInkubasi col-4 col-md-2 mx-2 mb-3" style="border: solid 1px #d8d8d8; border-radius: 10px; padding: 1%; cursor: pointer;">
							<a href="<?=base_url('dashboard/detailPraInkubasi/').$kl['id_kelas_training'];?>" style="text-decoration: none;">
								<img src="<?=base_url('assets/logo/gambarMentoring.png');?>" style="max-width: 70%; height: auto; margin-left: auto; margin-right: auto; display: block;">
								<p style="font-weight: 400;" class="mt-2"><?=$kl['nama_kelas'];?></p>
								<p class="text-right mt-4 mb-0" style="font-weight: 300; font-size: 14px;">Enroll Class : <span class="text-warning"><?=$kl['enroll_key'];?></span></p>
								<?php if($this->session->userdata('role_id') != 3):?>
									<a class="mt-2" href="#" style="font-size: 10px; float: right;" onclick="editKelas(this)" data-id="<?=$kl['id_kelas_training'];?>"><i class="fas fa-fw fa-pen"></i> Edit</a>
								<?php endif;?>
							</a>
						</div>
					<?php endforeach ?>
				</div>
				<?= $this->pagination->create_links();?>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Buat Kelas Training</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="post">
				<div class="modal-body">
					<div class="form-group row">
						<label for="nama" class="col-sm-5 col-form-label">Nama Kelas</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Kelas Training">
							<?=form_error('nama','<small class="text-danger pl-1">','</small>');?>
						</div>
					</div>
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

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalEditLabel">Edit Kelas Training</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form>
				<div class="modal-body">
					<div class="form-group row">
						<label for="nama" class="col-sm-5 col-form-label">Nama Kelas</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="nama2" name="nama" placeholder="Nama Kelas Training">
							<div id="validName"></div>
						</div>
					</div>
					<div class="form-group row">
						<label for="enroll" class="col-sm-5 col-form-label">Enroll Key</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="enroll2" name="enroll" placeholder="Buat Enroll Key">
							<div id="validEnroll"></div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-dark" id="btnSubmitEdit" name="btnSubmitEdit" onclick="pushEdit()">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	function editKelas(a){
		var id_kelas = a.getAttribute('data-id');
		document.getElementById('btnSubmitEdit').value = id_kelas;
		$.ajax({
			url: "<?= base_url(); ?>dashboard/editKelasPraInkubasi",
			method: 'POST',
			dataType: 'json',
			data: {
				id_kelas: id_kelas
			},
			success: function(data) {
				console.log(data)
				document.getElementById('nama2').value = data.nama;
				document.getElementById('enroll2').value = data.enroll;
				$("#modalEdit").modal("show");
			}
		});
	}

	function pushEdit(){
		var id_kelas = document.getElementById('btnSubmitEdit').value;
		var nama = document.getElementById('nama2').value;
		var enroll = document.getElementById('enroll2').value;
		console.log(id_kelas)
		console.log(nama)
		console.log(enroll)

		$.ajax({
			url: "<?= base_url(); ?>dashboard/pushEditKelasPrainkubasi",
			method: 'POST',
			dataType: 'json',
			data: {
				id_kelas: id_kelas,
				nama: nama,
				enroll: enroll
			},
			success: function(data) {
				console.log(data)
				if (data.indikator == 'salah') {
					document.getElementById('validName').innerHTML = '<small id="emailHelp" class="form-text text-danger">'+data.nama+'</small>';
					document.getElementById('validEnroll').innerHTML = '<small id="emailHelp" class="form-text text-danger">'+data.enroll+'</small>';
				} else{
					location.reload();
				}
			}
		});
	}
</script>