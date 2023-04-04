<section class="home-section">
	<div class="text container-fluid">
		<nav aria-label="breadcrumb" style="color: #5A47AB;">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7; ">
				<li class="breadcrumb-item"><a href="<?=base_url('dashboard/rekrutmen');?>" class="text-decoration-none" style="color: #5A47AB;">Rekrutmen</a></li>
				<li class="breadcrumb-item" class="text-decoration-none" style="color: #5A47AB;" aria-current="page">Forgos Coklat</li>
			</ol>
		</nav>

		<div class="px-3 pb-5 mr-5 bg-white" style="border: solid 1px #d8d8d8; border-radius: 5px; color: #5A47AB;">
			<h3>Kontrak Tenant</h3>
			
			<div class="row px-3 mt-5" style="color: #525F7F; font-size: 16px;">
				<div class="col-10 col-sm-8">
					<p>File Kontrak Tenant (PDF)</p>
					<iframe class="col-12" src="https://drive.google.com/file/d/1qngAy3D2zILkE5V-a6MgOE9ADC_H0B5r/preview" style="min-height: 480px;"></iframe><br>
				</div>
			</div>
			<?php if($tenant['status']==3):?>
				<a href="<?=base_url('dashboard/verifikasiKontrak/').$tenant['id_tenant'];?>" class="btn btn-dark mt-5 ml-3" type="submit">Verifikasi</a>
			<?php elseif($tenant['status']==4):?>
				<p class="mt-3">Kontrak telah diverifikasi!</p>
			<?php endif;?>
		</div>
	</div>
</section>




