<section class="home-section">
	<div class="text container-fluid px-5">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7;">
				<li class="breadcrumb-item" style="color: #5A47AB;"><a href="<?=base_url('dashboard/tenant/');?>" class="text-decoration-none" style="color: #5A47AB;">Tenant</a></li>
				<li class="breadcrumb-item" class="text-decoration-none"  aria-current="page"><a href="<?=base_url('dashboard/riwayatInkubasi/');?>" class="text-decoration-none" style="color: #5A47AB;">Riwayat Inkubasi</a></li>
			</ol>
		</nav>

		<div class="mx-5 mb-5 pr-5">
			<div class="head-home mt-3 mb-5" style="border: solid 2px; border-color: #FBD15B;">
				<h2 class="pl-3" style="font-weight: 500; color: #5A47AB;">Riwayat Inkubasi</h2>
			</div>

			<form class="form-inline my-2" method="post" action="<?= base_url('dashboard/search')?>" style="float: right;">
		      <input class="form-control mr-sm-2 col-9" id="search" name="search" placeholder="Cari tenant">
		      <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit" id="submitSearch" value="riwayatInkubasi" name="btnSearch"><i class="fas fa-fw fa-search"></i></button>
		    </form>

			<div class="table-responsive mb-3">
				<table class="table text-center" style="font-size: 14px;">
					<thead style="background-color: #5A47AB; color: #FBD15B;">
						<tr>
							<th scope="col" style="">No</th>
							<th scope="col">Nama Tenant</th>
							<th scope="col">Tanggal Pendaftaran</th>
							<th scope="col">Tanggal Selesai Inkubasi</th>
							<th scope="col">Action</th>
						</tr>
					</thead>
					<tbody class="bg-white">
						<?php $i=1; 
						foreach($tenant as $tn):?>
							<tr>
								<th scope="row"><?=$tn['nomor'];?></th>
								<td><?=$tn['nama_tenant']?></td>
								<td><?=$tn['waktu'];?></td>
								<td><?=$tn['waktu_selesai'];?></td>
								<td>
									<a href="<?=base_url('dashboard/detailTenant/').$tn['id_tenant'];?>" class="mx-2 text-decoration-none"><i class="far fa-fw fa-eye mx-2" style="color: #5A47AB; cursor: pointer;"></i></a>
								</td>
							</tr>
						<?php $i++; 
					endforeach;?>
					</tbody>
				</table>
			</div>
			<?= $this->pagination->create_links();?>
		</div>
	</div>
</section>
