<section class="home-section">
	<div class="text container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7;">
				<li class="breadcrumb-item" class="text-decoration-none"  aria-current="page"><a href="<?=base_url('dashboard/penilaianMonev/');?>" class="text-decoration-none" style="color: #5A47AB;">Penilaian Monev</a></li>
			</ol>
		</nav>

		<div class="mx-5 mb-5 pr-5">
			<div class="head-home mt-3" style="border: solid 2px; border-color: #FBD15B;">
				<h2 class="pl-3" style="font-weight: 500; color: #5A47AB;">Penilaian Monev</h2>
			</div>

			<?= $this->session->flashdata('message');?>
			<div class="row">
				<div class="col-10 col-sm-6">
					<div><?=$periodeRekrutmen;?></div>
					<div><?=$periodeMonev;?></div>
				</div>
				<div class="col-10 col-sm-6">
					<a href="#" class="text-decoration-none p-1 mt-3" style="color: #5A47AB; background-color: #bfcbec; border-radius: 5px; font-size: 14px; float: right;" data-toggle="modal" data-target="#modalBukaMonev"><i class="fas fa-fw fa-plus-circle"></i> Buka Upload Monev</a><br>
					<div class="mt-3"><?=$status;?></div>
				</div>
			</div>
			<form class="form-inline mb-2" method="post" action="<?= base_url('dashboard/search')?>" style="float: right;">
		      <input class="form-control mr-sm-2 col-9" id="search" name="search" placeholder="Cari tenant">
		      <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit" id="submitSearch" value="penilaianMonev" name="btnSearch"><i class="fas fa-fw fa-search"></i></button>
		    </form>

			<div class="table-responsive mt-3">
				<table class="table text-center" style="font-size: 14px;">
					<thead style="background-color: #5A47AB; color: #FBD15B;">
						<tr>
							<th scope="col" style="">ID</th>
							<th scope="col">Nama Tenant</th>
							<th scope="col">Tanggal Dikirim</th>
							<th scope="col">Tanggal Penilaian</th>
							<th scope="col">Nilai</th>
							<th scope="col">Status</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody class="bg-white">
						<?php 
						$i=1;
						foreach($monev as $mn):?>
						<tr>
							<th scope="row"><?=$mn['nomor'];?></th>
							<td><?=$mn['id_tenant'];?></td>
							<td><?=$mn['tanggal_dikirim'];?></td>
							<td><?=$mn['tanggal_penilaian'];?></td>
							<td class="text-left">
								Nilai Coach : <?=$mn['nilai_coach'];?><br>
								Nilai Inkubator : <?=$mn['nilai_inkubator'];?>
								<?php if($mn['nilai_coach'] != "Belum Ada" && $mn['nilai_inkubator'] != "Belum Ada"):?>
									<br><strong>Nilai Total : <?=$mn['nilai_total'];?></strong>
								<?php endif;?>
							</td>
							<td>
								<?php if($mn['nilai_coach'] == "Belum Ada" || $mn['nilai_inkubator'] == "Belum Ada"):?>
									<div class="boxMerah text-center mb-1">Belum Dinilai</div>
									<div class="boxOrange mb-1 text-center">Coach : <?=$mn['coach'];?></div>
								<?php else:
									if($mn['status'] == 1):?>
										<div class="boxMerah mb-1 text-center">Tidak Lulus</div>
									<?php else:?>
										<div class="boxHijau mb-1 text-center">Lulus</div>
									<?php endif;?>
										<div class="boxOrange mb-1 text-center">Coach : <?=$mn['coach'];?></div>
								<?php endif;?>
								<div class="boxBiru mb-1 text-center">Pendamping : <?=$mn['pendamping'];?></div>
							</td>
							<td>
								<i class="fas fa-fw fa-pen mx-2" style="cursor: pointer;" onclick="window.location='<?=base_url('dashboard/formPenilaianMonev/').$mn['id_monev'];?>'"></i>
								<a href="#" class="mx-2 text-decoration-none" style="color: red;"><i class="far fa-fw fa-trash-alt" data-id="<?=$mn['id_monev'];?>" onclick="modalHapusMonev(this)"></i></a>
							</td>
						</tr>
						<?php $i++; endforeach;?>
					</tbody>
				</table>
			</div>
			<?= $this->pagination->create_links();?>
		</div>
	</div>
</section>

<div class="modal fade" id="modalBukaMonev" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Upload Rentang Monev</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('dashboard/bukaMonev')?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group row">
						<label for="dokumen" class="col-sm-4 col-form-label">Periode</label>
						<div class="col-sm-8">
							<select class="form-control" id="periode" name="periode" required>
								<option value="">Periode rekrutmen</option>
								<?php foreach($rekrutmen as $rt):?>
									<option value="<?= $rt['id_rekrutmen'];?>"><?= $rt['awal_rekrutmen'] . ' sd ' . $rt['akhir_rekrutmen'];?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="nama" class="col-sm-4 col-form-label">Pembukaan</label>
						<div class="col-sm-8">
							<input type="date" class="form-control" id="awal" name="awal" min="<?=date('Y-m-d')?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="nama" class="col-sm-4 col-form-label">Deadline</label>
						<div class="col-sm-8">
							<input type="date" class="form-control" id="akhir" name="akhir" min="<?=date('Y-m-d')?>">
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

<div class="modal fade" id="modalHapusMonev" tabindex="-1" role="dialog" aria-labelledby="modalHapusMonevLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalHapusMonevLabel">Hapus Coaching Log</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p id="modalHapusMonevIsi">Anda yakin ingin menghapus Monev ini?</p>
			</div>
			<div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <a href="" class="btn btn-danger" id="submitHapus">Hapus</a>
		    </div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function modalHapusMonev(a){
		var id_monev = a.getAttribute('data-id');
		document.getElementById('submitHapus').href = `<?=base_url('dashboard/hapusMonev/');?>`+id_monev;
		$('#modalHapusMonev').modal('show');
	}
</script>