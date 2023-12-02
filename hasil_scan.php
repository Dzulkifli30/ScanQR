<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Scan QR Code</title>
    <!-- Menggunakan font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Custom CSS */
        body {
            font-family: 'Inter', sans-serif;
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
            height: 10.50%; /* 1/6 dari tampilan desktop */
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
            justify-content: center;
            align-items: center;
            /* background-color: black; */
            padding: 0px;
            margin-top: 100px; /* Margin tambahan untuk konten di bawah navbar */
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
            width: 50vw;
            height: 5vh;
            border-top-left-radius: 16px;
            border-top-right-radius: 16px;
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
            font-size: 1em;
        }
        .icon{
            font-size: 2em;
        }
        .input-content{
            margin: 20px 0;
            width: calc(2/3 * 100vw);
            height: calc(3/5 * 100vh);
            border-radius: 30px;
            border: 10px dashed black;
        }

        /* Input file dan layar kamera */

        #preview {
            display: none;
            margin: 20px 0;
            width: calc(2/3 * 100vw);
            height: calc(3/5 * 100vh);
            border-radius: 30px;
            border: 10px dashed black; /* Border lebih tebal dan garis putus-putus */
        }

    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <a class="navbar-brand" href="coba.html"><span class="check">Check</span><span class="dulu">dulu.</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav"></div>
    </nav>

    <div class="upload-scan-bar">
        <!-- <button class="upload-box" onclick="showScanner()">Scan QR Code</button> -->
        <div class="scan-box">Berikut hasil scan kode QR yang didapatkan</div>
    </div>

    <label class="column input-content">
        <span class="file-name">
            <?php
        // Mendapatkan nilai dari parameter content
        $content = $_GET['content'] ?? '';

        if (!empty($content)) {
            echo '<p>' . htmlspecialchars($content) . '</p>';
        } else {
            echo '<p>Tidak ada hasil scan QR Code.</p>';
        }
        ?>
        </span>
    </label>

</body>

</html>