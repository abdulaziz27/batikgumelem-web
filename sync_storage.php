<?php
$source = __DIR__ . '/storage/app/public';
$destination = __DIR__ . '/public/storage';

if (!is_dir($destination)) {
    mkdir($destination, 0755, true);
}

$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

foreach ($iterator as $item) {
    if ($item->isDir()) {
        mkdir($destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName(), 0755, true);
    } else {
        copy($item, $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName());
    }
}

echo "Storage synchronized successfully.\n";
