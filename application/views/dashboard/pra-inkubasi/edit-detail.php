<section class="home-section">
	<div class="text container-fluid px-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7;">
				<li class="breadcrumb-item" style="color: #5A47AB;">Kelas</li>
				<li class="breadcrumb-item" class="text-decoration-none"  aria-current="page"><a href="<?=base_url('dashboard/praInkubasi');?>" class="text-decoration-none" style="color: #5A47AB;">Pra-Inkubasi</a></li>
			</ol>
		</nav>

		<div class="mx-5 mb-5 pr-5">
			<div class="head-home mt-3" style="border: solid 2px; border-color: #FBD15B;">
				<h2 class="pl-3" style="font-weight: 500; color: #5A47AB;">Edit Pertemuan - <?=$pertemuan['nama']?></h2>
			</div>

			<?= $this->session->flashdata('message');?>

			<div class="my-5">
				<div class="mb-3" style="background-color: white; border-radius: 5px;">
					<label style="font-size: 20px; font-weight: 600; padding: 1%; color: #5A47AB; margin-bottom: 0;" class="col-12">Assignment</label>
					<?php $i = 1; 
					foreach($assignment as $as):
						$explodeAs = explode('(assignmentDelimiter)',$as['deskripsi']);?>
						<div class="<?=$as['jenis'].$as['id_detail_kelas'];?>">
							<form method="post" action="<?=base_url('dashboard/editDetailPertemuan/'.$as['id_detail_kelas'].'/'.$as['jenis']);?>" enctype="multipart/form-data" class="<?=$as['jenis'].$as['id_detail_kelas'];?>">
								<div class="boxDalamPraInkubasi px-4" style="padding: 1%; font-size: 14px; background-color: white;">
									<p id="<?=$as['jenis'].$as['id_detail_kelas'];?>">Assignment <?=$i;?></p>
									<div class="form-group">
										<label for="nama">Nama</label>
										<input type="text" class="form-control col-6" id="nama" name="nama" placeholder="Nama" value="<?=$explodeAs[0];?>" required>
									</div>
									<div class="form-group">
										<label for="deskripsi">Deskripsi</label>
										<textarea rows="3" class="form-control col-8" id="deskripsi" name="deskripsi" placeholder="Deskripsi" required><?=$explodeAs[1];?></textarea>
									</div>
									<div class="form-group">
										<label for="file">File Materi</label><br>
										<a href="<?=base_url('assets/dokumen/kelas/dokumen/').$as['file'];?>" download><?=$as['file'];?></a>
										<input class="col-8" type="file" name="dokumen" id="dokumen">
									</div>
									<div class="row">
										<button class="btn btn-dark ml-3" type="submit">Simpan</button>
										<button type="button" class="btn btn-danger ml-3" data-id="<?=$as['id_detail_kelas'];?>" data-jenis="<?=$as['jenis'];?>" onclick="hapusDetail(this)">Hapus</button>
									</div>
								</div>
							</form>
						</div>
					<?php $i++; endforeach;?>
				</div>
			</div>

			<div class="my-5">
				<div class="mb-3" style="background-color: white; border-radius: 5px;">
					<label style="font-size: 20px; font-weight: 600; padding: 1%; color: #5A47AB; margin-bottom: 0;" class="col-12">Link Video</label>
					<?php $i = 1; 
					foreach($link as $lk):
						$explodeLk = explode('(linkDelimiter)',$lk['deskripsi']);?>
						<div class="<?=$lk['jenis'].$lk['id_detail_kelas'];?>">
							<form method="post" action="<?=base_url('dashboard/editDetailPertemuan/'.$lk['id_detail_kelas'].'/'.$lk['jenis']);?>">
								<div class="boxDalamPraInkubasi px-4" style="padding: 1%; font-size: 14px; background-color: white;">
									<p id="<?=$lk['jenis'].$lk['id_detail_kelas'];?>">Link Video <?=$i;?></p>
									<div class="form-group">
										<label for="nama">Nama Link Video</label>
										<input type="text" class="form-control col-6" id="nama" name="nama" placeholder="Nama" value="<?=$explodeLk[0];?>" required>
									</div>
									<div class="form-group">
										<label for="deskripsi">Link Video</label>
										<input type="text" class="form-control col-6" id="link" name="link" placeholder="Link Video" value="https://www.youtube.com/watch?v=<?=$explodeLk[1];?>" required>
									</div>
									<div class="row">
										<button class="btn btn-dark ml-3" type="submit">Simpan</button>
										<button type="button" class="btn btn-danger ml-3" data-id="<?=$lk['id_detail_kelas'];?>" data-jenis="<?=$lk['jenis'];?>" onclick="hapusDetail(this)">Hapus</button>
									</div>
								</div>
							</form>
						</div>
					<?php $i++; endforeach;?>
				</div>
			</div>

			<div class="my-5">
				<div class="mb-3" style="background-color: white; border-radius: 5px;">
					<label style="font-size: 20px; font-weight: 600; padding: 1%; color: #5A47AB; margin-bottom: 0;" class="col-12">Dokumen Materi</label>
					<?php $i = 1; 
					foreach($dokumen as $dk):?>
						<div class="<?=$dk['jenis'].$dk['id_detail_kelas'];?>">
							<form method="post" action="<?=base_url('dashboard/editDetailPertemuan/'.$dk['id_detail_kelas'].'/'.$dk['jenis']);?>" enctype="multipart/form-data">
								<div class="boxDalamPraInkubasi px-4" style="padding: 1%; font-size: 14px; background-color: white;">
									<p id="<?=$dk['jenis'].$dk['id_detail_kelas'];?>">Dokumen <?=$i;?></p>
									<div class="form-group">
										<label for="nama">Nama Dokumen</label>
										<input type="text" class="form-control col-6" id="nama" name="nama" placeholder="Nama" value="<?=$dk['deskripsi'];?>" required>
									</div>
									<div class="form-group">
										<label for="file">File Dokumen</label><br>
										<a href="<?=base_url('assets/dokumen/kelas/dokumen/').$dk['file'];?>" download><?=$dk['file'];?></a>
										<input class="col-8" type="file" name="dokumen" id="dokumen">
									</div>
									<div class="row">
										<button class="btn btn-dark ml-3" type="submit">Simpan</button>
										<button type="button" class="btn btn-danger ml-3" data-id="<?=$dk['id_detail_kelas'];?>" data-jenis="<?=$dk['jenis'];?>" onclick="hapusDetail(this)">Hapus</button>
									</div>
								</div>
							</form>
						</div>
					<?php $i++; endforeach;?>
				</div>
			</div>

			<div class="my-5">
				<div class="mb-3" style="background-color: white; border-radius: 5px;">
					<label style="font-size: 20px; font-weight: 600; padding: 1%; color: #5A47AB; margin-bottom: 0;" class="col-12">Feedback</label>
					<?php $i = 1; 
					foreach($feedback as $fk):?>
						<div class="<?=$fk['jenis'].$fk['id_detail_kelas'];?>">
							<form method="post" action="<?=base_url('dashboard/editDetailPertemuan/'.$fk['id_detail_kelas'].'/'.$fk['jenis']);?>">
								<div class="boxDalamPraInkubasi px-4" style="padding: 1%; font-size: 14px; background-color: white;">
									<p id="<?=$fk['jenis'].$fk['id_detail_kelas'];?>">Feedback <?=$i;?></p>
									<div class="form-group">
										<label for="feedback">Feedback</label>
										<textarea rows="3" class="form-control col-8" id="feedback" name="feedback" placeholder="Feedback" required><?=$fk['deskripsi'];?></textarea>
									</div>
									<div class="row">
										<button class="btn btn-dark ml-3" type="submit">Simpan</button>
										<button type="button" class="btn btn-danger ml-3" data-id="<?=$fk['id_detail_kelas'];?>" data-jenis="<?=$fk['jenis'];?>" onclick="hapusDetail(this)">Hapus</button>
									</div>
								</div>
							</form>
						</div>
					<?php $i++; endforeach;?>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="modalHapusDetail" tabindex="-1" role="dialog" aria-labelledby="modalHapusDetailLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalHapusDetailLabel">Hapus Detail Kelas</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p id="modalHapusDetailIsi"></p>
			</div>
			<div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="button" class="btn btn-danger" id="submitHapusDetail" onclick="confirmHapusDetail(this)">Hapus</button>
		    </div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalSuksesHapus" tabindex="-1" role="dialog" aria-labelledby="modalSuksesHapusLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalSuksesHapusLabel">Hapus Detail Kelas</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p id="modalSuksesHapusIsi"></p>
			</div>
			<div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button></a>
		    </div>
		</div>
	</div>
</div>

<script type="text/javascript">

	function hapusDetail(a){
		var id_detail = a.getAttribute('data-id');
		var jenis = a.getAttribute('data-jenis');
		var nama = document.getElementById(jenis+id_detail).innerHTML;
		document.getElementById('submitHapusDetail').setAttribute('data-id',id_detail);
		document.getElementById('submitHapusDetail').setAttribute('data-jenis', jenis);
		document.getElementById('modalHapusDetailIsi').innerHTML = 'Anda yakin ingin menghapus pertemuan <strong>'+nama+'</strong> ?';
		$('#modalHapusDetail').modal('show');
	}

	function confirmHapusDetail(b){
		$('#modalHapusDetail').modal('hide');
		var id_detail = b.getAttribute('data-id');
		var jenis = b.getAttribute('data-jenis');
		var nama = document.getElementById(jenis+id_detail).innerHTML;

		$.ajax({
			url:"<?=base_url();?>/dashboard/hapusDetailPertemuan/"+id_detail+"/"+jenis,
			dataType:"JSON"
		});
		document.getElementsByClassName(jenis+id_detail)[0].innerHTML = '';
		document.getElementById('modalSuksesHapusIsi').innerHTML = 'Berhasil menghapus '+nama+'.';
		$('#modalSuksesHapus').modal('show');
	}
</script>