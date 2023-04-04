<section class="home-section">
	<div class="text container-fluid">
		<nav aria-label="breadcrumb" style="color: #5A47AB;">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7; ">
				<li class="breadcrumb-item" class="text-decoration-none"  aria-current="page"><a href="<?=base_url('dashboard/coachingLog/');?>" class="text-decoration-none" style="color: #5A47AB;">Coaching Log</a></li>
			</ol>
		</nav>

		<div class="mx-5 mb-5 pr-5">
			<div class="px-3 pb-5 mr-5 bg-white" style="border: solid 1px #d8d8d8; border-radius: 5px; color: #5A47AB;">
				<h1><?=$tenant['nama_tenant'];?></h1>
				<h6 class="text-muted">Tanggal Lapor : <?=$coachingLog['tanggal'];?></h6>
				<h5>Coach <?= $coachingLog['coach'];?></h5>

				<div class="innerCL row no-gutters my-5" style="font-size: 14px;">
					<div class="col-10 col-sm-5 offset-1 offset-sm-0">
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
					<div class="col-10 col-sm-5 offset-1">
						<p style="font-size: 20px; font-weight: 700;">Assignment Coaching Log</p>
						<?php if($coachingLog['dokumen'] == ''):?>
							<p>User belum melakukan upload assignment.</p>
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
</section>

