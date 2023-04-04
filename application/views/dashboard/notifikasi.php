<style type="text/css">
	div#boxNotif1{
		border: solid 1px #D8D8D8; 
		padding :2%; 
		background-color: white;
	}

	div#boxNotif2{
		border: solid 1px #D8D8D8; 
		padding :2%; 
		background-color: #D8D8D8;
	}
</style>

<section class="home-section">
	<div class="text container-fluid px-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7;">
				<li class="breadcrumb-item"><a href="<?=base_url('dashboard/notifikasi');?>" class="text-decoration-none" style="color: #5A47AB;">Notifikasi</a></li>
			</ol>
		</nav>

		<div class="mx-5 mb-5 pr-5">
			<div class="head-home my-3" style="border: solid 2px; border-color: #FBD15B;">
				<h2 class="pl-3" style="font-weight: 500; color: #5A47AB;">List Notifikasi</h2>
			</div>
			<?= $this->session->flashdata('message');?>

			<button type="button" id="btnMarkRead" class="btn btn-outline-success text-decoration-none p-1 mt-3" style=" border-radius: 5px; float: right;" onclick="readAll()">Tandai dibaca</button>

			<button type="button" id="btnMarkRead" class="btn btn-outline-info text-decoration-none p-1 mt-3 mr-3" style=" border-radius: 5px; float: right;" data-toggle="modal" data-target="#modalNotif">Buat Notifikasi</button><br>

			<div class="listNotif mt-5" style="font-size: 14px; color: black;">
				<?php foreach($notif as $nt):
					if($nt['status'] == 0):?>
						<div class="boxNotif mb-3" id="boxNotif1">
							<label style="font-weight: 700;"><img src="<?=base_url('assets/logo/avaInkubator.png')?>" style="max-width: 35px;"> <?=$nt['pengirim']?></label>
							<label style="float: right; font-weight: 300;"><?= $nt['waktu'];?></label>
							<div class="boxDalamNotif" style="padding: 1%;">
								<div class="row">
									<div class="col-11">
										<p style="color: black;"><?=$nt['isi'];?></p>
									</div>
									<div class="notifMark col-1">
										<span class="badge badge-pill badge-danger float-right">!</span>
									</div>
								</div>
								<?php if($nt['jenis'] == 'kontak-admin'):?>
									<a href="#" onclick="balasPesan(this)" data-id="<?=$nt['id_pengirim'];?>"><i class="fas fa-fw fa-reply"></i> Balas Pesan</a>
								<?php endif;?>
							</div>
						</div>
					<?php else:?>
						<div class="boxNotif mb-3" id="boxNotif2">
							<label style="font-weight: 700;"><img src="<?=base_url('assets/logo/avaInkubator.png')?>" style="max-width: 35px;"> <?=$nt['pengirim']?></label>
							<label style="float: right; font-weight: 300;"><?= $nt['waktu'];?></label>
							<div class="boxDalamNotif" style="padding: 1%;">
								<div class="row">
									<div class="col-11">
										<p style="color: black;"><?=$nt['isi'];?></p>
									</div>
									<div class="notifMark col-1">
									</div>
								</div>
								<?php if($nt['jenis'] == 'kontak-admin'):?>
									<a href="#" onclick="balasPesan(this)" data-id="<?=$nt['id_pengirim'];?>"><i class="fas fa-fw fa-reply"></i> Balas Pesan</a>
								<?php endif;?>
							</div>
						</div>
				<?php endif; 
				endforeach;?>
			</div>
			<?= $this->pagination->create_links();?>
		</div>
	</div>
</section>

<div class="modal fade" id="modalNotif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Buat Notifikasi</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('dashboard/pushNewNotification')?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group row jenisNotif">
						<label for="jenisNotif" class="col-sm-4 col-form-label">Jenis Notifikasi</label>
						<div class="col-sm-8">
							<select class="form-control" id="jenisNotif" name="jenisNotif" onchange="getFormNotif(this)" required>
							</select>
						</div>
					</div>
					<div id="formNotif">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-dark" id="btnSubmit" name="btnSubmit" value="link:0;file:0">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalReply" tabindex="-1" role="dialog" aria-labelledby="modalReplyLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalReplyLabel">Balas Pesan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('dashboard/kontakUser')?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group row">
						<label for="pesan" class="col-sm-4 col-form-label">Pesan</label>
						<div class="col-sm-8">
							<textarea class="form-control" id="pesan" name="pesan" required rows="4"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-dark" id="submitReply" name="submitReply" value="">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	var countNotif = '<?=$countNotif;?>';
	var role_id = `<?=$this->session->userdata('role_id');?>`;

	function disableButton(){
		var btnMark = document.getElementById('btnMarkRead');
		btnMark.classList.remove("btn-outline-success");
		btnMark.classList.add("btn-outline-secondary");
		btnMark.setAttribute("disabled", "true");
	}

	if (countNotif == 0) {
		disableButton()
	}

	function readAll(){
		var boxAktif = document.querySelectorAll('.boxNotif').length;
		var id_user = "<?=$this->session->userdata('id_user');?>";
		for (var i = 0; i < boxAktif; i++) {
			document.getElementsByClassName('boxNotif')[i].id = 'boxNotif2';
			document.getElementsByClassName('notifMark')[i].innerHTML = '';
		}

		$.ajax({
			url:"<?=base_url();?>/dashboard/readAll/"+id_user,
			dataType:"JSON"
		});
		disableButton();
		document.getElementById('notifCountHead').remove();
	}

	function checkRoleNotif(){
		var jenisNotif = ['Enrollment Kelas', 'Notifikasi Umum'];
		var valueJenisNotif = ['enroll', 'umum', 'coachinglog', 'uploadmonev'];

		if (role_id == 1 || role_id == 5) {
			var html = '<option value="">Pilih notifikasi disini...</option>';
			for (var i = 0; i < jenisNotif.length; i++) {
				html += '<option value="'+valueJenisNotif[i]+'">'+jenisNotif[i]+'</option>';
			}
		} else if(role_id == 3) {
			var html = '<option value="">Pilih notifikasi disini...</option>';
			for (var i = 0; i < jenisNotif.length; i++) {
				if (i != 0) {
					html += '<option value="'+valueJenisNotif[i]+'">'+jenisNotif[i]+'</option>';
				}
			}
		}
		document.getElementById('jenisNotif').innerHTML = html;
	}
	checkRoleNotif();

	function getFormNotif(data){
		var jenis = data.value;
		var formNotif = document.getElementById('formNotif');
		if (jenis == 'enroll') {
			if (role_id == 1) {
				formNotif.innerHTML = '';
				var divToCreate = document.createElement('div');
				divToCreate.className = 'jenisKelas';
				var html = '<div class="form-group row">';
				html += '<label for="jenisKelas" class="col-sm-4 col-form-label">Pilih jenis kelas</label>';
				html += `<div class="col-sm-8"><select class="form-control" id="jenisKelas" name="jenisKelas" onchange="getTenant('enroll',this.value)" required>`;
				html += '<option value="">Pilih jenis kelas disini...</option>';
				html += '<option value="training">Kelas Pra-Inkubasi</option>';
				html += '<option value="coaching">Kelas Inkubasi</option></select></div></div>';
				divToCreate.innerHTML = html;
				formNotif.appendChild(divToCreate);
			} else if(role_id == 5){
				getTenantEnroll('coaching');
			}
		} else if (jenis == 'umum'){
			formNotif.innerHTML = '';
			getTenant(jenis,jenis);
		}
	}

	function getTenant(jenis,data){
		var add = data;
		console.log(jenis);
		$.ajax({
			url:"<?=base_url();?>/dashboard/load_tenant/"+role_id+"/"+jenis+"/"+add,
			dataType:"JSON",
			success: function(newData){
				console.log(newData)
				if (jenis == 'enroll') {
					var formNotif = document.getElementById('formNotif');
					if (document.querySelectorAll('.innerForm').length > 0) {
						formNotif.removeChild(document.getElementsByClassName('innerForm')[0]);
					}
					var divToCreate = document.createElement('div');
					divToCreate.className = 'innerForm';
					var html = '<div class="form-group row">';
					html += '<label for="tenant" class="col-sm-4 col-form-label">Pilih tenant</label>';
					html += '<div class="col-sm-8"><select class="form-control" id="tenant" name="tenant" required>';
					html += '<option value="">Pilih tenant disini...</option>';
					for (var i = 0; i < newData.tenant.length; i++) {
						html += '<option value="'+newData.tenant[i].id_tenant+'">'+newData.tenant[i].nama_tenant+'</option>';
					}
					html += '</select></div></div>';
					html += '<div class="form-group row">';
					html += '<label for="kelas" class="col-sm-4 col-form-label">Pilih kelas</label>';
					html += '<div class="col-sm-8"><select class="form-control" id="kelas" name="kelas" required>';
					html += '<option value="">Pilih kelas disini...</option>';
					for (var i = 0; i < newData.kelas.length; i++) {
						html += '<option value="'+newData.kelas[i].nama_kelas+';'+newData.kelas[i].enroll_key+'">'+newData.kelas[i].nama_kelas+' - '+newData.kelas[i].enroll_key+'</option>';
					}
					html += '</select></div></div>';
					divToCreate.innerHTML = html;
					formNotif.appendChild(divToCreate);
				} else if (jenis == 'umum'){
					var formNotif = document.getElementById('formNotif');
					var divToCreate = document.createElement('div');
					divToCreate.className = 'innerForm';
					var html = '<div class="form-group row">';
					html += '<label for="tenant" class="col-sm-4 col-form-label">Pilih tenant</label>';
					html += '<div class="col-sm-8"><select class="form-control" id="tenant" name="tenant" required>';
					html += '<option value="">Pilih tenant disini...</option>';
					for (var i = 0; i < newData.tenant.length; i++) {
						html += '<option value="'+newData.tenant[i].id_tenant+'">'+newData.tenant[i].nama_tenant+'</option>';
					}
					html += '</select></div></div>';
					html += '<div class="form-group row">';
					html += '<label for="isi" class="col-sm-4 col-form-label">Isi Notifikasi</label>';
					html += '<div class="col-sm-8"><textarea class="form-control" id="isi" name="isi" rows=3 required></textarea>';
					html += '</div></div>';
					html += '<p><strong>Tambahkan tautan</strong></p>';
					html += '<div class="form-group row">';
  					html += '<label for="link" class="col-sm-4 col-form-label">Link</label>';
					html += '<div class="col-sm-8"><input type="text" class="form-control" name="link" placeholder="Link..."><small id="linkHelp" class="form-text text-muted">Boleh dikosongkan.</small></div></div>';
  					html += '<div class="form-group row">';
  					html += '<label for="file" class="col-sm-4 col-form-label">File</label>';
					html += '<div class="col-sm-8"><input type="file" name="file"><small id="fileHelp" class="form-text text-muted">Boleh dikosongkan.</small></div></div>';
					divToCreate.innerHTML = html;
					formNotif.appendChild(divToCreate);
				}
			}
		});
	}

	function tambahTautan(option){
		var formNotif = document.getElementById('formNotif');
		var valueBtn = document.getElementById('btnSubmit').value;
		var splitValueBtn = valueBtn.split(";");

		if (option == 'link') {
			var splitValueBtn2 = splitValueBtn[0].split(":");
			let totalLink = Number(splitValueBtn2[1]) + 1;
			var newValueBtn = "link:"+totalLink+";"+splitValueBtn[1];
			var divToCreate = document.createElement('div');
			divToCreate.className = 'tautan form-group row mt-3';
			var html = '<label for="link[]" class="col-sm-4 col-form-label">Link</label>';
			html += '<div class="col-sm-7"><input type="text" class="form-control" name="link[]" placeholder="Link..." required></div>';
			html += `<div class="col-sm-1"><i class="far fa-fw fa-trash-alt py-2 pr-3" style="color:red;" onclick="hapusTautan(this,'link')"></i></div>`;
			divToCreate.innerHTML = html;
		} else if (option == 'file'){
			var splitValueBtn2 = splitValueBtn[1].split(":");
			let totalLink = Number(splitValueBtn2[1]) + 1;
			var newValueBtn = splitValueBtn[0]+";file:"+totalLink;
			var divToCreate = document.createElement('div');
			divToCreate.className = 'tautan form-group row mt-3';
			var html = '<label for="file[]" class="col-sm-4 col-form-label">File</label>';
			html += '<div class="col-sm-7"><input type="file" name="file[]" required></div>';
			html += `<div class="col-sm-1"><i class="far fa-fw fa-trash-alt py-2 pr-3" style="color:red;" onclick="hapusTautan(this,'file')"></i></div>`;
			divToCreate.innerHTML = html;
		}
		document.getElementById('btnSubmit').value = newValueBtn;
		formNotif.appendChild(divToCreate);
		console.log(newValueBtn);
	}

	function hapusTautan(a,option){
		var valueBtn = document.getElementById('btnSubmit').value;
		var splitValueBtn = valueBtn.split(";");
		if (option == 'link') {
			var splitValueBtn2 = splitValueBtn[0].split(":");
			let totalLink = Number(splitValueBtn2[1]) - 1;
			var newValueBtn = "link:"+totalLink+";"+splitValueBtn[1];
		} else if (option == 'file'){
			var splitValueBtn2 = splitValueBtn[1].split(":");
			let totalLink = Number(splitValueBtn2[1]) - 1;
			var newValueBtn = splitValueBtn[0]+";file:"+totalLink;
		}
		document.getElementById('btnSubmit').value = newValueBtn;
		console.log(a.parentNode.parentNode)
		a.parentNode.parentNode.parentNode.removeChild(a.parentNode.parentNode);
	}

	function balasPesan(b){
		var id_user = b.getAttribute('data-id');
		document.getElementById('submitReply').value = id_user;
		$("#modalReply").modal("show");
	}
</script>