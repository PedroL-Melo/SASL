<?php
$dir = __DIR__ . '/resources/views';
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        $newContent = preg_replace('/\bdark:[a-z0-9\-]+\b/', '', $content);
        $newContent = str_replace('  ', ' ', $newContent);
        file_put_contents($file->getPathname(), $newContent);
    }
}
echo "Removed dark mode classes.";
