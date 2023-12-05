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
            justify-content: center;
            align-items: center;
            /* background-color: black; */
            padding: 0px;
            margin-top: 0px;
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
            white-space: pre-line;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
            width: 100%;
            font-size: 1em;
            font-weight: bold;
        }

        .icon {
            font-size: 2em;
        }

        .input-content {
            margin: 20px 0;
            width: calc(2/3 * 100vw);
            max-height: calc(3/5 * 100vh);
            /* Set maximum height */
            border-radius: 30px;
            border: 10px dashed black;
            overflow-y: auto;
            /* Enable vertical scrolling for overflow content */
            padding: 20px;
            /* Add padding for better aesthetics */
        }

        .link-text {
            padding-left: calc(1/20 * 100vw);
            padding-right: calc(1/20 * 100vw);

        }

        .copy-button {
            background-color: yellow;
            color: black;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 0px;
            font-weight: bold;
            /* Adjust as needed */
        }

        .copy-button:hover {
            background-color: #ffd700;
            /* Darker yellow on hover */
        }

        .back-to-home {
            color: #333;
            /* Dark text color */
            text-decoration: underline;
            margin-top: 10px;
            /* Adjust as needed */
            cursor: pointer;
        }

        .back-to-home:hover {
            color: #000;
            /* Darker text color on hover */
        }

        /* Input file dan layar kamera */

        #preview {
            display: none;
            margin: 20px 0;
            width: calc(2/3 * 100vw);
            height: calc(3/5 * 100vh);
            border-radius: 30px;
            border: 10px dashed black;
            /* Border lebih tebal dan garis putus-putus */
        }

        .absolute-alert {
            position: absolute;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <a class="navbar-brand" href="index.php"><span class="check">Check</span><span class="dulu">dulu.</span></a>
    </nav>

    <div class="upload-scan-bar">
        <!-- <button class="upload-box" onclick="showScanner()">Scan QR Code</button> -->
        <div class="scan-box">Berikut hasil scan kode QR yang didapatkan</div>
    </div>

    <label class="column input-content">
        <span id="resultText" class="file-name">
            <?php
            // Mendapatkan nilai dari parameter content
            $content = $_GET['content'] ?? '';

            if (!empty($content)) {
                echo '<p class="link-text" id="qrcodeText">' . htmlspecialchars($content) . '</p>';
            } else {
                echo '<p class="link-text" id="qrcodeText">Tidak ada hasil scan QR Code.</p>';
            }
            ?>
        </span>
    </label>

    <button class="copy-button">Copy Text <i class="fa-solid fa-copy"></i></button>
    <a class="back-to-home" href="index.php">Kembali ke halaman awal</a>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function copyText() {
            var textToCopy = document.getElementById('qrcodeText').innerText;

            var tempInput = document.createElement('textarea');
            tempInput.value = textToCopy;
            document.body.appendChild(tempInput);

            tempInput.select();
            tempInput.setSelectionRange(0, 99999);

            document.execCommand('copy');

            document.body.removeChild(tempInput);

            // Show Bootstrap alert after successful copy
            showAlert();
        }

        function showAlert() {
            // Create Bootstrap alert
            var alertDiv = document.createElement('div');
            alertDiv.className = 'alert alert-success alert-dismissible fade show absolute-alert';
            alertDiv.role = 'alert';
            alertDiv.innerHTML = '<strong>Berhasil!</strong> Teks berhasil disalin.';

            // Create close button
            var closeButton = document.createElement('button');
            closeButton.type = 'button';
            closeButton.className = 'close';
            closeButton.setAttribute('data-dismiss', 'alert');
            closeButton.innerHTML = '<span aria-hidden="true">&times;</span>';

            // Append close button to alert
            alertDiv.appendChild(closeButton);

            // Append alert to the document body
            document.body.appendChild(alertDiv);
        }
    </script>

</body>

</html>