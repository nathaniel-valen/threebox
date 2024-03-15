<?php  
$id = $_POST['film_id'];

?>           

           

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="media my-5">
        <img class="align-self-start mr-3" src="<?= base_url('assets/img/film/') . $film[$id]['gambar']; ?>" alt="Movie Poster" width="250px">
        <div class="media-body my-5">
            <h1 class="mx-5"><?= $film[$id]['judul']; ?></h1>
            <div class="duration mx-5"><?= $film[$id]['durasi']; ?> Menit</div>
            <p class="synopsis mx-5"><?= $film[$id]['deskripsi']; ?></p>
            <form action="<?= base_url('user/booking'); ?>" method="post">
                <a class="btn btn-secondary mx-5 my-5" href="<?= base_url('user'); ?>">Kembali</a>
                <input type="hidden" name="film_id" value="<?= $film[$id]['id']; ?>">
				<input type="hidden" name="urutan" value="<?= $id; ?>">
                <button type="submit" class="btn btn-primary my-5">Pesan Tiket</button>
            </form>

        </div>
    </div>
    <hr style="height: 10px; visibility: hidden;">.
</div>
<!-- /.container-fluid -->

    
       </div>
       <!-- End of Main Content -->
