<section class="home-section">
	<div class="container-fluid text px-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7;">
				<li class="breadcrumb-item" style="color: #5A47AB;">Kelas</li>
				<li class="breadcrumb-item" class="text-decoration-none"><a href="<?=base_url('dashboard/inkubasi');?>" class="text-decoration-none" style="color: #5A47AB;">Inkubasi</a></li>
				<li class="breadcrumb-item" class="text-decoration-none"  aria-current="page"><a href="<?=base_url('dashboard/inkubasiDetail/').$dataKelas['kelas']['id_kelas_coaching'];?>" class="text-decoration-none" style="color: #5A47AB;"><?=$dataKelas['kelas']['nama_kelas'];?></a></li>
			</ol>
		</nav>

		<div class="mx-5 mb-5 pr-5">
			<div class="head-home mt-3" style="border: solid 2px; border-color: #FBD15B;">
				<h2 class="pl-3" style="font-weight: 500; color: #5A47AB;"><?= $dataKelas['kelas']['nama_kelas'];?> - <?=$dataKelas['tenant']['nama_tenant'];?></h2>
			</div>

			<div class="col-sm-6 offset-6">
				<form method="get" action="<?=base_url('dashboard/detailUserInkubasi/').$dataKelas['kelas']['id_kelas_coaching'];?>">
					<div class="form-inline">
						<select class="form-control col-6 col-sm-4 offset-6 offset-sm-6 my-2 mr-2" style="background-color: #F2F2F2;" name="pilihTenant" id="pilihTenant" required>
							<?php foreach($selectTenant as $tn):?>
								<option value="<?=$tn['id_tenant'];?>"><?=$tn['nama_tenant'];?></option>
							<?php endforeach;?>
						</select>
						<button type="submit" class="btn btn-secondary my-2">Submit</button>
					</div>
				</form>
			</div>

			<div class="listPraInkubasi my-5">
				<?php $i=0;
				foreach($dataKelas['pertemuan'] as $pt):?>
					<div class="boxPraInkubasi mb-3" style="border: solid 1px #D8D8D8;">
						<label style="color: #5A47AB;font-size: 20px; font-weight: 600; border-bottom: solid 1px #D8D8D8; padding: 1%; background-color: #d8d8d8; margin-bottom: 0;" class="col-12"><?=$pt['nama'];?> <span class="text-success" style="float: right; font-size:12px;">Progress : <?=$progress[$i]?> %</span></label>
						<div class="boxDalamPraInkubasi" style="padding: 1.5%; padding-right: 0; background-color: white; font-size: 14px;">
							<div style="min-height: 200px;">
								<?php foreach($dataKelas['detail'] as $dt):?>
									<?php if($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'dokumen'):?>
										<p style="color: black;"><a href="<?=base_url('assets/dokumen/kelas/dokumen/').$dt['file'];?>" download><i class="fas fa-fw fa-file-pdf mr-2"></i><?=$dt['deskripsi'];?></a> <span class="text-muted ml-1">22kb</span><span style="float:right;"><input class="checkSelesai form-check-input" type="checkbox" <?=$dt['progress'];?> disabled></span></p>
									
									<?php elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'assignment'):?>
										<?php $judul = explode("(assignmentDelimiter)",$dt['deskripsi']);?>
										<p>
											<a href="<?=base_url('dashboard/tugasUserInkubasi/').$dt['id_detail_kelas'];?>/<?=$dataKelas['tenant']['id_tenant'];?>" class="text-decoration-none" style="color: black;"><i class="fas fa-fw fa-clipboard-list mr-2"></i></i><?=$judul[0];?></a>
											<span style="float:right;"><input class="checkSelesai form-check-input" type="checkbox" <?=$dt['progress'];?> disabled></span>
										</p>
									
									<?php elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'link'):?>
										<?php $judulLink = explode("(linkDelimiter)",$dt['deskripsi']);?>
										<p style="color: black;">
											<a href="<?=base_url('dashboard/videoInkubasi/').$dt['id_detail_kelas'];?>" class="text-decoration-none" style="color: black;"><i class="fas fa-fw fa-link mr-2"></i></i><?=$judulLink[0];?></a>
											<span style="float:right;"><input class="checkSelesai form-check-input" type="checkbox" <?=$dt['progress'];?> disabled></span>
										</p>
									
									<?php elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'forum'):?>
										<p style="color: black;"><i class="fas fa-fw fa-comments mr-2"></i></i>Forum <?=$pt['nama'];?></p>
									
									<?php elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'feedback'):?>
										<p style="color: black; cursor: pointer;" id="feedback" onclick="feedback(this)" data-judul="Feedback <?=$pt['nama'];?>" data-deskripsi="<?=$dt['deskripsi'];?>">
											<i class="fas fa-fw fa-bullhorn mr-2"></i>Feedback <?=$pt['nama'];?>
											<span style="float:right;"><input class="checkSelesai form-check-input" type="checkbox" <?=$dt['progress'];?> disabled></span>
										</p>
									
									<?php elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'page'):?>
										<?php $judul = explode("(pageDelimiter)",$dt['deskripsi']);?>
										<p>
											<i class="far fa-fw fa-window-restore mr-2" style="color: black;"></i><a href="<?=base_url('dashboard/pageInkubasi/').$dt['id_detail_kelas'];?>" class="text-decoration-none" style="color: black;"><?=$judul[0]?></a>
											<span style="float:right;"><input class="checkSelesai form-check-input" type="checkbox" <?=$dt['progress'];?> disabled></span>
										</p>
									<?php endif;?>
								<?php endforeach;?>
							</div>
						</div>
					</div>
				<?php $i++;endforeach;?>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="modalFeedback" tabindex="-1" role="dialog" aria-labelledby="modalFeedbackLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalFeedbackLabel"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p id="modalFeedbackIsi"></p>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	function feedback(value){
		var isi = value.getAttribute('data-deskripsi');
		var judul = value.getAttribute('data-judul');
		document.getElementById('modalFeedbackLabel').innerHTML = judul;
		document.getElementById('modalFeedbackIsi').innerHTML = isi;
		$("#modalFeedback").modal("show");
	}
</script>