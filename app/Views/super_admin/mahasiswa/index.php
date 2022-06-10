<?= $this->extend("super_admin/index") ?>

<?= $this->section("title") ?>
Data - Mahasiswa
<?= $this->endSection(); ?>

<?= $this->section("content") ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800"><?php echo $title; ?></h1>

<!-- Message Alert -->
<?php
if (session()->getFlashData('success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
}
?>
<!-- Tombol Menambah Data -->
<div class="card-body">
    <a href="<?= base_url('super_admin/mahasiswa/create') ?>" class="btn btn-primary mb-4">
        Create Data
    </a>

    <!-- DataTable  -->
    <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Picture</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telephone</th>
                    <th>Keahlian</th>
                    <th>email</th>
                    <th>action</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Picture</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Telephone</th>
                    <th>Keahlian</th>
                    <th>email</th>
                    <th>action</th>
                </tr>
            </tfoot>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($mahasiswa as $d) : ?>
                    <tr>
                        <td><?= $i++; ?></td>
                        <td><img src="/uploads/images/<?= ($d['image']); ?>" class="card-img" alt="..."></td>
                        <td><?= $d['nama']; ?></td>
                        <td><?= $d['alamat']; ?></td>
                        <td><?= $d['telephone']; ?></td>
                        <td><?= $d['pengalaman']; ?></td>
                        <td><?= $d['email']; ?></td>
                        <td>

                            <div class="row">
                                <div class="col-3">
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal-<?= $d['id'] ?>" title="Lihat">
                                        Edit
                                    </button>

                                    <!-- Edit Data -->
                                    <div class="modal fade" id="editModal-<?= $d['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">

                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="<?= base_url('/super_admin/mahasiswa/update/') ?>" method="post" enctype="multipart/form-data">
                                                    <?= csrf_field(); ?>
                                                    <input type="hidden" name="id" value="<?= $d['id'] ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="nama">Nama</label>
                                                            <input type="text" name="nama" class="form-control" id="nama" value="<?= $d['nama'] ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="alamat">Alamat</label>
                                                            <input type="text" name="alamat" class="form-control" id="alamat" value="<?= $d['alamat'] ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pendidikan">Pendidikan</label>
                                                            <input type="text" name="pendidikan" class="form-control" id="pendidikan" value="<?= $d['pendidikan'] ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="keahlian">Keahlian</label>
                                                            <input type="text" name="keahlian" class="form-control" id="keahlian" value="<?= $d['keahlian'] ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="telephone">Telephone</label>
                                                            <input type="text" name="telephone" class="form-control" id="telephone" value="<?= $d['telephone'] ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pengalaman">Pengalaman</label>
                                                            <input type="text" name="pengalaman" class="form-control" id="pengalaman" value="<?= $d['pengalaman'] ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="image">Image</label>
                                                            <input type="file" name="image" class="form-control" id="image" value="<?= $d['image'] ?>" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="text" name="email" class="form-control" id="email" value="<?= $d['email'] ?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>


                                                </form>

                                            </div>
                                        </div>
                                    </div>

                                    <form action="<?= base_url('/super_admin/mahasiswa/delete/') ?>" method="post">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="id" value="<?= $d['id'] ?>">
                                        <button class="btn btn-sm btn-outline-secondary" onclick="return confirm('Are you sure ?')">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>