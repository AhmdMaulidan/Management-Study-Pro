<?= $this->extend('layout/dashboard_template') ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h4 class="mb-4">Selamat Datang <?= esc(session()->get('namaKelas')) ?></h4>

<!-- Kartu Ringkasan (tidak berubah) -->
<div class="row">
    <!-- Card: Input Tugas -->
    <div class="col-lg-4 col-md-6 mb-4">
        <!-- BUNGKUS DENGAN TAG <a> -->
        <a href="<?= site_url('tugas/tambah') ?>" class="text-decoration-none">
            <div class="card summary-card shadow-sm h-100">
                <div class="card-body bg-success">
                    <div class="d-flex justify-content-between align-items-start">
                        <div><i class="fa fa-plus fa-3x"></i></div>
                        <div><i class="fa fa-briefcase fa-3x opacity-50"></i></div>
                    </div>
                    <h5 class="mt-3 text-white">Input Tugas</h5>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span>Tambah</span> <!-- Ganti link jadi span -->
                    <i class="fa fa-arrow-right arrow-icon"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Card: Daftar Tugas -->
    <div class="col-lg-4 col-md-6 mb-4">
        <a href="<?= site_url('tugas/daftar') ?>" class="text-decoration-none">
            <div class="card summary-card shadow-sm h-100">
                <div class="card-body" style="background-color: #6777ef;">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="display-5"><?= $totalTugas ?></div>
                            <h5 class="mt-2 text-white">Daftar Tugas</h5>
                        </div>
                        <div><i class="fa fa-briefcase fa-3x opacity-50"></i></div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span>Lihat</span>
                    <i class="fa fa-arrow-right arrow-icon"></i>
                </div>
            </div>
        </a>
    </div>

    <!-- Card: Tugas Selesai -->
    <div class="col-lg-4 col-md-6 mb-4">
        <a href="<?= site_url('tugas/selesai') ?>" class="text-decoration-none">
            <div class="card summary-card shadow-sm h-100">
                <div class="card-body bg-info">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="display-5"><?= $tugasSelesai ?></div>
                            <h5 class="mt-2 text-white">Tugas Selesai</h5>
                        </div>
                        <div><i class="fa fa-check-circle fa-3x opacity-50"></i></div>
                    </div>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <span>Lihat</span>
                    <i class="fa fa-arrow-right arrow-icon"></i>
                </div>
            </div>
        </a>
    </div>
</div>

<!-- Filter (tidak berubah) -->
<div class="d-flex justify-content-between align-items-center mt-4 flex-wrap">
    <h5 class="mb-2 task-list-title">Daftar Tugas</h5>
    <form action="<?= site_url('dashboard') ?>" method="get" class="ms-auto">
        <div class="input-group">
            <select name="filter_kelas" class="form-select">
                <option value="Semua" <?= ($currentFilter == 'Semua' || !$currentFilter) ? 'selected' : '' ?>>Semua
                    Kelas</option>
                <option value="Kelas A" <?= ($currentFilter == 'Kelas A') ? 'selected' : '' ?>>Kelas A</option>
                <option value="Kelas B" <?= ($currentFilter == 'Kelas B') ? 'selected' : '' ?>>Kelas B</option>
                <option value="Gabungan" <?= ($currentFilter == 'Gabungan') ? 'selected' : '' ?>>Gabungan</option>
            </select>
            <button class="btn btn-outline-primary" type="submit"><i class="fa fa-filter"></i> Filter</button>
        </div>
    </form>
</div>
<hr>

<?php if (empty($tugasTerdekat)): ?>
<div class="alert alert-info">Belum ada tugas yang akan datang.</div>
<?php else: ?>
<?php foreach ($tugasTerdekat as $tugas): ?>
<div class="card mb-3 task-card-clickable" data-bs-toggle="modal" data-bs-target="#taskDetailModal"
    data-title="<?= esc($tugas['nama_tugas']) ?>" data-deadline-text="<?= esc($tugas['days_left_text']) ?>"
    data-date="<?= date('d F Y', strtotime($tugas['deadline'])) ?>" data-category="<?= esc($tugas['kategori_kelas']) ?>"
    data-description="<?= esc($tugas['keterangan']) ?>"
    data-image-path="<?= $tugas['file_path'] ? site_url('tugas/file/' . $tugas['file_path']) : '' ?>">
    <div class="card-body">
        <!-- PASTIKAN CLASS INI ADA -->
        <h5 class="card-title task-card-title"><?= esc($tugas['nama_tugas']) ?></h5>
        <p class="card-text text-muted mt-3">
            <i class="fa-regular fa-clock me-2"></i> Deadline: <?= esc($tugas['days_left_text']) ?>
            <span class="ms-4"><i class="fa-regular fa-calendar-alt me-2"></i>
                <?= date('d F Y', strtotime($tugas['deadline'])) ?></span>
            <span class="ms-4"><i class="fa-solid fa-briefcase me-2"></i> Kategori:
                <?= esc($tugas['kategori_kelas']) ?></span>
        </p>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>


<!-- === MODAL POP-UP (Struktur HTML) === -->
<div class="modal fade" id="taskDetailModal" tabindex="-1" aria-labelledby="taskDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTaskTitle">Detail Tugas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="modalTaskImageContainer" class="mb-3">
                    <!-- Gambar akan dimuat di sini oleh JavaScript -->
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Deadline:</strong> <span id="modalTaskDeadline"></span></li>
                    <li class="list-group-item"><strong>Tanggal:</strong> <span id="modalTaskDate"></span></li>
                    <li class="list-group-item"><strong>Kategori:</strong> <span id="modalTaskCategory"></span></li>
                </ul>
                <hr>
                <h6>Keterangan:</h6>
                <p id="modalTaskDescription">Tidak ada keterangan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<!-- === JAVASCRIPT untuk Modal Dinamis === -->
<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const taskDetailModal = document.getElementById('taskDetailModal');

    taskDetailModal.addEventListener('show.bs.modal', function(event) {
        // Tombol/kartu yang diklik untuk membuka modal
        const card = event.relatedTarget;

        // Ambil data dari atribut data-*
        const title = card.dataset.title;
        const deadlineText = card.dataset.deadlineText;
        const date = card.dataset.date;
        const category = card.dataset.category;
        const description = card.dataset.description;
        const imagePath = card.dataset.imagePath;

        // Ambil elemen di dalam modal yang akan diisi
        const modalTitle = taskDetailModal.querySelector('#modalTaskTitle');
        const modalDeadline = taskDetailModal.querySelector('#modalTaskDeadline');
        const modalDate = taskDetailModal.querySelector('#modalTaskDate');
        const modalCategory = taskDetailModal.querySelector('#modalTaskCategory');
        const modalDescription = taskDetailModal.querySelector('#modalTaskDescription');
        const modalImageContainer = taskDetailModal.querySelector('#modalTaskImageContainer');

        // Isi konten modal dengan data
        modalTitle.textContent = title;
        modalDeadline.textContent = deadlineText;
        modalDate.textContent = date;
        modalCategory.textContent = category;
        modalDescription.textContent = description || 'Tidak ada keterangan.';

        // Handle gambar
        modalImageContainer.innerHTML = ''; // Kosongkan dulu container gambar
        if (imagePath) {
            const img = document.createElement('img');
            img.src = imagePath;
            img.classList.add('img-fluid', 'rounded');
            modalImageContainer.appendChild(img);
        }
    });
});
</script>
<?= $this->endSection() ?>