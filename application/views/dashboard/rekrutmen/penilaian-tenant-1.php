<section class="home-section">
	<div class="text container-fluid">
		<nav aria-label="breadcrumb" style="color: #5A47AB;">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7; ">
				<li class="breadcrumb-item"><a href="<?=base_url('dashboard/rekrutmen');?>" class="text-decoration-none" style="color: #5A47AB;">Rekrutmen</a></li>
			</ol>
		</nav>

		<div class="px-3 pb-5 mr-5 bg-white" style="border: solid 1px #d8d8d8; border-radius: 5px; color: #5A47AB;">
			<h3>Detail Tenant Tahap 1</h3>
			<div class="row px-3 mt-5" style="color: #525F7F; font-size: 16px;">
				<div class="col-10 col-sm-5">
					<p>Nama Tenant</p>
					<p><?=$tenant['nama_tenant'];?></p>
				</div>
				<div class="col-10 col-sm-5 offset-1">
					<p>Jenis Tenant</p>
					<p><?=$tenant['jenis_tenant'];?></p>
				</div>
			</div>

			<hr>
			<p class="px-3 mt-2" style="color: #525f7f; font-size: 14px; font-weight: 300;">Data Diri</p>
			<div class="row px-3" style="color: #525F7F; font-size: 16px;">
				<div class="col-10 col-sm-5">
					<p>Nama Lengkap</p>
					<p><?=$user_tenant['nama'];?></p><br>
					<p>Tempat, Tanggal Lahir</p>
					<p><?=$user_tenant['tempat_lahir'];?>, <?=$user_tenant['tanggal_lahir'];?></p><br>
					<p>Pendidikan Terakhir</p>
					<p><?=$user_tenant['pendidikan'];?></p><br>
					<p>Jenis Kelamin</p>
					<p><?=$user_tenant['jenis_kelamin'];?></p><br>
				</div>
				<div class="col-10 col-sm-5 offset-1">
					<p>Alamat Rumah</p>
					<p><?=$user_tenant['alamat'];?></p><br>
					<p>No. HP</p>
					<p><?=$user_tenant['telepon'];?></p><br>
					<p>Email</p>
					<p><?=$user_tenant['email'];?></p><br>
				</div>
			</div>

			<hr>
			<p class="px-3 mt-2" style="color: #525f7f; font-size: 14px; font-weight: 300;">Data Usaha</p>
			<div class="row px-3" style="color: #525F7F; font-size: 16px;">
				<div class="col-10 col-sm-5">
					<p>Alamat Usaha (No. Telp / WA)</p>
					<p><?=$data_usaha['alamat'];?></p><br>
					<p>Bidang Usaha</p>
					<p><?=$tenant['bidang_usaha'];?></p><br>
				</div>
				<div class="col-10 col-sm-5 offset-1">
					<p>Mulai Usaha</p>
					<p><?=$data_usaha['mulai_usaha'];?></p><br>
					<p>Modal Awal Usaha (Rp)</p>
					<p><?=$data_usaha['modal_awal'];?></p><br>
				</div>
			</div>

			<hr>
			<p class="px-3 mt-2" style="color: #525f7f; font-size: 14px; font-weight: 300;">Komposisi Modal Usaha Saat Ini</p>
			<div class="row px-3" style="color: #525F7F; font-size: 16px;">
				<div class="col-10 col-sm-8">
					<?php for($j = 0; $j < count($sumberUsaha); $j++):?>
						<div class="row">
							<div class="col-5 col-sm-2 offset-0 offset-sm-0">
								<p><?=$sumberUsaha[$j];?></p>
							</div>
							<div class="col-5 col-sm-2 offset-1 ">
								<p>Rp. <?=$nominalSumberUsaha[$j];?></p>
							</div>
						</div>
					<?php endfor;?>
					<br>
					<p>Produk yang Dihasilkan</p>
					<p><?=$data_usaha['produk_dihasilkan'];?></p><br>
					<p>Aset yang Dimiliki</p>
					<?php if($data_usaha['aset']=="Tidak ada"):?>
						<p><?=$data_usaha['aset'];?></p><br>
					<?php else:
						foreach($aset as $as):?>
							<?=$as;?>
						<?php endforeach; 
					endif;?>
					<p>Kapasitas Produksi per Bulan</p>
					<p><?=$data_usaha['kapasitas_produksi'];?></p><br>
					<p>Omset per Bulan</p>
					<p><?=$data_usaha['omset'];?></p><br>
					<p>Jangkauan Pasar</p>
					<p><?=$data_usaha['jangkauan_pasar'];?></p><br>
				</div>
			</div>

			<hr>
			<p class="px-3 mt-2" style="color: #525f7f; font-size: 14px; font-weight: 300;">Pengembangan Usaha</p>
			<div class="row px-3" style="color: #525F7F; font-size: 16px;">
				<div class="col-12">
					<p>Permasalahan yang Dihadapi</p>
					<p><?=$data_usaha['permasalahan'];?></p><br>
					<p>Rencana Pengembangan</p>
					<p><?=$data_usaha['rencana_pengembangan'];?></p><br>
					<p>Foto Produk</p>
					<?php 
					for ($i=0; $i < $jumlah_gambar-1; $i++):?>
						<img src="<?=base_url('assets/image/foto_produk/').$gambar[$i];?>" alt="<?=$gambar[$i];?>" class="img-fluid mr-2" style="max-width: 200px;">
					<?php endfor;?>
					<br>
					<br><p>Proposal</p>
					<iframe class="col-12 col-sm-6" src="<?=base_url('assets/dokumen/proposal/').$data_usaha['proposal'];?>" style="min-height: 480px;"></iframe><br>
					<br><p>Perizinan dan Sertifikat</p>
					<div class="row no-gutters">
						<div class="col-10 col-sm-5">
							<p>Perizinan</p>
							<?php if($data_usaha['perjanjian_usaha']=="Tidak ada"):?>
								<p><?=$data_usaha['perjanjian_usaha'];?></p><br>
							<?php else:
								foreach($perjanjian as $pu):?>
									<?=$pu;?>
								<?php endforeach; 
							endif;?>
						</div>
						<div class="col-10 col-sm-5 offset-0 offset-sm-1">
							<p>Sertifikat</p>
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
			<button class="btn btn-dark mt-5 ml-3" data-toggle="modal" data-target="#modalNilai1">Nilai Tenant</button>
		</div>
	</div>
</section>

<div class="modal fade" id="modalNilai1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Penilaian Tenant Tahap 1</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('dashboard/submitPenilaian1/').$tenant['id_tenant'];?>">
				<div class="modal-body">
					<p>Keterangan Nilai<i class="add-more fas fa-fw fa-plus" style="float: right; cursor: pointer;" onclick="tambahPenilaian()"></i></p>
					<p>1 (Sangat tidak baik) - 5 (Sangat Baik)</p>

					<div class="form-penilaian">
					</div>
					<div class="form-penilaian">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-dark">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	var formPenilaian = document.getElementsByClassName('form-penilaian')[0];
	var penilaianDefault = ['Profil Bisnis', 'Profil Tim', 'Produk', 'Model Bisnis', 'Keuangan'];
	console.log(penilaianDefault.length);

	var formPenilaianHTML = '';

	for (var i = 0; i < penilaianDefault.length; i++) {
		formPenilaianHTML += '<div class="form-group row px-3" id="penilaianGroup'+i+'">';
		formPenilaianHTML += '<input type="text" class="form-control col-5" id="namaPenilaian[]" name="namaPenilaian[]" placeholder="Nama Penilaian" value="'+penilaianDefault[i]+'" required>';
		formPenilaianHTML += '<input type="number" class="form-control col-3 offset-1" id="penilaian[]" name="penilaian[]" placeholder="1-5" min="1" max="5" required>';
		formPenilaianHTML += '<div class="col-1"><i class="hapus far fa-fw fa-trash-alt" style="color:red;" onclick="hapusPenilaian(this)" data-id="'+i+'"></i></div></div>';
	}

	formPenilaian.innerHTML = formPenilaianHTML;

	function tambahPenilaian(){
		var penilaianTambahanInnerHTML = document.getElementsByClassName('form-penilaian')[1].innerHTML;
		console.log(penilaianTambahanInnerHTML);

		var html = penilaianTambahanInnerHTML;

		html += '<div class="form-group row px-3" id="penilaianGroup'+i+'">';
		html += '<input type="text" class="form-control col-5" id="namaPenilaian[]" name="namaPenilaian[]" placeholder="Nama Penilaian" required>';
		html += '<input type="number" class="form-control col-3 offset-1" id="penilaian[]" name="penilaian[]" placeholder="1-5" min="1" max="5" required>';
		html += '<div class="col-1"><i class="hapus far fa-fw fa-trash-alt" style="color:red;" onclick="hapusPenilaian(this)" data-id="'+i+'"></i></div></div>';

		console.log(html);

		document.getElementsByClassName('form-penilaian')[1].innerHTML = html;
		i++;
	}

	function hapusPenilaian(data){
		var id = data.getAttribute('data-id');
		document.getElementById('penilaianGroup'+id+'').remove();
		console.log(id);
	}
</script>




