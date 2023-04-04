<div class="container-fluid px-5">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-white" style="font-weight: 300;">
			<li class="breadcrumb-item"><a href="<?=base_url('user');?>" class="text-decoration-none text-muted">Beranda</a></li>
			<li class="breadcrumb-item text-muted" aria-current="page"><a href="<?=base_url('user/inkubasi');?>" class="text-decoration-none text-muted">Inkubasi</a></li>
		</ol>
	</nav>

	<div class="mx-5 mb-5">
		<div class="head-home my-3" style="border: solid 2px; border-color: #FBD15B;">
			<h2 style="font-weight: 500; padding: 5px;"><?=$dataKelas['kelas']['nama_kelas'];?> - <?=$dataKelas['tenant']['nama_tenant'];?><span class="persenKelas text-success" style="float: right; font-size: 15px;">Progress : <?=$dataKelas['enroll']['progress'];?>%</span></h2>
		</div>

		<div class="listPraInkubasi my-5">
			<?php $i=0;
			foreach($dataKelas['pertemuan'] as $pt):?>
				<div class="boxPraInkubasi mb-3" style="border: solid 1px #D8D8D8;">
					<label style="color: #5A47AB;font-size: 20px; font-weight: 600; border-bottom: solid 1px #D8D8D8; padding: 1%; background-color: #d8d8d8; margin-bottom: 0;" class="col-12"><?=$pt['nama']?><span class="persenDetail text-success" style="float: right; font-size:12px;">Progress : <?=$progress[$i]?>%</span></label>
					<div class="boxDalamPraInkubasi" style="padding: 1.5%; padding-bottom: 0; padding-right: 0; background-color: white; font-size: 14px;">
						<div style="min-height: 200px;">
							<p style="color: black;"><?=$pt['deskripsi'];?></p>
							<?php foreach($detailKelas as $dt):?>
								<?php if($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'dokumen'):?>
									<p>
										<a href="<?=base_url('assets/dokumen/kelas/dokumen/').$dt['file'];?>" style="color: black;" download>
											<i class="fas fa-fw fa-file-pdf mr-2"></i><?=$dt['deskripsi'];?>
										</a>
										<span class="text-muted ml-1">22kb</span>
										<span style="float:right;">
											<input class="checkSelesai form-check-input" type="checkbox" value="<?= $dt['status'];?>" id="<?= $dt['id_detail_kelas'];?>" data-id="<?= $dt['id_detail_kelas'];?>" onclick="checkSudah(this)">
										</span>
									</p>
								
								<?php elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'assignment'):?>
									<?php $judul = explode("(assignmentDelimiter)",$dt['deskripsi']);?>
									<p>
										<a href="<?=base_url('user/tugasInkubasi/').$dt['id_detail_kelas'].'/'.$dataKelas['tenant']['id_tenant'];?>" class="text-decoration-none" style="color: black;">
											<i class="fas fa-fw fa-clipboard-list mr-2"></i><?=$judul[0];?>
										</a>
										<span style="float:right;">
											<input class="checkSelesai form-check-input" id="<?= $dt['id_detail_kelas'];?>" type="checkbox" value="<?=$dt['status'];?>" data-id="<?= $dt['id_detail_kelas'];?>" disabled>
										</span>
									</p>
								
								<?php elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'link'):?>
									<?php $judulLink = explode("(linkDelimiter)",$dt['deskripsi']);?>
									<p style="color: black;">
										<a href="<?=base_url('user/videoInkubasi/').$dt['id_detail_kelas'];?>" class="text-decoration-none" style="color: black;">
											<i class="fas fa-fw fa-link mr-2"></i></i><?=$judulLink[0];?>
										</a>
										<span style="float:right;">
											<input class="checkSelesai form-check-input" type="checkbox"  value="<?= $dt['status'];?>" data-id="<?= $dt['id_detail_kelas'];?>" id="<?= $dt['id_detail_kelas'];?>" onclick="checkSudah(this)">
										</span>
									</p>
								
								<?php elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'forum'):?>
									<p style="color: black;">
										<i class="fas fa-fw fa-comments mr-2"></i>Forum <?=$pt['nama'];?>
										<span style="float:right;">
											<input class="checkSelesai form-check-input" id="<?= $dt['id_detail_kelas'];?>" type="checkbox" value="<?= $dt['status'];?>" data-id="<?= $dt['id_detail_kelas'];?>" onclick="checkSudah(this)">
										</span>
									</p>
								
								<?php elseif($pt['id_pertemuan_kelas'] == $dt['id_pertemuan_kelas'] && $dt['jenis'] == 'feedback'):?>
									<p>
										<a style="color: black; cursor: pointer; text-decoration: none;" id="feedback" onclick="feedback(this)" data-judul="Feedback <?=$pt['nama'];?>" data-deskripsi="<?=$dt['deskripsi'];?>">
											<i class="fas fa-fw fa-bullhorn mr-2"></i>Feedback <?=$pt['nama'];?>
										</a>
										<span style="float:right;">
											<input class="checkSelesai form-check-input" id="<?= $dt['id_detail_kelas'];?>" type="checkbox" value="<?= $dt['status'];?>" data-id="<?= $dt['id_detail_kelas'];?>" onclick="checkSudah(this)">
										</span>
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

	var checkselesai = document.getElementsByClassName('checkSelesai');
	var count = checkselesai.length;
	for (var x = 0; x < count; x++) {
		if (checkselesai[x].value == 1) {
			checkselesai[x].checked= true;
		}else{
			checkselesai[x].checked= false;
		}
	}

	function feedback(value){
		var isi = value.getAttribute('data-deskripsi');
		var judul = value.getAttribute('data-judul');
		document.getElementById('modalFeedbackLabel').innerHTML = judul;
		document.getElementById('modalFeedbackIsi').innerHTML = isi;
		$("#modalFeedback").modal("show");
	}

	function checkSudah(data){
		var id = data.getAttribute('data-id');
		var id_tenant = '<?=$dataKelas['tenant']['id_tenant'];?>';
		console.log(id);
		console.log(id_tenant);

		$.ajax({
            url: "<?= base_url(); ?>user/check_selesaiInkubasi",
            method: 'POST',
            data: {
            	id: id,
            	id_tenant: id_tenant,
            },
            dataType:"JSON",
            success: function(data) {
            	console.log(data.valueSent);
            	load_persen();
            }
        });	
	}

	function load_persen(){
		var id = "<?=$dataKelas['kelas']['id_kelas_coaching'];?>";
		var id_tenant = '<?=$dataKelas['tenant']['id_tenant'];?>';
		$.ajax({
            url: "<?= base_url(); ?>user/load_persenInkubasi/"+id+"/"+id_tenant,
            dataType:"JSON",
            success: function(data) {
            	document.getElementsByClassName('persenDetail')[0].innerHTML = 'Progress : ' + data.progress[0] + '%';
            	document.getElementsByClassName('persenDetail')[1].innerHTML = 'Progress : ' + data.progress[1] + '%';
            	document.getElementsByClassName('persenKelas')[0].innerHTML = 'Progress : ' + data.progress[2] + '%';
            	console.log(data.progress);
            }
        });
	}
</script>