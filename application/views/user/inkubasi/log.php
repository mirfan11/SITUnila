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
		<div class="container-fluid mb-5">
			<a href="<?=base_url('user/tambahCoachingLog');?>" class="text-decoration-none p-1" style="color: #5A47AB; background-color: #F2F2F2; border-radius: 5px;"><i class="fas fa-fw fa-plus-circle"></i> Tambah Coaching Log</a>
		</div>
		
		<div style="background-color: #D8D8D8; padding: 0.5%; font-weight: 500;">
			Coaching Log
		</div>
		<div class="py-5 px-4" style="border: solid 1px #D8D8D8;">
			<div class="table-responsive">
				<table class="table table-borderless">
					<thead style="background-color: #5A47AB; color: #FBD15B;">
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Tenant</th>
							<th scope="col">Hasil sebelumnya</th>
							<th scope="col">Tujuan tahap ini</th>
							<th scope="col">Hasil yang ingin dicapai</th>
							<th scope="col">Hasil</th>
							<th scope="col">Tujuan tahap selanjutnya</th>
							<th scope="col" class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; 
						foreach($coachingLog as $cl):?>
							<tr>
								<th scope="row"><?=$cl['nomor'];?></th>
								<td>
									<div class="boxHijau mb-1 text-center">Nama Tenant : <?=$cl['nama_tenant']?></div>
									<div class="boxOrange text-center">Coach : <?= $cl['coach'];?></div>
									<div>Tanggal Lapor : <?=$cl['tanggal'];?></div>
								</td>
								<td><?=$cl['hasil_sebelumnya']?></td>
								<td><?=$cl['tujuan_ini'];?></td>
								<td><?=$cl['hasil_ingin'];?></td>
								<td><?=$cl['hasil_dicapai'];?></td>
								<td><?=$cl['tujuan_selanjutnya'];?></td>
								<td>
									<div class="row no-gutters justify-content-center">
										<a href="<?=base_url('user/detailCoachingLog/'.$cl['id_coaching_log']);?>" class="mx-1 text-decoration-none" style="color: #5A47AB; cursor: pointer;">
											<i class="far fa-fw fa-eye"></i>
										</a>
										<a href="<?=base_url('user/tugasCoachingLog/'.$cl['id_coaching_log'].'/'.$cl['id_tenant']);?>" class="mx-1 text-decoration-none" style="color: black; cursor: pointer;">
											<i class="fas fa-fw fa-pen"></i>
										</a>
										<?php if($cl['feedback']==""):?>
											<a href="#" class="mx-1 text-decoration-none" style="color: red;" data-id="<?=$cl['id_coaching_log'];?>" onclick="modalHapus(this)"><i class="far fa-fw fa-trash-alt"></i></a>
										<?php endif;?>
									</div>
									<?php if($cl['feedback']!=""):?>
										<a href="#" class="text-decoration-none" onclick="modalFeedback(this)" data-value="<?=$cl['id_coaching_log'];?>" data-row="<?=$i-1;?>">
											<div class="boxHijau mt-2 text-center py-2">Lihat Feedback</div>
										</a>
									<?php endif;?>
								</td>
							</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
			<?= $this->pagination->create_links();?>
		</div>

	</div>
</div>

<div class="modal fade" id="modalFeedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Feedback</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div id="isi-modal">
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalHapusCL" tabindex="-1" role="dialog" aria-labelledby="modalHapusCLLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalHapusCLLabel">Hapus Coaching Log</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p id="modalHapusCLIsi">Anda yakin ingin menghapus Coaching Log ini?</p>
			</div>
			<div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <a href="" class="btn btn-danger" id="submitHapus">Hapus</a>
		    </div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function modalFeedback(data){
		var id = data.getAttribute('data-value');
		$.ajax({
			url:"<?=base_url();?>/user/getFeedbackCL/"+id,
			dataType:"JSON",
			success: function(data){
				var feedback = data;
				var html = `<div class="modal-body mb-4">`;
				html += `<h4 class="mb-3">Feedback Coach</h4>`;
				html += `<div class="py-2 px-3" style="border-radius: 5px; background-color: #F1F1F1; min-height: 100px;"><p>`+feedback+`</p></div></div>`;
				document.getElementById('isi-modal').innerHTML = html;
				$('#modalFeedback').modal('show');
			}
		});
	}

	function modalHapus(a){
		var id_cl = a.getAttribute('data-id');
		document.getElementById('submitHapus').href = `<?=base_url('user/hapusCoachingLog/')?>`+id_cl;
		$('#modalHapusCL').modal('show');
	}
</script>