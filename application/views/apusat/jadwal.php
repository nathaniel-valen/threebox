<!-- Begin Page Content -->
<div class="container-fluid">
	<!-- Page Heading -->
	<h1 class="h1 mb-4 text-gray-800"><?= $title;?></h1>
    <div class="col-lg-9">
        <?= form_error('judulFilm', '<div class="alert alert-danger col-lg-6" role="alert">', '</div>');?>
     </div>
     <div class="col-lg-9">
        <?= form_error('namaBioskop', '<div class="alert alert-danger col-lg-6" role="alert">', '</div>');?>
     </div>
     <div class="col-lg-9">
        <?= form_error('jamTayang', '<div class="alert alert-danger col-lg-6" role="alert">', '</div>');?>
     </div>
     <div class="col-lg-9">
        <?= form_error('tanggal', '<div class="alert alert-danger col-lg-6" role="alert">', '</div>');?>
     </div>
     <div class="col-lg-9">
        <?= form_error('idStudio', '<div class="alert alert-danger col-lg-6" role="alert">', '</div>');?>
     </div>
        <?= $this->session->flashdata('error_message'); ?>  
        <?= $this->session->flashdata('message');?>    
        <a class="btn btn-primary mb-3" href=""  data-toggle="modal" data-target="#newJadwalModal">Add Jadwal</a>
    <table class="table table-hover">
        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Film</th>
            <th scope="col">Bioskop</th>
            <th scope="col">Tanggal Tayang</th>
            <th scope="col">Jam Tayang</th>
            <th scope="col">Studio</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;?>
            <?php foreach($jadwal as $j):?>
                
            <tr>
                <th scope="row"><?= $i;?></th>
                <td><?= $j['judul'];?></td>
                <td><?= $j['nama_bioskop'];?></td>
                <td><?= $j['tanggal'];?></td>
                <td><?= $j['jam_tayang'];?></td>
                <td>Studio <?= $j['id_studio'];?></td>
                <td>                             
                    <a class="badge badge-secondary" href="#" data-toggle="modal" data-target="#editJadwal<?= $j['id_jadwal'];?>">edit</a>
                    <a class="badge badge-danger" href="#" data-toggle="modal" data-target="#confirmDelete<?= $j['id_jadwal'];?>">delete</a>
                </td>
            </tr>
            <?php $i++;?>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->

<!-- ============================================================= INSERT JADWAL =============================================================-->

     <!-- Modal -->
    <div class="modal fade" id="newJadwalModal" tabindex="-1" role="dialog" aria-labelledby="newJadwalModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newJadwalModalLabel">Add New Jadwal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('apusat/jadwal');?>" method="post">
            <div class="modal-body">
                <div class="form-group">
                    <select name="judulFilm" id="judulFilm" class="form-control">
                        <option value="">Pilih Judul Film</option>
                        <?php foreach ($film as $f): ?>
                            <option value="<?= $f['id'] ?>"><?= $f['judul']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            <div class="form-group">
                <select name="namaBioskop" id="namaBioskop" class="form-control">
                    <option value="">Pilih Bioskop</option>
                    <?php foreach ($bioskop as $b): ?>
                        <option value="<?= $b['id']; ?>"><?= $b['nama_bioskop'] ;?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="jamTayang" name="jamTayang" placeholder="Jam Tayang : 12:30">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="tanggal" name="tanggal" placeholder="Tanggal : 12-12-2023">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" id="idStudio" name="idStudio" placeholder="Studio : 3">
            </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
            </form>
            </div>
        </div>
    </div>
<!-- ============================================================= INSERT JADWAL END =============================================================-->

<!-- ============================================================= DELETE JADWAL =============================================================-->

<?php foreach($jadwal as $j):?>
    <div class="modal fade" id="confirmDelete<?= $j['id_jadwal'];?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Confirm Delete Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this schedule?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="<?= base_url('apusat/deleteJadwal/' . $j['id_jadwal']);?>">Delete</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;?>
<!-- ============================================================= DELETE JADWAL END =============================================================-->


<!-- ============================================================= EDIT JADWAL END =============================================================-->
<?php foreach($jadwal as $j): ?>
    <div class="modal fade" id="editJadwal<?= $j['id_jadwal']; ?>" tabindex="-1" role="dialog" aria-labelledby="editJadwalModalLabel<?= $j['id_jadwal']; ?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Header, form, dan footer modal -->
                <form action="<?= base_url('apusat/updateJadwal/' . $j['id_jadwal']); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="judulFilm">Judul Film</label>
                            <input type="text" class="form-control" id="judulFilm" name="judulFilm" value="<?= $j['judul']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="judulFilm">Bioskop</label>
                            <input type="text" class="form-control" id="bioskop" name="bioskop" value="<?= $j['nama_bioskop']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="judulFilm">Jam Tayang</label>
                            <input type="text" class="form-control" id="jamTayang" name="jamTayang" value="<?= $j['jam_tayang']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="durasi">Tanggal</label>
                            <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?= $j['tanggal']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Studio</label>
                            <input type="text" class="form-control" id="studio" name="studio" value="<?= $j['id_studio']; ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
