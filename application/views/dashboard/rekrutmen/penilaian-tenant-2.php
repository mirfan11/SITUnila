<section class="home-section">
	<div class="text container-fluid">
		<nav aria-label="breadcrumb" style="color: #5A47AB;">
			<ol class="breadcrumb" style="font-weight: 400; background-color: #E4E9F7; ">
				<li class="breadcrumb-item"><a href="<?=base_url('dashboard/rekrutmen');?>" class="text-decoration-none" style="color: #5A47AB;">Rekrutmen</a></li>
			</ol>
		</nav>

		<div class="px-3 pb-5 mr-5 bg-white" style="border: solid 1px #d8d8d8; border-radius: 5px; color: #5A47AB;">
			<h3>Detail Tenant Tahap 2</h3>
			
			<div class="row px-3 mt-5" style="color: #525F7F; font-size: 16px;">
				<div class="col-10 col-sm-8">
					<p>File Presentasi (PPT)</p>
					<p><a href="<?=base_url('assets/dokumen/ppt/').$countTenant['presentasi'];?>" download><?=$countTenant['presentasi'];?></a></p><br>
					<p>Link Youtube Demo Produk</p>
					<p><a href="https://www.youtube.com/watch?v=<?=$countTenant['link'];?>" target="https://www.youtube.com/watch?v=<?=$countTenant['link'];?>">https://www.youtube.com/watch?v=<?=$countTenant['link'];?></a></p><br>
					<iframe class="col-12" src="https://www.youtube.com/embed/<?=$countTenant['link'];?>" style="min-height: 240px; max-width: 480px; display: block; border:none;"></iframe>
					<br><p>Profile Tim</p>
					<iframe class="col-12" src="<?=base_url('assets/dokumen/profile/').$countTenant['profile'];?>" style="min-height: 480px;"></iframe><br>
				</div>
			</div>
			<button class="btn btn-dark mt-5 ml-3" data-toggle="modal" data-target="#modalNilai1">Nilai Tenant</button>
		</div>
	</div>
</section>

<div class="modal fade" id="modalNilai1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Penilaian Tenant Tahap 2</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="post" action="<?=base_url('dashboard/submitPenilaian2/').$countTenant['id_tenant'];?>">
				<div class="modal-body">
					<p>Keterangan Nilai<i class="add-more fas fa-fw fa-plus" style="float: right; cursor: pointer;" onclick="tambahPenilaian()"></i></p>
					<p>1 (Sangat tidak baik) - 5 (Sangat Baik)</p>
					<div class="form-penilaian">
					</div>
					<div class="form-penilaian">
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-dark">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	var formPenilaian = document.getElementsByClassName('form-penilaian')[0];
	var penilaianDefault = ['Skala', 'Tim', 'Inovasi Produk', 'Model Bisnis', 'Keuangan'];
	console.log(penilaianDefault.length);

	var formPenilaianHTML = '';

	for (var i = 0; i < penilaianDefault.length; i++) {
		formPenilaianHTML += '<div class="form-group row px-3" id="penilaianGroup'+i+'">';
		formPenilaianHTML += '<input type="text" class="form-control col-5" id="namaPenilaian[]" name="namaPenilaian[]" placeholder="Nama Penilaian" value="'+penilaianDefault[i]+'" required>';
		formPenilaianHTML += '<input type="number" class="form-control col-3 offset-1" id="penilaian[]" name="penilaian[]" placeholder="1-5" min="1" max="5" required>';
		formPenilaianHTML += '<div class="col-1"><i class="hapus far fa-fw fa-trash-alt" style="color:red;" onclick="hapusPenilaian(this)" data-id="'+i+'"></i></div></div>';
	}

	formPenilaian.innerHTML = formPenilaianHTML;

	function tambahPenilaian(){
		var penilaianTambahanInnerHTML = document.getElementsByClassName('form-penilaian')[1].innerHTML;
		console.log(penilaianTambahanInnerHTML);

		var html = penilaianTambahanInnerHTML;

		html += '<div class="form-group row px-3" id="penilaianGroup'+i+'">';
		html += '<input type="text" class="form-control col-5" id="namaPenilaian[]" name="namaPenilaian[]" placeholder="Nama Penilaian" required>';
		html += '<input type="number" class="form-control col-3 offset-1" id="penilaian[]" name="penilaian[]" placeholder="1-5" min="1" max="5" required>';
		html += '<div class="col-1"><i class="hapus far fa-fw fa-trash-alt" style="color:red;" onclick="hapusPenilaian(this)" data-id="'+i+'"></i></div></div>';

		console.log(html);

		document.getElementsByClassName('form-penilaian')[1].innerHTML = html;
		i++;
	}

	function hapusPenilaian(data){
		var id = data.getAttribute('data-id');
		document.getElementById('penilaianGroup'+id+'').remove();
		console.log(id);
	}
</script>



