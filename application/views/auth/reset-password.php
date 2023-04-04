<div class="container my-5" style="min-height: calc(100vh - 40px);">
	<div class="loginSection">
		<div class="loginHead py-3" style="background-color: #D8CFFF;">
			<img src="<?=base_url('assets/logo/logo.png');?>" class="img-fluid" style="max-width: 50%; height: auto; margin-left: auto; margin-right: auto; display: block;">
			<h1 class="text-center mt-3">Sistem Inkubasi Tenant Unila (SIT)</h1>
		</div>
		<div class="loginForm py-5" style="border: solid 2px #D8CFFF;">
			<h2 class="text-center mb-5">Lupa Password</h2>
			<form class="col-8 col-sm-6 offset-2 offset-sm-3" method="post" action="">
				<?= $this->session->flashdata('message');?>
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
				<button class="btnRegis btn btn-lg px-5 mt-2" type="submit">Submit</a>
			</form>
		</div>
	</div>
</div>