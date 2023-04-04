<style type="text/css">
	div#boxNotif1{
		border: solid 1px #D8D8D8; 
		padding :2%; 
		background-color: white;
	}

	div#boxNotif2{
		border: solid 1px #D8D8D8; 
		padding :2%; 
		background-color: #D8D8D8;
	}
</style>

<div class="container-fluid py-5" style="padding-right: 10%; padding-left: 10%;">
	<div class="head-home my-5" style="border: solid 2px; border-color: #FBD15B;">
		<h2 style="font-weight: 500; padding: 5px;">List Notifikasi</h2>
	</div>
	<?= $this->session->flashdata('message');?>
	<div class="container-fluid mb-5">
		<button type="button" id="btnMarkRead" class="btn btn-outline-success text-decoration-none p-1" style=" border-radius: 5px; float: right;" onclick="readAll()">Tandai dibaca</button>

		<button type="button" id="btnMarkRead" class="btn btn-outline-info text-decoration-none p-1 mr-3" style=" border-radius: 5px; float: right;" data-toggle="modal" data-target="#modalNotif">Kontak Admin</button><br>
	</div>

	<div class="listNotif mt-5" style="font-size: 14px; color: black;">
		<?php foreach($notif as $nt):
			if($nt['status'] == 0):?>
				<div class="boxNotif mb-3" id="boxNotif1">
					<label style="font-weight: 700;"><img src="<?=base_url('assets/logo/avaInkubator.png')?>" style="max-width: 35px;"> <?=$nt['pengirim']?></label>
					<label style="float: right; font-weight: 300;"><?= $nt['waktu'];?></label>
					<div class="boxDalamNotif" style="padding: 1%;">
						<div class="row">
							<div class="col-11">
								<p style="color: black;"><?=$nt['isi'];?></p>
							</div>
							<div class="notifMark col-1">
								<span class="badge badge-pill badge-danger float-right">!</span>
							</div>
						</div>
						<?php if($nt['file'] != "" || $nt['link'] != ""):?>
							<hr style="border-top: solid 1px #D8D8D8;">
								<h3>Tautan</h3>
								<div class="row no-gutters">
									<div class="col-6">
										<p>Link : <a href="<?=$nt['link']?>" target="<?=$nt['link']?>"><?=$nt['link']?></a></p>
									</div>
									<div class="col-6">
										<p>File: <a href="<?=$nt['file']?>" target="<?=$nt['file']?>"><?=$nt['file']?></a></p>
									</div>
								</div>
							<?php endif;?>
					</div>
				</div>
				<?php else:?>
					<div class="boxNotif mb-3" id="boxNotif2">
						<label style="font-weight: 700;"><img src="<?=base_url('assets/logo/avaInkubator.png')?>" style="max-width: 35px;"> <?=$nt['pengirim']?></label>
						<label style="float: right; font-weight: 300;"><?= $nt['waktu'];?></label>
						<div class="boxDalamNotif" style="padding: 1%;">
							<div class="row">
								<div class="col-11">
									<p style="color: black;"><?=$nt['isi'];?></p>
								</div>
								<div class="notifMark col-1">
								</div>
							</div>
							<?php if($nt['file'] != "" || $nt['link'] != ""):?>
								<p>Tautan</p>
								<div class="row no-gutters">
									<div class="col-6">
										
									</div>
									<div class="col-6">
										
									</div>
								</div>
							<?php endif;?>
						</div>
					</div>
				<?php endif; 
			endforeach;?>
		</div>
		<?= $this->pagination->create_links();?>
	</div>

<div class="modal fade" id="modalNotif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Kontak Admin</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('user/kontakAdmin')?>" enctype="multipart/form-data">
				<div class="modal-body">
					<div class="form-group row">
						<label for="pesan" class="col-sm-4 col-form-label">Pesan</label>
						<div class="col-sm-8">
							<textarea class="form-control" id="pesan" name="pesan" required rows="4"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-dark" id="btnSubmit" name="btnSubmit" value="link:0;file:0">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	var countNotif = '<?=$countNotif;?>';
	console.log(countNotif);

	function disableButton(){
		var btnMark = document.getElementById('btnMarkRead');
		btnMark.classList.remove("btn-outline-success");
		btnMark.classList.add("btn-outline-secondary");
		btnMark.setAttribute("disabled", "true");
	}

	if (countNotif == 0) {
		disableButton()
	}

	function readAll(){
		var boxAktif = document.querySelectorAll('.boxNotif').length;
		var id_user = "<?=$this->session->userdata('id_user');?>";
		for (var i = 0; i < boxAktif; i++) {
			document.getElementsByClassName('boxNotif')[i].id = 'boxNotif2';
			document.getElementsByClassName('notifMark')[i].innerHTML = '';
		}

		$.ajax({
			url:"<?=base_url();?>/user/readAll/"+id_user,
			dataType:"JSON"
		});
		disableButton();
		document.getElementById('notifCountHead').remove();
	}
</script>