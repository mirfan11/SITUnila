<div class="container-fluid py-5" style="padding-right: 10%; padding-left: 10%;">
	<div class="head-home my-5" style="border: solid 2px; border-color: #FBD15B;">
		<h2 style="font-weight: 500; padding: 5px;">Upload Berkas Seleksi Tahap 2</h2>
	</div>

	<form class="col-8 col-sm-6" method="post" action="" enctype="multipart/form-data">
		<div class="form-group">
			<div class="row">
				<div class="col-md-4">
					<label>File Presentasi (PPT)</label>            
				</div>
				<div class="col-md-7">            
					<input type="file" id="ppt" name="ppt" accept=".ppt, .pptx" required>
				</div>
			</div>
		</div>
		<div class="form-group mb-4">
			<label for="link">Link Youtube Demo Produk</label>
			<input type="text" class="form-control" id="link" name="link">
		</div>
		<div class="form-group">
			<div class="row">
				<div class="col-md-4">
					<label>Profile Tim (PDF)</label>            
				</div>
				<div class="col-md-7">            
					<input type="file" id="profile" name="profile" accept="application/pdf" required>
				</div>
			</div>
		</div>
		<br><button type="submit" class="btnRegis btn btn-lg px-5 mt-2">Submit Berkas</button>
	</form>

</div>