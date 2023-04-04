<div class="container-fluid py-5" style="padding-right: 10%; padding-left: 10%;">
	<div class="head-home my-5" style="border: solid 2px; border-color: #FBD15B;">
		<h2 style="font-weight: 500; padding: 5px;">Profile</h2>
	</div>

	<div class="px-5">
		<h3 style="color: #5A47AB;">Detail User</h3>
	</div>

	<div class="my-4 px-5" style="font-size: 16px;">
		<?= $this->session->flashdata('message');?>
		<form method="post" action="">
			<div class="form-row">
				<div class="form-group col-10 col-md-5">
					<label for="nama">Nama</label>
					<input type="text" class="form-control" id="nama" name="nama" value="<?=$user['nama'];?>">
					<?=form_error('nama','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group col-10 col-md-5 offset-0 offset-md-1">
					<label for="email">Email Address</label>
					<input type="text" class="form-control" id="email" name="email" value="<?=$user['email'];?>">
					<?=form_error('email','<small class="text-danger pl-1">','</small>');?>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-10 col-md-3">
					<label for="tempatLahir">Tempat Lahir</label>
					<input type="text" class="form-control" id="tempatLahir" name="tempatLahir" value="<?=$user['tempat_lahir'];?>">
					<?=form_error('tempatLahir','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group col-10 col-md-3 offset-0 offset-md-1">
					<label for="tanggalLahir">Tanggal Lahir</label>
					<input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir" value="<?=$user['tanggal_lahir'];?>">
					<?=form_error('tanggalLahir','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group col-10 col-md-3 offset-0 offset-md-1">
					<label for="kelamin">Jenis Kelamin</label>
					<select class="form-control" id="kelamin" name="kelamin">
						<option value="">Pilih jenis kelamin</option>
						<option value="Laki-laki">Laki-laki</option>
						<option value="Perempuan">Perempuan</option>
					</select>
					<?=form_error('kelamin','<small class="text-danger pl-1">','</small>');?>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-10 col-md-3">
					<label for="telepon">No HP (WA)</label>
					<input type="text" class="form-control" id="telepon" name="telepon" value="<?=$user['telepon'];?>">
					<?=form_error('telepon','<small class="text-danger pl-1">','</small>');?>	
				</div>
				<div class="form-group col-10 col-md-3 offset-0 offset-md-1">
					<label for="pendidikan">Pendidikan Terakhir</label>
					<input type="text" class="form-control" id="pendidikan" name="pendidikan" value="<?=$user['pendidikan'];?>">
					<?=form_error('pendidikan','<small class="text-danger pl-1">','</small>');?>
				</div>
			</div>
			<div class="form-group">
				<label for="alamat">Alamat</label>
				<textarea class="form-control col-10 col-md-5" id="alamat" name="alamat" rows="4"><?=$user['alamat'];?></textarea>
				<?=form_error('alamat','<small class="text-danger pl-1">','</small>');?>
			</div>
			<button type="submit" class="btn btn-success">Edit</button>
		</form>
	</div>

	<div class="px-5">
		<h3 style="color: #5A47AB;">Ubah Password</h3>
	</div>

	<div class="my-4 px-5" style="font-size: 16px;">
		<form method="post" action="<?=base_url('user/ubahPassword/').$this->session->userdata('id_user');?>">
		  <div class="form-group">
		    <label for="password1">Password Baru</label>
		    <input type="password" class="form-control col-10 col-md-3" id="password1" name="password1" placeholder="Password" onkeyup="verifPassword1(this)">
		    <div id="validPass1"></div>
		  </div>
		  <div class="form-group">
		    <label for="password2">Masukkan Ulang Password</label>
		    <input type="password" class="form-control col-10 col-md-3" id="password2" name="password2" placeholder="Ulangi password" onkeyup="verifPassword2(this)">
		  	<div id="validPass2"></div>
		  </div>
		  <div class="form-group">
		    <label for="verif">Kode Verifikasi</label>
		    <div class="col-10">
			    <div class="row">
			    	<input type="text" class="form-control col-10 col-md-3" id="verif" name="verif" placeholder="Kode" disabled onkeyup="validCode(this)">
			    	<div class="col-10 col-md-3">
			    		<button type="button" id="btnKirimKode" class="btn btn-outline-info" onclick="kirimKode()">Kirim Kode</button>
			    	</div>
			    </div>
		    </div>
		    <div id="validCode"></div>
		  </div>
		  <button type="submit" class="btn btn-success" id="buttonSubmitPass" disabled>Submit</button>
		</form>
	</div>
</div>


<script type="text/javascript">
	var jenis_kelamin = ['Laki-laki', 'Perempuan'];
	var user_kelamin = '<?=$user['jenis_kelamin']?>';
	var html_jenis_kelamin = '<option value="'+user_kelamin+'">'+user_kelamin+'</option>';

	for (var i = 0; i < jenis_kelamin.length; i++) {
		if (jenis_kelamin[i] != user_kelamin) {
			html_jenis_kelamin += '<option value="'+jenis_kelamin[i]+'">'+jenis_kelamin[i]+'</option>';
		}
	}

	document.getElementById('kelamin').innerHTML = html_jenis_kelamin;

	function verifPassword1(a){
		var input = a.value;
		if (input.length < 8) {
			document.getElementById('validPass1').innerHTML = `<small id="emailHelp" class="form-text text-danger">Password harus terdiri dari minimal 8 huruf!</small>`
		}else{
			document.getElementById('validPass1').innerHTML = '';
		}
		buttonInputPass();
	}

	function verifPassword2(b){
		var pass1 = document.getElementById('password1').value;
		if (pass1 != '') {
			var input = b.value;
			if (input != pass1) {
				document.getElementById('validPass2').innerHTML = `<small id="emailHelp" class="form-text text-danger">Password tidak sama!</small>`
			}else{
				document.getElementById('validPass2').innerHTML = '';
			}
		}
		buttonInputPass();
	}

	function kirimKode(){
		var email = `<?=$this->session->userdata('email');?>`;
		$.ajax({
			url: "<?= base_url(); ?>user/kodeUbahPass",
			method: 'POST',
			data: {
				email: email
			},
			success: function() {
				document.getElementById('validCode').innerHTML = '<small id="emailHelp" class="form-text text-muted">Kode verifikasi telah dikirimkan melalui email anda.</small>';
				document.getElementById('verif').disabled = false;
				document.getElementById('btnKirimKode').disabled = true;
			}
		});
	}

	function validCode(c){
		var code = c.value;
		var email = `<?=$this->session->userdata('email');?>`;
		$.ajax({
			url: "<?= base_url(); ?>user/verifKodeValidPass",
			method: 'POST',
			data: {
				code: code,
				email: email
			},
			success: function(data) {
				console.log(data)
				if (data == 'salah') {
					document.getElementById('validCode').innerHTML = '<small id="emailHelp" class="form-text text-danger">Kode anda salah.</small>';
					buttonInputPass();
				} else {
					document.getElementById('validCode').innerHTML = '';
					buttonInputPass();
				}
			}
		});
	}

	function buttonInputPass(){
		var p1 = document.getElementById('password1').value;
		var p2 = document.getElementById('password2').value;
		var c1 = document.getElementById('verif').value;
		var v1 = document.getElementById('validPass1').innerHTML;
		var v2 = document.getElementById('validPass2').innerHTML;
		var c2 = document.getElementById('validCode').innerHTML;

		if (p1 != '' && p2 != '' && c1 != '') {
			if (v1 == '' && v2 == '' && c2 == '') {
				document.getElementById('buttonSubmitPass').disabled = false;
			} else {
				document.getElementById('buttonSubmitPass').disabled = true;
			}
		} else {
			document.getElementById('buttonSubmitPass').disabled = true;
		}
	}
</script>