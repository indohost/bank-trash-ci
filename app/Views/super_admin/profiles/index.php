<?= $this->extend("super_admin/index") ?>

<?= $this->section("title") ?>
Profiles - Bank Sampah
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

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?php echo $title; ?></h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <a href="<?= base_url('super_admin/profiles/create') ?>" class="btn btn-primary mb-4">
                    Create Data
                </a>
            </div>
            <div class="col-12 col-sm-auto">
                <a href="<?= base_url('super_admin/profiles/download-excel') ?>" class="d-none d-sm-inline-block btn btn-success shadow-sm"><i class="fas fa-file-excel"></i> Report to Excel</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Full Name</th>
                        <th>Contact</th>
                        <th>Skills</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Full Name</th>
                        <th>Contact</th>
                        <th>Skills</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($profiles as $d) : ?>
                        <tr>
                            <td><?= $i++; ?></td>
                            <td>
                                <img src="<?= base_url('uploads/profiles/' . $d['photo']) ?>" alt="" width="100">
                            </td>
                            <td><?= $d['full_name']; ?></td>
                            <td><?= $d['contact']; ?></td>
                            <td><?= $d['skills']; ?></td>
                            <td>
                                <div class="row">
                                    <div class="col-3">
                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editModal-<?= $d['id'] ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <!-- Edit Data -->
                                        <div class="modal fade" id="editModal-<?= $d['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url('/super_admin/profiles/update/') ?>" method="post" enctype="multipart/form-data">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="id" value="<?= $d['id'] ?>">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="full_name">Full Name</label>
                                                                <input type="text" name="full_name" class="form-control" id="full_name" value="<?= $d['full_name'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="contact">Contact</label>
                                                                <textarea class="form-control" name="contact" id="contact" rows="3"><?= $d['contact'] ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="position">Position</label>
                                                                <input type="text" name="position" class="form-control" id="position" value="<?= $d['position'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="location">Location</label>
                                                                <input type="text" name="location" class="form-control" id="location" value="<?= $d['location'] ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="summary">Summary</label>
                                                                <textarea class="form-control" name="summary" id="summary" rows="3"><?= $d['summary'] ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="skills">Skills</label>
                                                                <textarea class="form-control" name="skills" id="skills" rows="3"><?= $d['skills'] ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="work_experiece">Work Experiece</label>
                                                                <textarea class="form-control" name="work_experiece" id="work_experiece" rows="3"><?= $d['work_experiece'] ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="portofolio">Portofolio</label>
                                                                <textarea class="form-control" name="portofolio" id="portofolio" rows="3"><?= $d['portofolio'] ?></textarea>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="education">Education</label>
                                                                <textarea class="form-control" name="education" id="education" rows="3"><?= $d['education'] ?></textarea>
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
                                        <!-- End Edit Data -->
                                    </div>
                                    <div class="col-3">
                                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#detailModal-<?= $d['id'] ?>">
                                            <i class="fas fa-file"></i>
                                        </button>

                                        <!-- Detail Data -->
                                        <div class="modal fade" id="detailModal-<?= $d['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Data</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <div class="row">
                                                                    <div class="col-md-9">
                                                                        <b>Full Name</b>
                                                                        <p>
                                                                            <?= $d['full_name'] ?>
                                                                        </p>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <img src="<?= base_url('uploads/profiles/' . $d['photo']) ?>" alt="" width="100">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <b>Summary</b>
                                                                <p>
                                                                    <?= $d['summary'] ?>
                                                                </p>
                                                            </div>
                                                            <div class="form-group">
                                                                <b>Contact</b>
                                                                <p>
                                                                    <?= $d['contact'] ?>
                                                                </p>
                                                            </div>
                                                            <div class="form-group">
                                                                <b>Position</b>
                                                                <p>
                                                                    <?= $d['position'] ?>
                                                                </p>
                                                            </div>
                                                            <div class="form-group">
                                                                <b>Location</b>
                                                                <p>
                                                                    <?= $d['location'] ?>
                                                                </p>
                                                            </div>
                                                            <div class="form-group">
                                                                <b>Skills</b>
                                                                <p>
                                                                    <?= $d['skills'] ?>
                                                                </p>
                                                            </div>
                                                            <div class="form-group">
                                                                <b>Work Experiece</b>
                                                                <p>
                                                                    <?= $d['work_experiece'] ?>
                                                                </p>
                                                            </div>
                                                            <div class="form-group">
                                                                <b>Portofolio</b>
                                                                <p>
                                                                    <?= $d['portofolio'] ?>
                                                                </p>
                                                            </div>
                                                            <div class="form-group">
                                                                <b>Education</b>
                                                                <p>
                                                                    <?= $d['education'] ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Detail Data -->
                                    </div>
                                    <div class="col-3">
                                        <form action="<?= base_url('/super_admin/profiles/download-pdf/') ?>" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?= $d['id'] ?>">
                                            <button class="btn btn-secondary">
                                                <i class="fas fa-file-pdf"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-3">
                                        <form action="<?= base_url('/super_admin/profiles/delete/') ?>" method="post">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="id" value="<?= $d['id'] ?>">
                                            <button class="btn btn-danger" onclick="return confirm('Are you sure ?')">
                                                <i class="fas fa-trash"></i>
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
</div>

<?= $this->endSection(); ?>
<?= $this->section("js") ?>
<script>
    CKEDITOR.replace('contact');
    CKEDITOR.replace('summary');
    CKEDITOR.replace('skills');
    CKEDITOR.replace('work_experiece');
    CKEDITOR.replace('portofolio');
    CKEDITOR.replace('education');
</script>
<?= $this->endSection() ?>