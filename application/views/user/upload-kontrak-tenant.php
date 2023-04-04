<div class="container-fluid py-5" style="padding-right: 10%; padding-left: 10%;">
	<div class="head-home my-5" style="border: solid 2px; border-color: #FBD15B;">
		<h2 style="font-weight: 500; padding: 5px;">Kontrak Tenant</h2>
	</div>

	<?php if($tenant['kontrak']==""):?>
		<div style="border: solid 1px #d8d8d8;">
			<div style="font-weight: 700; font-size: 20px; padding: 1%;">Kontrak Tenant</div>
			<div style="border-top: solid 1px #d8d8d8; padding-left: 1%;" class="py-4">File Kontrak Tenant dapat diunduh <a href="<?=base_url('assets/dokumen/contoh_dokumen.pdf')?>" download>disini</a></div>
		</div>

		<form class="col-8 col-sm-6 mt-5" method="post" action="" enctype="multipart/form-data">
			<div class="form-group">
				<label style="font-weight: 700;">Upload File Kontrak Tenant (PDF)</label>                        
				<div class="custom-file">
					<input type="file" id="kontrak" name="kontrak" accept="application/pdf" required>
				</div>
			</div>
			<br><button type="submit" name="submit" class="btnRegis btn btn-lg px-5 mt-2" value="submit">Submit Berkas</button>
		</form>
	<?php else:?>
		<div class="col-8 col-sm-6 mt-5">
			<iframe class="col-12" src="https://drive.google.com/file/d/1qngAy3D2zILkE5V-a6MgOE9ADC_H0B5r/preview" style="min-height: 480px;"></iframe>
		</div>
	<?php endif;?>
</div>
