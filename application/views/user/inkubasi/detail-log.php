<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/user/coachinglog.css');?>">
<div class="container-fluid px-5">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-white" style="font-weight: 300;">
			<li class="breadcrumb-item"><a href="<?=base_url('user');?>" class="text-decoration-none text-muted">Beranda</a></li>
			<li class="breadcrumb-item"><a href="<?=base_url('user/inkubasi');?>" class="text-decoration-none text-muted">Inkubasi</a></li>
			<li class="breadcrumb-item text-muted" aria-current="page"><a href="<?=base_url('user/coachingLog');?>" class="text-decoration-none text-muted">Coaching Log</a></li>
		</ol>
	</nav>

	<div class="mx-5 mb-5">
		<div class="head-home my-3" style="border: solid 2px; border-color: #FBD15B;">
			<h2 style="font-weight: 500; padding: 5px;">Coaching Log</h2>
		</div>

		<div class="p-3 bg-white" style="border: solid 1px #d8d8d8; border-radius: 5px; color: #5A47AB;">
			<h1><?=$tenant['nama_tenant'];?></h1>
			<h6 class="text-muted">Tanggal Lapor : <?=$coachingLog['tanggal'];?></h6>
			<h5>Coach <?= $coachingLog['coach'];?></h5>

			<div class="innerCL row no-gutters my-5" style="font-size: 14px;">
				<div class="col-10 col-sm-5">
					<p style="font-size: 20px; font-weight: 700;">Hasil Sebelumnya</p>
					<p><?=$coachingLog['hasil_sebelumnya'];?></p>
					<br><p style="font-size: 20px; font-weight: 700;">Tujuan Tahap Ini</p>
					<p><?=$coachingLog['tujuan_ini'];?></p>
					<br><p style="font-size: 20px; font-weight: 700;">Hasil yang Ingin Dicapai</p>
					<p><?=$coachingLog['hasil_ingin'];?></p>
					<br><p style="font-size: 20px; font-weight: 700;">Hasil yang Dicapai</p>
					<p><?=$coachingLog['hasil_dicapai'];?></p>
					<br><p style="font-size: 20px; font-weight: 700;">Tujuan Tahap Selanjutnya</p>
					<p><?=$coachingLog['tujuan_selanjutnya'];?></p>
					<br>
				</div>
				<div class="col-10 col-sm-5 offset-0 offset-sm-1">
					<p style="font-size: 20px; font-weight: 700;">Assignment Coaching Log</p>
					<?php if($coachingLog['dokumen'] == ''):?>
						<p>Anda belum melakukan upload assignment.</p>
					<?php else:?>
						<p><?= $coachingLog['jawaban'];?></p>
						<br>
						<iframe class="col-12 col-sm-6" src="<?=base_url('assets/dokumen/coaching_log/').$coachingLog['dokumen'];?>" style="min-height: 480px; min-width: 400px;"></iframe>
					<?php endif;?>
				</div>
			</div>
		</div>
	</div>
</div>