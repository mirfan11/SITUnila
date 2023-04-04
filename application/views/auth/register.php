<div class="container my-5" style="min-height: calc(100vh - 40px);">
	<div class="loginSection">
		<div class="loginHead py-3" style="background-color: #D8CFFF;">
			<img src="<?=base_url('assets/logo/logo.png');?>" class="img-fluid" style="max-width: 50%; height: auto; margin-left: auto; margin-right: auto; display: block;">
			<h1 class="text-center mt-3">Sistem Inkubasi Tenant Unila (SIT)</h1>
		</div>
		<div class="loginForm py-5" style="border: solid 2px #D8CFFF;">
			<form class="col-8 col-sm-6 offset-2 offset-sm-3" method="post" action="">
				<div class="form-group">
					<label for="nama">Nama</label>
					<input type="text" class="form-control" id="nama" name="nama" value="<?=set_value('nama');?>">
					<?=form_error('nama','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group">
					<label for="email">Email Address</label>
					<input type="text" class="form-control" id="email" name="email" value="<?=set_value('email');?>">
					<?=form_error('email','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group">
					<label for="telepon">No HP (WA)</label>
					<input type="text" class="form-control" id="telepon" name="telepon" value="<?=set_value('telepon');?>">
					<?=form_error('telepon','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group">
					<label for="tempatLahir">Tempat Lahir</label>
					<input type="text" class="form-control" id="tempatLahir" name="tempatLahir" value="<?=set_value('tempatLahir');?>">
					<?=form_error('tempatLahir','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group">
					<label for="tanggalLahir">Tanggal Lahir</label>
					<input type="date" class="form-control" id="tanggalLahir" name="tanggalLahir" value="<?=set_value('tanggalLahir');?>">
					<?=form_error('tanggalLahir','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group">
					<label for="pendidikan">Pendidikan Terakhir</label>
					<input type="text" class="form-control" id="pendidikan" name="pendidikan" value="<?=set_value('pendidikan');?>">
					<?=form_error('pendidikan','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group">
					<label for="kelamin">Jenis Kelamin</label>
					<select class="form-control" id="kelamin" name="kelamin" value="<?=set_value('kelamin');?>">
						<option value="">Pilih jenis kelamin</option>
						<option value="Laki-laki">Laki-laki</option>
						<option value="Perempuan">Perempuan</option>
					</select>
					<?=form_error('kelamin','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group">
					<label for="alamat">Alamat</label>
					<textarea class="form-control" id="alamat" name="alamat" rows="2" value="<?=set_value('alamat');?>"></textarea>
					<?=form_error('alamat','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group">
					<label for="password1">Password</label>
					<input type="password" class="form-control" id="password1" name="password1">
					<?=form_error('password1','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group">
					<label for="password2">confirm Password</label>
					<input type="password" class="form-control" id="password2" name="password2">
					<?=form_error('password2','<small class="text-danger pl-1">','</small>');?>
				</div>
				<div class="form-group form-check">
					<input type="checkbox" class="form-check-input" id="exampleCheck1">
					<label class="form-check-label" for="exampleCheck1">Check me out</label>
				</div>
				<button type="submit" class="btnLogin btn btn-lg px-5 mt-2">Daftar</button>
				<a class="btnRegis btn btn-lg px-5 mt-2" href="#">Masuk</a>
			</form>
		</div>
	</div>
</div>