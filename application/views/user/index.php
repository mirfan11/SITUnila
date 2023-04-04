<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/user/index.css');?>">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="jumbotron" style="background-color: #5A47AB;">
	<div class="container-fluid">
		<img src="<?=base_url('assets/logo/jumbotron-home-tenant.png');?>" class="img-fluid" style="max-width: 50%; height: auto; margin-left: auto; margin-right: auto; display: block;">
		<p class="text-warning text-center" style="font-size: 1.8vw;"><?= $this->session->userdata('nama');?> - TENANT</p>
	</div>
</div>

<div class="container-fluid py-5" style="padding-right: 10%; padding-left: 10%;">
	<div class="menuProgress" style="border: solid 1px #e8e7e7;">
		<div class="row justify-content-center no-gutters p-5">
			<img src="<?=base_url('assets/logo/progress-pra-inkubasi.png');?>" class="mx-3 mt-2 img-fluid" width="100" height="100" style="width: 100%; max-width: 150px; height: auto; cursor: pointer;" onclick="window.location='<?=base_url('user/praInkubasi')?>'">
			<img src="<?=base_url('assets/logo/progress-inkubasi.png');?>" class="mx-3 mt-2 img-fluid" width="100" height="100" style="width: 100%; max-width: 150px; height: auto; cursor: pointer;" onclick="window.location='<?=base_url('user/inkubasi')?>'">
			<img src="<?=base_url('assets/logo/progress-monev.png');?>" class="mx-3 mt-2 img-fluid" width="100" height="100" style="width: 100%; max-width: 150px; height: auto; cursor: pointer;" onclick="window.location='<?=base_url('user/monev')?>'">
		</div>
	</div>
	<div class="head-home my-5" style="border: solid 2px; border-color: #FBD15B;">
		<h2 style="font-weight: 500; padding: 5px;">Status Tenant</h2>
	</div>
	<div class="container-fluid mb-5">
		<a href="<?=base_url('user/tambahTenant');?>" class="text-decoration-none p-1" style="color: #5A47AB; background-color: #F2F2F2; border-radius: 5px;"><i class="fas fa-fw fa-plus-circle"></i> Tambah Tenant</a>
	</div>
	<div class="table-responsive">
		<table class="table text-center">
			<thead>
				<tr>
					<th scope="col">No</th>
					<th scope="col">Nama Tenant</th>
					<th scope="col">Tanggal Pendaftaran</th>
					<th scope="col">Bidang Usaha</th>
					<th scope="col">Status</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$i=1;
				foreach($dataTenant as $dt):?>
					<tr>
						<th scope="row"><?=$dt['nomor'];?></th>
						<td><?=$dt['nama_tenant'];?></td>
						<td><?=$dt['waktu'];?></td>
						<td><?=$dt['bidang_usaha'];?></td>
						<td>
							<?php if($dt['status']==1):?>
								<div class="boxMerah">Belum Dinilai</div>
							<?php elseif($dt['status']==2):?>
								<div class="boxHijau">Lulus Tahap 1</div>
								<a href="<?= base_url('user/uploadTahap2/').$dt['id_tenant'];?>" class="text-decoration-none"><div class="boxOrange mt-2"><i class="fas fa-fw fa-pen"></i> Update</div></a></td>
							<?php elseif($dt['status']==3 || $dt['status']== 4 || $dt['status']== 5):?>
								<div class="boxHijau">Diterima</div>
								<?php if($dt['kontrak']!=""):?>
									<a href="<?=base_url('user/uploadKontrakTenant/').$dt['id_tenant']?>" class="UploadKontrak text-decoration-none"><div class="boxOrange mt-2"><i class="far fa-fw fa-eye"></i> Kontrak Tenant</div></a>
								<?php else:?>
									<a href="<?=base_url('user/uploadKontrakTenant/').$dt['id_tenant']?>" class="UploadKontrak text-decoration-none"><div class="boxOrange mt-2"><i class="fas fa-fw fa-pen"></i> Upload Kontrak</div></a>
								<?php endif;?>
							<?php elseif($dt['status']==0):?>
								<div class="boxMerah mb-1 text-center">Tidak Diterima</div>
							<?php endif;?>
							</td>
							<td>
								<a href="<?= base_url('user/detailTenant/'.$dt['id_tenant']) ;?>" class="mx-2 text-decoration-none" style="color: #5A47AB;" data-toggle="tooltip" data-placement="top" title="Detail"><i class="far fa-fw fa-eye"></i></a> 
								<?php if($dt['status']==0):?>
								<a href="" class="mx-2 text-decoration-none" style="color: red;" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="far fa-fw fa-trash-alt"></i></a></td>
								<?php endif;?>
						</tr>
				<?php 
				$i++;
				endforeach;?>
					
			</tbody>
		</table>
	</div>
	<?= $this->pagination->create_links();?>

	<div class="grafikKeyPerformance mt-5">
		<div class="head-home mb-3" style="border: solid 2px; border-color: #FBD15B;">
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

<div class="modal fade" tabindex="-1" role="dialog" id="modalMessage">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body" id="bodyModalMessage">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
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
					radius:4
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

<?php if($this->session->userdata('errorMessage')!= NULL):?>
	var message = `<?=$this->session->userdata('errorMessage');?>`;
	console.log(message);
	$(document).ready(function(){
		if (message == 'pra-inkubasi') {
			document.getElementById('bodyModalMessage').innerHTML = '<p>Silahkan selesaikan tahap Pendaftaran Tenant untuk dapat mengakses halaman ini!</p>'
		} else if (message == 'inkubasi'){
			document.getElementById('bodyModalMessage').innerHTML = '<p>Silahkan selesaikan tahap Pra-Inkubasi untuk dapat mengakses halaman ini!</p>'
		} else if (message == 'rekrutmen'){
			document.getElementById('bodyModalMessage').innerHTML = '<p>Pendaftaran tenant baru belum dibuka. Selalu update berita pembukaan pendaftaran melalui halaman pengumuman kami.</p>'
		} else if (message == 'penilaian'){
			document.getElementById('bodyModalMessage').innerHTML = '<p>Penilaian sedang dalam proses, harap ditunggu.</p>'
		}
		$('#modalMessage').modal('show');
	});
<?php $this->session->unset_userdata('errorMessage');
endif;?>


</script>