<style type="text/css">
	td{
		min-width: 150px;
	}
</style>
<section class="home-section">
	<div class="text container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7;">
				<li class="breadcrumb-item" class="text-decoration-none"  aria-current="page"><a href="<?=base_url('dashboard/coachingLog/');?>" class="text-decoration-none" style="color: #5A47AB;">Coaching Log</a></li>
			</ol>
		</nav>

		<div class="mx-5 mb-5 pr-5">
			<div class="head-home mt-3" style="border: solid 2px; border-color: #FBD15B;">
				<h2 class="pl-3" style="font-weight: 500; color: #5A47AB;">Coaching Log</h2>
			</div>

			<form class="form-inline mt-4 mb-2" method="post" action="<?= base_url('dashboard/search')?>" style="float: right;">
		      <input class="form-control mr-sm-2 col-9" id="search" name="search" placeholder="Cari tenant">
		      <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit" id="submitSearch" value="coachingLog" name="btnSearch"><i class="fas fa-fw fa-search"></i></button>
		    </form>

			<div class="table-responsive mt-5 mb-3">
				<table class="table" style="font-size: 14px;">
					<thead style="background-color: #5A47AB; color: #FBD15B;">
						<tr>
							<th scope="col">No</th>
							<th scope="col">Tenant</th>
							<th scope="col">Hasil sebelumnya</th>
							<th scope="col">Tujuan tahap ini</th>
							<th scope="col">Hasil yang ingin dicapai</th>
							<th scope="col">Hasil</th>
							<th scope="col">Tujuan tahap selanjutnya</th>
							<th scope="col" class=" text-center">Action</th>
						</tr>
					</thead>
					<tbody class="bg-white">
						<?php $i = 1; 
						foreach($coachingLog as $cl):?>
						<tr>
							<th scope="row"><?=$cl['nomor'];?></th>
							<td>
								<div class="boxHijau mb-1 text-center">Nama Tenant : <?= $cl['nama_tenant'];?></div>
								<div class="boxOrange text-center">Coach : <?= $cl['coach'];?></div>
								<div>Tanggal Lapor : <?=$cl['tanggal']?></div>
							</td>
							<td><?=$cl['hasil_sebelumnya']?></td>
							<td><?=$cl['tujuan_ini'];?></td>
							<td><?=$cl['hasil_ingin'];?></td>
							<td><?=$cl['hasil_dicapai'];?></td>
							<td><?=$cl['tujuan_selanjutnya'];?></td>
							<td>
								<div class="row no-gutters justify-content-center">
									<a href="<?=base_url('dashboard/detailCoachingLog/').$cl['id_coaching_log'];?>" class="mx-1 text-decoration-none" style="color: #5A47AB;">
										<i class="far fa-fw fa-eye"></i>
									</a>
									<a href="#" class="mx-1 text-decoration-none" style="color: red;" data-id="<?=$cl['id_coaching_log'];?>" onclick="modalHapus(this)"><i class="far fa-fw fa-trash-alt"></i></a>
								</div>
								<?php if($cl['feedback']==""):?>
									<a href="#" class="text-decoration-none" onclick="modalFeedback(this)" data-value="<?=$cl['id_coaching_log'];?>" data-type="tambah">
										<div class="boxHijau mt-2 text-center"><i class="fas fa-fw fa-plus-circle"></i> Tambah Feedback</div>
									</a>
								<?php else:?>
									<a href="#" class="text-decoration-none" onclick="modalFeedback(this)" data-value="<?=$cl['id_coaching_log'];?>" data-type="edit" data-row="<?=$i-1;?>">
										<div class="boxHijauTua mt-2 text-center"><i class="fas fa-fw fa-pen"></i> Ubah Feedback</div>
									</a>
								<?php endif;?>
							</td>
						</tr>
						<?php $i++;endforeach;?>
					</tbody>
				</table>
			</div>
			<?= $this->pagination->create_links();?>
		</div>
	</div>
</section>

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
		var type = data.getAttribute('data-type');
		
		if (type == 'tambah') {
			var html = `<form method="post" action="<?=base_url('dashboard/submitFeedbackCoachingLog');?>">`;
			html += `<div class="modal-body">`;
			html += `<div class="form-group row">`;
			html += `<label for="feedback" class="col-sm-3 col-form-label">Feedback</label>`;
			html += `<div class="col-sm-9">`;
			html += `<textarea class="form-control" id="feedback" rows=3 name="feedback" placeholder="Feedback"></textarea></div></div></div>`;
			html += `<div class="modal-footer">
						<button type="submit" class="btn btn-dark" id="submitFeedback" name="submit" value="`+id+`">Submit</button>
					</div></form>`;

			document.getElementById('isi-modal').innerHTML = html;
			$('#modalFeedback').modal('show');
		}else{
			$.ajax({
				url:"<?=base_url();?>/dashboard/getFeedbackCL/"+id,
				dataType:"JSON",
				success: function(data){
					var feedback = data;
					var html = `<form method="post" action="<?=base_url('dashboard/submitFeedbackCoachingLog');?>">`;
					html += `<div class="modal-body">`;
					html += `<div class="form-group row">`;
					html += `<label for="feedback" class="col-sm-3 col-form-label">Feedback</label>`;
					html += `<div class="col-sm-9">`;
					html += `<textarea class="form-control" id="feedback" rows=3 name="feedback" placeholder="Feedback">`+feedback+`</textarea></div></div></div>`;
					html += `<div class="modal-footer">
								<button type="submit" class="btn btn-dark" id="submitFeedback" name="submit" value="`+id+`">Submit</button>
							</div></form>`;
					document.getElementById('isi-modal').innerHTML = html;
					$('#modalFeedback').modal('show');
				}
			});
		}
	}

	function modalHapus(a){
		var id_cl = a.getAttribute('data-id');
		document.getElementById('submitHapus').href = `<?=base_url('dashboard/hapusCoachingLog/')?>`+id_cl;
		$('#modalHapusCL').modal('show');
	}
</script>