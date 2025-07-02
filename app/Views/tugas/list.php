<?= $this->extend('layout/dashboard_template') ?>
<?= $this->section('title') ?><?= esc($title) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
        <h4 class="mb-2 mb-md-0"><?= esc($title) ?></h4>

        <div class="d-flex align-items-center">
            <form action="<?= current_url() ?>" method="get" class="d-flex align-items-center">
                <select name="filter_kelas" class="form-select form-select-sm me-2" style="width: 120px;">
                    <option value="Semua" <?= ($currentFilter == 'Semua' || !$currentFilter) ? 'selected' : '' ?>>Semua
                        Kelas</option>
                    <option value="Kelas A" <?= ($currentFilter == 'Kelas A') ? 'selected' : '' ?>>Kelas A</option>
                    <option value="Kelas B" <?= ($currentFilter == 'Kelas B') ? 'selected' : '' ?>>Kelas B</option>
                    <option value="Gabungan" <?= ($currentFilter == 'Gabungan') ? 'selected' : '' ?>>Gabungan</option>
                </select>
                <button class="btn btn-sm btn-outline-primary" type="submit"><i class="fa fa-filter"></i></button>
            </form>

            <form action="<?= current_url() ?>" method="get" class="d-flex align-items-center ms-3">
                <label for="perPage" class="me-2 form-label mb-0 small">Tampilkan:</label>
                <select name="perPage" id="perPage" class="form-select form-select-sm" style="width: auto;"
                    onchange="this.form.submit()">
                    <option value="5" <?= ($currentPerPage == 5) ? 'selected' : '' ?>>5</option>
                    <option value="10" <?= ($currentPerPage == 10) ? 'selected' : '' ?>>10</option>
                    <option value="25" <?= ($currentPerPage == 25) ? 'selected' : '' ?>>25</option>
                </select>
            </form>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Tugas</th>
                        <th>Kelas</th>
                        <th>Deadline</th>
                        <th>Status</th>
                        <?php if (!$is_finished_page): ?>
                        <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($tugas)): ?>
                    <tr>
                        <td colspan="<?= $is_finished_page ? '4' : '5' ?>" class="text-center">Tidak ada tugas yang
                            cocok dengan kriteria.</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($tugas as $item): ?>
                    <tr>
                        <td><?= esc($item['nama_tugas']) ?></td>
                        <td><?= esc($item['kategori_kelas']) ?></td>
                        <td><?= date('d M Y', strtotime($item['deadline'])) ?></td>
                        <td>
                            <?php
                                    $statusClass = 'bg-secondary';
                                    if ($item['status'] == 'Sedang Dikerjakan') $statusClass = 'bg-warning text-dark';
                                    if ($item['status'] == 'Selesai') $statusClass = 'bg-success';
                                    ?>
                            <span class="badge <?= $statusClass ?>"><?= esc($item['status']) ?></span>
                        </td>
                        <?php if (!$is_finished_page): ?>
                        <td>
                            <a href="<?= site_url('tugas/edit/' . $item['id']) ?>" class="btn btn-sm btn-info">Edit</a>
                            <a href="<?= site_url('tugas/delete/' . $item['id']) ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus tugas ini?')">Hapus</a>
                        </td>
                        <?php endif; ?>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer d-flex justify-content-center">
        <?= $pager->links('default', 'bootstrap_5_pagination') ?>
    </div>
</div>
<?= $this->endSection() ?>