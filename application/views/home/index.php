<div class="jumbotron bg-white">
	<div class="container-fluid">
		<div class="row no-gutters">
			<div class="col-12 col-sm-6">
			  <h1 class="display-5 my-3" style="color: #FBD15B;">Sistem Inkubasi Tenant Unila (SIT) </h1>
			  <p class="lead" style="font-size: 35px;">Merencanakan dan melaksanakan berbagai kegiatan terkait pengembangan minat dan budaya kewirausahaan bagi mahasiswa dan alumni </p>
			</div>
			<div class="col-12 col-sm-6">
				<img src="<?=base_url('assets/logo/jumbotron.png');?>" alt="jumbotron" class="img-fluid">
			</div>
		</div>
	</div>
</div>

<div class="container-fluid p-5">
	<div class="head-home mb-4" style="border: solid 2px; border-color: #FBD15B;">
		<h2 style="font-weight: 500; padding: 5px;">Pengumuman Sit</h2>
	</div>

	<div class="content">
		<?php foreach($pengumuman as $pg):?>
		<div class="media p-3 mb-4" style="border: solid 1px #d8d8d8; padding:1%; border-radius: 5px; cursor: pointer;" onclick="window.location='<?=base_url('home/detail/').$pg['id_pengumuman'];?>'">
		  <img src="<?=base_url('assets/logo/gambar-artikel-home.png');?>" class="mr-3" alt="artikel" style="max-width: 80px;">
		  <div class="media-body">
		    <h5 class="mt-0" style="font-weight: 700;"><?=$pg['judul'];?></h5>
		    <p class="text-secondary"><i class="far fa-fw fa-calendar"></i> <?=$pg['tanggal'];?></p>
		  </div>
		</div>
		<?php endforeach;?>
	</div>
	<?= $this->pagination->create_links();?>
</div>
