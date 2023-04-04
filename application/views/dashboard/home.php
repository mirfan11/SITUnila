<div class="jumbotron bg-white">
	<div class="container-fluid">
		<div class="row no-gutters">
			<div class="col-12 col-sm-6">
				<h1 class="display-5 my-3" style="color: #FBD15B;">Sistem Inkubasi Tenant Unila (SIT) </h1>
				<p class="lead" style="font-size: 35px;">Merencanakan dan melaksanakan berbagai kegiatan terkait pengembangan minat dan budaya kewirausahaan bagi mahasiswa dan alumni </p>
			</div>
			<div class="col-12 col-sm-6">
				<img src="<?=base_url('assets/logo/jumbotron.png');?>" alt="jumbotron" class="img-fluid">
			</div>
		</div>
	</div>
</div>

<div class="container-fluid p-5">
	<div class="head-home mb-4" style="border-bottom: solid 2px; border-color: #FBD15B;">
		<div class="row no-gutters">
			<div class="col-6">
				<h2 style="font-weight: 500; padding: 2px; font-size: 45px;">Pengumuman Sit</h2>
			</div>
			<div class="col-6 text-right">
				<p class="pt-4" style="font-size: 22px; font-weight: 300; display: inline-block; cursor: pointer;" onclick="window.location='<?=base_url("home/tambah_pengumuman");?>'"><i class="fas fa-fw fa-plus-circle"></i>Tambah</p>
			</div>
		</div>
	</div>

	<div class="content">
		<?php foreach($pengumuman as $pg):?>
			<div class="media p-3 mb-4" style="border: solid 1px #d8d8d8; padding:1%; border-radius: 5px;">
				<img src="<?=base_url('assets/logo/gambar-artikel-home.png');?>" class="mr-3" alt="artikel" style="max-width: 80px;">
				<div class="media-body">
					<div class="row">
						<div class="col-9">
							<h5 class="mt-0" id="judulPengumuman" style="font-weight: 700;"><?=$pg['judul'];?></h5>
							<p class="text-secondary"><i class="far fa-fw fa-calendar"></i><?=$pg['tanggal'];?></p>
						</div>
						<div class="col-3 text-right">
							<i class="fas fa-fw fa-pen" style="cursor: pointer;" onclick="window.location='<?=base_url('home/edit_pengumuman/').$pg['id_pengumuman'];?>'"></i>
							<i class="fas fa-fw fa-times" id="<?=$pg['judul'];?>" name="<?=$pg['id_pengumuman'];?>" style="cursor: pointer;" onclick="hapusPengumuman(this.id)"></i>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach;?>
	</div>
	<?= $this->pagination->create_links();?>
</div>

<div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Hapus Pengumuman</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p id="modalDalemHapus"></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btnHapus btn btn-dark" id="">Hapus</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function load_data(){
		var start = '<?=$start;?>';

		$.ajax({
			url:"<?=base_url();?>/home/load_pengumuman/",
			type:'POST',
			start:start,
			dataType:"JSON",
			success: function(data){
				var html = '<div>';
				console.log(data.hasil.length);
				for (var i = 0; i < data.hasil.length; i++) {
					html += '<div class="media p-3 mb-4" style="border: solid 1px #d8d8d8; padding:1%; border-radius: 5px;">';
					html += '<img src="<?=base_url('assets/logo/gambar-artikel-home.png');?>" class="mr-3" alt="artikel" style="max-width: 80px;">';
					html += '<div class="media-body">';
					html += '<div class="row">';
					html += '<div class="col-9">';
					html += '<h5 class="mt-0" id="judulPengumuman" style="font-weight: 700;">'+data.hasil[i].judul+'</h5>';
					html += '<p class="text-secondary"><i class="far fa-fw fa-calendar"></i>'+data.hasil[i].tanggal+'</p></div>';
					html += '<div class="col-3 text-right">';
					html += '<i class="fas fa-fw fa-pen" style="cursor: pointer;" onclick=""></i>';
					html += '<i class="fas fa-fw fa-times" id="'+data.hasil[i].judul+'" name="'+data.hasil[i].id_pengumuman+'" style="cursor: pointer;" onclick="hapusPengumuman(this.id)"></i>';
					html += '</div></div></div></div>';
				}
				html += '</div>'
				$('.content').html(html);
			}
		});
	}
	
		$(document).on('click', '.btnHapus', function() {
            var id = $(this).attr('id');
            console.log(id); // ambil nilai dr attribut id
            $.ajax({
            	url: "<?= base_url(); ?>home/hapusPengumuman",
            	method: 'POST',
            	data: {
            		id: id
            	},
            	success: function(data) {
            		load_data();
            	}
            });
            $("#modalHapus").modal("hide");
        });

	function hapusPengumuman($id){
		var id = $id;
		var id2 = document.getElementById($id).getAttribute("name");
		console.log(id);
		console.log(id2);
		$("#modalHapus").modal("show");
		document.getElementById("modalDalemHapus").innerHTML = "Anda yakin ingin menghapus pengumuman " + id +" ?";
		document.getElementsByClassName('btnHapus')[0].id = id2;
	}
</script>