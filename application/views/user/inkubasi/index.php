<div class="container-fluid px-5">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-white" style="font-weight: 300;">
			<li class="breadcrumb-item"><a href="<?=base_url('user');?>" class="text-decoration-none text-muted">Beranda</a></li>
			<li class="breadcrumb-item text-muted" aria-current="page"><a href="<?=base_url('user/inkubasi');?>" class="text-decoration-none text-muted">Inkubasi</a></li>
		</ol>
	</nav>

	<div class="mx-5 mb-5">
		<div class="head-home my-3" style="border: solid 2px; border-color: #FBD15B;">
			<h2 style="font-weight: 500; padding: 5px;" id="header">Inkubasi</h2>
		</div>

		<div class="row no-gutters">
			<a href="#" class="text-decoration-none p-1 mb-2 mr-3" style="color: #5A47AB; background-color: #F2F2F2; border-radius: 5px;" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-fw fa-plus-circle"></i> Ikuti Kelas Coaching</a>
			<a href="<?=base_url('user/coachingLog');?>" class="text-decoration-none p-1 mb-2 mr-3" style="color: #5A47AB; background-color: #F2F2F2; border-radius: 5px;"><i class="fas fa-fw fa-bookmark"></i> Coaching Log</a>
			<div class="form-inline col-12 col-sm-4">
				<select class="form-control col-6 col-sm-6 mb-2 mr-2" style="background-color: #F2F2F2;" name="pilihTenant" id="pilihTenant">
					<option value="">Pilih Tenant</option>
					<?php foreach($kelas as $kl):?>
						<option value="<?=$kl['id_tenant'];?>"><?=$kl['nama_tenant'];?></option>
					<?php endforeach;?>
				</select>
				<button type="button" class="btn btn-secondary mb-2" onclick="load_data()">Submit</button>
			</div>
		</div>

		<div class="my-5" style="border: solid 1px #d8d8d8; border-radius: 2px; padding: 1%; background-color: white; min-height: 420px;">
			<div class="listBoxInkubasi row no-gutters p-3" style="color: #5A47AB;">

			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ikuti Kelas Coaching</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('user/enrollInkubasi');?>">
				<div class="modal-body">
					<div class="form-group row">
						<label for="enroll" class="col-sm-4 col-form-label">Nama Tenant</label>
						<div class="col-sm-8">
							<select class="form-control" name="tenant" required>
								<option value="">Pilih Tenant</option>
								<?php foreach($tenant as $tn):?>
									<option value="<?=$tn['id_tenant'];?>"><?=$tn['nama_tenant'];?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class="form-group row">
						<label for="enroll" class="col-sm-4 col-form-label">Enroll Key</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="enroll" name="enroll" placeholder="Masukkan key">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btnLogin">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalEnrollTidakAda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">System</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Kelas tidak terdaftar, silahkan cek enroll key.</p>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	<?php if($this->session->userdata('system')== 'tidak ada'):?>
		$(document).ready(function(){
			$("#modalEnrollTidakAda").modal("show");
		});
	<?php 
	$this->session->unset_userdata('system');
	endif;?>

	function load_data(){
		var tenant = document.getElementById('pilihTenant').value;
		$.ajax({
			url:"<?=base_url();?>/user/load_inkubasi/"+tenant,
			dataType:"JSON",
			success: function(data){
				console.log(data.kelas);
				var html = '';
				for (var i = 0; i < data.kelas.length; i++) {
					var url = '';
					url = '<?=base_url('user/detailInkubasi/');?>' + data.kelas[i].id_kelas_coaching + '/' + tenant;
					html += `<div class="boxPraInkubasi col-4 col-md-2 mx-2" style="border: solid 1px #d8d8d8; border-radius: 10px; padding: 1%; cursor: pointer;" onclick="window.location='`+url+`'">`;
					html += '<img src="<?=base_url('assets/logo/gambarMentoring.png');?>" style="max-width: 70%; height: auto; margin-left: auto; margin-right: auto; display: block;">';
					html += '<p style="font-weight: 400;" class="mt-2">'+data.kelas[i].nama_kelas+'</p>';
					html += '<p class="text-right mt-4 mb-0" style="font-weight: 300; font-size: 14px;">Enroll Class : <span class="text-warning">'+data.kelas[i].enroll_key+'</span></p></div>';
				}
				$('.listBoxInkubasi').html(html);
				console.log(html);
			}
		});
	}
</script>