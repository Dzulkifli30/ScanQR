<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Tentukan direktori untuk menyimpan file sementara
    $uploadDir = 'uploads/';

    // Pastikan direktori upload ada atau buat jika belum ada
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Handle file upload
    if (isset($_FILES['qrFile']) && $_FILES['qrFile']['error'] === UPLOAD_ERR_OK) {
        // Ubah nama file menjadi 'uploadfile'
        $filePath = 'uploadfile.png';
        $qrFilePath = $uploadDir . $filePath;

        move_uploaded_file($_FILES['qrFile']['tmp_name'], $qrFilePath);
        
        // echo $qrFilePath;
        // Gunakan perintah ffmpeg untuk mengkonversi MP3 ke Wav
        $command = "zbarimg --quiet --raw '$qrFilePath'";
        $result = shell_exec($command);

        // Tampilkan link untuk mengunduh file Wav
        echo 'hasil dari scanqr ' . $result . PHP_EOL;
    } else {
        echo '<script>alert("Terjadi kesalahan saat membaca kode qr")</script>';
        header("Location: index.php");
    }
} else {
    // Redirect ke halaman formulir jika mencoba mengakses convert.php secara langsung
    header("Location: index.php");
    exit();
}

?>