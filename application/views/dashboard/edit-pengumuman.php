<div class="container-fluid px-5">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white" style="font-weight: 300;">
	    <li class="breadcrumb-item"><a href="<?=base_url('home');?>" class="text-decoration-none text-muted">Site Home</a></li>
	    <li class="breadcrumb-item text-muted" aria-current="page">Edit Pengumuman</li>
	  </ol>
	</nav>

	<form class="col-10 offset-1 mt-5" method="post" action="">
		<div class="form-group">
			<label class="form-group-label" for="judul">Judul</label>
			<input class="form-control col-8 col-sm-6" type="text" id="judul" name="judul" value="<?=$pengumuman['judul'];?>" placeholder="Tuliskan Judul">
		</div>
		<div class="form-group mt-4">
			<label class="form-group-label" for="deskripsi">Deskripsi</label>
			<textarea class="form-control col-10 col-sm-8" id="deskripsi" name="deskripsi" placeholder="Tuliskan Deskripsi disini" rows="4"><?=$pengumuman['deskripsi'];?></textarea>
		</div>
		<button class="btn btnRegis mb-5">Submit</button>
	</form>
</div>