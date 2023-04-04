<div class="container my-5" style="min-height: calc(100vh - 40px);">
	<div class="loginSection">
		<div class="loginHead py-3" style="background-color: #D8CFFF;">
			<img src="<?=base_url('assets/logo/logo.png');?>" class="img-fluid" style="max-width: 50%; height: auto; margin-left: auto; margin-right: auto; display: block;">
			<h1 class="text-center mt-3">Sistem Inkubasi Tenant Unila (SIT)</h1>
		</div>
		<div class="loginForm py-5" style="border: solid 2px #D8CFFF;">
			<form class="col-8 col-sm-6 offset-2 offset-sm-3" method="post" action="">
			<?= $this->session->flashdata('message');?>
			  <div class="form-group">
			    <label for="email">Email address</label>
			    <input type="text" class="form-control" id="email" name="email" placeholder="Email">
			    <?=form_error('email','<small class="text-danger pl-1">','</small>');?>
			  </div>
			  <div class="form-group">
			    <label for="password">Password</label>
			    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
			    <?=form_error('password','<small class="text-danger pl-1">','</small>');?>
			    <small id="lupaPass" name="lupaPass" class="form-text text-muted"><a href="<?=base_url('auth/lupaPassword')?>">Lupa Password?</a></small>
			  </div>
			  <div class="mt-4">
			  	<button type="submit" class="btnLogin btn btn-lg px-5 mt-2">Masuk</button>
			  	<a class="btnRegis btn btn-lg px-5 mt-2" href="#">Daftar</a>
			  </div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalVerif" tabindex="-1" role="dialog" aria-labelledby="modalVerifLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalVerifLabel">System</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalVerifBody">
        
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
<?php if($this->session->userdata('aktivasi_akun') == 'belum'):?>
	$(document).ready(function(){
		document.getElementById('modalVerifBody').innerHTML = 'Silahkan cek email untuk aktivasi akun anda.';
		$('#modalVerif').modal('show');
	});
<?php $this->session->unset_userdata('aktivasi_akun');
elseif ($this->session->userdata('aktivasi_akun') == 'sudah') :?>
	$(document).ready(function(){
		document.getElementById('modalVerifBody').innerHTML = 'Aktivasi akun anda telah berhasil, silahkan login.';
		$('#modalVerif').modal('show');
	});
<?php $this->session->unset_userdata('aktivasi_akun');
endif;?>
</script>