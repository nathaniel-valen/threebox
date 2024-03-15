            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h1 mb-4 text-gray-800"><?= $title; ?></h1>

                <div class="col-lg-9">
                    <?= form_error('namaBioskop', '<div class="alert alert-danger col-lg-6" role="alert">', '</div>'); ?>
                </div>
                <div class="col-lg-9">
                    <?= form_error('lokasi', '<div class="alert alert-danger col-lg-6" role="alert">', '</div>'); ?>
                </div>
                <div class="col-lg-9">
                    <?= form_error('totalStudio', '<div class="alert alert-danger col-lg-6" role="alert">', '</div>'); ?>
                </div>
                <div class="form-group">
                    <?= form_error('idBioskop', '<div class="alert alert-danger col-lg-6" role="alert">', '</div>'); ?>
                </div>

                <?= $this->session->flashdata('message'); ?>
                <?= $this->session->flashdata('error_message'); ?>
                <a class="btn btn-primary mb-3" href="" data-toggle="modal" data-target="#newBioskopModal">Add Bioskop</a>

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Bioskop</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">Total Studio</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($bioskop as $b) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $b['nama_bioskop']; ?></td>
                                <td><?= $b['lokasi']; ?></td>
                                <td><?= $b['total_studio']; ?></td>
                                <td>
                                    <a class="badge badge-secondary" href="#" data-toggle="modal" data-target="#editBioskopModal<?= $b['id']; ?>">edit</a>
                                    <a class="badge badge-danger" href="" data-toggle="modal" data-target="#confirmDelete<?= $b['id']; ?>">delete</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            </div>
            <!-- /.container-fluid -->

            <!-- ============================================================= INSERT BIOSKOP =============================================================-->

            <div class="modal fade" id="newBioskopModal" tabindex="-1" role="dialog" aria-labelledby="newBioskopModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newBioskopModalLabel">Add New Bioskop</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= base_url('apusat/bioskop'); ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="idBioskop" name="idBioskop" placeholder="ID Bioskop : 1">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="namaBioskop" name="namaBioskop" placeholder="Nama Bioskop : Senayan City">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Lokasi : Jakarta">
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="totalStudio" name="totalStudio" placeholder="Total Studio : 3">
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
            <!-- ============================================================= INSERT BIOSKOP END =============================================================-->

            <!-- ============================================================= DELETE BIOSKOP =============================================================-->
            <?php foreach ($bioskop as $b) : ?>
                <div class="modal fade" id="confirmDelete<?= $b['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmDeleteLabel">Confirm Delete Cinema </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this cinema data?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-danger" href="<?= base_url('apusat/deleteBioskop/' . $b['id']); ?>">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- ============================================================= DELETE BIOSKOP END =============================================================-->
            <!-- ============================================================= EDIT BIOSKOP =============================================================-->
            <?php foreach ($bioskop as $b) : ?>
                <div class="modal fade" id="editBioskopModal<?= $b['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editBioskopModalLabel<?= $b['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editBioskopModalLabel<?= $b['id']; ?>">Edit Bioskop</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="<?= base_url('apusat/updateBioskop/' . $b['id']); ?>" method="post">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="editNamaBioskop<?= $b['id']; ?>">Nama Bioskop</label>
                                        <input type="text" class="form-control" id="editNamaBioskop<?= $b['id']; ?>" name="editNamaBioskop" value="<?= $b['nama_bioskop']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="editLokasi<?= $b['id']; ?>">Lokasi</label>
                                        <input type="text" class="form-control" id="editLokasi<?= $b['id']; ?>" name="editLokasi" value="<?= $b['lokasi']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="editTotalStudio<?= $b['id']; ?>">Total Studio</label>
                                        <input type="number" class="form-control" id="editTotalStudio<?= $b['id']; ?>" name="editTotalStudio" value="<?= $b['total_studio']; ?>">
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

            <!-- ============================================================= EDIT BIOSKOP END =============================================================-->