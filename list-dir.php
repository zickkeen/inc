<?php

function listFolderContents($directory) {
    // Pastikan direktori ada dan bisa dibaca
    if (!is_dir($directory) || !is_readable($directory)) {
        echo "<div class='alert alert-danger'>Direktori tidak valid atau tidak dapat dibaca.</div>";
        return;
    }

    // Buka direktori
    $files = scandir($directory);
    if ($files === false) {
        echo "<div class='alert alert-danger'>Gagal membaca isi direktori.</div>";
        return;
    }

    echo "<h3 class='mt-4'>Isi Folder: " . htmlspecialchars($directory) . "</h3>";
    echo "<ul class='list-group mt-3'>";
    
    // Tampilkan setiap item dalam direktori
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $filePath = $directory . DIRECTORY_SEPARATOR . $file;
        $icon = is_dir($filePath) ? '📁' : '📄';
        $itemClass = is_dir($filePath) ? 'list-group-item list-group-item-primary' : 'list-group-item';

        echo "<li class='$itemClass'>$icon " . htmlspecialchars($file) . "</li>";
    }
    echo "</ul>";
}

$uploadDir = __DIR__;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileToUpload'])) {
    $targetFile = $uploadDir . DIRECTORY_SEPARATOR . basename($_FILES['fileToUpload']['name']);

    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
        echo "<div class='alert alert-success mt-3'>File berhasil diunggah.</div>";
    } else {
        echo "<div class='alert alert-danger mt-3'>Gagal mengunggah file.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Folder & Upload File</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <h1 class="mt-5">File Manager</h1>

        <!-- Form Upload File -->
        <form action="" method="post" enctype="multipart/form-data" class="mt-4">
            <div class="form-group">
                <label for="fileToUpload">Pilih file untuk diunggah:</label>
                <input type="file" class="form-control-file" id="fileToUpload" name="fileToUpload" required>
            </div>
            <button type="submit" class="btn btn-primary">Unggah File</button>
        </form>

        <!-- Tampilkan Isi Folder -->
        <?php listFolderContents($uploadDir); ?>
    </div>
</body>
</html>
