<section class="home-section">
	<div class="text container-fluid px-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7;">
				<li class="breadcrumb-item" style="color: #5A47AB;">Kelas</li>
				<li class="breadcrumb-item" class="text-decoration-none"><a href="<?=base_url('dashboard/inkubasi');?>" class="text-decoration-none" style="color: #5A47AB;">Inkubasi</a></li>
				<li class="breadcrumb-item" class="text-decoration-none"  aria-current="page"><a href="<?=base_url('dashboard/inkubasiDetail/').$kelas['id_kelas_coaching'];?>" class="text-decoration-none" style="color: #5A47AB;"><?=$kelas['nama_kelas'];?></a></li>
			</ol>
		</nav>

		<div class="mx-5 mb-5 pr-5">
			<div class="head-home mt-3" style="border: solid 2px; border-color: #FBD15B;">
				<h2 class="pl-3" style="font-weight: 500; color: #5A47AB;"><?=$kelas['nama_kelas']?> - Page</h2>
			</div>

			<div class="my-5">
				<form method="post" action="">
					<p style="color:#5A47AB;">Ubah Page</p>
					<div class="mb-3" style="border: solid 1px #D8D8D8;">
						<label style="font-size: 20px; font-weight: 600; border-bottom: solid 1px #D8D8D8; padding: 1%; background-color: #d8d8d8; color: #5A47AB; margin-bottom: 0;" class="col-12">General</label>
						<div class="boxDalamPraInkubasi px-4" style="padding: 1%; font-size: 14px; background-color: white;">
							<div class="form-group">
								<label for="nama">Nama</label>
								<input type="text" class="form-control col-6" id="nama" name="nama" placeholder="Nama" value="<?=$pertemuan['nama'];?>">
								<?=form_error('nama','<small class="text-danger pl-1">','</small>');?>
							</div>
							<div class="form-group">
								<label for="deskripsi">Deskripsi</label>
								<textarea rows="3" class="form-control col-8" id="deskripsi" name="deskripsi" placeholder="Deskripsi"><?=$pertemuan['deskripsi'];?></textarea>
								<?=form_error('deskripsi','<small class="text-danger pl-1">','</small>');?>
							</div>
						</div>
					</div>
					<button class="btn btn-dark" type="submit">Simpan</button>
				</form>
			</div>
		</div>
	</div>
</section>