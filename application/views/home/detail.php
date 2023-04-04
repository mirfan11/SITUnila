<div class="container-fluid px-5">
	<nav aria-label="breadcrumb">
	  <ol class="breadcrumb bg-white" style="font-weight: 300;">
	    <li class="breadcrumb-item"><a href="<?=base_url('home');?>" class="text-decoration-none text-muted">Site Home</a></li>
	    <li class="breadcrumb-item text-muted" aria-current="page"><?=$pengumuman['judul'];?></li>
	  </ol>
	</nav>

	<div class="contentDetail p-5">
		<h3 style="font-weight: 700;"><?=$pengumuman['judul'];?></h3>
		<div><?=$pengumuman['deskripsi'];?></div>
	</div>
</div>