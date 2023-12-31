<?php
    $folderPath = 'uploads'; // Ganti dengan path folder Anda

    // Membaca daftar file dalam folder
    $files = scandir($folderPath);
    
    // Menghapus setiap file
    foreach ($files as $file) {
        // Hindari menghapus "." dan ".."
        if ($file !== "." && $file !== "..") {
            $filePath = $folderPath . '/' . $file;
    
            // Hapus file
            if (is_file($filePath)) {
                unlink($filePath);
                // echo 'File ' . $file . ' berhasil dihapus.<br>';
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkdulu - online free ScanQR website</title>
    <!-- Menggunakan font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Custom CSS */
        body {
            font-family: 'Arial', sans-serif;
            text-align: center;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f5f5f5;
        }

        .navbar-custom {
            background-color: #000;
            height: 10.50%;
            /* 1/6 dari tampilan desktop */
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }

        .navbar-custom .navbar-brand {
            font-family: 'Inter', sans-serif;
        }

        .navbar-custom .navbar-brand .check {
            color: yellow;
            font-weight: 700;
        }

        .navbar-custom .navbar-brand .dulu {
            color: #fff;
            font-weight: 1000;
        }

        .upload-scan-bar {
            display: flex;
            justify-content: space-around;
            align-items: center;
            /* background-color: black; */
            padding: 0px;
            margin-top: 100px;
            /* Margin tambahan untuk konten di bawah navbar */
        }

        .upload-text,
        .scan-code {
            color: yellow;
            font-family: 'Inter', sans-serif;
            font-weight: bold;
            text-align: center;
            position: absolute;
        }

        .upload-text {
            font-size: 18pt;
            left: 380px;
            top: 251px;
        }

        .upload-box,
        .scan-box {
            width: 180px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: yellow;
            font-family: 'Inter', sans-serif;
            font-weight: bold;
            background-color: black;
            position: absolute;
            cursor: pointer;
        }

        .upload-box {
            left: 100px;
            top: 135px;
        }

        .scan-box {
            left: 300px;
            top: 135px;
        }

        .scan-code {
            font-size: 14pt;
            left: 520px;
            top: 257px;
        }

        .column {
            background-color: #F2EDED;
            height: 20vh;
            width: 40vw;
            margin: 10px;
            border: 5px solid #D0B770;
            border-radius: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
            position: relative;
        }

        .column:hover {
            background-color: #d0d0d0;
        }

        .file-name {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
            width: 100%;
            font-size: 2em;
        }

        .icon {
            font-size: 2em;
        }

        /* Input file dan layar kamera */
        #fileInput {
            display: none;
            margin: 20px 0;
            width: calc(2/3 * 100vw);
            height: calc(3/5 * 100vh);
            border-radius: 30px;
            border: 10px dashed black;
            /* Border lebih tebal dan garis putus-putus */
        }

        #preview {
            display: none;
            margin: 20px 0;
            width: calc(2/3 * 100vw);
            height: calc(3/5 * 100vh);
            border-radius: 30px;
            border: 10px dashed black;
            /* Border lebih tebal dan garis putus-putus */
        }
        #konversiBtn {
    display: none;
    background-color: yellow;
    color: black;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1.5em;
    margin-top: 10px;
    /* Perubahan untuk mengatur tombol ke tengah */
    margin: 0 auto;
}
    /* perubahan ketika tombol di arahkan */
  #konversiBtn:hover {
            background-color: #ffd700;
            /* Darker yellow on hover */
        }

/* Tambahan untuk membuat tombol berada di tengah secara vertikal */
form {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    margin-top: 20px;
}
    </style>
    <title>Navbar Custom</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <a class="navbar-brand" href="#"><span class="check">Check</span><span class="dulu">dulu.</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav"></div>
    </nav>

    <!-- Pilihan Upload Image dan Scan QR Code -->
    <div class="upload-scan-bar">
        <button class="upload-box" onclick="showScanner()">Scan QR Code</button>
        <button class="scan-box" onclick="showFileInput()">Upload Image</button>
    </div>

    <!-- Input file dan layar kamera -->
    <form action="hasil_uploads.php" method="post" enctype="multipart/form-data">
        <label class="column btn input-content" id="fileInput">
            <input type="file" name="qrFile" style="display: none;" onchange="updateFileName(this)">
            <span class="file-name">
                <i class="fa-solid fa-cloud-arrow-up icon"></i>
                <p>Input file Here</p>
            </span>
        </label>
        <button type="submit" id="konversiBtn">Konversi</button>
    </form>

    <!-- <input type="file" id="fileInput"> -->
    <video id="preview" autoplay></video>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Include Instascan library -->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <script>
        const fileInput = document.getElementById('fileInput');
        const preview = document.getElementById('preview');

        function updateFileName(input) {
            var fileName = input.files[0].name;
            var fileDisplay = input.parentElement.querySelector('.file-name');
            var konversiBtn = document.getElementById('konversiBtn');

            fileDisplay.textContent = fileName;

            // Tampilkan tombol konversi jika file sudah diinput
            konversiBtn.style.display = 'block';
        }

        function showFileInput() {
            fileInput.style.display = 'block';
            preview.style.display = 'none';
        }

        function showScanner() {
            fileInput.style.display = 'none';
            preview.style.display = 'block';

            const scanner = new Instascan.Scanner({ video: preview });

            scanner.addListener('scan', function (content) {
                // Ketika QR Code terdeteksi, pindah ke halaman baru dengan isi QR Code sebagai parameter
                window.location.href = 'hasil_scan.php?content=' + encodeURIComponent(content);
            });

            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    console.error('Tidak ada kamera yang ditemukan.');
                    showFileInput();
                }
            }).catch(function (e) {
                console.error(e);
                showFileInput();
            });
        }
    </script>
</body>

</html>