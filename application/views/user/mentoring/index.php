<div class="container-fluid px-5">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-white" style="font-weight: 300;">
			<li class="breadcrumb-item"><a href="<?=base_url('home');?>" class="text-decoration-none text-muted">Beranda</a></li>
			<li class="breadcrumb-item text-muted">Forgos Coklat</li>
			<li class="breadcrumb-item text-muted" aria-current="page">Mentor</li>
		</ol>
	</nav>

	<div class="mx-5 mb-5">
		<div class="head-home my-3" style="border: solid 2px; border-color: #FBD15B;">
			<h2 style="font-weight: 500; padding: 5px;">Mentor</h2>
		</div>

		<div class="row no-gutters">
			<div class="col-5 col-sm-2">
				<a href="<?=base_url('user/tambahTenant');?>" class="text-decoration-none p-1" style="color: #5A47AB; background-color: #F2F2F2; border-radius: 5px;" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-fw fa-plus-circle"></i> Ikuti Kelas Mentoring</a>
			</div>
			<div class="col-5 col-sm-2 ">
				<a href="<?=base_url('user/tambahTenant');?>" class="text-decoration-none p-1" style="color: #5A47AB; background-color: #F2F2F2; border-radius: 5px;" data-toggle="modal" data-target="#modalListMentor"><i class="fas fa-fw fa-bars"></i> List Mentor</a>
			</div>
		</div>

		<div class="my-5" style="border: solid 1px #d8d8d8; border-radius: 2px; padding: 1%;">
			<h4 style="font-weight: 400;">Kelas Mentoring</h4>
			<div class="listBoxMentoring row no-gutters mt-5">
				<div class="boxMentoring col-4 col-md-2 mx-2" style="border: solid 1px #d8d8d8; border-radius: 10px; padding: 1%; cursor: pointer;" onclick="window.location='<?=base_url('user/kelasMentoring');?>'">
					<img src="<?=base_url('assets/logo/gambarMentoring.png');?>" style="max-width: 70%; height: auto; margin-left: auto; margin-right: auto; display: block;">
					<p style="font-weight: 400;" class="mt-2">Mentoring 1</p>
					<p class="text-right mt-4 mb-0" style="font-weight: 300; font-size: 14px;">Mentor : Ahmad Nafri</p>
				</div>
				<div class="boxMentoring col-4 col-md-2 mx-2" style="border: solid 1px #d8d8d8; border-radius: 10px; padding: 1%; cursor: pointer;">
					<img src="<?=base_url('assets/logo/gambarMentoring.png');?>" style="max-width: 70%; height: auto; margin-left: auto; margin-right: auto; display: block;">
					<p style="font-weight: 400;" class="mt-2">Mentoring 2</p>
					<p class="text-right mt-4 mb-0" style="font-weight: 300; font-size: 14px;">Mentor : Ahmad Nafri</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ikuti Kelas Mentoring</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form>
				<div class="modal-body">
					<div class="form-group row">
						<label for="enroll" class="col-sm-3 col-form-label">Enroll Key</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="enroll" name="enroll" placeholder="Masukkan key">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btnLogin">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="modalListMentor" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalScrollableTitle">List Mentor</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col">Nama Mentor</th>
								<th scope="col">Keahlian</th>
								<th scope="col">Kontak WA</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<th scope="row">1</th>
								<td>Ahmad Nafri</td>
								<td>1. Basis Data<br>2. Pemrograman Terstruktur</td>
								<td>089509850985</td>
							</tr>
							<tr>
								<th scope="row">2</th>
								<td>Bejo</td>
								<td>1. Leadership<br>2. Manajemen IT</td>
								<td>089509860957</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>