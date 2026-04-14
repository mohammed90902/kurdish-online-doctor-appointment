<?php

function deduplicateJson($filePath) {
    if (!file_exists($filePath)) {
        echo "File not found: $filePath\n";
        return;
    }

    $content = file_get_contents($filePath);
    $data = json_decode($content, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Invalid JSON in $filePath: " . json_last_error_msg() . "\n";
        return;
    }

    // ksort($data); // Optional: sort keys
    $newContent = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    file_put_contents($filePath, $newContent);
    echo "Deduplicated $filePath\n";
}

$files = [
    'd:/Desktop/kurdish-doctor-appointment/resources/lang/ckb.json',
    'd:/Desktop/kurdish-doctor-appointment/resources/lang/ar.json',
    'd:/Desktop/kurdish-doctor-appointment/resources/lang/en.json',
];

foreach ($files as $file) {
    deduplicateJson($file);
}
