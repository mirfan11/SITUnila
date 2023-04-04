<section class="home-section">
	<div class="text container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7;">
				<li class="breadcrumb-item" class="text-decoration-none"  aria-current="page"><a href="<?=base_url('dashboard/penilaianMonev/');?>" class="text-decoration-none" style="color: #5A47AB;">Penilaian Monev</a></li>
			</ol>
		</nav>

		<div class="mx-5 mb-5 pr-5">
			<div class="head-home mt-3" style="border: solid 2px; border-color: #FBD15B;">
				<h2 class="pl-3" style="font-weight: 500; color: #5A47AB;">Penilaian Monev</h2>
			</div>

			<div class="my-5">
				<form method="post" action="<?=base_url('dashboard/submitPenilaianMonev/').$monev['id_monev'];?>">
					<div class="mb-3" style="border: solid 1px #D8D8D8;">
						<label style="font-size: 20px; font-weight: 600; border-bottom: solid 1px #D8D8D8; padding: 1%; background-color: #d8d8d8; color: #5A47AB; margin-bottom: 0;" class="col-12">Form Penilaian Monev (KPI : Key Performance Indicator)</label>
						<div class="boxDalamPraInkubasi px-4" style="padding: 1%; font-size: 14px; color: #525F7F; background-color: white;">
							<div class="form-row">
								<div class="form-group col-12 col-sm-4">
									<label for="tenant">Nama Tenant</label>
									<input type="text" class="form-control col-10" id="tenant" name="tenant" readonly value="<?=$tenant['nama_tenant'];?>">
								</div>
								<?php if($this->session->userdata('role_id') == 1 && $monev['coach'] == ''):?>
									<div class="form-group col-12 col-sm-3">
										<label for="coach">Nama Coach</label>
										<select class="form-control" style="background-color: #F2F2F2;" name="coach" id="coach" required>
										</select>
									</div>
								<?php else:?>
									<div class="form-group col-12 col-sm-3">
										<label for="coach">Nama Coach</label>
										<input type="text" class="form-control" style="background-color: #F2F2F2;" name="coach" id="coach" value="<?=$monev['coach'];?>" readonly>
									</div>
								<?php endif;?>
							</div>
							<br><p>Bisnis Plan</p>
							<iframe class="col-10" src="https://drive.google.com/file/d/1qngAy3D2zILkE5V-a6MgOE9ADC_H0B5r/preview" style="min-height: 480px; margin-right: auto; margin-left: auto; display: block;"></iframe><br>
							<br><p>Pembukuan</p>
							<iframe class="col-10" src="https://drive.google.com/file/d/1qngAy3D2zILkE5V-a6MgOE9ADC_H0B5r/preview" style="min-height: 480px; margin-right: auto; margin-left: auto; display: block;"></iframe><br>

							<div class="table-responsive px-5 my-3">
								<table class="table text-center" style="font-size: 14px;">
									<thead style="background-color: #5A47AB; color: #FBD15B;">
										<tr>
											<th scope="col">No</th>
											<th scope="col">Tahapan Penilaian</th>
											<th scope="col">Point Penilaian</th>
											<th scope="col">Keterangan</th>
											<th scope="col">Action</th>
										</tr>
									</thead>
									<tbody class="bg-white tablePenilaian">
										<?php for($i = 0; $i < $countNilai; $i++):?>
											<tr class="rowPenilaian">
												<th scope="row" class="nomorPenilaian"><?=$i+1;?></th>
												<td>
													<input type="text" class="form-control namaPenilaian" name="namaPenilaian[]" placeholder="Nama Penilaian" required>
												</td>
												<td>
													<input type="number" class="form-control penilaian" name="penilaian[]" placeholder="1-5" required min="1" max="5">
												</td>
												<td>
													<textarea class="form-control keterangan" rows="2" name="keterangan[]"></textarea>
												</td>
												<td>
													<i class="far fa-fw fa-trash-alt text-danger" onclick="deletePenilaian(this)"></i>
												</td>
											</tr>
										<?php endfor;?>
										<div id="penilaianTambahan">
										</div>
									</tbody>
								</table>
							</div>
							<button class="btn btn-dark" type="submit">Submit Nilai</button>
							<button class="btn btn-success" type="button" onclick="tambahPenilaian()"><i class="fas fa-fw fa-plus-circle"></i> Tambah Penilaian</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<script type="text/javascript">
	<?php if($this->session->userdata('role_id') == 1 && $monev['coach'] == ''):?>
	function checkCoach(){
		var coach = '<?=$monev['coach']?>';
		var listCoach = <?=$coach?>;

		if (coach == '') {
			var htmlListCoach = '<option value="">Pilih coach</option>';
			for (var i = 0; i < listCoach.length; i++) {
				htmlListCoach += '<option value="'+listCoach[i]+'">'+listCoach[i]+'</option>';
			}
		} else {
			var htmlListCoach = '<option value="'+coach+'">'+coach+'</option>';
			for (var i = 0; i < listCoach.length; i++) {
				if (listCoach[i] != coach) {
					htmlListCoach += '<option value="'+listCoach[i]+'">'+listCoach[i]+'</option>';
				}
			}
		}
		document.getElementById('coach').innerHTML = htmlListCoach;
	}
	checkCoach();
	<?php endif;?>

	<?php if($data_nilai == ""):?>
		var namaPenilaian = ['Perkembangan Bisnis Model', 'Perkembangan Produk', 'Perkembangan / Kelengkapan SDM sebagai team', 'Aspek Legalitas (HKI, Badan Hukum, dll...)', 'Marketing Plan yang sudah dikerjakan', 'Financial Plan', 'Operation Plan', 'Checklist Action Plan', 'Jumlah Sesi Coaching', 'Kualitas Sesi Coaching'];

		for (var i = 0; i < namaPenilaian.length; i++) {
			var kolom = document.getElementsByClassName('namaPenilaian')[i];
			kolom.value = namaPenilaian[i];
		}
	<?php else:?>
		var namaPenilaian = [<?= $data_nilai['nama_penilaian'] ;?>];
		var nilai = [<?= $data_nilai['nilai'] ;?>];
		var keterangan = [<?= $data_nilai['keterangan'] ;?>];

		for (var i = 0; i < namaPenilaian.length; i++) {
			var kolom1 = document.getElementsByClassName('namaPenilaian')[i];
			var kolom2 = document.getElementsByClassName('penilaian')[i];
			var kolom3 = document.getElementsByClassName('keterangan')[i];
			kolom1.value = namaPenilaian[i];
			kolom2.value = nilai[i];
			kolom3.innerHTML = keterangan[i];
		}
	<?php endif;?>

	function tambahPenilaian(){
		var divPenilaian = document.querySelector('.tablePenilaian');
		console.log(divPenilaian);
		var row = document.createElement('tr');
		row.className = `rowPenilaian`;
		var totalPenilaian = document.querySelectorAll('.rowPenilaian').length;
		console.log(totalPenilaian);
		var htmlAdd = `<th scope="row" class="nomorPenilaian">`+ (totalPenilaian+1) +`</th>
						<td>
							<input type="text" class="form-control namaPenilaian" name="namaPenilaian[]" placeholder="Nama Penilaian" required>
						</td>
						<td>
							<input type="number" class="form-control penilaian" name="penilaian[]" placeholder="1-5" required min="1" max="5">
						</td>
						<td>
							<textarea class="form-control keterangan" rows="2" name="keterangan[]"></textarea>
						</td>
						<td>
							<i class="far fa-fw fa-trash-alt text-danger" onclick="deletePenilaian(this)"></i>
						</td>`;
		row.innerHTML = htmlAdd;
		divPenilaian.parentNode.appendChild(row);
		console.log(row);
	}

	function deletePenilaian(a){
		a.parentNode.parentNode.parentNode.removeChild(a.parentNode.parentNode);
		var totalPenilaian = document.querySelectorAll('.rowPenilaian').length;
		for (var i = 0; i < totalPenilaian; i++) {
			document.getElementsByClassName('nomorPenilaian')[i].innerHTML = i+1;
		}
	}
</script>
