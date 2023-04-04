<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/user/index.css');?>">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container-fluid px-5">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb bg-white" style="font-weight: 300;">
			<li class="breadcrumb-item"><a href="<?=base_url('user');?>" class="text-decoration-none text-muted">Beranda</a></li>
			<li class="breadcrumb-item text-muted" aria-current="page"><a href="<?=base_url('user/monev');?>" class="text-decoration-none text-muted">Monev</a></li>
		</ol>
	</nav>

	<div class="mx-5 mb-5" style="min-height: calc(80vh - 40px);">
		<div class="head-home my-3" style="border: solid 2px; border-color: #FBD15B;">
			<h2 style="font-weight: 500; padding: 5px;">Monev</h2>
		</div>
		<a href="#" class="text-decoration-none p-1" style="color: #5A47AB; background-color: #F2F2F2; border-radius: 5px;" onclick="checkMonev()"><i class="fas fa-fw fa-plus-circle" ></i> Upload Bahan Monev</a>
		
		<div class="col-12 col-sm-4 p-0 mt-3">
			<?= $this->session->flashdata('message');?>
		</div>

		<div class="table-responsive mt-3">
			<table class="table text-center table-borderless">
				<thead style="background-color: #5A47AB; color: #FBD15B;">
					<tr>
						<th scope="col">No</th>
						<th scope="col">Nama Tenant</th>
						<th scope="col">File</th>
						<th scope="col">Tanggal Dikirim</th>
						<th scope="col">Status Monev</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i=1;
					foreach($monev as $mn):?>
						<tr>
							<th scope="row"><?=$mn['nomor'];?></th>
							<td><?=$mn['id_tenant'];?></td>
							<td>
								<a href="<?=base_url('assets/dokumen/monev/action-plan/').$mn['action_file'];?>" target="<?=base_url('assets/dokumen/action-plan/').$mn['action_file'];?>" class="text-decoration-none"><i class="fas fa-fw fa-file-pdf mr-2"></i> Action_Plan</a><br>
								<a href="<?=base_url('assets/dokumen/monev/action-plan/').$mn['pembukuan'];?>" target="<?=base_url('assets/dokumen/action-plan/').$mn['pembukuan'];?>" class="text-decoration-none"><i class="fas fa-fw fa-file-pdf mr-2"></i> Pembukuan</a>
							</td>
							<td><?=$mn['tanggal_dikirim'];?></td>
							<td>
								<?php if($mn['nilai_coach'] == "Belum Ada" || $mn['nilai_inkubator'] == "Belum Ada"):?>
									<div class="boxMerah text-center">Belum Dinilai</div>
								<?php else:?>
									Nilai Coach : <?=$mn['nilai_coach'];?><br>
									Nilai Inkubator : <?=$mn['nilai_inkubator'];?>
								<?php endif;?>
							</td>
							<td>
								<a href="<?=base_url('user/detailMonev/'.$mn['id_monev']);?>" class="mx-2 text-decoration-none" style="color: #5A47AB;"><i class="far fa-fw fa-eye"></i></a> 
								<?php if($mn['nilai_coach'] == "Belum Ada" || $mn['nilai_inkubator'] == "Belum Ada"):?>
									<a href="#" class="mx-2 text-decoration-none" style="color: red;" data-id="<?=$mn['id_monev'];?>" onclick="modalHapus(this)"><i class="far fa-fw fa-trash-alt"></i></a>
								<?php endif;?>
							</td>
						</tr>
					<?php $i++; endforeach;?>
					</tbody>
				</table>
			</div>
			<?= $this->pagination->create_links();?>
		</div>
		<div class="mx-5 mb-5">
			<div class="head-home my-5" style="border: solid 2px; border-color: #FBD15B;">
				<h2 style="font-weight: 500; padding: 5px;">Grafik Key Performance</h2>
			</div>

			<div class="container py-4" style="background-color: #172B4D; border-radius: 5px;">
				<select class="form-control col-6 col-sm-3 ml-4 mb-4" id="pilihTenant" name="pilihTenant" onchange="getGrafik(this)">
				    <option value="">Pilih tenant</option>
				    <?php foreach($tenantGrafik as $tg):?>
				    	<option value="<?=$tg['id_tenant'];?>"><?=$tg['nama_tenant'];?></option>
				    <?php endforeach;?>
				</select>

				<div id="grafik">
				  <canvas id="myChart"></canvas>
				</div>
			</div>

		</div>
	</div>

	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Upload Bahan Monev</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form method="post" action="<?=base_url('user/uploadMonev');?>" enctype="multipart/form-data">
					<div class="modal-body">
						<div class="form-group row">
							<label for="enroll" class="col-sm-3 col-form-label">Tenant</label>
							<div class="col-sm-9">
								<select class="form-control" name="tenant">
									<option value="">Pilih tenant...</option>
									<?php foreach($tenant as $tn):?>
										<option value="<?=$tn['id_tenant'];?>"><?=$tn['nama_tenant'];?></option>
									<?php endforeach;?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3">Action File</label>
							<div class="custom-file col-sm-9">
								<input type="file" id="actionPlan" name="actionPlan">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-sm-3">Pembukuan</label>
							<div class="custom-file col-sm-9">
								<input type="file" id="pembukuan" name="pembukuan">
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

	<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">System Message</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p>Belum pada masa upload monev.</p>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btnLogin">Submit</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalHapusMonev" tabindex="-1" role="dialog" aria-labelledby="modalHapusMonevLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalHapusMonevLabel">Hapus Monev</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p id="modalHapusMonevIsi">Anda yakin ingin menghapus Monev ini?</p>
			</div>
			<div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <a href="" class="btn btn-danger" id="submitHapus">Hapus</a>
		    </div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function modalHapus(a){
		var id_monev = a.getAttribute('data-id');
		document.getElementById('submitHapus').href = `<?=base_url('user/hapusMonev/')?>`+id_monev;
		$('#modalHapusMonev').modal('show');
	}

	function checkMonev(){
		var a = '<?=count($uploadMonev);?>';
		if (a > 0) {
			$('#exampleModal').modal('show');
		} else {
			$('#messageModal').modal('show');
		}
	}

	var chart = document.getElementById('myChart');
	const data = {
		labels: [],
		datasets: [{
			label: 'Nilai',
			backgroundColor: '#5E72E4',
			borderColor: '#5E72E4',
			data: [],
			tension: 0.4
		}]
	};

	const myChart = new Chart(chart,{
		type: 'line',
		data: data,
		options: {
			plugins:{
				legend:{
					align: 'end',
					labels:{
						color:'white'
					}
				}
			},
			elements:{
				point:{
					radius:1
				}
			},
			scales:{
				x:{
					grid:{
						display:false
					},
					ticks :{
						color: 'white'
					}
				},
				y:{
					min:0,
					max:100,
					ticks :{
						color: 'white',
						stepSize: 20
					}
				}
			}
		}
	}
	);		

	function getGrafik(a){
		var value = a.value;
		var grafik = document.getElementById('grafik').innerHTML;
		$.ajax({
			url:"<?=base_url();?>/user/getGrafikTenant/"+value,
			dataType:"JSON",
			success: function(b){
				updateChart(b.tanggal,b.nilai);
			}
		});
	}

	function updateChart(tanggal,nilai){
		var count = myChart.data.labels.length;
		for (var j = 0; j < count; j++) {
			myChart.data.labels.pop(j);
			myChart.data.datasets[0].data.pop(j);
		}
		myChart.update();

		for (var i = 0; i < tanggal.length; i++) {
			myChart.data.labels.push(tanggal[i]);
			myChart.data.datasets[0].data.push(nilai[i]);
		}
		myChart.update();
	}
</script>