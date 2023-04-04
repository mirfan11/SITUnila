<!DOCTYPE html>
<html>
<head>
	<title>Sistem Inkubasi Tenant UNILA</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700&display=swap" rel="stylesheet">
	<link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
	<script src="https://kit.fontawesome.com/8f37dd1c37.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/style.css');?>">
	<style>
		body{
			font-family: 'Poppins', sans-serif;
			font-weight: 500;
			color: #5A47AB;
		}
	</style>
</head>
<body>
	<?php if($this->session->userdata('email') === NULL):?>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid my-2">
				<a class="navbar-brand" href="#"><img src="<?=base_url('assets/logo/logo.png');?>" class="img-fluid" style="max-width: 300px;" /></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item mx-3">
							<a class="nav-link" href="<?=base_url('home');?>" style="color: #5A47AB;">Beranda</a>
						</li>
						<li class="nav-item mx-3">
							<a class="nav-link" href="#" style="color: #5A47AB;">Tentang</a>
						</li>
						<li class="nav-item mx-3">
							<a class="btn btnLogin px-4" href="<?=base_url('auth');?>">Masuk</a>
						</li>
						<li class="nav-item mx-3">
							<a class="btn btnRegis px-4" href="<?=base_url('auth/register')?>">Daftar</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<?php else:?>
			<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #5A47AB">
				<div class="container-fluid my-2">
					<a class="navbar-brand" href="#"><img src="<?=base_url('assets/logo/logo.png');?>" class="img-fluid" style="max-width: 200px;" /></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>

					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav ml-auto">
							<li class="nav-item">
								<a class="nav-link pr-5" href="<?=base_url('home');?>" style="color: white;">Site Home</a>
							</li>
							<li class="nav-item mr-3" style="border-right: solid 1px white;">
								<?php if($this->session->userdata('role_id')!=2):?>
									<a class="nav-link pr-5" href="<?=base_url('dashboard');?>" style="color: white;">Beranda</a>
								<?php else:?>
									<a class="nav-link pr-5" href="<?=base_url('user');?>" style="color: white;">Beranda</a>
								<?php endif;?>
							</li>
							<li class="nav-item mx-3">
								<?php if($this->session->userdata('role_id')!=2):?>
									<div class="mx-3">
										<i class='bx bxs-bell-ring mt-2' style="font-size: 21px; color: #FBD15B; cursor: pointer;" onclick="window.location='<?=base_url('dashboard/notifikasi');?>'"></i>
										<?php if($this->session->userdata('notif') != "0"):?>
							                <span class="badge badge-pill badge-danger" id="notifCountHead"><?=$this->session->userdata('notif');?></span>
							            <?php endif;?>
									</div>
								<?php else:?>
									<div class="mx-3">
										<i class='bx bxs-bell-ring mt-2' style="font-size: 21px; color: #FBD15B; cursor: pointer;" onclick="window.location='<?=base_url('user/notifikasi');?>'"></i>
										<?php if($this->session->userdata('notif') != "0"):?>
							                <span class="badge badge-pill badge-danger" id="notifCountHead"><?=$this->session->userdata('notif');?></span>
							            <?php endif;?>
									</div>
								<?php endif;?>
							</li>
							<li class="nav-item dropdown mx-3">
								<a class="nav-link p-0" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #FBD15B; color:#5A47AB; border-radius: 5px; font-size: 14px;"><img src="<?=base_url('assets/logo/logo-admin.png');?>" class="img-fluid" style="max-width: 40px;"><label class="pl-1 pr-5"><?=$this->session->userdata('nama');?></label></a>
								<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
									<a class="dropdown-item" href="<?=base_url('user/profile/').$this->session->userdata('id_user');?>">Profile</a>
									<a class="dropdown-item" href="<?=base_url('auth/logout');?>">Logout</a>
								</div> 
							</li>
						</ul>
					</div>
				</div>
			</nav>
			<?php endif;?>