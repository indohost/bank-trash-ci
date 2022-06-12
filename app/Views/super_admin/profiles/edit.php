<?= $this->extend("super_admin/index") ?>

<?= $this->section("title") ?>
Profiles - Bank Sampah
<?= $this->endSection(); ?>

<?= $this->section("content") ?>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Edit Data</h1>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
    </div>
    <div class="card-body">
        <?php foreach ($profiles as $d) : ?>
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
        <?php endforeach; ?>
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