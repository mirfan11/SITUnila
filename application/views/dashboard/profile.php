<section class="home-section">
	<div class="text container-fluid px-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7;">
				<li class="breadcrumb-item"><a href="<?=base_url('dashboard/profile/').$user['id_user'];?>" class="text-decoration-none" style="color: #5A47AB;">Profile</a></li>
			</ol>
		</nav>

		<div class="mx-5 mb-5 pr-5 py-3 bg-white" style="border-radius: 5px;">
			<div class="px-5">
				<h2 style="color: #5A47AB;">Detail User</h2>
			</div>
	
			<div class="my-4 px-5" style="font-size: 16px;">
				<?= $this->session->flashdata('message');?>
				<form method="post" action="">
					<div class="form-row">
					  <div class="form-group col-10 col-md-5">
							<label for="nama">Nama</label>
							<input type="text" class="form-control" id="nama" name="nama" value="<?=$user['nama'];?>">
							<?=form_error('nama','<small class="text-danger pl-1">','</small>');?>
						</div>
						<div class="form-group col-10 col-md-5 offset-0 offset-md-1">
							<label for="email">Email Address</label>
							<input type="text" class="form-control" id="email" name="email" value="<?=$user['email'];?>">
							<?=form_error('email','<small class="text-danger pl-1">','</small>');?>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-10 col-md-3">
							<label for="tempatLahir">Tempat Lahir</label>
							<input type="text" class="form-control" id="tempatLahir" name="tempatLahir" value="<?=$user['tempat_lahir'];?>">
							<?=form_error('tempatLahir','<small class="text-danger pl-1">','</small>');?>
						</div>
						<div class="form-group col-10 col-md-3 offset-0 offset-md-1">
							<label for="tanggalLahir">Tanggal Lahir</label>
							<input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir" value="<?=$user['tanggal_lahir'];?>">
							<?=form_error('tanggalLahir','<small class="text-danger pl-1">','</small>');?>
						</div>
						<div class="form-group col-10 col-md-3 offset-0 offset-md-1">
							<label for="kelamin">Jenis Kelamin</label>
							<select class="form-control" id="kelamin" name="kelamin">
								<option value="">Pilih jenis kelamin</option>
								<option value="Laki-laki">Laki-laki</option>
								<option value="Perempuan">Perempuan</option>
							</select>
							<?=form_error('kelamin','<small class="text-danger pl-1">','</small>');?>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-10 col-md-3">
							<label for="telepon">No HP (WA)</label>
							<input type="text" class="form-control" id="telepon" name="telepon" value="<?=$user['telepon'];?>">
							<?=form_error('telepon','<small class="text-danger pl-1">','</small>');?>	
						</div>
						<div class="form-group col-10 col-md-3 offset-0 offset-md-1">
							<label for="pendidikan">Pendidikan Terakhir</label>
							<input type="text" class="form-control" id="pendidikan" name="pendidikan" value="<?=$user['pendidikan'];?>">
							<?=form_error('pendidikan','<small class="text-danger pl-1">','</small>');?>
						</div>
					</div>
					<div class="form-group">
						<label for="alamat">Alamat</label>
						<textarea class="form-control col-10 col-md-5" id="alamat" name="alamat" rows="4"><?=$user['alamat'];?></textarea>
						<?=form_error('alamat','<small class="text-danger pl-1">','</small>');?>
					</div>
					<?php //if($this->session->userdata('role_id') == 4):?>
						<!-- <div class="form-group">
							<label for="keahlian">Keahlian</label>
							<div id="keahlianGroup">
							</div>
						</div> -->
					<?php //endif;?>
				  <button type="submit" class="btn btn-success">Edit</button>
				</form>
			</div>
		</div>

	</div>
</section>

<script type="text/javascript">
	var jenis_kelamin = ['Laki-laki', 'Perempuan'];
	var user_kelamin = '<?=$user['jenis_kelamin']?>';
	var html_jenis_kelamin = '<option value="'+user_kelamin+'">'+user_kelamin+'</option>';

	for (var i = 0; i < jenis_kelamin.length; i++) {
		if (jenis_kelamin[i] != user_kelamin) {
			html_jenis_kelamin += '<option value="'+jenis_kelamin[i]+'">'+jenis_kelamin[i]+'</option>';
		}
	}

	document.getElementById('kelamin').innerHTML = html_jenis_kelamin;

	// function formKeahlian(){
	// 	var keahlian = <?=$keahlian;?>;
	// 	console.log(keahlian.length);
	// 	var htmlKeahlian = '';
	// 	if (keahlian == "") {
	// 		htmlKeahlian = `<div class="form-inline keahlian mb-2">`
	// 		htmlKeahlian += `<input type="text" class="form-control col-8" name="keahlian[]" required>`;
	// 		htmlKeahlian += `<button class="btn btn-primary ml-2" type="button" id="tambahKeahlian" onclick="addKeahlian()"><i class="fas fa-fw fa-plus-circle"></i> Tambah</button></div>`;

	// 		document.getElementById('keahlianGroup').innerHTML = htmlKeahlian;
	// 	} else {
	// 		for (var i = 0; i < keahlian.length; i++) {
	// 			if (i == 0) {
	// 				htmlKeahlian += `<div class="form-inline keahlian mb-2">`
	// 				htmlKeahlian += `<input type="text" class="form-control col-8" name="keahlian[]" value="`+keahlian[i]+`" required>`;
	// 				htmlKeahlian += `<button class="btn btn-primary ml-2" type="button" id="tambahKeahlian" onclick="addKeahlian()"><i class="fas fa-fw fa-plus-circle"></i> Tambah</button></div>`;
	// 			}else{
	// 				htmlKeahlian += `<div class="form-inline keahlian mb-2">`
	// 				htmlKeahlian += `<input type="text" class="form-control col-8" name="keahlian[]" value="`+keahlian[i]+`" required>`;
	// 				htmlKeahlian += `<button class="btn btn-danger ml-2" type="button" id="hapusKeahlian" onclick="deleteKeahlian(this)"><i class="far fa-fw fa-trash-alt"></i> Hapus</button></div>`;
	// 			}
	// 		}
	// 		document.getElementById('keahlianGroup').innerHTML = htmlKeahlian;
	// 	}
	// }
	// formKeahlian();

	// function addKeahlian(){
	// 	const node = document.querySelector('.keahlian');
	// 	console.log(node);
	// 	var divToCreate = document.createElement('div');
	// 	divToCreate.className = `form-inline keahlian mb-2`;
	// 	var htmlKeahlian = `<input type="text" class="form-control col-8" name="keahlian[]" required>`;
	// 	htmlKeahlian += `<button class="btn btn-danger ml-2" type="button" id="hapusKeahlian" onclick="deleteKeahlian(this)"><i class="far fa-fw fa-trash-alt"></i> Hapus</button>`;
	// 	divToCreate.innerHTML = htmlKeahlian;
	// 	node.parentNode.appendChild(divToCreate);
	// }

	// function deleteKeahlian(a){
	// 	console.log(a.parentNode.parentNode);
	// 	a.parentNode.parentNode.removeChild(a.parentNode);
	// }
</script>