<section class="home-section">
	<div class="text container-fluid px-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7;">
				<li class="breadcrumb-item" style="color: #5A47AB;">Kelas</li>
				<li class="breadcrumb-item" class="text-decoration-none"><a href="<?=base_url('dashboard/praInkubasi');?>" class="text-decoration-none" style="color: #5A47AB;">Pra Inkubasi</a></li>
				<li class="breadcrumb-item" class="text-decoration-none"  aria-current="page"><a href="<?=base_url('dashboard/detailPraInkubasi/').$kelas['id_kelas_training'];?>" class="text-decoration-none" style="color: #5A47AB;"><?=$kelas['nama_kelas'];?></a></li>
			</ol>
		</nav>

		<div class="mx-5 mb-5 pr-5">
			<div class="head-home mt-3" style="border: solid 2px; border-color: #FBD15B;">
				<h2 class="pl-3" style="font-weight: 500; color: #5A47AB;"><?= $kelas['nama_kelas'];?></h2>
			</div>

			<div class="row no-gutters">
				<div class="col-sm-5">
					<a href="<?=base_url('dashboard/buatPertemuanTraining/').$kelas['id_kelas_training'];?>" class="text-decoration-none p-1" style="color: #5A47AB; background-color: #bfcbec; border-radius: 5px; font-size: 14px;"><i class="fas fa-fw fa-plus-circle"></i> Buat Pertemuan Training</a>
				</div>
				<div class="col-sm-6 offset-1">
					<form method="post" action="<?=base_url('dashboard/detailUserPraInkubasi')?>">
						<div class="form-inline">
							<select class="form-control col-6 col-sm-4 offset-6 offset-sm-6 my-2 mr-2" style="background-color: #F2F2F2;" name="pilihTenant" id="pilihTenant" required>
								<option value="">Pilih Tenant</option>
								<?php foreach($tenant as $tn):?>
									<option value="<?=$tn['id_tenant'];?>"><?=$tn['nama_tenant'];?></option>
								<?php endforeach;?>
							</select>
							<button type="submit" class="btn btn-secondary my-2">Submit</button>
						</div>
					</form>
				</div>
			</div>


			<div class="listPraInkubasi my-5">
				<?php foreach($pertemuan as $pt):?>
					<div class="boxPraInkubasi mb-3" style="border: solid 1px #D8D8D8;">
						<label style="color: #5A47AB;font-size: 20px; font-weight: 600; border-bottom: solid 1px #D8D8D8; padding: 1%; background-color: #d8d8d8; margin-bottom: 0;" class="col-12"><?=$pt['nama'];?><span>
							<a href="#" style="float: right; font-weight: 300; font-size: 12px; text-decoration: none; color: red" data-pertemuan="<?= $pt['id_pertemuan_kelas']?>" data-nama="<?=$pt['nama'];?>" onclick="hapusPertemuan(this)"><i class="far fa-fw fa-trash-alt"></i> Hapus</a>
							<a class="mr-3" href="<?= base_url('dashboard/editPertemuanPraInkubasi/').$kelas['id_kelas_training'].'/'.$pt['id_pertemuan_kelas'];?>" style="float: right; font-weight: 300; font-size: 12px; text-decoration: none;"><i class="fas fa-fw fa-pen"></i> Edit</a>
						</span></label>
						<div class="boxDalamPraInkubasi" style="padding: 1.5%; padding-bottom: 0; padding-right: 0; background-color: white; font-size: 14px;">
							<div style="min-height: 200px;">
								<p style="color: black;"><?=$pt['deskripsi'];?></p>
								<?php foreach($detail as $dt):?>
									<?php if($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'dokumen'):?>
										<p style="color: black;"><a href="<?=base_url('assets/dokumen/kelas/dokumen/').$dt['file'];?>" download><i class="fas fa-fw fa-file-pdf mr-2"></i> <?=$dt['deskripsi'];?></a> <span class="text-muted ml-1">22kb</span></p>
									
									<?php elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'assignment'):?>
										<?php $judul = explode("(assignmentDelimiter)",$dt['deskripsi']);?>
										<p><a href="<?=base_url('dashboard/tugasPraInkubasi/').$dt['id_detail_kelas'];?>" class="text-decoration-none" style="color: black;"><i class="fas fa-fw fa-clipboard-list mr-2"></i></i><?=$judul[0];?></a></p>
									
									<?php elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'link'):?>
										<?php $judulLink = explode("(linkDelimiter)",$dt['deskripsi']);?>
										<p style="color: black;"><a href="<?=base_url('dashboard/videoPraInkubasi/').$dt['id_detail_kelas'];?>" class="text-decoration-none" style="color: black;"><i class="fas fa-fw fa-link mr-2"></i></i><?= $judulLink[0];?></a></p>
									
									<?php elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'forum'):?>
										<p style="color: black;"><i class="fas fa-fw fa-comments mr-2"></i></i>Forum <?=$pt['nama'];?></p>
									
									<?php elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'feedback'):?>
										<p style="color: black; cursor: pointer;" id="feedback" onclick="feedback(this)" data-judul="Feedback <?=$pt['nama'];?>" data-deskripsi="<?=$dt['deskripsi'];?>"><i class="fas fa-fw fa-bullhorn mr-2"></i>Feedback <?=$pt['nama'];?></p>
									<?php endif;?>
								<?php endforeach;?>
							</div>
							<div class="col-10 offset-2 col-sm-3 offset-sm-9">
								<p class="mb-0" style="color: #5A47AB; text-align: right; cursor: pointer;" id="<?=$pt['id_pertemuan_kelas'];?>" onclick="modalTambah(this.id)"><i class="fas fa-fw fa-plus-circle"></i> Tambah Activity atau Pembelajaran</p>
							</div>
						</div>
					</div>
				<?php endforeach;?>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Activity atau Pembelajaran</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form>
				<div class="modal-body">
					<div class="row">
						<div class="col-4 mt-2">
							<img src="<?=base_url('assets/logo/logo-page-training.png');?>" class="modalTambahAttr img-fluid" style="margin-right: auto; margin-left: auto; display: block; max-width: 50%; max-height: 82px; cursor: pointer" onclick="tambahPage(this.id)">
							<p class="modalTambahAttr text-center" style="cursor: pointer" onclick="tambahPage(this.id)">Page</p>
						</div>
						<div class="col-4 mt-2">
							<img src="<?=base_url('assets/logo/logo-link-training.png');?>" class="modalTambahAttr img-fluid" style="margin-right: auto; margin-left: auto; display: block; max-width: 50%; max-height: 82px; cursor: pointer" onclick="tambahLink(this.id)">
							<p class="modalTambahAttr text-center" style="cursor: pointer" onclick="tambahLink(this.id)">Link</p>
						</div>
						<div class="col-4 mt-2">
							<img src="<?=base_url('assets/logo/logo-assignment-training.png');?>" class="modalTambahAttr img-fluid" style="margin-right: auto; margin-left: auto; display: block; max-width: 50%; max-height: 82px; cursor: pointer" onclick="tambahAssignment(this.id)">
							<p class="modalTambahAttr text-center" style="cursor: pointer" onclick="tambahAssignment(this.id)">Assignment</p>
						</div>
						<div class="col-4 mt-2">
							<img src="<?=base_url('assets/logo/logo-feedback-training.png');?>" class="modalTambahAttr img-fluid" style="margin-right: auto; margin-left: auto; display: block; max-width: 50%; max-height: 82px; cursor: pointer" onclick="tambahFeedback(this.id)">
							<p class="modalTambahAttr text-center" style="cursor: pointer" onclick="tambahFeedback(this.id)">Feedback</p>
						</div>
						<div class="col-4 mt-2">
							<img src="<?=base_url('assets/logo/logo-dokumen-training.png');?>" class="modalTambahAttr img-fluid" style="margin-right: auto; margin-left: auto; display: block; max-width: 50%; max-height: 82px; cursor: pointer" onclick="tambahDokumen(this.id)">
							<p class="modalTambahAttr text-center" style="cursor: pointer" onclick="tambahDokumen(this.id)">Materi</p>
						</div>
						<div class="col-4 mt-2">
							<img src="<?=base_url('assets/logo/logo-forum-training.png');?>" class="modalTambahAttr img-fluid" style="margin-right: auto; margin-left: auto; display: block; max-width: 50%; max-height: 82px; cursor: pointer" onclick="tambahForum(this.id)">
							<p class="modalTambahAttr text-center" style="cursor: pointer" onclick="tambahForum(this.id)">Forum</p>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalTambahDokumen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Dokumen</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('dashboard/submitDokumenPraInkubasi')?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group row">
						<label for="link" class="col-sm-3 col-form-label">Nama Materi</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama materi" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="dokumen" class="col-sm-3 col-form-label">Dokumen</label>
						<div class="col-sm-9">
							<input type="file" id="dokumen" name="dokumen">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-dark" id="submitDokumen" name="submit">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalTambahLink" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Link</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('dashboard/submitLinkPraInkubasi');?>">
				<div class="modal-body">
					<div class="form-group row">
						<label for="link" class="col-sm-3 col-form-label">Nama Link Video</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama link" required>
						</div>
					</div>
					<div class="form-group row">
						<label for="link" class="col-sm-3 col-form-label">Link Video</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="link" name="link" placeholder="Link Video" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-dark" id="submitLink" name="submit">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalTambahFeedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Feedback</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('dashboard/submitFeedbackPraInkubasi');?>">
				<div class="modal-body">
					<div class="form-group row">
						<label for="feedback" class="col-sm-3 col-form-label">Feedback</label>
						<div class="col-sm-9">
							<textarea class="form-control" id="feedback" rows=3 name="feedback" placeholder="Feedback"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-dark" id="submitFeedback" name="submit">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalTambahAssignment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Assignment</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('dashboard/submitTugasPraInkubasi');?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group row">
						<label for="nama" class="col-sm-3 col-form-label">Nama Assignment</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Assignment">
							<?=form_error('nama','<small class="text-danger pl-1">','</small>');?>
						</div>
					</div>
					<div class="form-group row">
						<label for="deskripsi" class="col-sm-3 col-form-label">Deskripsi Assignment</label>
						<div class="col-sm-9">
							<textarea class="form-control" id="deskripsi" rows=3 name="deskripsi" placeholder="Deskripsi"></textarea>
							<?=form_error('deskripsi','<small class="text-danger pl-1">','</small>');?>
						</div>
					</div>
					<div class="form-group row">
						<label for="dokumen" class="col-sm-3 col-form-label">Dokumen</label>
						<div class="col-sm-9">
							<input type="file" id="dokumen" name="dokumen">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-dark" id="submitAssignment" name="submit">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

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

<div class="modal fade" id="modalHapusPertemuan" tabindex="-1" role="dialog" aria-labelledby="modalHapusPertemuanLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalHapusPertemuanLabel">Hapus Pertemuan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p id="modalHapusPertemuanIsi"></p>
			</div>
			<div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <a href="" class="btn btn-danger" id="submitHapusPertemuan">Hapus</a>
		    </div>
		</div>
	</div>
</div>

<!-- <div class="modal fade" id="modalEditPertemuan" tabindex="-1" role="dialog" aria-labelledby="modalEditPertemuanLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalEditPertemuanLabel">Edit Pertemuan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('dashboard/editPertemuan/').$kelas['id_kelas_training'];?>">
				<div class="modal-body">
					<div class="form-group row">
						<label for="namaPertemuan" class="col-sm-4 col-form-label">Nama Pertemuan</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="namaPertemuan" name="namaPertemuan" placeholder="Nama Pertemuan" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-dark" id="submitEditPertemuan" name="submitEditPertemuan">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div> -->

<script type="text/javascript">

	function modalTambah($id){
		var id = $id;
		for (var i = 0; i < 12; i++) {
			document.getElementsByClassName('modalTambahAttr')[i].id = id;
		}
		$('#exampleModal').modal('show');
	}

	function tambahPage($id){
		var id = $id;
		window.location.href = "<?=base_url('dashboard/editPagePraInkubasi/');?>" + id;
	}

	function tambahLink($id){
		$('#exampleModal').modal('hide');
		document.getElementById('submitLink').value = $id;
		$('#modalTambahLink').modal('show');
	}

	function tambahDokumen($id){
		$('#exampleModal').modal('hide');
		document.getElementById('submitDokumen').value = $id;
		$('#modalTambahDokumen').modal('show');
	}

	function tambahFeedback($id){
		$('#exampleModal').modal('hide');
		document.getElementById('submitFeedback').value = $id;
		$('#modalTambahFeedback').modal('show');
	}

	function tambahAssignment($id){
		$('#exampleModal').modal('hide');
		document.getElementById('submitAssignment').value = $id;
		$('#modalTambahAssignment').modal('show');
	}

	// function editPertemuan(data){
	// 	document.getElementById('submitEditPertemuan').value = data.getAttribute('data-id');
	// 	document.getElementById('namaPertemuan').value = data.getAttribute('data-nama');
	// 	$('#modalEditPertemuan').modal('show');
	// }

	function hapusPertemuan(a){
		var id_pertemuan = a.getAttribute('data-pertemuan');
		var nama = a.getAttribute('data-nama');
		document.getElementById('submitHapusPertemuan').href = `<?=base_url('dashboard/hapusPertemuan/')?>`+id_pertemuan;
		document.getElementById('modalHapusPertemuanIsi').innerHTML = 'Anda yakin ingin menghapus pertemuan <strong>'+nama+'</strong> ?';
		$('#modalHapusPertemuan').modal('show');
	}

	function feedback(value){
		var isi = value.getAttribute('data-deskripsi');
		var judul = value.getAttribute('data-judul');
		document.getElementById('modalFeedbackLabel').innerHTML = judul;
		document.getElementById('modalFeedbackIsi').innerHTML = isi;
		$("#modalFeedback").modal("show");
	}
</script>