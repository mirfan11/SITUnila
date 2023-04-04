<section class="home-section">
	<div class="text container-fluid px-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7;">
				<li class="breadcrumb-item" style="color: #5A47AB;">Tenant</li>
				<li class="breadcrumb-item" class="text-decoration-none"  aria-current="page"><a href="<?=base_url('dashboard/tenant/');?>" class="text-decoration-none" style="color: #5A47AB;">Daftar Tenant</a></li>
			</ol>
		</nav>

		<div class="mx-5 mb-5 pr-5">
			<div class="head-home mt-3 mb-5" style="border: solid 2px; border-color: #FBD15B;">
				<h2 class="pl-3" style="font-weight: 500; color: #5A47AB;">Daftar Tenant</h2>
			</div>

		<form class="form-inline my-2" method="post" action="<?= base_url('dashboard/search')?>" style="float: right;">
	      <input class="form-control mr-sm-2 col-9" id="search" name="search" placeholder="Cari tenant">
	      <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit" id="submitSearch" value="tenant" name="btnSearch"><i class="fas fa-fw fa-search"></i></button>
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
						<th scope="col">Progress</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody class="bg-white" id="bodyTable">
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
								<?php elseif($tn['status']==3):?>
									<div class="boxHijau mb-1 text-center">Diterima</div>
									<?php if($tn['kontrak']!=""):?>
										<div class="boxBiru mb-1 text-center" style="cursor: pointer;" onclick="window.location='<?=base_url('dashboard/kontrakTenant/').$tn['id_tenant'];?>'">Kontrak Tenant</div>
									<?php else:?>
										<div class="boxBiru mb-1 text-center" style="cursor: pointer;" data-toggle="modal" data-target="#modalBelumUpload">Kontrak Tenant</div>
									<?php endif;?>
								<?php elseif($tn['status']==4 || $tn['status']==5):?>
									<div class="boxHijau mb-1 text-center">Diterima</div>
									<div class="boxBiru mb-1 text-center" style="cursor: pointer;" onclick="window.location='<?=base_url('dashboard/kontrakTenant/').$tn['id_tenant'];?>'">Kontrak Tenant</div>
									<div class="boxBiru mb-1 text-center">Pendamping : <?=$tn['pendamping'];?></div>
									<?php if($tn['status']==5 && $this->session->userdata('role_id') == 1):?>
										<div class="boxOrange mb-1 text-center" style="cursor: pointer;" id="<?=$tn['id_tenant'];?>" onclick="editPendamping(this.id)"><i class="fas fa-fw fa-pen mx-2"></i>Edit Penamping</div>
									<?php endif;?>
								<?php endif;?>
							</td>
							<td>
								<label>Pra-Inkubasi</label>
								<div class="progress">
								  <div class="progress-bar bg-success" role="progressbar" style="width: <?=$tn['progress']?>%;" aria-valuenow="<?=$tn['progress']?>" aria-valuemin="0" aria-valuemax="100"><?=$tn['progress']?>%</div>
								</div>
							</td>
							<td>
								<a href="<?=base_url('dashboard/detailTenant/').$tn['id_tenant'];?>" class="mx-2 text-decoration-none"><i class="far fa-fw fa-eye mx-2" style="color: #5A47AB; cursor: pointer;" data-toggle="modal" data-target="#exampleModal"></i></a>
								<?php if($tn['status'] == 0):?>
									<a href="" class="mx-2 text-decoration-none" style="color: red;"><i class="far fa-fw fa-trash-alt"></i></a>
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

<div class="modal fade" id="modalEditPendamping" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Pendamping Tenant</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('dashboard/editPendamping');?>">
				<div class="modal-body">
					<div class="form-group row">
						<label for="tenant" class="col-sm-5 col-form-label">Nama Tenant</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="tenant" name="tenant" placeholder="Forgos Coklat" readonly>
						</div>
					</div>
					<div class="form-group row">
						<label for="pendamping" class="col-sm-5 col-form-label">Nama Pendamping</label>
						<div class="col-sm-7">
							<select class="form-control" id="pendamping" name="pendamping">
								<option>Pilih pendamping</option>
								<?php foreach($pendamping as $pd):?>
									<option value="<?=$pd['id_user'];?>"><?=$pd['nama'];?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-dark" id="submitEditPendamping" name="submitEditPendamping">Submit</button>
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

<script type="text/javascript">

	function editPendamping($id){
		var id = $id;
		document.getElementById('submitEditPendamping').value = id;
		$("#modalEditPendamping").modal("show");
		console.log(document.getElementById('submitEditPendamping').value);
	}

	$(document).ready(function(){
		$(document).on('click', '.btnHapus', function() {
            var id = $(this).attr('id');
            console.log(id); // ambil nilai dr attribut id
            $.ajax({
            	url: "<?= base_url(); ?>dashboard/hapusPengumuman",
            	method: 'POST',
            	data: {
            		id: id
            	},
            	success: function(data) {
            		load_data();
            	}
            });
            $("#modalHapus").modal("hide");
        });
	});

	function search(){
		var key = document.getElementById('search').value;
		$.ajax({
            url: "<?= base_url(); ?>dashboard/searchTenant",
            method: 'POST',
            data: {
            	key: key
            },
            success: function(data) {
            	console.log(data);
            }
        });
	}
</script>