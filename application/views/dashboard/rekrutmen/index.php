<section class="home-section">
	<div class="text container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7;">
				<li class="breadcrumb-item"><a href="<?=base_url('dashboard/rekrutmen');?>" class="text-decoration-none" style="color: #5A47AB;">Rekrutmen</a></li>
			</ol>
		</nav>

		<div class="container-fluid pr-5">
			<?= $this->session->flashdata('message');?>
			<a href="#" class="text-decoration-none p-1" style="color: #5A47AB; background-color: #bfcbec; border-radius: 5px; font-size: 14px; float: right;" data-toggle="modal" data-target="#modalBukaPendaftaran"><i class="fas fa-fw fa-plus-circle"></i> Buka Pendaftaran Tenant</a><br>
			<?=$status;?>

			<form class="form-inline mb-2" method="post" action="<?= base_url('dashboard/search')?>" style="float: right;">
		      <input class="form-control mr-sm-2 col-9" id="search" name="search" placeholder="Cari tenant">
		      <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit" id="submitSearch" value="rekrutmen" name="btnSearch"><i class="fas fa-fw fa-search"></i></button>
		    </form>
			<div class="table-responsive mb-3">
				<table class="table text-center" style="font-size: 14px;">
					<thead style="background-color: #5A47AB; color: #FBD15B;">
						<tr>
							<th scope="col" style="">No</th>
							<th scope="col">Nama Tenant</th>
							<th scope="col">Tanggal Pendaftaran</th>
							<th scope="col">Bidang Usaha</th>
							<th scope="col">Status</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody class="bg-white">
						<?php 
						$i=1;
						foreach($tenant as $tn):?>
						<tr>
							<th scope="row"><?=$tn['nomor'];?></th>
							<td><?=$tn['nama_tenant']?></td>
							<td><?=$tn['waktu'];?></td>
							<td><?=$tn['bidang_usaha'];?></td>
							<td>
								<?php if($tn['status']==1):?>
									<div class="boxOrange mb-1 text-center">Belum Dinilai</div>
								<?php elseif($tn['status']==2):?>
									<div class="boxHijauTua mb-1 text-center">Lolos Tahap 1</div>
								<?php elseif($tn['status'] == 3 || $tn['status'] == 4|| $tn['status'] == 5):?>
									<div class="boxHijau mb-1 text-center">Diterima</div>
									<?php if($tn['kontrak']!=""):?>
										<div class="boxBiru mb-1 text-center" style="cursor: pointer;" onclick="window.location='<?=base_url('dashboard/kontrakTenant/').$tn['id_tenant']?>'">Kontrak Tenant</div>
									<?php else:?>
										<div class="boxBiru mb-1 text-center" style="cursor: pointer;" data-toggle="modal" data-target="#modalBelumUpload">Kontrak Tenant</div>
									<?php endif;?>
								<?php elseif($tn['status']==0):?>
									<div class="boxMerah mb-1 text-center">Tidak Diterima</div>
								<?php endif;?>
							</td>
							<td>
								<a href="<?=base_url('dashboard/detailTenant/').$tn['id_tenant'];?>" class="mx-2 text-decoration-none"><i class="far fa-fw fa-eye mx-2" style="color: #5A47AB; cursor: pointer;"></i></a>
								<?php if($tn['status']==1):?>
									<i class="fas fa-fw fa-pen mx-2" style="cursor: pointer;" onclick="window.location='<?=base_url('dashboard/penilaianTenant1/').$tn['id_tenant'];?>'"></i> 
								<?php elseif($tn['status']==2):?>
									<i class="fas fa-fw fa-pen mx-2" style="cursor: pointer;" onclick="window.location='<?=base_url('dashboard/penilaianTenant2/').$tn['id_tenant'];?>'"></i> 
								<?php elseif($tn['status'] == 0):?>
									<a href="#" class="mx-2 text-decoration-none" style="color: red;" data-id="<?=$tn['id_tenant'];?>" onclick="modalHapus(this)"><i class="far fa-fw fa-trash-alt"></i></a>
								<?php endif;?>
							</td>
						</tr>
						<?php 
						$i++;
						endforeach;?>
						</tbody>
					</table>
				</div>
				<?= $this->pagination->create_links();?>
		</div>
	</div>
</section>

<div class="modal fade" id="modalBukaPendaftaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Buka Pendaftaran Tenant</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('dashboard/pembukaanRekrutmen')?>">
				<div class="modal-body">
					<div class="form-group row">
						<label for="nama" class="col-sm-5 col-form-label">Awal Periode</label>
						<div class="col-sm-7">
							<input type="date" class="form-control" id="awal" name="awal" min="<?=date('Y-m-d')?>">
						</div>
					</div>
					<div class="form-group row">
						<label for="nama" class="col-sm-5 col-form-label">Akhir Periode</label>
						<div class="col-sm-7">
							<input type="date" class="form-control" id="akhir" name="akhir" min="<?=date('Y-m-d')?>">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-dark">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalBelumUpload">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <p>User belum melakukan upload.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalHapusLabel">Hapus Tenant</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p id="modalHapusIsi">Anda yakin ingin menghapus Tenant ini?</p>
			</div>
			<div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <a href="" class="btn btn-danger" id="submitHapus">Hapus</a>
		    </div>
		</div>
	</div>
</div>

<script type="text/javascript">
<?php if($this->session->userdata('penilaian')!= NULL):?>
	$(document).ready(function(){
		console.log('masuk');
		$('#modalBelumUpload').modal('show');
	});
<?php $this->session->unset_userdata('penilaian');
endif;
?>

	function modalHapus(a){
		var id = a.getAttribute('data-id');
		document.getElementById('submitHapus').href = `<?=base_url('dashboard/hapusTenant/')?>`+id;
		$('#modalHapus').modal('show');
	}
</script>