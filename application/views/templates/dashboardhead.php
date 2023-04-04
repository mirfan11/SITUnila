<!DOCTYPE html>
<!-- Created by CodingLab |www.youtube.com/CodingLabYT-->
<html lang="en" dir="ltr">
<head>
  <title>Dashboard - SIT</title>
  <meta charset="UTF-8">
  <!--<title> Responsive Sidebar Menu  | CodingLab </title>-->
  <link rel="stylesheet" href="<?=base_url('assets/css/dashboard/sidebar.css');?>">
  <link rel="stylesheet" href="<?=base_url('assets/css/dashboard/style.css');?>">
  <!-- Boxicons CDN Link -->
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/8f37dd1c37.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #5A47AB">
    <div class="container-fluid my-2">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mx-3" style="border-right: solid 1px white;">
            <a class="nav-link pr-5" href="<?=base_url('home');?>" style="color: white;">Site Home</a>
          </li>
          <li class="nav-item mx-3">
            <a class="btn btnLogin px-4" href="<?=base_url('dashboard/notifikasi');?>"><i class='bx bxs-bell-ring' style="font-size: 21px; color: #FBD15B;"></i>
              <?php if($this->session->userdata('notif') != "0"):?>
                <span class="badge badge-pill badge-danger" id="notifCountHead"><?=$this->session->userdata('notif');?></span>
              <?php endif;?>
            </a>
          </li>
          <li class="nav-item dropdown mx-3">
                <a class="nav-link p-0" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #FBD15B; color:#5A47AB; border-radius: 5px; font-size: 14px;"><img src="<?=base_url('assets/logo/logo-admin.png');?>" class="img-fluid" style="max-width: 40px;"><label class="pl-1 pr-5"><?=$this->session->userdata('nama');?></label></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="<?=base_url('dashboard/profile/').$this->session->userdata('id_user');?>">Profile</a>
                  <a class="dropdown-item" href="<?=base_url('auth/logout');?>">Logout</a>
                </div> 
              </li>
        </ul>
      </div>
    </div>
  </nav>