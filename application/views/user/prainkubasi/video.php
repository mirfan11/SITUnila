<div class="container-fluid px-5">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-white" style="font-weight: 300;">
			<li class="breadcrumb-item"><a href="<?=base_url('user');?>" class="text-decoration-none text-muted">Beranda</a></li>
			<li class="breadcrumb-item text-muted" aria-current="page"><a href="<?=base_url('user/praInkubasi');?>" class="text-decoration-none text-muted">Pra-Inkubasi</a></li>
		</ol>
	</nav>

	<div class="mx-5 mb-5">
		<div class="head-home my-3" style="border: solid 2px; border-color: #FBD15B;">
			<h2 style="font-weight: 500; padding: 5px;">Pra Inkubasi</h2>
		</div>

		<div class="listPraInkubasi my-5">
			<div class="boxPraInkubasi mb-3" style="border: solid 1px #D8D8D8;">
				<label style="font-size: 20px; font-weight: 700; border-bottom: solid 1px #D8D8D8; padding: 1%; background-color: #d8d8d8;" class="col-12">Video</label>
				<div class="boxDalamPraInkubasi px-4" style="padding: 1%; min-height: 400px;">
					<p>Link Video : <a href="https://www.youtube.com/watch?v=<?=$detailKelas['deskripsi'];?>" target="https://www.youtube.com/watch?v=<?=$detailKelas['deskripsi'];?>">https://www.youtube.com/watch?v=<?=$detailKelas['deskripsi'];?></a></p>
					<iframe class="col-12" src="https://www.youtube.com/embed/<?=$detailKelas['deskripsi'];?>" style="min-height: 240px; max-width: 480px; border:none;"></iframe>
				</div>
			</div>
		</div>
	</div>
</div>