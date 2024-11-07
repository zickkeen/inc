<?php

function listFolderContents($directory) {
    // Pastikan direktori ada dan bisa dibaca
    if (!is_dir($directory) || !is_readable($directory)) {
        echo "Direktori tidak valid atau tidak dapat dibaca.";
        return;
    }

    // Buka direktori
    $files = scandir($directory);
    if ($files === false) {
        echo "Gagal membaca isi direktori.";
        return;
    }

    echo "<h3>Isi Folder: " . htmlspecialchars($directory) . "</h3>";
    echo "<ul>";
    
    // Tampilkan setiap item dalam direktori
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') {
            continue;
        }

        $filePath = $directory . DIRECTORY_SEPARATOR . $file;
        if (is_dir($filePath)) {
            echo "<li><strong>Folder:</strong> " . htmlspecialchars($file) . "</li>";
        } else {
            echo "<li><strong>File:</strong> " . htmlspecialchars($file) . "</li>";
        }
    }
    echo "</ul>";
}

// Menggunakan direktori yang sama dengan lokasi file PHP ini
$directory = __DIR__;
listFolderContents($directory);
