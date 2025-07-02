<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection('title') ?> | MgmtStudy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body,
    html {
        height: 100%;
        margin: 0;
    }

    .main-bg {
        background-color: #f0f2f5;
    }

    .header-bg {
        background-color: #2F58CD;
        padding: 1.5rem 0;
    }

    .logo {
        font-weight: bold;
        color: white;
        font-size: 1.5rem;
    }

    .logo-icon {
        filter: brightness(0) invert(1);
        margin-right: 8px;
    }

    .content-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 84px);
        /* Full height minus header */
    }

    .auth-card {
        max-width: 450px;
        width: 100%;
    }
    </style>
</head>

<body class="main-bg">

    <header class="header-bg">
        <div class="container text-center">
            <a class="navbar-brand logo" href="<?= site_url('/') ?>">
                <img src="https://api.iconify.design/logos:bootstrap.svg" alt="Logo" width="30" height="24"
                    class="d-inline-block align-text-top logo-icon">
                MgmtStudy
            </a>
        </div>
    </header>

    <main class="content-wrapper">
        <div class="container">
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Script per Halaman -->
    <?= $this->renderSection('scripts') ?>
</body>

</html>