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
        $icon = is_dir($filePath) ? '📁' : '📄'; // Gunakan ikon berbeda untuk folder dan file
        $itemClass = is_dir($filePath) ? 'list-group-item list-group-item-primary' : 'list-group-item';

        echo "<li class='$itemClass'>$icon " . htmlspecialchars($file) . "</li>";
    }
    echo "</ul>";
}

// Menggunakan direktori yang sama dengan lokasi file PHP ini
$directory = __DIR__;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Isi Folder</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container">
        <?php listFolderContents($directory); ?>
    </div>
</body>
</html>
