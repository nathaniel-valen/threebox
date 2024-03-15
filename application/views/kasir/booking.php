            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                
                <h1 class="h1 mb-4 text-gray-800"><?= $title; ?></h1>
                
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Studio</th>
                            <th scope="col">Nama Film</th>
                            <th scope="col">Jam Tayang</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach($jadwal as $j):?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td>Studio <?=$j['id_studio'];?></td>
                                <td><?= $j['nama_film']; ?></td>
                                <td><?= $j['jam_tayang']; ?></td>
                                <td>
                                    <a class="badge badge-primary" href="<?=base_url('kasir/seat')?>">booking</a>
                                </td>
                            </tr>
                            <?php $i++; ?>               
                            <?php endforeach;?>                
                        </tbody>
                    </table>
                </div>
                
                <div class="ml-4 mt-5">
                    <a class="btn btn-secondary btn-sm" href="<?= base_url('kasir/bioskop');?>">Kembali</a>
                </div>
            <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->