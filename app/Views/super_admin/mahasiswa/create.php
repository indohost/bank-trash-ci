<?= $this->extend("super_admin/index") ?>

<?= $this->section("title") ?>
Create - Bank Sampah
<?= $this->endSection(); ?>

<?= $this->section("content") ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Create Data CV</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Create Data CV</h6>
    </div>
    <div class="card-body">
        <form class="row g-3" action="<?= base_url('super_admin/mahasiswa/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <!-- Profile content row-->
            <div class="col-md-6">
                <div class="mb-2">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" name="nama" id="nama" required="required">
                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-2">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="alamat" id="alamat" required="required">
                </div>
            </div>

            <div class="col-12">
                <div class="mb-2">
                    <label for="pendidikan" class="form-label">Pendidikan</label>
                    <input type="text" class="form-control" name="pendidikan" id="pendidikan" required="required"></input>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-2">
                    <label for="keahlian" class="form-label">Keahlian</label>
                    <input type="text" class="form-control" name="keahlian" id="keahlian" required="required">
                </div>
            </div>
            <div class="col-md-4">
                <label for="image" class="form-label">Photo</label>
                <div class="col-sm-12 form-control">
                    <div class="mb-2">
                        <input type="file" value="" id="image" name="image" required="required">
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="mb-2">
                    <label for="telephone" class="form-label">Telephone</label>
                    <input type="text" class="form-control" name="telephone" id="telephone" required="required">
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-2">
                    <label for="pengalaman" class="form-label">Pengalaman</label>
                    <input type="text" class="form-control" name="pengalaman" id="pengalaman" required="required">
                </div>
            </div>

            <div class="col-md-12">
                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="email" id="email" required="required">
                </div>
            </div>


    </div>
    <div class="modal-footer">
        <a href="/super_admin/mahasiswa/"><button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
    </div>
    </form>
</div>
</div>
</div>

<?= $this->endSection(); ?>