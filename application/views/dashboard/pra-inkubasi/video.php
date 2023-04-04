<section class="home-section">
	<div class="text container-fluid px-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7;">
				<li class="breadcrumb-item" style="color: #5A47AB;">Kelas</li>
				<li class="breadcrumb-item" class="text-decoration-none"  aria-current="page"><a href="<?=base_url('dashboard/praInkubasi');?>" class="text-decoration-none" style="color: #5A47AB;">Pra Inkubasi</a></li>
				<li class="breadcrumb-item" class="text-decoration-none"  aria-current="page"><a href="<?=base_url('dashboard/detailPraInkubasi/').$kelas['id_kelas_training'];?>" class="text-decoration-none" style="color: #5A47AB;"><?=$kelas['nama_kelas'];?></a></li>
			</ol>
		</nav>

		<div class="mx-5 mb-5 pr-5">
			<div class="head-home mt-3" style="border: solid 2px; border-color: #FBD15B;">
				<h2 class="pl-3" style="font-weight: 500; color: #5A47AB;"><?= $kelas['nama_kelas'];?> - Link Video <?= $kelas['nama_kelas'];?></h2>
			</div>

			<div class="listPraInkubasi my-5">
				<div class="boxPraInkubasi mb-3" style="border: solid 1px #D8D8D8;">
					<label style="color: #5A47AB;font-size: 20px; font-weight: 600; border-bottom: solid 1px #D8D8D8; padding: 1%; background-color: #d8d8d8; margin-bottom: 0;" class="col-12">Video</label>
					<div class="boxDalamPraInkubasi px-4" style="padding: 1%; min-height: 400px; font-size: 15px; color: #5A47AB; background-color: white;">
						<p>Link Video : <a href="https://www.youtube.com/watch?v=<?=$detailKelas['deskripsi'];?>" target="https://www.youtube.com/watch?v=<?=$detailKelas['deskripsi'];?>">https://www.youtube.com/watch?v=<?=$detailKelas['deskripsi'];?></a></p>
						<iframe class="col-12" src="https://www.youtube.com/embed/<?=$detailKelas['deskripsi'];?>" style="min-height: 240px; max-width: 480px; margin-right: auto; margin-left: auto; display: block; border:none;"></iframe>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>