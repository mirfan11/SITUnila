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
		<div class="listPraInkubasi my-5">
			<div class="boxPraInkubasi mb-3" style="border: solid 1px #D8D8D8;">
				<label style="font-size: 20px; font-weight: 700; border-bottom: solid 1px #D8D8D8; padding: 1%; background-color: #d8d8d8;" class="col-12">Coaching Log <?=$ke;?></label>
				<div class="boxDalamPraInkubasi px-4" style="padding: 1%;">
					<p class="text-muted">Deskripsi Tugas</p>
					<div class="px-2 col-12 col-sm-8 text-muted" style="box-shadow: 1px 1px 5px 1px #888888; padding: 1%;">
						Buat Coaching Log sesuai dengan format.
					</div>
					<p style="color: black;" class="mt-3"><i class="fas fa-fw fa-file-pdf mr-2"></i> Format Coaching Log <label class="text-muted ml-1">22kb</label></p>
				</div>
			</div>

			<div class="boxPraInkubasi mb-3" style="border: solid 1px #D8D8D8;">
				<label style="font-size: 20px; font-weight: 700; border-bottom: solid 1px #D8D8D8; padding: 1%; background-color: #d8d8d8; color: #2DCE89;" class="col-12">Assignment</label>
				<div class="boxDalamPraInkubasi" style="padding: 1.5%;">
					<p style="font-weight: 700;">Jawaban</p>
					<form method="post" action="" enctype="multipart/form-data">
						<div class="form-group">
							<textarea class="form-control col-10 col-sm-8" id="jawaban" name="jawaban" rows="2" placeholder="jawaban dari tugas..."><?=$cl['jawaban'];?></textarea>
						</div>
						<div class="form-group">
							<label style="font-weight: 700;">Upload File Tugas</label>
							<div class="custom-file">
							<a href="<?=base_url('assets/dokumen/coaching_log/').$cl['dokumen'];?>" target="<?=base_url('assets/dokumen/coaching_log/').$cl['dokumen'];?>"><?=$cl['dokumen'];?></a>
								<input type="file" id="file" name="file" required accept="application/pdf">
								<small id="fileHelp" class="form-text text-danger">*upload berupa file PDF</small>
							</div>
						</div>
						<br><button type="submit" class="btnRegis btn px-3 mt-2">Submit Berkas</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>