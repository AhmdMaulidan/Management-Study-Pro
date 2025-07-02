<?= $this->extend('layout/template') ?>

<?= $this->section('title') ?>
Selamat Datang
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm auth-card">
            <div class="card-body p-4">

                <!-- Form Title, will change dynamically -->
                <h3 id="form-title" class="card-title text-center mb-4 fw-bold">Daftar Kelas</h3>

                <!-- Alert for messages -->
                <?php if (session()->getFlashdata('error')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session()->getFlashdata('error') ?>
                </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('success') ?>
                </div>
                <?php endif; ?>

                <!-- ==== FORM DAFTAR KELAS (DEFAULT) ==== -->
                <form action="<?= site_url('register') ?>" method="post" id="form-daftar">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="register-email" class="form-label">Masukkan Email</label>
                        <input type="email" class="form-control" name="email" id="register-email"
                            placeholder="example@gmail.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="register-password" class="form-label">Masukkan Password</label>
                        <input type="password" class="form-control" name="password" id="register-password" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_kelas" class="form-label">Masukkan Nama Kelas</label>
                        <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" required>
                    </div>
                    <div class="mb-3">
                        <label for="pin_kelas" class="form-label">Masukkan PIN Kelas <small>(6-10
                                karakter)</small></label>
                        <input type="text" class="form-control" name="pin_kelas" id="pin_kelas" required minlength="6"
                            maxlength="10">
                    </div>
                    <p class="text-center text-muted small">Sudah memiliki kelas? <a href="#" class="fw-bold"
                            id="show-login">Masuk Kelas</a></p>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary fw-bold">Daftar Kelas</button>
                    </div>
                </form>

                <!-- ==== FORM MASUK KELAS (HIDDEN) ==== -->
                <form action="<?= site_url('login') ?>" method="post" id="form-masuk" style="display: none;">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="login-email" class="form-label">Masukkan Email</label>
                        <input type="email" class="form-control" name="email" id="login-email"
                            placeholder="example@gmail.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="login-password" class="form-label">Masukkan Password</label>
                        <input type="password" class="form-control" name="password" id="login-password" required>
                    </div>
                    <p class="text-center text-muted small">Belum memiliki kelas? <a href="#" class="fw-bold"
                            id="show-register">Daftar Kelas</a></p>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary fw-bold">Masuk Kelas</button>
                    </div>
                </form>

                <!-- ==== FORM LIHAT KELAS (HIDDEN) ==== -->
                <form action="<?= site_url('guest/access') ?>" method="post" id="form-lihat" style="display: none;">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="pin_access" class="form-label">Masukkan PIN Kelas</label>
                        <input type="text" class="form-control" name="pin_kelas" id="pin_access" required>
                    </div>
                    <p class="text-center text-muted small">Belum memiliki kelas? <a href="#" class="fw-bold"
                            id="show-register-from-guest">Daftar Kelas</a></p>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary fw-bold">Masuk Kelas</button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <a href="#" class="text-decoration-none" id="show-guest">Lihat Kelas?</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const formDaftar = document.getElementById('form-daftar');
    const formMasuk = document.getElementById('form-masuk');
    const formLihat = document.getElementById('form-lihat');
    const formTitle = document.getElementById('form-title');

    const linkShowLogin = document.getElementById('show-login');
    const linkShowRegister = document.getElementById('show-register');
    const linkShowRegisterFromGuest = document.getElementById('show-register-from-guest');
    const linkShowGuest = document.getElementById('show-guest');

    function showForm(formToShow, title) {
        formDaftar.style.display = 'none';
        formMasuk.style.display = 'none';
        formLihat.style.display = 'none';

        formToShow.style.display = 'block';
        formTitle.textContent = title;
    }

    linkShowLogin.addEventListener('click', (e) => {
        e.preventDefault();
        showForm(formMasuk, 'Masuk Kelas');
    });

    linkShowRegister.addEventListener('click', (e) => {
        e.preventDefault();
        showForm(formDaftar, 'Daftar Kelas');
    });

    linkShowRegisterFromGuest.addEventListener('click', (e) => {
        e.preventDefault();
        showForm(formDaftar, 'Daftar Kelas');
    });

    linkShowGuest.addEventListener('click', (e) => {
        e.preventDefault();
        showForm(formLihat, 'Masuk Kelas');
    });

    // Logic to show a specific form based on URL hash, e.g. /#login
    const hash = window.location.hash;
    if (hash === '#login') {
        showForm(formMasuk, 'Masuk Kelas');
    } else if (hash === '#guest') {
        showForm(formLihat, 'Masuk Kelas');
    } else {
        showForm(formDaftar, 'Daftar Kelas');
    }
});
</script>
<?= $this->endSection() ?>