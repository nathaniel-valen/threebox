<!-- Begin Page Content -->
<div class="container-fluid">

<div class="jumbotron">
   <h1 class="display-4">Hello, <?= $user['name'];?></h1>
   <p class="lead">Selamat datang di Halaman Administrator Bioskop Threebox Cinema.</p>
   <hr class="my-4">
   <p>Berikut beberapa menu yang bisa dapat di akses pada halaman ini</p>
   <p class="lead">
      <a class="btn btn-secondary btn-sm" href="<?=base_url('abioskop/bioskop')?>" role="button">Menu Management Bioskop</a>  
      <a class="btn btn-secondary btn-sm" href="<?=base_url('abioskop/film')?>" role="button">Menu Management Film</a>   
      <a class="btn btn-secondary btn-sm" href="<?=base_url('abioskop/film')?>" role="button">Menu Management Jadwal</a>   
   </p>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->