            <!-- Begin Page Content -->
            <div class="container-fluid">

            	<!-- Page Heading -->
            	<h1 class="h1 mb-4 text-gray-800"><?= $title;?></h1>

                <div class="col-lg-9">
                    <?= form_error('judulFilm', '<div class="alert alert-danger col-lg-6" role="alert">', '
                        </div>');?>
                 </div>
                <div class="col-lg-9">
                    <?= form_error('durasi', '<div class="alert alert-danger col-lg-6" role="alert">', '
                        </div>');?>
                 </div>
                <div class="col-lg-9">
                    <?= form_error('deskripsi', '<div class="alert alert-danger col-lg-6" role="alert">', '
                        </div>');?>
                 </div>
               
                       
                    <?= $this->session->flashdata('error_message'); ?>
                    <?= $this->session->flashdata('message');?>
                    <a class="btn btn-primary mb-3" href=""  data-toggle="modal" data-target="#newFilmModal">Add Film</a>

                <table class="table table-hover">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Film</th>
                        <th scope="col">Durasi</th>
                        <th scope="col-lg-6">Deskripsi</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;?>
                        <?php foreach($film as $f):?>
                        
                        <tr>
                            <th scope="row"><?= $i;?></th>
                            <td><?= $f['judul'];?></td>
                            <td><?= $f['durasi'];?></td>
                            <td class="col-lg-6"><?= $f['deskripsi'];?></td>
                            <td>                             
                                <a class="badge badge-secondary" href="#" data-toggle="modal" data-target="#editFilmModal<?= $f['id'];?>">edit</a>
                                <a class="badge badge-danger" href="#" data-toggle="modal" data-target="#confirmDelete<?= $f['id'];?>">delete</a>
                            </td>
                        </tr>
                        <?php $i++;?>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <!-- /.container-fluid -->
            
<!-- ============================================================= INSERT MOVIE =============================================================-->
            <div class="modal fade" id="newFilmModal" tabindex="-1" role="dialog" aria-labelledby="newFilmModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newFilmModalLabel">Add New Film</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="<?= base_url('apusat/film');?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="judulFilm" name="judulFilm" placeholder="Judul Film">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="durasi" name="durasi" placeholder="Durasi">
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <div class="form-group">
                        <textarea type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Deskripsi" cols="30" rows="10"></textarea>
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
            </div>
<!-- ============================================================= INSERT MOVIE END =============================================================-->


<!-- ============================================================= DELETE MOVIE =============================================================-->
            <?php foreach($film as $f):?>
                <div class="modal fade" id="confirmDelete<?= $f['id'];?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel<?= $f['id'];?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteLabel<?= $f['id'];?>">Confirm Delete Film</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this movie?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-danger" href="<?= base_url('apusat/deleteFilm/' . $f['id']);?>">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
<!-- ============================================================= DELETE MOVIE END =============================================================-->

<!-- ============================================================= EDIT MOVIE =============================================================-->
            <?php foreach($film as $f): ?>
            <div class="modal fade" id="editFilmModal<?= $f['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editFilmModalLabel<?= $f['id']; ?>" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <!-- Header, form, dan footer modal -->
                        <form action="<?= base_url('apusat/updateFilm/' . $f['id']); ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="judulFilm">Judul Film</label>
                                    <input type="text" class="form-control" id="judulFilm" name="judulFilm" value="<?= $f['judul']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="durasi">Durasi</label>
                                    <input type="text" class="form-control" id="durasi" name="durasi" value="<?= $f['durasi']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= $f['deskripsi']; ?></textarea>
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
            <?php endforeach;?>
            <!-- End of Main Content -->