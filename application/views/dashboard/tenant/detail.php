<section class="home-section">
	<div class="text container-fluid">
		<nav aria-label="breadcrumb" style="color: #5A47AB;">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7; ">
				<li class="breadcrumb-item"><a href="<?=base_url('dashboard/tenant');?>" class="text-decoration-none" style="color: #5A47AB;">Tenant</a></li>
				<li class="breadcrumb-item" class="text-decoration-none" style="color: #5A47AB;" aria-current="page"><?=$tenant['nama_tenant'];?></li>
			</ol>
		</nav>

		<div class="col-12 col-sm-6 pl-0">
			<?= $this->session->flashdata('message');?>
		</div>

		<div class="px-3 pb-5 mr-5 bg-white" style="border: solid 1px #d8d8d8; border-radius: 5px; color: #5A47AB;">
			<h3>Detail Tenant</h3>
			<?php if($tenant['status'] != 1):?>
			<div class="btn-group" role="group" aria-label="Basic example">
			  <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalPenilaian1">Lihat Penilaian Tenant ke-1</button>
			  	<?php if($tenant['status']!=2):?>
			  		<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalPenilaian2">Lihat Penilaian Tenant ke-2</button>
				<?php endif;?>
			</div>
			<?php endif;?>
			<div class="row px-3 mt-5" style="color: #525F7F; font-size: 16px;">
				<div class="col-10 col-sm-5">
					<p style="font-weight: 700">Nama Tenant</p>
					<p><?=$tenant['nama_tenant'];?></p>
				</div>
				<div class="col-10 col-sm-5 offset-1">
					<p style="font-weight: 700">Jenis Tenant</p>
					<p><?=$tenant['jenis_tenant'];?></p>
				</div>
			</div>

			<hr>
			<label class="px-1 mx-2 my-3" style="color: #525f7f; font-size: 14px; font-weight: 300; box-shadow: 0px 1px 0px 0px #a1abc2;">Data Diri</label>
			<div class="row px-3" style="color: #525F7F; font-size: 16px;">
				<div class="col-10 col-sm-5">
					<p style="font-weight: 700">Nama Lengkap</p>
					<p><?=$user_tenant['nama'];?></p><br>
					<p style="font-weight: 700">Tempat, Tanggal Lahir</p>
					<p><?=$user_tenant['tempat_lahir'];?>, <?=$user_tenant['tanggal_lahir'];?></p><br>
					<p style="font-weight: 700">Pendidikan Terakhir</p>
					<p><?=$user_tenant['pendidikan'];?></p><br>
					<p style="font-weight: 700">Jenis Kelamin</p>
					<p><?=$user_tenant['jenis_kelamin'];?></p><br>
				</div>
				<div class="col-10 col-sm-5 offset-1">
					<p style="font-weight: 700">Alamat Rumah</p>
					<p><?=$user_tenant['alamat'];?></p><br>
					<p style="font-weight: 700">No. HP</p>
					<p><?=$user_tenant['telepon'];?></p><br>
					<p style="font-weight: 700">Email</p>
					<p><?=$user_tenant['email'];?></p><br>
				</div>
			</div>

			<hr>
			<label class="px-1 mx-2 my-3" style="color: #525f7f; font-size: 14px; font-weight: 300; box-shadow: 0px 1px 0px 0px #a1abc2;">Data Usaha</label>
			<div class="row px-3" style="color: #525F7F; font-size: 16px;">
				<div class="col-10 col-sm-5">
					<p style="font-weight: 700">Alamat Usaha (No. Telp / WA)</p>
					<p><?=$data_usaha['alamat'];?></p><br>
					<p style="font-weight: 700">Bidang Usaha</p>
					<p><?=$tenant['bidang_usaha'];?></p><br>
				</div>
				<div class="col-10 col-sm-5 offset-1">
					<p style="font-weight: 700">Mulai Usaha</p>
					<p><?=$data_usaha['mulai_usaha'];?></p><br>
					<p style="font-weight: 700">Modal Awal Usaha (Rp)</p>
					<p><?=$data_usaha['modal_awal'];?></p><br>
				</div>
			</div>

			<hr>
			<label class="px-1 mx-2 my-3" style="color: #525f7f; font-size: 14px; font-weight: 300; box-shadow: 0px 1px 0px 0px #a1abc2;">Komposisi Modal Usaha Saat Ini</label>
			<div class="row px-3" style="color: #525F7F; font-size: 16px;">
				<div class="col-10 col-sm-8">
					<?php for($j = 0; $j < count($sumberUsaha); $j++):?>
						<div class="row">
							<div class="col-5 col-sm-2 offset-0 offset-sm-0">
								<p style="font-weight: 700"><?=$sumberUsaha[$j];?></p>
							</div>
							<div class="col-5 col-sm-2 offset-1 ">
								<p>Rp. <?=$nominalSumberUsaha[$j];?></p>
							</div>
						</div>
					<?php endfor;?>
					<br>
					<p style="font-weight: 700">Produk yang Dihasilkan</p>
					<p><?=$data_usaha['produk_dihasilkan'];?></p><br>
					<p style="font-weight: 700">Aset yang Dimiliki</p>
					<?php if($data_usaha['aset']=="Tidak ada"):?>
						<p><?=$data_usaha['aset'];?></p><br>
					<?php else:
						foreach($aset as $as):?>
							<?=$as;?>
						<?php endforeach; 
					endif;?>
					<p style="font-weight: 700">Kapasitas Produksi per Bulan</p>
					<p><?=$data_usaha['kapasitas_produksi'];?></p><br>
					<p style="font-weight: 700">Omset per Bulan</p>
					<p><?=$data_usaha['omset'];?></p><br>
					<p style="font-weight: 700">Jangkauan Pasar</p>
					<p><?=$data_usaha['jangkauan_pasar'];?></p><br>
				</div>
			</div>

			<hr>
			<label class="px-1 mx-2 my-3" style="color: #525f7f; font-size: 14px; font-weight: 300; box-shadow: 0px 1px 0px 0px #a1abc2;">Pengembangan Usaha</label>
			<div class="row px-3" style="color: #525F7F; font-size: 16px;">
				<div class="col-12">
					<p style="font-weight: 700">Permasalahan yang Dihadapi</p>
					<p><?=$data_usaha['permasalahan'];?></p><br>
					<p style="font-weight: 700">Rencana Pengembangan</p>
					<p><?=$data_usaha['rencana_pengembangan'];?></p><br>
					<p style="font-weight: 700">Foto Produk</p>
					<?php 
					for ($i=0; $i < $jumlah_gambar-1; $i++):?>
						<img src="<?=base_url('assets/image/foto_produk/').$gambar[$i];?>" alt="<?=$gambar[$i];?>" class="img-fluid mr-2" style="max-width: 200px;">
					<?php endfor;?>
					<br>
					<br><p style="font-weight: 700">Proposal</p>
					<iframe class="col-12 col-sm-6" src="<?=base_url('assets/dokumen/proposal/').$data_usaha['proposal'];?>" style="min-height: 480px;"></iframe><br>
					<br><p style="font-weight: 700">Perizinan dan Sertifikat</p>
					<div class="row no-gutters">
						<div class="col-10 col-sm-5">
							<p style="font-weight: 700">Perizinan</p>
							<?php if($data_usaha['perjanjian_usaha']=="Tidak ada"):?>
								<p><?=$data_usaha['perjanjian_usaha'];?></p><br>
							<?php else:
								foreach($perjanjian as $pu):?>
									<?=$pu;?>
								<?php endforeach; 
							endif;?>
						</div>
						<div class="col-10 col-sm-5 offset-0 offset-sm-1">
							<p style="font-weight: 700">Sertifikat</p>
							<?php if($data_usaha['sertifikat_produk']=="Tidak ada"):?>
								<p><?=$data_usaha['sertifikat_produk'];?></p><br>
							<?php else:
								foreach($sertifikat as $sp):?>
									<?=$sp;?>
								<?php endforeach; 
							endif;?>
						</div>
					</div>
				</div>
			</div>
			<?php if($tenant['status'] >= 3):?>
				<hr>
				<label class="px-1 mx-2 my-3" style="color: #525f7f; font-size: 14px; font-weight: 300; box-shadow: 0px 1px 0px 0px #a1abc2;">Pengembangan Usaha</label>
				<div class="row px-3" style="color: #525F7F; font-size: 16px;">
					<div class="col-12 col-sm-6">
						<p style="font-weight: 700">Link Youtube Demo Produk</p>
						<a href="https://www.youtube.com/watch?v=<?=$data_usaha2['link'];?>" target="https://www.youtube.com/watch?v=<?=$data_usaha2['link'];?>">https://www.youtube.com/watch?v=<?=$data_usaha2['link'];?></a>
					</div>
					<div class="col-12 col-sm-6">
						<p style="font-weight: 700">File Presentasi</p>
						<a href="<?=base_url('assets/dokumen/ppt/').$data_usaha2['presentasi'];?>"><?=$data_usaha2['profile'];?></a>
					</div>
					<div class="col-12 col-sm-8">
						<br><p style="font-weight: 700">Profile Tim</p>
						<iframe class="col-12" src="<?=base_url('assets/dokumen/profile/').$data_usaha2['profile'];?>" style="min-height: 480px;"></iframe><br>
					</div>
				</div>
			<?php endif;?>
			<?php if($tenant['status'] == 5 && $this->session->userdata('role_id') == 1):?>
				<hr>
				<div class="row">
					<a href="<?=base_url('dashboard/lulusInkubasi/'.$tenant['id_tenant']);?>" class="btn btn-outline-info" style="text-align: center; display: inline-block; margin: 0 auto;">Tandai Sebagai Lulus</a>
				</div>
			<?php endif;?>
		</div>
	</div>
</section>

<div class="modal fade" id="modalPenilaian1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Penilaian Tenant Tahap 1</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Keterangan Nilai</p>
				<p>1 (Sangat tidak baik) - 5 (Sangat Baik)</p>
				<div class="table-responsive mt-3 col-10 pl-0 offset-1">
					<table class="table text-center">
						<thead style="background-color: #5A47AB; color: #FBD15B;">
							<tr>
								<th scope="col">Penilaian</th>
								<th scope="col">Point Penilaian</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($penilaian1 as $p1):?>
								<tr>
									<td><?=$p1['penilaian'];?></td>
									<td><?=$p1['nilai'];?></td>
								</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modalPenilaian2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Penilaian Tenant Tahap 2</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Keterangan Nilai</p>
				<p>1 (Sangat tidak baik) - 5 (Sangat Baik)</p>
				<div class="table-responsive mt-3 col-10 pl-0 offset-1">
					<table class="table text-center">
						<thead style="background-color: #5A47AB; color: #FBD15B;">
							<tr>
								<th scope="col">Penilaian</th>
								<th scope="col">Point Penilaian</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($penilaian2 as $p2):?>
								<tr>
									<td><?=$p2['penilaian'];?></td>
									<td><?=$p2['nilai'];?></td>
								</tr>
							<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	
</script>




