            <!-- Begin Page Content -->
            <div class="container-fluid">
            	<div>
            		<!-- Page Heading -->
            		<h1 id="now-showing" class="h3 mb-4 text-gray-800 text-center">Now Showing</h1>
            		<div class="container-movie-card">
            			<?php $i = 0;?>
            			<?php foreach ($film as $f): ?>
            			<div class="movie-card">
            				<img src="<?= base_url('assets/img/film/') . $f['gambar']; ?>" class="card-img-top"
            					alt="<?= $f['judul']; ?>" alt="Nama Film">
            				<div class="movie-details">
            					<h5 class="mb-4"><?= $f['judul']; ?></h5>
            				</div>
            				<div class="movie-card-footer">
            					<form action="<?= base_url('user/detail'); ?>" method="post">
            						<input type="hidden" name="film_id" value="<?= $i; ?>">
            						<button type="submit" class="btn btn-info">Selengkapnya</button>
            					</form>
            				</div>
            			</div>
            			<?php $i++ ?>
            			<?php endforeach; ?>
            		</div>
            	</div>
            	<br><br>
            	<div>
            		<!-- Page Heading -->
            		<h1 id="coming-soon" class="h3 mb-4 text-gray-800 text-center">Coming Soon</h1>
            		<div class="container-movie-card">
            			<?php $i = 0;?>
            			<?php foreach ($coming as $c): ?>
            			<div class="movie-card">
            				<img src="<?= base_url('assets/img/film/') . $c['gambar']; ?>" class="card-img-top"
            					alt="<?= $c['judul']; ?>" alt="Nama Film">
            				<div class="movie-details">
            					<h5 class="mb-4"><?= $c['judul']; ?></h5>
            				</div>
            				<div class="movie-card-footer">
            					<form action="<?= base_url('user/detail'); ?>" method="post">
            						<button type="submit" class="btn btn-info">Selengkapnya</button>
            					</form>
            				</div>
            			</div>
            			<?php $i++ ?>
            			<?php endforeach; ?>
            		</div>
            	</div>
            	<br><br>
            	<div>
            		<!-- Page Heading -->
            		<h1 id="theatres" class="h3 mb-4 text-gray-800 text-center">Theatres</h1>
            		<div>
            			<table class="table table-hover">
            				<thead>
            					<tr>
            						<th scope="col">No</th>
            						<th scope="col">Nama Bioskop</th>
            						<th scope="col">Lokasi</th>
            						<th scope="col">Action</th>
            					</tr>
            				</thead>
            				<tbody>
            					<?php $i = 1; ?>
                                <?php foreach ($bioskop as $b) : ?>
            					<tr>
            						<th scope="row"><?= $i; ?></th>
            						<td>Studio <?=$b['nama_bioskop'];?></td>
            						<td><?= $b['lokasi']; ?></td>
            						<td>
            							<a class="badge badge-primary" href="<?=base_url('kasir/seat')?>">detail</a>
            						</td>
            					</tr>
            					<?php $i++; ?>
                                <?php endforeach; ?>
            				</tbody>
            			</table>
            		</div>
            	</div>
            </div>
            <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
