<?php  
$film_id = $_POST['film_id'];
$urutan =  $_POST['urutan']

?>           

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
	<table class="table table-hover ">
		<?php if (empty($jadwal)) :?>
			<h1>Saat ini sedang tidak ada jadwal. Silahkan cek kembali nanti</h1>
		<?php else:?>
		<thead>
		<tr>
			<th scope="col">No</th>
			<th scope="col">Film</th>
			<th scope="col">Bioskop</th>
			<th scope="col">Tanggal Tayang</th>
			<th scope="col">Jam Tayang</th>
			<th scope="col">Studio</th>
		</tr>
		</thead>
		<tbody>
			<?php $i = 1;?>
		  	<?php  foreach ($jadwal as $j) :?>
				<tr>
					<th scope="row"><?= $i?></th>
					<td><?=$j['judul'];?></td>
					<td><?= $j['nama_bioskop']?></td>
					<td><?=$j['tanggal']?></td>
					<td><?=$j['jam_tayang']?></td>
					<td><?=$j['id_studio']?></td>
					<td>
						<a class="badge badge-secondary" href="<?=base_url('user/seat')?>" >Pilih Jadwal</a>
					</td>
				</tr>
			<?php $i++?>
		 	<?php endforeach;?>
		</tbody>
	</table>
	<?php endif;?>
	<form action="<?= base_url('user/detail'); ?>" method="post">
		<input type="hidden" name="film_id" value="<?= $urutan ; ?>">
		<button type="submit" class="btn btn-dark my-5 mx-5" href="<?=base_url('user')?>">Kembali</button>
	</form>


    <hr style="height: 10px; visibility: hidden;">.
</div>
<!-- /.container-fluid -->

    
       </div>
       <!-- End of Main Content -->
