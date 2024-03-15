<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h1 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Bioskop</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($bioskop as $b) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $b['nama_bioskop']; ?></td>
                    <!-- Pass the bioskop ID as a parameter to the jadwal page -->
                    <td><a href="<?= base_url('kasir/booking/' . $b['id']); ?>" class="badge badge-primary">Detail</a></td>
                </tr>
                <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
