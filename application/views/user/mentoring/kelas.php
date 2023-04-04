<div class="container-fluid px-5">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-white" style="font-weight: 300;">
			<li class="breadcrumb-item"><a href="<?=base_url('home');?>" class="text-decoration-none text-muted">Beranda</a></li>
			<li class="breadcrumb-item text-muted">Forgos Coklat</li>
			<li class="breadcrumb-item text-muted">Mentor</li>
			<li class="breadcrumb-item text-muted" aria-current="page">Mentoring 1</li>
		</ol>
	</nav>

	<div class="mx-5 mb-5">
		<div class="head-home my-3" style="border: solid 2px; border-color: #FBD15B;">
			<h2 style="font-weight: 500; padding: 5px;">Mentor</h2>
		</div>

		<h3 style="font-weight: 400;" class="mt-5">Kelas Mentoring 1</h3>
		<div class="listKelasMentoring">
			<div class="boxKelasMentoring mb-3" style="border: solid 1px #D8D8D8;">
				<label style="font-size: 20px; font-weight: 400; border-bottom: solid 1px #D8D8D8; padding: 1%; background-color: #d8d8d8;" class="col-12">Pertemuan Mentoring 1</label>
				<div class="boxDalamPraInkubasi" style="padding: 1.5%; font-weight: 300;">
					<p style="color: black;"><i class="fas fa-fw fa-link mr-2"></i></i>Link Video Mentoring 1</p>
					<p style="color: black; cursor: pointer;" onclick="window.location='<?=base_url('user/feedbackMentoring');?>'"><i class="fas fa-fw fa-bullhorn mr-2"></i></i>Feedback Mentoring 1</p>
				</div>
			</div>
		</div>
	</div>
</div>