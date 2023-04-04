<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<section class="home-section">
	<div class="text container-fluid">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7;">
				<li class="breadcrumb-item"><a href="<?=base_url('dashboard');?>" class="text-decoration-none" style="color: #5A47AB;">Dashboard</a></li>
			</ol>
		</nav>

		<div class="col-12 px-5">
			<h2 style="color: #5A47AB;">Selamat Datang di SIT UNILA</h2>
			<p style="color: #FFD600;"><?=$nama_user . ' - ' . $role;?></p>
		</div>

		<?php if($this->session->userdata('role_id') == 1):?>
			<div class="row no-gutters mt-5 px-4">
				<div class="col-6 col-sm-3 px-3 py-1" style="">
					<div class="px-3 py-1" style="background-color: #F8F9FE; border-radius: 5px;">
						<p style="font-size: 14px;">Total Tenant</p>
						<p style="font-size: 20px;"><?=$info['tenant'];?> <span style="height: 25px; width: 25px; background-color: #F5365C; border-radius: 50%; display: inline-block; float: right;"></span></p>
					</div>
				</div>
				<div class="col-6 col-sm-3 px-3 py-1" style="">
					<div class="px-3 py-1" style="background-color: #F8F9FE; border-radius: 5px;">
						<p style="font-size: 14px;">Total Coach</p>
						<p style="font-size: 20px;"><?=$info['coach'];?> <span style="height: 25px; width: 25px; background-color: #FB6340; border-radius: 50%; display: inline-block; float: right;"></span></p>
					</div>
				</div>
				<div class="col-6 col-sm-3 px-3 py-1" style="">
					<div class="px-3 py-1" style="background-color: #F8F9FE; border-radius: 5px;">
						<p style="font-size: 14px;">Total Pendamping</p>
						<p style="font-size: 20px;"><?=$info['pendamping'];?> <span style="height: 25px; width: 25px; background-color: #FFD600; border-radius: 50%; display: inline-block; float: right;"></span></p>
					</div>
				</div>
				<div class="col-6 col-sm-3 px-3 py-1" style="">
					<div class="px-3 py-1" style="background-color: #F8F9FE; border-radius: 5px;">
						<p style="font-size: 14px;">Total Kelas</p>
						<p style="font-size: 20px;"><?=$info['kelas'];?> <span style="height: 25px; width: 25px; background-color: #11CDEF; border-radius: 50%; display: inline-block; float: right;"></span></p>
					</div>
				</div>
			</div>
		<?php endif;?>

		<div class="my-5 px-5">
			<div class="head-home mt-3 mb-5">
				<h2 style="font-weight: 500; color: #5A47AB;">Grafik Key Performance</h2>
			</div>
			
			<div class="container py-4" style="background-color: #172B4D; border-radius: 5px;">
				<select class="form-control col-6 col-sm-3 ml-4 mb-4" id="pilihTenant" name="pilihTenant" onchange="getGrafik(this)">
				    <option value="">Pilih tenant</option>
				    <?php foreach($tenantGrafik as $tg):?>
				    	<option value="<?=$tg['id_tenant'];?>"><?=$tg['nama_tenant'];?></option>
				    <?php endforeach;?>
				</select>

				<div id="grafik">
				  <canvas id="myChart" width="80" height="30"></canvas>
				</div>
			</div>
		</div>
	</div>
</section>

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
			url:"<?=base_url();?>/dashboard/getGrafikTenant/"+value,
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