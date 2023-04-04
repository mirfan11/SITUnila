<div class="sidebar">
    <div class="logo-details">
        <div class="logo_name"><img src="<?=base_url('assets/logo/logo-min.png');?>" class="img-fluid" style="max-width: 80%; height: auto;"></div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
      <?php if($this->session->userdata('role_id') == 1):?>
      <li>
        <a href="<?= base_url('dashboard');?>">
          <i class='bx bx-tv' style="color: #5E72E4;"></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li>
      <li class="tenant">
       <a href="#">
         <i class='bx bxs-planet' ></i>
         <span class="links_name">Tenant</span>
       </a>
       <span class="tooltip">Tenant</span>
     </li>
     <div id="dropdown-container-3" name="dropdown-container-3">
       <li class="ml-3">
         <a href="<?= base_url('dashboard/tenant');?>">
           <i class='bx bx-list-ol' style="color: #8493eb;"></i>
           <span class="links_name">Daftar Tenant</span>
         </a>
         <span class="tooltip">Daftar Tenant</span>
       </li>
       <li class="ml-3">
         <a href="<?= base_url('dashboard/riwayatInkubasi');?>">
           <i class='bx bx-history' style="color: #7687e8;"></i>
           <span class="links_name">Riwayat Inkubasi</span>
         </a>
         <span class="tooltip">Riwayat Inkubasi</span>
       </li>
     </div>
     <li>
       <a href="<?= base_url('dashboard/rekrutmen');?>">
        <i class='bx bxs-user-circle' style="color: #F3A4B5;"></i>
         <span class="links_name">Rekrutmen</span>
       </a>
       <span class="tooltip">Rekrutmen</span>
     </li>
     <li class="kelas">
       <a href="#">
         <i class='bx bx-list-ul' style="color: #F5365C;"></i>
         <span class="links_name">Kelas</span>
       </a>
       <span class="tooltip">Kelas</span>
     </li>
     <div id="dropdown-container" name="dropdown-container">
       <li class="ml-3">
         <a href="<?= base_url('dashboard/praInkubasi');?>">
           <i class='bx bx-chevron-right' style="color: #F5365C;"></i>
           <span class="links_name">Pra Inkubasi</span>
         </a>
         <span class="tooltip">Pra Inkubasi</span>
       </li>
       <li class="ml-3">
         <a href="<?= base_url('dashboard/inkubasi');?>">
           <i class='bx bx-chevron-right' style="color: #F5365C;"></i>
           <span class="links_name">Inkubasi</span>
         </a>
         <span class="tooltip">Inkubasi</span>
       </li>
     </div>
     <li class="monev-side">
       <a href="#">
         <i class='bx bx-key' style="color: #11CDEF;"></i>
         <span class="links_name">Monev</span>
       </a>
       <span class="tooltip">Monev</span>
     </li>
      <div id="dropdown-container-2" name="dropdown-container-2">
       <li class="ml-3">
         <a href="<?=base_url('dashboard/coachingLog')?>">
           <i class='bx bx-chevron-right' style="color: #11CDEF;"></i>
           <span class="links_name">Coaching Log</span>
         </a>
         <span class="tooltip">Coaching Log</span>
       </li>
       <li class="ml-3">
         <a href="<?= base_url('dashboard/penilaianMonev');?>">
           <i class='bx bx-chevron-right' style="color: #11CDEF;"></i>
           <span class="links_name">Penilaian Monev</span>
         </a>
         <span class="tooltip">Penilaian Monev</span>
       </li>
     </div>
     <li>
       <a href="<?= base_url('dashboard/masterData');?>">
         <i class='bx bxs-user' style="color: #FFD600;"></i>
         <span class="links_name">Master Data</span>
       </a>
       <span class="tooltip">Master Data</span>
     </li>

     <?php elseif($this->session->userdata('role_id') == 3):?>
      <li>
        <a href="<?= base_url('dashboard');?>">
          <i class='bx bx-tv' style="color: #5E72E4;"></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li>
      <li class="tenant">
       <a href="#">
         <i class='bx bxs-planet' ></i>
         <span class="links_name">Tenant</span>
       </a>
       <span class="tooltip">Tenant</span>
     </li>
     <div id="dropdown-container-3" name="dropdown-container-3">
       <li class="ml-3">
         <a href="<?= base_url('dashboard/tenant');?>">
           <i class='bx bx-list-ol' style="color: #8493eb;"></i>
           <span class="links_name">Daftar Tenant</span>
         </a>
         <span class="tooltip">Daftar Tenant</span>
       </li>
       <li class="ml-3">
         <a href="<?= base_url('dashboard/riwayatInkubasi');?>">
           <i class='bx bx-history' style="color: #7687e8;"></i>
           <span class="links_name">Riwayat Inkubasi</span>
         </a>
         <span class="tooltip">Riwayat Inkubasi</span>
       </li>
     </div>
     <li class="kelas">
       <a href="#">
         <i class='bx bx-list-ul' style="color: #F5365C;"></i>
         <span class="links_name">Kelas</span>
       </a>
       <span class="tooltip">Kelas</span>
     </li>
     <div id="dropdown-container" name="dropdown-container">
       <li class="ml-3">
         <a href="<?= base_url('dashboard/praInkubasi');?>">
           <i class='bx bx-chevron-right' style="color: #F5365C;"></i>
           <span class="links_name">Pra Inkubasi</span>
         </a>
         <span class="tooltip">Pra Inkubasi</span>
       </li>
       <li class="ml-3">
         <a href="<?= base_url('dashboard/inkubasi');?>">
           <i class='bx bx-chevron-right' style="color: #F5365C;"></i>
           <span class="links_name">Inkubasi</span>
         </a>
         <span class="tooltip">Inkubasi</span>
       </li>
     </div>
     <li class="monev-side">
       <a href="#">
         <i class='bx bx-key' style="color: #11CDEF;"></i>
         <span class="links_name">Monev</span>
       </a>
       <span class="tooltip">Monev</span>
     </li>
      <div id="dropdown-container-2" name="dropdown-container-2">
       <li class="ml-3">
         <a href="<?=base_url('dashboard/coachingLog')?>">
           <i class='bx bx-chevron-right' style="color: #11CDEF;"></i>
           <span class="links_name">Coaching Log</span>
         </a>
         <span class="tooltip">Coaching Log</span>
       </li>
       <li class="ml-3">
         <a href="<?= base_url('dashboard/penilaianMonev');?>">
           <i class='bx bx-chevron-right' style="color: #11CDEF;"></i>
           <span class="links_name">Penilaian Monev</span>
         </a>
         <span class="tooltip">Penilaian Monev</span>
       </li>
     </div>

     <?php elseif($this->session->userdata('role_id') == 5):?>
      <li>
        <a href="<?= base_url('dashboard');?>">
          <i class='bx bx-tv' style="color: #5E72E4;"></i>
          <span class="links_name">Dashboard</span>
        </a>
         <span class="tooltip">Dashboard</span>
      </li>
      <li>
       <a href="<?= base_url('dashboard/tenant');?>">
         <i class='bx bxs-planet' ></i>
         <span class="links_name">Tenant</span>
       </a>
       <span class="tooltip">Tenant</span>
     </li>
     <li>
       <a href="<?= base_url('dashboard/riwayatInkubasi');?>">
         <i class='bx bx-history' style="color: #1f37bc;"></i>
         <span class="links_name">Riwayat Inkubasi</span>
       </a>
       <span class="tooltip">Riwayat Inkubasi</span>
     </li>
     <li>
       <a href="<?= base_url('dashboard/inkubasi');?>">
         <i class='bx bx-list-ul' style="color: #F5365C;"></i>
         <span class="links_name">Kelas</span>
       </a>
       <span class="tooltip">Kelas</span>
     </li>
     <li class="monev-side">
       <a href="#">
         <i class='bx bx-key' style="color: #11CDEF;"></i>
         <span class="links_name">Monev</span>
       </a>
       <span class="tooltip">Monev</span>
     </li>
      <div id="dropdown-container-2" name="dropdown-container-2">
       <li class="ml-3">
         <a href="<?=base_url('dashboard/coachingLog')?>">
           <i class='bx bx-chevron-right' style="color: #11CDEF;"></i>
           <span class="links_name">Coaching Log</span>
         </a>
         <span class="tooltip">Coaching Log</span>
       </li>
       <li class="ml-3">
         <a href="<?= base_url('dashboard/penilaianMonev');?>">
           <i class='bx bx-chevron-right' style="color: #11CDEF;"></i>
           <span class="links_name">Penilaian Monev</span>
         </a>
         <span class="tooltip">Penilaian Monev</span>
       </li>
     </div>
     <?php endif;?>
    </ul>
  </div>
  
<script>

</script>

  