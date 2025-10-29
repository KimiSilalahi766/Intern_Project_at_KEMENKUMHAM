# 📘 PANDUAN LENGKAP MENJALANKAN PROJECT DI VSCODE

## 🎯 TUJUAN
Menjalankan aplikasi Generator Laporan Evaluasi DOCX di komputer lokal Anda menggunakan VSCode.

---

## 📋 DAFTAR ISI
1. [Software Yang Dibutuhkan](#software-yang-dibutuhkan)
2. [Instalasi Software](#instalasi-software)
3. [Download & Setup Project](#download--setup-project)
4. [Menjalankan Aplikasi](#menjalankan-aplikasi)
5. [Testing Aplikasi](#testing-aplikasi)
6. [Troubleshooting](#troubleshooting)

---

## 1️⃣ SOFTWARE YANG DIBUTUHKAN

### ✅ Wajib Install:
1. **VSCode** (Code Editor)
2. **PHP 8.1+** (Bahasa Pemrograman)
3. **Composer** (Package Manager untuk PHP)
4. **Web Browser** (Chrome/Edge/Firefox)

### ⚠️ Opsional (Pilih salah satu):
- **PHP Built-in Server** (sudah include di PHP, RECOMMENDED)
- **XAMPP** (jika ingin pakai Apache)
- **Laragon** (alternatif XAMPP)

---

## 2️⃣ INSTALASI SOFTWARE

### A. INSTALL VSCODE

#### Windows:
1. Buka browser
2. Ke: https://code.visualstudio.com/
3. Klik tombol **"Download for Windows"**
4. Tunggu download selesai
5. **Jalankan installer** (VSCodeUserSetup-x64-1.x.x.exe)
6. Klik **Next > Next > Install**
7. Centang **"Add to PATH"** (PENTING!)
8. Klik **Finish**

#### Mac:
1. Buka browser
2. Ke: https://code.visualstudio.com/
3. Klik **"Download for Mac"**
4. Buka file `.dmg` yang ter-download
5. Drag **Visual Studio Code** ke folder **Applications**
6. Done!

---

### B. INSTALL PHP

#### Windows (Menggunakan XAMPP - TERMUDAH):

1. **Download XAMPP:**
   - Buka: https://www.apachefriends.org/
   - Klik **"XAMPP for Windows"**
   - Download versi **8.2.x** atau lebih tinggi

2. **Install XAMPP:**
   - Jalankan installer (xampp-windows-x64-8.2.x-installer.exe)
   - Klik **Next**
   - Pilih komponen:
     - ✅ Apache
     - ✅ PHP
     - ✅ MySQL (opsional, tidak dipakai di project ini)
   - Pilih lokasi install: `C:\xampp`
   - Klik **Next > Next > Install**
   - Tunggu sampai selesai
   - Klik **Finish**

3. **Tambahkan PHP ke PATH:**
   - Klik kanan **"This PC"** atau **"My Computer"**
   - Pilih **"Properties"**
   - Klik **"Advanced system settings"**
   - Klik **"Environment Variables"**
   - Di bagian **"System variables"**, cari **"Path"**
   - Klik **"Edit"**
   - Klik **"New"**
   - Ketik: `C:\xampp\php`
   - Klik **OK > OK > OK**

4. **Verifikasi PHP:**
   - Buka **Command Prompt** (tekan `Win + R`, ketik `cmd`, Enter)
   - Ketik: `php --version`
   - Harus muncul:
     ```
     PHP 8.2.x (cli) ...
     ```
   - Jika muncul "php is not recognized", restart komputer lalu coba lagi

#### Mac:
```bash
# Install menggunakan Homebrew
brew install php
```

#### Linux:
```bash
# Ubuntu/Debian
sudo apt update
sudo apt install php php-cli php-mbstring php-xml php-zip php-gd

# CentOS/RHEL
sudo yum install php php-cli php-mbstring php-xml php-zip php-gd
```

---

### C. INSTALL COMPOSER

#### Windows:

1. **Download Composer:**
   - Buka: https://getcomposer.org/download/
   - Klik **"Composer-Setup.exe"**
   - Tunggu download selesai

2. **Install Composer:**
   - Jalankan **Composer-Setup.exe**
   - Pilih **"Install for all users"**
   - Klik **Next**
   - Composer akan **auto-detect** lokasi PHP
     - Jika tidak detect, arahkan ke: `C:\xampp\php\php.exe`
   - Klik **Next > Next > Install**
   - Klik **Finish**

3. **Verifikasi Composer:**
   - Buka **Command Prompt** BARU
   - Ketik: `composer --version`
   - Harus muncul:
     ```
     Composer version 2.x.x
     ```

#### Mac:
```bash
# Install via Homebrew
brew install composer
```

#### Linux:
```bash
# Download dan install
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"
sudo mv composer.phar /usr/local/bin/composer
```

---

## 3️⃣ DOWNLOAD & SETUP PROJECT

### A. DOWNLOAD PROJECT

**Dari Platform Ini:**
1. Klik tombol **"Download"** atau **"Export"**
2. Download sebagai **ZIP file**
3. Extract file ZIP ke folder yang Anda inginkan
   - Contoh: `D:\Projects\laporan-evaluasi\`
   - Atau: `C:\Users\NamaAnda\Documents\laporan-evaluasi\`

**PENTING:** 
- Jangan taruh di folder `Desktop` (bisa error)
- Jangan taruh di folder yang namanya punya **spasi** atau **karakter aneh**
- Path yang bagus: `D:\Projects\laporan-evaluasi\`

---

### B. BUKA PROJECT DI VSCODE

1. **Buka VSCode**
   - Klik icon VSCode di Desktop
   - Atau cari "Visual Studio Code" di Start Menu

2. **Buka Folder Project:**
   - Klik **"File"** → **"Open Folder"**
   - Atau tekan: `Ctrl + K, Ctrl + O`
   - Navigate ke folder project Anda
   - Pilih folder **laporan-evaluasi**
   - Klik **"Select Folder"**

3. **VSCode akan membuka folder** dengan struktur seperti ini:
   ```
   laporan-evaluasi/
   ├── app/
   ├── public/
   ├── writable/
   ├── vendor/ (belum ada)
   ├── composer.json
   └── README.md
   ```

---

### C. INSTALL DEPENDENCIES

1. **Buka Terminal di VSCode:**
   - Klik menu **"Terminal"** → **"New Terminal"**
   - Atau tekan: `` Ctrl + ` `` (tombol backtick di samping angka 1)
   - Terminal akan muncul di bawah

2. **Pastikan Anda di folder project:**
   - Di terminal, akan muncul path seperti:
     ```
     PS D:\Projects\laporan-evaluasi>
     ```
   - Jika tidak, ketik:
     ```
     cd D:\Projects\laporan-evaluasi
     ```

3. **Install Dependencies dengan Composer:**
   - Ketik di terminal:
     ```bash
     composer install
     ```
   - Tekan **Enter**
   - Tunggu proses install (2-5 menit)
   - Akan muncul output seperti:
     ```
     Installing dependencies from lock file
     Package operations: 35 installs, 0 updates, 0 removals
     ...
     Generating optimized autoload files
     ```

4. **Selesai!**
   - Folder `vendor/` sekarang sudah ada
   - Dependencies sudah terinstall

---

## 4️⃣ MENJALANKAN APLIKASI

### METODE 1: Menggunakan PHP Built-in Server (RECOMMENDED) ⭐

#### Step 1: Buka Terminal di VSCode
- Jika belum buka, tekan `` Ctrl + ` ``

#### Step 2: Jalankan Server
Ketik di terminal:
```bash
php -S localhost:8080 -t public
```

Tekan **Enter**

#### Step 3: Lihat Output
Akan muncul:
```
[Tue Oct 28 10:00:00 2025] PHP 8.2.23 Development Server (http://localhost:8080) started
```

**JANGAN TUTUP TERMINAL INI!** Server sedang jalan.

#### Step 4: Buka Browser
1. Buka **Chrome** atau **Edge** atau **Firefox**
2. Ketik di address bar:
   ```
   http://localhost:8080
   ```
3. Tekan **Enter**

#### Step 5: Cek Aplikasi
✅ Harus muncul form dengan:
- Background biru gradasi
- Header biru dengan border kuning
- Form putih
- Input field dengan border biru

🎉 **BERHASIL!** Aplikasi sudah jalan!

---

### METODE 2: Menggunakan XAMPP (Alternatif)

#### Step 1: Copy Project ke htdocs
1. Buka File Explorer
2. Navigate ke: `C:\xampp\htdocs\`
3. Copy folder **laporan-evaluasi** ke sini
4. Hasilnya: `C:\xampp\htdocs\laporan-evaluasi\`

#### Step 2: Start XAMPP
1. Buka **XAMPP Control Panel**
2. Klik tombol **"Start"** di samping **Apache**
3. Status Apache akan jadi **hijau**

#### Step 3: Buka Browser
Ketik di address bar:
```
http://localhost/laporan-evaluasi/
```

---

## 5️⃣ TESTING APLIKASI

### A. TEST FORM

1. **Buka aplikasi** di browser: `http://localhost:8080`

2. **Isi SEMUA field:**
   - Satuan Kerja (KOP): `KANTOR WILAYAH KEMENKUMHAM JAWA TIMUR`
   - Alamat: `Jl. Veteran No. 20, Surabaya`
   - Telpon: `(031) 5321234`
   - Laman: `https://jatim.kemenkumham.go.id`
   - Surel: `kanwiljatim@kemenkumham.go.id`
   - Satuan Kerja (Judul): `KANWIL KEMENKUMHAM JATIM`
   - Satuan Kerja (Judul 2): `Kantor Wilayah Jawa Timur`
   - Triwulan (E-Monev): `III`
   - Tahun (E-Monev): `2024`
   - Output (E-Monev): `95%`
   - Triwulan (SMART): `III`
   - Tahun (SMART): `2024`
   - Output (SMART): `92%`
   - Hambatan 1: `Kurangnya SDM yang terlatih`
   - Hambatan 2: `Koneksi internet yang tidak stabil`
   - Rencana 1: `Mengadakan pelatihan untuk SDM`
   - Rencana 2: `Upgrade koneksi internet`

3. **Upload 3 Gambar:**
   - Gambar E-Monev: Pilih gambar/screenshot apapun (JPG/PNG, max 2MB)
   - Gambar SMART: Pilih gambar lain
   - Gambar E-Performance: Pilih gambar lain

4. **Klik Tombol "KIRIM"**

---

### B. CEK HASIL

#### Cara 1: Lihat Download Browser
1. Setelah klik KIRIM, tunggu beberapa detik
2. Browser akan **otomatis download** file
3. Lihat pojok kanan bawah browser (Chrome/Edge)
4. Atau tekan `Ctrl + J` untuk buka Downloads
5. File akan ada dengan nama:
   ```
   Laporan_Evaluasi_2025-10-28_103045.docx
   ```

#### Cara 2: Cek Folder Downloads
1. Buka File Explorer
2. Ketik di address bar: `%USERPROFILE%\Downloads`
3. Tekan Enter
4. Cari file terbaru: `Laporan_Evaluasi_...`

#### Cara 3: Cek Folder Project
1. Buka folder project di VSCode
2. Buka folder: `writable/filedox/`
3. File `update_laporanevaluasi.docx` sudah ada

---

### C. BUKA FILE HASIL

1. **Double-click** file DOCX yang ter-download
2. **Microsoft Word** akan membuka file
3. **Cek apakah data sudah masuk:**
   - Apakah nama satuan kerja sudah terganti?
   - Apakah alamat, telpon, dll sudah terganti?
   - Apakah gambar sudah masuk?

---

## 6️⃣ TROUBLESHOOTING

### ❌ Problem 1: "php: command not found"

**Penyebab:** PHP belum terinstall atau belum di PATH

**Solusi:**
1. Install PHP (lihat bagian 2B)
2. Tambahkan PHP ke PATH
3. Restart terminal/command prompt
4. Coba lagi: `php --version`

---

### ❌ Problem 2: "composer: command not found"

**Penyebab:** Composer belum terinstall

**Solusi:**
1. Install Composer (lihat bagian 2C)
2. Restart terminal
3. Coba lagi: `composer --version`

---

### ❌ Problem 3: Port 8080 already in use

**Error:**
```
bind: Address already in use
```

**Solusi:**
Ganti port ke 9000:
```bash
php -S localhost:9000 -t public
```

Lalu buka browser ke: `http://localhost:9000`

---

### ❌ Problem 4: Form tidak muncul / blank page

**Solusi:**

1. **Cek terminal, apakah ada error?**

2. **Pastikan server jalan:**
   ```
   [Tue Oct 28 10:00:00 2025] PHP 8.2.23 Development Server (http://localhost:8080) started
   ```

3. **Cek apakah sudah buka URL yang benar:**
   ```
   http://localhost:8080
   ```

4. **Cek permission folder writable:**
   ```bash
   # Windows (di Git Bash atau PowerShell)
   icacls writable /grant Everyone:F /T
   ```

---

### ❌ Problem 5: File tidak ter-download

**Cek 1: Apakah ada error di form?**
- Lihat apakah ada pesan error merah
- Pastikan SEMUA field sudah diisi
- Pastikan 3 gambar sudah di-upload

**Cek 2: Template Word**
- Pastikan file `writable/filedox/laporanevaluasi.docx` ada
- File ini HARUS punya placeholder format `${...}`

**Cek 3: Log File**
1. Buka folder: `writable/logs/`
2. Buka file terbaru: `log-2025-10-28.php`
3. Cari kata "ERROR" atau "error"
4. Lihat detail error nya

**Cek 4: Browser Console**
1. Tekan `F12` di browser
2. Klik tab **"Console"**
3. Lihat apakah ada error merah

---

### ❌ Problem 6: Placeholder tidak terganti

**Penyebab:** Template Word tidak punya placeholder yang benar

**Solusi:**
1. Buka file: `writable/filedox/laporanevaluasi.docx`
2. Di Microsoft Word, ganti teks dengan placeholder:
   - Ganti "NAMA SATKER" dengan `${JUDUL}`
   - Ganti "Alamat" dengan `${Alamat}`
   - Dan seterusnya...
3. Format placeholder HARUS: `${namaplaceholder}`
4. Simpan file
5. Coba submit form lagi

**Daftar lengkap placeholder ada di file: CARA_PAKAI.txt**

---

## 🎯 RINGKASAN URUTAN APLIKASI YANG DIBUKA

### URUTAN LENGKAP:

1. **Install Software (Sekali saja):**
   - Install VSCode
   - Install PHP (via XAMPP)
   - Install Composer

2. **Setup Project (Sekali saja):**
   - Download & extract project
   - Buka VSCode
   - Buka folder project di VSCode
   - Buka terminal di VSCode
   - Jalankan: `composer install`

3. **Setiap Kali Mau Pakai Aplikasi:**
   - Buka VSCode
   - Buka terminal (`` Ctrl + ` ``)
   - Jalankan: `php -S localhost:8080 -t public`
   - Buka browser
   - Ketik: `http://localhost:8080`
   - Isi form & submit

4. **Stop Server:**
   - Tekan `Ctrl + C` di terminal VSCode

---

## 📱 APLIKASI YANG HARUS TERBUKA SAAT PAKAI:

1. ✅ **VSCode** - untuk jalankan server
2. ✅ **Terminal di VSCode** - server jalan di sini
3. ✅ **Web Browser** - untuk buka aplikasi
4. ✅ **Microsoft Word** - untuk buka file hasil

---

## 💡 TIPS

1. **Jangan tutup terminal** selama aplikasi dipakai
2. **Bookmark** `http://localhost:8080` di browser
3. **Simpan** file template jangan di-hapus
4. **Backup** folder project secara berkala
5. **Gunakan Git** untuk version control (opsional)

---

## ✅ CHECKLIST SEBELUM MULAI

- [ ] VSCode sudah terinstall
- [ ] PHP sudah terinstall (cek: `php --version`)
- [ ] Composer sudah terinstall (cek: `composer --version`)
- [ ] Project sudah di-download & extract
- [ ] Dependencies sudah di-install (`composer install`)
- [ ] Template file ada di `writable/filedox/laporanevaluasi.docx`
- [ ] Template punya placeholder format `${...}`
- [ ] Server berhasil jalan (`php -S localhost:8080 -t public`)
- [ ] Browser bisa buka `http://localhost:8080`
- [ ] Form muncul dengan benar

---

## 🎉 SELAMAT!

Jika semua langkah di atas berhasil, aplikasi Anda sudah jalan!

Silakan baca file **PENTING_FILE_HASIL.txt** untuk tahu dimana file hasil nya!

---

📧 **Ada masalah?** Cek log di: `writable/logs/log-YYYY-MM-DD.php`
