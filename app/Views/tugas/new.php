<?= $this->extend('layout/dashboard_template') ?>
<?= $this->section('title') ?>Tambah Tugas<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Form Input Tugas</h4>
    </div>
    <div class="card-body">
        <?php if (session()->get('errors')): ?>
        <div class="alert alert-danger">
            <?php foreach (session()->get('errors') as $error): ?>
            <p><?= esc($error) ?></p>
            <?php endforeach ?>
        </div>
        <?php endif; ?>

        <form action="<?= site_url('tugas/create') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="nama_tugas" class="form-label">Nama Tugas</label>
                <input type="text" name="nama_tugas" id="nama_tugas" class="form-control" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="kategori_kelas" class="form-label">Kelas</label>
                    <select name="kategori_kelas" id="kategori_kelas" class="form-select" required>
                        <option value="Kelas A">Kelas A</option>
                        <option value="Kelas B">Kelas B</option>
                        <option value="Gabungan">Gabungan</option>
                    </select>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="deadline" class="form-label">Deadline</label>
                    <input type="date" name="deadline" id="deadline" class="form-control" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="Belum Dikerjakan">Belum Dikerjakan</option>
                    <option value="Sedang Dikerjakan">Sedang Dikerjakan</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Upload File (Opsional)</label>
                <input type="file" name="file" id="file" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Simpan Tugas</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>