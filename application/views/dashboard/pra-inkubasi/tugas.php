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
				<h2 class="pl-3" style="font-weight: 500; color: #5A47AB;"><?=$kelas['nama_kelas'];?> - <?= $kontenKelas[0];?></h2>
			</div>

			<div class="my-5">
				<div class="boxPraInkubasi mb-3" style="border: solid 1px #D8D8D8;">
					<label style="font-size: 20px; font-weight: 700; border-bottom: solid 1px #D8D8D8; padding: 1%; background-color: #d8d8d8; color: #5A47AB; margin-bottom: 0;" class="col-12"><?=$kontenKelas[0];?></label>
					<div class="boxDalamPraInkubasi px-4" style="padding: 1%; font-size: 15px; color: #5A47AB; background-color: white;">
						<p class="text-muted">Deskripsi Tugas</p>
						<div class="px-2 col-12 col-sm-8 text-muted" style="box-shadow: 1px 1px 5px 1px #888888; padding: 1%;">
							<?=$kontenKelas[1];?>
						</div>
						<p style="color: black;" class="mt-3"><a href="<?=base_url('assets/dokumen/kelas/dokumen/').$detailKelas['file'];?>" style="color: black;" download><i class="fas fa-fw fa-file-pdf mr-2"></i> Materi Tugas </a><label class="text-muted ml-1">22kb</label></p>
					</div>
				</div>

				<?php if($id_tenant != ''):?>
					<div class="boxPraInkubasi mb-3" style="border: solid 1px #D8D8D8;">
						<label style="font-size: 20px; font-weight: 700; border-bottom: solid 1px #D8D8D8; padding: 1%; background-color: #d8d8d8; color: #5A47AB; margin-bottom: 0;" class="col-12">Assignment</label>
						<div class="boxDalamPraInkubasi px-4" style="padding: 1%; font-size: 15px; color: #5A47AB; background-color: white;">
							<p class="text-muted">Jawaban</p>
							<?php if($countJawaban == 0):?>
								<p>User belum melakukan upload.</p>
								<?php else:?>
									<div class="form-group">
										<textarea class="form-control" id="jawaban" name="jawaban" rows="2" disabled><?=$jawaban['deskripsi']?></textarea>
									</div>
									<div class="row no-gutters">
										<div class="form-group col-12 col-sm-6">
											<label style="font-weight: 700;">File Tugas</label><br>
											<iframe class="col-12" src="https://drive.google.com/file/d/1qngAy3D2zILkE5V-a6MgOE9ADC_H0B5r/preview" style="min-height: 480px; max-width: 480px;"></iframe>
										</div>
										<?php if($jawaban['nilai'] == ""):?>
											<form class="col-12 col-sm-6" method="post" action="">
												<div class="form-group">
													<label style="font-weight: 700;">Nilai</label><br>
													<input type="number" name="nilai" id="nilai" class="form-control col-10 col-sm-6" placeholder="1-100">
													<?=form_error('nilai','<small class="text-danger pl-1">','</small>');?>
												</div>
												<button type="submit" class="btn btn-dark">Input</button>
											</form>
											<?php else:?>
												<div class="form-group col-12 col-sm-6">
													<label style="font-weight: 700;">Nilai</label><br>
													<h2><?=$jawaban['nilai'];?></h2>
												</div>
											<?php endif;?>
										</div>
									<?php endif;?>
								</div>
							</div>
						<?php endif;?>
					</div>
				</div>

			</div>
		</section>