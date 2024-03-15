<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h1 mb-4 text-gray-800"><?= $title;?></h1>
    
    <a class="btn btn-primary mb-3" href="" data-toggle="modal" data-target="#newKaryawanModal">Add Karyawan</a>
    
    <?= $this->session->flashdata('message');?>
    <?= $this->session->flashdata('error_message');?>


    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Role</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;?>
            <?php foreach($dataKaryawan as $u) :?>
                <?php if($u['role_id'] != 4 ) :?>
                    <tr>
                        <th scope="row"><?= $i;?></th>
                        <td><?= $u['name'];?></td>
                        <td><?= $u['role'];?></td>
                        <td><?= $u['jenis_kelamin'];?></td>
                        <td>
                            <a class="badge badge-secondary" href="#" data-toggle="modal" data-target="#editKaryawanModal<?= $u['id'];?>">edit role</a>
                            <a class="badge badge-danger" href="#" data-toggle="modal" data-target="#confirmDelete<?= $u['id'];?>">delete</a>
                       
                          
                        </td>
                    </tr>
                    <?php $i++;?>
                <?php endif;?>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<!-- /.container-fluid -->

<!-- ============================================================= INSERT KARYAWAN =============================================================-->

<div class="modal fade" id="newKaryawanModal" tabindex="-1" role="dialog" aria-labelledby="newKaryawanModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newKaryawanModalLabel">Add New Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('apusat/regisKaryawan');?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="namaKaryawan" name="namaKaryawan" placeholder="Nama Lengkap e.g : Jhon Doe" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="userName" name="userName" placeholder="Username e.g : jhondoe123" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <select name="jenisKelamin" id="jenisKelamin" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select name="role" id="role" class="form-control" required>
                            <option value="">Select Role</option>
                            <option value="1">Administrator Pusat</option>
                            <option value="2">Administrator Bioskop</option>
                            <option value="3">Kasir</option>
                         </select>
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
<!-- ============================================================= INSERT KARYAWAN END =============================================================-->

<!-- ============================================================= DELETE KARYAWAN =============================================================-->

<?php foreach($dataKaryawan as $u) :?>
    <div class="modal fade" id="confirmDelete<?= $u['id'];?>" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteLabel">Confirm Delete Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this data?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="<?= base_url('apusat/deleteKaryawan/' . $u['id']);?>">Delete</a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;?>
<!-- ============================================================= DELETE KARYAWAN END =============================================================-->

<!-- ============================================================= EDIT KARYAWAN =============================================================-->
<?php foreach ($dataKaryawan as $u) : ?>
<div class="modal fade" id="editKaryawanModal<?= $u['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editKaryawanModalLabel<?= $u['id']; ?>" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKaryawanModalLabel">Edit Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('apusat/updateKaryawan/' . $u['id']); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="namaKaryawan" name="namaKaryawan" value="<?= $u['name']; ?>" disabled>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="userName" name="userName" value="<?= $u['username']; ?>" disabled>
                    </div>
                    <div class="form-group">
                         <select name="role" id="role" class="form-control" required>
                            <option value="">Select Role</option>
                            <option value="1" <?php if($u['role_id'] == 1) echo 'selected'; ?>>Administrator Pusat</option>
                            <option value="2" <?php if($u['role_id'] == 2) echo 'selected'; ?>>Administrator Bioskop</option>
                            <option value="3" <?php if($u['role_id'] == 3) echo 'selected'; ?>>Kasir</option>
                        </select>
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