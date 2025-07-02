<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> | MgmtStudy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <style>
    /* CSS Variables untuk tema */
    :root {
        --sidebar-width: 300px;
        --primary-color: #3366FF;
        --sidebar-bg: #fff;
        /* KEMBALIKAN: Latar sidebar jadi putih */
        --sidebar-active-bg: #eef2ff;
        --sidebar-active-color: var(--primary-color);
        --body-bg: #f4f7fa;
    }

    body {
        background-color: var(--body-bg);
        transition: margin-left 0.3s ease;
    }

    /* --- Sidebar Styling --- */
    .sidebar {
        width: var(--sidebar-width);
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        background-color: var(--sidebar-bg);
        /* Latar sidebar putih */
        border-right: 1px solid #dee2e6;
        /* Tambahkan kembali border kanan */
        padding-top: 80px;
        /* Beri ruang untuk navbar di atas */
        transition: margin-left 0.3s ease;
        z-index: 1020;
        /* Di bawah navbar atas */
    }

    .sidebar .nav-link {
        color: #555;
        /* KEMBALIKAN: Warna font link jadi gelap */
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        margin: 0.25rem 1rem;
        font-weight: 500;
    }

    .sidebar .nav-link.active,
    .sidebar .nav-link:hover {
        background-color: var(--sidebar-active-bg);
        color: var(--sidebar-active-color);
    }

    .sidebar .nav-link .fa-fw {
        margin-right: 10px;
    }

    /* --- Top Navbar Styling --- */
    .top-navbar {
        height: 65px;
        background: var(--primary-color);
        /* Latar navbar atas tetap biru */
        padding: 0 1.5rem;
        position: fixed;
        /* Jadikan navbar fixed */
        top: 0;
        right: 0;
        left: 0;
        z-index: 1030;
        /* Di atas sidebar */
    }

    .logo-text {
        font-weight: 700;
        font-size: 1.6rem;
        color: #fff;
        /* Warna logo di navbar tetap putih */
    }

    /* Style untuk elemen di navbar atas */
    .top-navbar .btn-link,
    .top-navbar .input-group-text,
    .top-navbar .form-control {
        color: #fff;
    }

    .top-navbar .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .top-navbar .form-control,
    .top-navbar .input-group-text {
        background-color: rgba(255, 255, 255, 0.2) !important;
        border: none !important;
    }

    /* --- Main Content Layout --- */
    .main-wrapper {
        margin-left: var(--sidebar-width);
        padding-top: 65px;
        /* Beri ruang untuk navbar atas yang fixed */
        transition: margin-left 0.3s ease;

    }

    .task-card-title {
        color: #615DFF !important;
        /* Tambahkan !important jika perlu */
        font-weight: 600;
    }

    /* --- Responsive State --- */
    @media (min-width: 992px) {
        body.sidebar-collapsed .sidebar {
            margin-left: calc(-1 * var(--sidebar-width));
        }

        body.sidebar-collapsed .main-wrapper {
            margin-left: 0;
        }
    }

    @media (max-width: 991.98px) {
        .sidebar {
            margin-left: calc(-1 * var(--sidebar-width));
        }

        .main-wrapper {
            margin-left: 0;
        }

        body.sidebar-open .sidebar {
            margin-left: 0;
        }
    }

    /* --- Styling Lain (Card, dll) Tetap Sama --- */
    .summary-card {
        border: none;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
    }

    .summary-card .card-body {
        color: #fff;
        padding: 1.5rem;
    }

    .summary-card .card-body .display-5 {
        font-weight: 700;
    }

    .summary-card .card-footer {
        background-color: #fff;
        border-top: none;
        padding: 0.75rem 1.5rem;
    }

    .summary-card .card-footer a {
        text-decoration: none;
        color: #555;
        font-weight: 500;
    }

    .summary-card .card-footer .arrow-icon {
        color: #ccc;
    }

    .task-list-title {
        color: #615DFF;
    }

    .task-card-clickable {
        cursor: pointer;
        transition: transform 0.2s ease-in-out;
    }

    .task-card-clickable:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }
    </style>
</head>

<body class="">

    <nav class="top-navbar d-flex align-items-center">
        <!-- PERUBAHAN STRUKTUR: Logo & Hamburger ada di sini -->
        <div class="d-flex align-items-center">
            <button class="btn btn-link" id="sidebar-toggle">
                <i class="fa-solid fa-bars fs-5"></i>
            </button>
            <a class="navbar-brand ms-2" href="<?= site_url('dashboard') ?>">
                <span class="logo-text"><i class="fa-solid fa-layer-group"></i> MgmtStudy</span>
            </a>
        </div>

        <div class="ms-auto d-flex align-items-center">
            <div class="input-group me-3">
                <span class="input-group-text"><i class="fa-solid fa-search"></i></span>
                <input type="text" class="form-control" placeholder="Search...">
            </div>
            <a href="#" class="btn btn-link"><i class="fa-solid fa-bell fs-5"></i></a>
            <a href="#" class="btn btn-link"><i class="fa-solid fa-user-circle fs-5"></i></a>
        </div>
    </nav>

    <aside class="sidebar">
        <!-- PERUBAHAN STRUKTUR: Header logo sudah dipindah ke navbar atas -->
        <div class="p-2">
            <p class="text-muted small text-uppercase mt-3 mb-2 px-2">Materially</p>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= (uri_string() == 'dashboard') ? 'active' : '' ?>"
                        href="<?= site_url('dashboard') ?>">
                        <i class="fa fa-home fa-fw"></i> Dashboard
                    </a>
                </li>
            </ul>
            <p class="text-muted small text-uppercase mt-4 mb-2 px-2">Pages</p>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?= (str_contains(uri_string(), 'tugas/tambah')) ? 'active' : '' ?>"
                        href="<?= site_url('tugas/tambah') ?>">
                        <i class="fa fa-plus fa-fw"></i> Tambah Tugas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (str_contains(uri_string(), 'tugas/daftar')) ? 'active' : '' ?>"
                        href="<?= site_url('tugas/daftar') ?>">
                        <i class="fa fa-briefcase fa-fw"></i> Daftar Tugas
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= (str_contains(uri_string(), 'tugas/selesai')) ? 'active' : '' ?>"
                        href="<?= site_url('tugas/selesai') ?>">
                        <i class="fa fa-check fa-fw"></i> Tugas Selesai
                    </a>
                </li>
                <li class="nav-item mt-4">
                    <a class="nav-link" href="<?= site_url('logout') ?>">
                        <i class="fa fa-sign-out-alt fa-fw"></i> Log Out
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="main-wrapper">
        <main class="p-4">
            <?= $this->renderSection('content') ?>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript tidak perlu diubah -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarToggle = document.getElementById('sidebar-toggle');
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                if (window.innerWidth < 992) {
                    document.body.classList.toggle('sidebar-open');
                } else {
                    document.body.classList.toggle('sidebar-collapsed');
                }
            });
        }
    });
    </script>
    <?= $this->renderSection('scripts') ?>

</body>

</html>