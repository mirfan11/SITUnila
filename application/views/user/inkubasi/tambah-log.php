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
		<div style="background-color: #D8D8D8; padding: 0.5%; font-weight: 500;">
			Tambah Coaching Log
		</div>
		<div class="py-5 px-4" style="border: solid 1px #D8D8D8;">
			<form class="col-8 col-sm-6" method="post" action="">
				<div class="form-group">
					<label for="namaTenant">Nama Tenant</label>
					<select class="form-control col-6 col-sm-6" id="namaTenant" name="namaTenant">
						<option value="">Pilih Tenant</option>
						<?php foreach($tenant as $tn):?>
							<option value="<?=$tn['id_tenant'];?>"><?=$tn['nama_tenant'];?></option>
						<?php endforeach;?>
					</select>
					<?=form_error('namaTenant','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group">
					<label for="hasilSebelumnya">Hasil Sebelumnya</label>
					<textarea class="form-control" id="hasilSebelumnya" name="hasilSebelumnya" rows="2"></textarea>
					<?=form_error('hasilSebelumnya','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group">
					<label for="tujuanIni">Tujuan tahap ini</label>
					<textarea class="form-control" id="tujuanIni" name="tujuanIni" rows="2"></textarea>
					<?=form_error('tujuanIni','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group">
					<label for="hasilInginDicapai">Hasil yang ingin dicapai</label>
					<textarea class="form-control" id="hasilInginDicapai" name="hasilInginDicapai" rows="2"></textarea>
					<?=form_error('hasilInginDicapai','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group">
					<label for="hasilDicapai">Hasil yang dicapai</label>
					<textarea class="form-control" id="hasilDicapai" name="hasilDicapai" rows="2"></textarea>
					<?=form_error('hasilDicapai','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group">
					<label for="tujuanSelanjutnya">Tujuan tahap selanjutnya</label>
					<textarea class="form-control" id="tujuanSelanjutnya" name="tujuanSelanjutnya" rows="2"></textarea>
					<?=form_error('tujuanSelanjutnya','<small class="text-danger pl-1">','</small>');?>
				</div>
				<br><button type="submit" class="btnRegis btn btn-lg px-5 mt-2">Submit Coaching Log</button>
			</form>
		</div>
	</div>
</div>