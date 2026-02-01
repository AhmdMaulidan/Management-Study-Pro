# Management Study Pro

Aplikasi manajemen tugas untuk pelajar dan mahasiswa yang dibangun dengan **CodeIgniter 4**. Aplikasi ini membantu mengelola tugas-tugas kuliah dengan fitur tracking deadline, kategorisasi kelas, dan akses bersama via PIN.

![image alt](https://github.com/AhmdMaulidan/Management-Study-Pro/blob/32be331b20a8a8a6069695c0ca571b3e9602efcd/Ficture%20project.png)

## ✨ Fitur

- **🔐 Autentikasi User** - Registrasi dan login dengan email & password
- **📚 Manajemen Kelas** - Buat dan kelola kelas dengan PIN unik
- **📝 Manajemen Tugas** - Tambah, edit, hapus tugas dengan mudah
- **📅 Tracking Deadline** - Lihat sisa hari menuju deadline
- **📊 Dashboard** - Ringkasan tugas aktif dan tugas terdekat
- **👥 Guest Access** - Berbagi akses kelas via PIN ke teman sekelas
- **📎 Upload File** - Lampirkan file ke tugas (JPG, PNG, PDF, DOCX, ZIP)
- **🔍 Filter Kategori** - Filter tugas berdasarkan kategori kelas

## 🛠️ Teknologi

- **Framework**: CodeIgniter 4.6
- **Backend**: PHP 8.1+
- **Database**: SQLite / MySQL
- **Frontend**: HTML, CSS, JavaScript, Bootstrap

## 📦 Instalasi

### Prasyarat

- PHP 8.1 atau lebih tinggi
- Composer
- Extension PHP: intl, mbstring

### Langkah Instalasi

1. **Clone repository**

   ```bash
   git clone https://github.com/username/Management-Study-Pro.git
   cd Management-Study-Pro
   ```

2. **Install dependencies**

   ```bash
   composer install
   ```

3. **Setup environment**

   ```bash
   cp env .env
   ```

4. **Konfigurasi database** di file `.env`:

   **Opsi A - SQLite (Tanpa server database):**

   ```ini
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost:8080/'

   database.default.DBDriver = SQLite3
   database.default.database = writable/database.db
   ```

   **Opsi B - MySQL:**

   ```ini
   CI_ENVIRONMENT = development
   app.baseURL = 'http://localhost:8080/'

   database.default.hostname = localhost
   database.default.database = management_study_pro
   database.default.username = root
   database.default.password = your_password
   database.default.DBDriver = MySQLi
   database.default.port = 3306
   ```

5. **Buat file database (untuk SQLite)**

   ```bash
   touch writable/database.db
   ```

6. **Jalankan migration**

   ```bash
   php spark migrate
   ```

7. **Jalankan development server**

   ```bash
   php spark serve
   ```

8. **Buka browser** dan akses `http://localhost:8080`

## 📁 Struktur Project

```
Management-Study-Pro/
├── app/
│   ├── Controllers/
│   │   ├── Auth.php           # Login & Registrasi
│   │   ├── Dashboard.php      # Halaman Dashboard
│   │   ├── Guest.php          # Akses Guest via PIN
│   │   └── TugasController.php # CRUD Tugas
│   ├── Models/
│   │   ├── UserModel.php      # Model User
│   │   ├── KelasModel.php     # Model Kelas
│   │   └── TugasModel.php     # Model Tugas
│   ├── Views/
│   │   ├── auth/              # View Login/Register
│   │   ├── dashboard/         # View Dashboard
│   │   └── tugas/             # View Tugas
│   └── Database/
│       └── Migrations/        # Database Migrations
├── public/                    # Public assets
├── writable/                  # Uploads & Cache
└── .env                       # Environment config
```

## 🔧 Penggunaan

### Registrasi & Login

1. Buka halaman utama
2. Klik "Daftar Kelas" untuk membuat akun baru
3. Login dengan email dan password

### Mengelola Tugas

1. Klik "Tambah Tugas" untuk membuat tugas baru
2. Isi nama tugas, kategori kelas, deadline, dan status
3. Upload file jika diperlukan
4. Klik "Simpan"

### Berbagi Kelas via PIN

1. Bagikan PIN kelas ke teman
2. Teman bisa mengakses daftar tugas melalui fitur "Lihat Kelas" dengan PIN

## 📄 License

Licensed under the [MIT License](LICENSE).

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan buat Pull Request atau buka Issue untuk saran dan perbaikan.
