<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/user/index.css');?>">
<div class="container-fluid px-5">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-white" style="font-weight: 300;">
			<li class="breadcrumb-item"><a href="<?=base_url('user');?>" class="text-decoration-none text-muted">Beranda</a></li>
			<li class="breadcrumb-item text-muted" aria-current="page"><a href="<?=base_url('user/monev');?>" class="text-decoration-none text-muted">Monev</a></li>
		</ol>
	</nav>

	<div class="mx-5 mb-5" style="min-height: calc(80vh - 40px);">
		<div class="head-home my-3" style="border: solid 2px; border-color: #FBD15B;">
			<h2 style="font-weight: 500; padding: 5px;">Monev</h2>
		</div>

		<div class="p-3 bg-white" style="border: solid 1px #d8d8d8; border-radius: 5px; color: #5A47AB;">
			<h1><?=$tenant['nama_tenant'];?></h1>
			<h6 class="text-muted"><?=$monev['tanggal_dikirim'];?></h6>
			<?php if($monev['coach'] != ''):?>
				<h5>Coach <?= $monev['coach'];?></h5>
			<?php endif;?>

			<br><p>Bisnis Plan</p>
			<iframe class="col-10" src="https://drive.google.com/file/d/1qngAy3D2zILkE5V-a6MgOE9ADC_H0B5r/preview" style="min-height: 480px;"></iframe><br>
			<br><p>Pembukuan</p>
			<iframe class="col-10" src="https://drive.google.com/file/d/1qngAy3D2zILkE5V-a6MgOE9ADC_H0B5r/preview" style="min-height: 480px;"></iframe><br>
		
			<br><p>Penilaian Inkubator<span class="text-muted" style="font-size: 10px;"> (Poin penilaian 1 - 5)</span></p>
			<div class="table-responsive mt-3 col-10 pl-0">
				<table class="table text-center">
					<thead style="background-color: #5A47AB; color: #FBD15B;">
						<tr>
							<th scope="col">No</th>
							<th scope="col">Tahapan Penilaian</th>
							<th scope="col">Point Penilaian</th>
							<th scope="col">Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1;
						foreach($penilaian_inkubator as $pi):?>
							<tr>
								<th scope="row" class="nomorPenilaian"><?=$i;?></th>
								<td><?=$pi['nama_penilaian'];?></td>
								<td><?=$pi['nilai'];?></td>
								<td><?=$pi['keterangan'];?></td>
							</tr>
						<?php $i++;
						endforeach;?>
						<?php if($monev['nilai_inkubator'] != ''):?>
							<tr>
								<th colspan="2">Hasil Kalkulasi Penilaian</th>
								<td><?=$monev['nilai_inkubator'];?></td>
								<td></td>
							</tr>
						<?php endif;?>
					</tbody>
				</table>
			</div><br>

			<br><p>Penilaian Coach<span class="text-muted" style="font-size: 10px;"> (Poin penilaian 1 - 5)</span></p>
			<div class="table-responsive mt-3 col-10 pl-0">
				<table class="table text-center">
					<thead style="background-color: #5A47AB; color: #FBD15B;">
						<tr>
							<th scope="col">No</th>
							<th scope="col">Tahapan Penilaian</th>
							<th scope="col">Point Penilaian</th>
							<th scope="col">Keterangan</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1;
						foreach($penilaian_coach as $pc):?>
							<tr>
								<th scope="row" class="nomorPenilaian"><?=$i;?></th>
								<td><?=$pc['nama_penilaian'];?></td>
								<td><?=$pc['nilai'];?></td>
								<td><?=$pc['keterangan'];?></td>
							</tr>
						<?php $i++;
						endforeach;?>
						<?php if($monev['nilai_coach'] != ''):?>
							<tr>
								<th colspan="2">Hasil Kalkulasi Penilaian</th>
								<td><?=$monev['nilai_coach'];?></td>
								<td></td>
							</tr>
						<?php endif;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
