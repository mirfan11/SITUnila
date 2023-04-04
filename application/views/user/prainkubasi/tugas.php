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
				<label style="font-size: 20px; font-weight: 700; border-bottom: solid 1px #D8D8D8; padding: 1%; background-color: #d8d8d8;" class="col-12"><?=$kontenKelas[0];?></label>
				<div class="boxDalamPraInkubasi px-4" style="padding: 1%;">
					<p class="text-muted">Deskripsi Tugas</p>
					<div class="px-2 col-12 col-sm-8 text-muted" style="box-shadow: 1px 1px 5px 1px #888888; padding: 1%;">
						<?=$kontenKelas[1];?>
					</div>
					<p style="color: black;" class="mt-3"><a href="<?=base_url('assets/dokumen/kelas/dokumen/').$detailKelas['file'];?>" style="color: black;" download><i class="fas fa-fw fa-file-pdf mr-2"></i> Materi Tugas </a><label class="text-muted ml-1">22kb</label></p>
				</div>
			</div>

			<div class="boxPraInkubasi mb-3" style="border: solid 1px #D8D8D8;">
				<label style="font-size: 20px; font-weight: 700; border-bottom: solid 1px #D8D8D8; padding: 1%; background-color: #d8d8d8; color: #2DCE89;" class="col-12">Assignment</label>
				<div class="boxDalamPraInkubasi" style="padding: 1.5%;">
					<p class="text-muted">Jawaban</p>
					<?php if($countJawaban == 0):?>
					<form method="post" action="<?=base_url('user/uploadAssignmentPraInkubasi/').$detailKelas['id_detail_kelas'].'/'.$progress['id_tenant'];?>" enctype="multipart/form-data">
						<div class="form-group">
							<textarea class="form-control" id="jawaban" name="jawaban" rows="2"></textarea>
						</div>
						<div class="form-group">
							<label style="font-weight: 700;">Upload File Tugas</label><br>
							<input type="file" id="file" name="file">
						</div>
						<br><button type="submit" class="btnRegis btn px-3 mt-2">Submit Berkas</button>
					</form>
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
								<div class="form-group col-12 col-sm-6">
									<label style="font-weight: 700;">Nilai</label><br>
									<h3>Sedang dalam proses penilaian.</h3>
								</div>
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
		</div>
	</div>
</div>

<div class="modal fade" id="modalEnrollTidakAda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">System</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Tolong inputkan jawaban anda.</p>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	<?php if($this->session->userdata('system')== 'tidak ada'):?>
		$(document).ready(function(){
			$("#modalEnrollTidakAda").modal("show");
		});
	<?php 
	$this->session->unset_userdata('system');
	endif;?>
</script>