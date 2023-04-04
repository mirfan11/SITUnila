<div class="container-fluid py-5" style="padding-right: 10%; padding-left: 10%;">
	<div class="head-home my-5" style="border: solid 2px; border-color: #FBD15B;">
		<h2 style="font-weight: 500; padding: 5px;">Tambah Tenant</h2>
	</div>

	<form class="col-8 col-sm-6" action="<?=base_url('user/uploadDataTenant');?>" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label for="jenisTenant">Jenis Tenant</label>
			<select class="form-control col-6" id="jenisTenant" name="jenisTenant" required>
				<option>Pilih Jenis Tenant</option>
				<option value="INWALL">INWALL</option>
				<option value="OUTWALL">OUTWALL</option>
			</select>
		</div>
		<div class="form-group">
			<label for="namaTenant">Nama Tenant</label>
			<input type="text" class="form-control" id="namaTenant" name="namaTenant" required>
		</div>

		<br><h2 style="font-weight: 700;">Data Diri</h2><br>
		<div class="form-group">
			<label for="nama">Nama</label>
			<input type="text" class="form-control" id="nama" name="nama" value="<?=$dataDiri['nama'];?>" readonly>
		</div>
		<div class="form-group">
			<label for="ttl">Tempat, Tanggal Lahir</label>
			<input type="text" class="form-control" id="ttl" name="ttl" value="<?=$dataDiri['tempat_lahir'];?>, <?=$dataDiri['tanggal_lahir'];?>" readonly>
		</div>
		<div class="form-group">
			<label for="pendidikan">Pendidikan Terakhir</label>
			<input type="text" class="form-control" id="pendidikan" name="pendidikan" value="<?=$dataDiri['pendidikan'];?>" readonly>
		</div>
		<div class="form-group">
			<label for="kelamin">Jenis Kelamin</label>
			<input type="text" class="form-control" id="kelamin" name="kelamin" value="<?=$dataDiri['jenis_kelamin'];?>" readonly>
		</div>
		<div class="form-group">
			<label for="alamat">Alamat</label>
			<textarea class="form-control" id="alamat" name="alamat" rows="2"  readonly><?=$dataDiri['alamat'];?></textarea>
		</div>
		<div class="form-group">
			<label for="telepon">No HP (WA)</label>
			<input type="text" class="form-control" id="telepon" name="telepon" value="<?=$dataDiri['telepon'];?>" readonly>
		</div>
		<div class="form-group">
			<label for="email">Email Address</label>
			<input type="email" class="form-control" id="email" name="email"value="<?=$dataDiri['email'];?>" readonly>
		</div>

		<br><h2 style="font-weight: 700;">Data Usaha</h2><br>
		<div class="form-group">
			<label for="alamat">Alamat Usaha</label>
			<textarea class="form-control" id="alamatUsaha" name="alamatUsaha" rows="2" required></textarea>
		</div>
		<div class="form-group">
			<label>Perjanjian Usaha</label><br>
			<div class="form-check form-check-inline">
				<input type="radio" class="form-check-input" id="perjanjianUsahaRadio1" name="perjanjianUsahaRadio" value="Ada" required>
				<label class="form-check-label" for="perjanjianUsahaRadio">Ada</label>
			</div>
			<div class="form-check form-check-inline">
				<input type="radio" class="form-check-input" id="perjanjianUsahaRadio2" name="perjanjianUsahaRadio" value="Tidak Ada" required>
				<label class="form-check-label" for="perjanjianUsahaRadio">Tidak Ada</label>
			</div>
		</div>
		<div class="control-group2 after-add-more2">
			<div class="fotoPerjanjian form-group" style="display: none;">
				<div class="row">
					<div class="col-md-4">
						<label>Dokumen Perjanjian</label>
					</div>
					<div class="col-md-5">            
						<input type="file" id="image2" name="image2[]" required disabled accept="application/pdf, image/*">
						<small class="form-text text-muted">PDF atau Foto dokumen.</small>
					</div>
					<div class="col-md-3">
						<button class="add-more2 btn btn-success" type="button">Tambah Dokumen</button>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Sertifikat Produk yang Dimiliki</label><br>
			<div class="form-check form-check-inline">
				<input type="radio" class="form-check-input" id="sertifikatRadio1" name="sertifikatRadio" value="Ada">
				<label class="form-check-label" for="perjanjianUsahaRadio">Ada</label>
			</div>
			<div class="form-check form-check-inline">
				<input type="radio" class="form-check-input" id="sertifikatRadio2" name="sertifikatRadio" value="Tidak ada">
				<label class="form-check-label" for="perjanjianUsahaRadio">Tidak Ada</label>
			</div>
		</div>
		<div class="control-group3 after-add-more3">
			<div class="fotoSerti form-group" style="display: none;">
				<div class="row">
					<div class="col-md-4">
						<label>Sertifikat</label>            
					</div>
					<div class="col-md-5">            
						<input type="file" id="image3" name="image3[]" required disabled accept="application/pdf, image/*">
						<small class="form-text text-muted">PDF atau Foto dokumen.</small>
					</div>
					<div class="col-md-3">
						<button class="add-more3 btn btn-success" type="button">Tambah Dokumen</button>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="bidang">Bidang Usaha</label>
			<select class="form-control col-6" id="bidang" name="bidang" required>
				<option>Pilih bidang usaha</option>
				<option value="Pangan">Pangan</option>
				<option value="Kesehatan">Kesehatan</option>
				<option value="Transportasi">Transportasi</option>
				<option value="Kesehatan">Energi</option>
				<option value="Rekayasa Keteknikan">Rekayasa Keteknikan</option>
				<option value="Pertahanan Keamanan">Pertahanan Keamanan</option>
				<option value="Kemaritiman">Kemaritiman</option>
				<option value="Multidisiplin dan Lintas Sektoral">Multidisiplin dan Lintas Sektoral</option>
			</select>
		</div>
		<div class="form-group">
			<label for="mulaiUsaha">Mulai Usaha</label>
			<input type="text" class="form-control" id="mulaiUsaha" name="mulaiUsaha" required>
		</div>
		<div class="form-group">
			<label for="modalAwal">Modal Awal Usaha (Rp)</label>
			<input type="text" class="form-control" id="modalAwal" name="modalAwal" required>
		</div>
		<label>Sumber Usaha</label>
		<div class="form-row mb-3">
			<div class="form-group col-6">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="sumberUsaha[]" id="sumberUsaha1" value="Investasi" onclick="checkSumberUsaha(this)">
					<label class="form-check-label" for="sumberUsaha1">
						Investasi
					</label>
				</div>
			</div>
			<div class="col">
				<input class="form-control" type="text" name="nominalSumberUsaha[]" id="nominalSumberUsaha1" disabled onkeyup="rupiah(this)">
			</div>
		</div>
		<div class="form-row mb-3">
			<div class="form-group col-6">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="sumberUsaha[]" id="sumberUsaha2" value="Pinjaman Bank" onclick="checkSumberUsaha(this)">
					<label class="form-check-label" for="sumberUsaha2">
						Pinjaman Bank
					</label>
				</div>
			</div>
			<div class="col">
				<input class="form-control" type="text" name="nominalSumberUsaha[]" id="nominalSumberUsaha2" disabled onkeyup="rupiah(this)">
			</div>
		</div>
		<div class="form-row mb-3">
			<div class="form-group col-6">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="sumberUsaha[]" id="sumberUsaha3" value="Hibah" onclick="checkSumberUsaha(this)">
					<label class="form-check-label" for="sumberUsaha3">
						Hibah
					</label>
				</div>
			</div>
			<div class="col">
				<input class="form-control" type="text" name="nominalSumberUsaha[]" id="nominalSumberUsaha3" disabled onkeyup="rupiah(this)">
			</div>
		</div>
		<div class="form-row mb-3">
			<div class="form-group col-6">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="sumberUsaha[]" id="sumberUsaha4" value="Bootstrap" onclick="checkSumberUsaha(this)">
					<label class="form-check-label" for="sumberUsaha4">
						Bootstrap
					</label>
				</div>
			</div>
			<div class="col">
				<input class="form-control" type="text" name="nominalSumberUsaha[]" id="nominalSumberUsaha4" disabled onkeyup="rupiah(this)">
			</div>
		</div>
		<div class="form-row mb-3">
			<div class="form-group col-6">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="sumberUsaha[]" id="sumberUsaha5" value="Keluarga/Teman/Kolega" onclick="checkSumberUsaha(this)">
					<label class="form-check-label" for="sumberUsaha5">
						Keluarga / Teman / Kolega
					</label>
				</div>
			</div>
			<div class="col">
				<input class="form-control" type="text" name="nominalSumberUsaha[]" id="nominalSumberUsaha5" disabled onkeyup="rupiah(this)">
			</div>
		</div>
		<div class="form-row mb-3">
			<div class="form-group col-6">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="sumberUsaha[]" id="sumberUsaha6" value="Crowdfunding" onclick="checkSumberUsaha(this)">
					<label class="form-check-label" for="sumberUsaha6">
						Crowdfunding
					</label>
				</div>
			</div>
			<div class="col">
				<input class="form-control" type="text" name="nominalSumberUsaha[]" id="nominalSumberUsaha6" disabled onkeyup="rupiah(this)">
			</div>
		</div>
		<div class="form-row mb-3">
			<div class="form-group col-6">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" name="sumberUsaha[]" id="sumberUsaha7" value="Pribadi" onclick="checkSumberUsaha(this)">
					<label class="form-check-label" for="sumberUsaha7">
						Pribadi
					</label>
				</div>
			</div>
			<div class="col">
				<input class="form-control" type="text" name="nominalSumberUsaha[]" id="nominalSumberUsaha7" disabled onkeyup="rupiah(this)">
			</div>
		</div>
		<div class="form-group">
			<label for="produk">Produk yang Dihasilkan</label>
			<input type="text" class="form-control" id="produk" name="produk" required>
		</div>
		<div class="form-group">
			<label>Aset yang dimiliki</label><br>
			<div class="form-check form-check-inline">
				<input type="radio" class="form-check-input" id="asetRadio1" name="asetRadio" value="Ada">
				<label class="form-check-label" for="asetRadio">Ada</label>
			</div>
			<div class="form-check form-check-inline">
				<input type="radio" class="form-check-input" id="asetRadio2" name="asetRadio" value="Tidak Ada">
				<label class="form-check-label" for="asetRadio">Tidak Ada</label>
			</div>
		</div>
		<div class="control-group4 after-add-more4">
			<div class="fotoAset form-group" style="display: none;">
				<div class="row">
					<div class="col-md-4">
						<label>Aset</label>            
					</div>
					<div class="col-md-5">            
						<input type="file" id="image4" name="image4[]" required disabled accept="application/pdf, image/*">
						<small class="form-text text-muted">PDF atau Foto.</small>
					</div>
					<div class="col-md-3">
						<button class="add-more4 btn btn-success" type="button">Tambah Aset</button>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="produksi">Kapasitas Produksi per Bulan</label>
			<input type="number" class="form-control" id="produksi" name="produksi" required>
		</div>
		<div class="form-group">
			<label for="omset">Omset per Bulan</label>
			<input type="text" class="form-control" id="omset" name="omset" required>
		</div>
		<div class="form-group">
			<label for="jangkauan">Jangkauan Pasar</label>
			<input type="text" class="form-control" id="jangkauan" name="jangkauan" required>
		</div>
		<div class="form-row">
			<label class="col-12">Jumlah Tenaga Kerja</label>
			<div class="form-group col-6">
				<label for="tenagaLaki" class="text-secondary">Laki-laki (orang)</label>
				<input type="number" class="form-control" id="tenagaLaki" name="tenagaLaki" required>
			</div>
			<div class="form-group col-6">
				<label for="tenagaPerempuan" class="text-secondary">Perempuan (orang)</label>
				<input type="number" class="form-control" id="tenagaPerempuan" name="tenagaPerempuan" required>
			</div>
		</div>

		<br><h2 style="font-weight: 700;">Pengembangan Usaha</h2><br>
		<div class="form-group">
			<label for="permasalahan">Permasalahan yang di Hadapi</label>
			<textarea class="form-control" id="permasalahan" name="permasalahan" rows="2" required></textarea>
		</div>
		<div class="form-group">
			<label for="rencana">Rencana Pengembangan Usaha</label>
			<textarea class="form-control" id="rencana" name="rencana" rows="2" required></textarea>
		</div>
		<div class="control-group after-add-more">
			<div class="form-group">
				<div class="row">
					<div class="col-md-4">
						<label>Foto Produk</label>           
					</div>
					<div class="col-md-5">            
						<input type="file" id="image1[]" name="image1[]" required accept="image/*">
					</div>
					<div class="col-md-3">
						<button class="add-more btn btn-success" type="button">Tambah Foto</button>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-4">
					<label>Proposal (PDF only)</label>            
				</div>
				<div class="col-md-7">            
					<input type="file" id="file1" name="file1" required accept="application/pdf">
				</div>
			</div>
		</div>

		<br><button type="submit" class="btnRegis btn btn-lg px-5 mt-2">Submit</button>
	</form>
	<div class="copy invisible">
		<div class="control-group my-3">
			<div class="form-group">
				<div class="row">
					<div class="col-md-5 offset-md-4">            
						<input type="file" id="image1[]" name="image1[]" accept="image/*">
					</div>
					<div class="col-md-3">
						<button class="remove btn btn-danger" type="button">Hapus</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="copy2 invisible">
		<div class="control-group2 my-3">
			<div class="form-group">
				<div class="row">
					<div class="col-md-5 offset-md-4">            
						<input type="file" id="image2" name="image2[]" accept="application/pdf, image/*">
					</div>
					<div class="col-md-3">
						<button class="remove2 btn btn-danger" type="button">Hapus</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="copy3 invisible">
		<div class="control-group3 my-3">
			<div class="form-group">
				<div class="row">
					<div class="col-md-5 offset-md-4">            
						<input type="file" id="image3" name="image3[]" accept="application/pdf, image/*">
					</div>
					<div class="col-md-3">
						<button class="remove3 btn btn-danger" type="button">Hapus</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="copy4 invisible">
		<div class="control-group4 my-3">
			<div class="form-group">
				<div class="row">
					<div class="col-md-5 offset-md-4">            
						<input type="file" id="image4" name="image4[]" accept="application/pdf, image/*">
					</div>
					<div class="col-md-3">
						<button class="remove4 btn btn-danger" type="button">Hapus</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$(".add-more").click(function(){ 
			var html = $(".copy").html();
			$(".after-add-more").after(html);
		});

		$(".add-more2").click(function(){ 
			var html = $(".copy2").html();
			$(".after-add-more2").after(html);
		});

		$(".add-more3").click(function(){ 
			var html = $(".copy3").html();
			$(".after-add-more3").after(html);
		});

		$(".add-more4").click(function(){ 
			var html = $(".copy4").html();
			$(".after-add-more4").after(html);
		});

        // saat tombol remove dklik control group akan dihapus 
        $("body").on("click",".remove",function(){ 
        	$(this).parents(".control-group").remove();
        });

        $("body").on("click",".remove2",function(){ 
        	$(this).parents(".control-group2").remove();
        });

        $("body").on("click",".remove3",function(){ 
        	$(this).parents(".control-group3").remove();
        });

        $("body").on("click",".remove4",function(){ 
        	$(this).parents(".control-group4").remove();
        });

        $("#perjanjianUsahaRadio1").click(function(){ 
        	document.getElementsByClassName('fotoPerjanjian')[0].style = 'display: block';
        	document.getElementById('image2').disabled = false;
        });

        $("#perjanjianUsahaRadio2").click(function(){ 
        	document.getElementsByClassName('fotoPerjanjian')[0].style = 'display: none';
        	document.getElementById('image2').disabled = true;
        });

        $("#sertifikatRadio1").click(function(){ 
        	document.getElementsByClassName('fotoSerti')[0].style = 'display: block';
        	document.getElementById('image3').disabled = false;
        });

        $("#sertifikatRadio2").click(function(){ 
        	document.getElementsByClassName('fotoSerti')[0].style = 'display: none';
        	document.getElementById('image3').disabled = true;
        });

        $("#asetRadio1").click(function(){
        	document.getElementsByClassName('fotoAset')[0].style = 'display: block';
        	document.getElementById('image4').disabled = false;
        });

        $("#asetRadio2").click(function(){ 
        	document.getElementsByClassName('fotoAset')[0].style = 'display: none';
        	document.getElementById('image4').disabled = true;
        });

    });
	var tanpa_rupiah = document.getElementById('modalAwal');
	tanpa_rupiah.addEventListener('keyup', function(e)
	{
		tanpa_rupiah.value = formatRupiah(this.value);
	});

	// var tanpa_rupiah2 = document.getElementById('modalSendiri');
	// tanpa_rupiah2.addEventListener('keyup', function(e)
	// {
	// 	tanpa_rupiah2.value = formatRupiah(this.value);
	// });

	// var tanpa_rupiah3 = document.getElementById('modalKeluarga');
	// tanpa_rupiah3.addEventListener('keyup', function(e)
	// {
	// 	tanpa_rupiah3.value = formatRupiah(this.value);
	// });

	var tanpa_rupiah4 = document.getElementById('omset');
	tanpa_rupiah4.addEventListener('keyup', function(e)
	{
		tanpa_rupiah4.value = formatRupiah(this.value);
	});

	function rupiah(a){
		var tanpa_rupiah5 = document.getElementById(a.id);
		tanpa_rupiah5.value = formatRupiah(a.value);
	}

	function formatRupiah(angka, prefix)
	{
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split    = number_string.split(','),
		sisa     = split[0].length % 3,
		rupiah     = split[0].substr(0, sisa),
		ribuan     = split[0].substr(sisa).match(/\d{3}/gi);

		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}

	function checkSumberUsaha(a){
		var check = document.getElementById(a.id).checked;
		var sumberUsaha = ['Investasi','Pinjaman Bank','Hibah','Bootstrap','Keluarga/Teman/Kolega','Crowdfunding','Pribadi'];
		var value = a.value;
		for (var i = 0; i < sumberUsaha.length; i++) {
			if (sumberUsaha[i] == value) {
				var form = document.getElementById('nominalSumberUsaha'+(i+1));
				if (check == true) {
					form.disabled = false;
				}else{
					form.value = '';
					form.disabled = true;
				}
			}
		}
	}
</script>
