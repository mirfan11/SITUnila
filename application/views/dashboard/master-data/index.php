<section class="home-section">
	<div class="text container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7;">
				<li class="breadcrumb-item"><a href="<?=base_url('dashboard/masterData');?>" class="text-decoration-none" style="color: #5A47AB;">Master Data</a></li>
			</ol>
		</nav>

		<div class="container-fluid">
			<div class="col-6 pl-0" style="font-size: 14px;"><?= $this->session->flashdata('message');?></div>
			<a href="#" class="text-decoration-none p-1" style="color: #5A47AB; background-color: #bfcbec; border-radius: 5px; font-size: 14px;" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-fw fa-plus-circle"></i> Tambah Pengguna</a>


			<div class="table-responsive pr-5 mt-3">
				<table class="table text-center" style="font-size: 14px;">
					<thead style="background-color: #5A47AB; color: #FBD15B;">
						<tr>
							<th scope="col" style="">No</th>
							<th scope="col">Nama Pengguna</th>
							<th scope="col">Role</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody class="bg-white">
						<?php 
						$i=1;
						foreach($user as $us):?>
							<tr>
								<th scope="row"><?=$us['nomor'];?></th>
								<td><?=$us['nama'];?></td>
								<td><?=$us['role_id'];?></td>
								<td>
									<i class="fas fa-fw fa-pen mx-2" style="cursor: pointer;" onclick="editModal(this)" data-id="<?=$us['id_user'];?>" data-nama="<?=$us['nama'];?>" data-email="<?=$us['email'];?>" data-role="<?=$us['role_id'];?>"></i>
									<i class="far fa-fw fa-trash-alt mx-2 text-danger" style="cursor: pointer;" onclick="hapusModal(this)" data-id="<?=$us['id_user'];?>" data-nama="<?=$us['nama'];?>"></i>
								</td>
							</tr>
							<?php $i++;
						endforeach;
						?>
					</tbody>
				</table>
			</div>
			<?= $this->pagination->create_links();?>
		</div>

	</div>
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="">
				<div class="modal-body">
					<div class="form-group row">
						<label for="nama" class="col-sm-5 col-form-label">Nama Pengguna</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Pengguna">
							<?=form_error('nama','<small class="text-danger pl-1">','</small>');?>
						</div>
					</div>
					<div class="form-group row">
						<label for="email" class="col-sm-5 col-form-label">Email</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="email" name="email" placeholder="Email">
							<?=form_error('email','<small class="text-danger pl-1">','</small>');?>
						</div>
					</div>
					<div class="form-group row">
						<label for="role" class="col-sm-5 col-form-label">Role</label>
						<div class="col-sm-7">
							<select class="form-control" id="role" name="role">
								<option>Role</option>
								<option value="1">Inkubator</option>
								<option value="3">Pendamping</option>
								<option value="4">Mentor</option>
								<option value="5">Coach</option>
							</select>
							<?=form_error('role','<small class="text-danger pl-1">','</small>');?>
						</div>
					</div>
					<div class="form-group row">
						<label for="password1" class="col-sm-5 col-form-label">Password</label>
						<div class="col-sm-7">
							<input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
							<?=form_error('password1','<small class="text-danger pl-1">','</small>');?>
						</div>
					</div>
					<div class="form-group row">
						<label for="password2" class="col-sm-5 col-form-label">Konfirmasi Password</label>
						<div class="col-sm-7">
							<input type="password" class="form-control" id="password2" name="password2" placeholder="Ulangi password">
							<?=form_error('password2','<small class="text-danger pl-1">','</small>');?>
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

<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Pengguna</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" id="formEdit" action="">
				<div class="modal-body">
					<div class="form-group row">
						<label for="nama" class="col-sm-5 col-form-label">Nama Pengguna</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="namaEdit" name="namaEdit" placeholder="Nama Pengguna">
						</div>
					</div>
					<div class="form-group row">
						<label for="email" class="col-sm-5 col-form-label">Email</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" id="emailEdit" name="emailEdit" placeholder="Email">
						</div>
					</div>
					<div class="form-group row">
						<label for="role" class="col-sm-5 col-form-label">Role</label>
						<div class="col-sm-7">
							<select class="form-control" id="roleEdit" name="roleEdit">
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="password1" class="col-sm-5 col-form-label">Password</label>
						<div class="col-sm-7">
							<input type="password" class="form-control" id="passwordEdit1" name="passwordEdit1" placeholder="Password">
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

<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Pengguna</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p id="modalHapusIsi"></p>
			</div>
			<div class="modal-footer">
				<a class="btn btn-dark" id="submitHapus">Delete</a>
			</div>
		</form>
	</div>
</div>
</div>

<script type="text/javascript">
	function editModal(value){
		var id = value.getAttribute('data-id');
		var nama = value.getAttribute('data-nama');
		var email = value.getAttribute('data-email');
		var role = value.getAttribute('data-role');

		var innerRole;
		var valueRole;

		if (role === 'Inkubator') {
			innerRole = ["Inkubator", "Pendamping", "Mentor", "Coach"];
			valueRole = [1, 3, 4, 5];
		} else if (role ==='Pendamping'){
			innerRole = ['Pendamping', 'Inkubator', 'Mentor', 'Coach'];
			valueRole = [3, 1, 4, 5];
		} else if (role === 'Mentor'){
			innerRole = ['Mentor', 'Inkubator', 'Pendamping', 'Coach'];
			valueRole = [4, 1, 3, 5];
		} else if (role === 'Coach'){
			innerRole = ['Coach', 'Inkubator', 'Pendamping', 'Mentor'];
			valueRole = [5, 1, 3, 4];
		}

		var str = "";
		var i=0;
		for (var item of innerRole) {
			str += '<option value="' + valueRole[i] + '">' + innerRole[i] + '</option>';
			i++;
		}

		document.getElementById('namaEdit').value = nama;
		document.getElementById('emailEdit').value = email;
		document.getElementById('roleEdit').innerHTML = str;
		document.getElementById('formEdit').action = '<?=base_url('dashboard/editMasterData/')?>' + id;

		$("#modalEdit").modal("show");
	}

	function hapusModal(value){
		var id = value.getAttribute('data-id');
		var nama = value.getAttribute('data-nama');

		document.getElementById('modalHapusIsi').innerHTML = "Anda yakin ingin menghapus user " + nama + " ?";
		document.getElementById('submitHapus').setAttribute('href', "<?=base_url('dashboard/deleteMasterData/')?>" + id);

		$("#modalHapus").modal("show");	
	}
</script>