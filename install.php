<?php
$zip = new ZipArchive;
if ($zip->open('game.zip') === TRUE) {
    $zip->extractTo(__DIR__ . '/');
    $zip->close();
    
    // Если файлы оказались внутри папки home, вытаскиваем их в корень
    if (is_dir(__DIR__ . '/home')) {
        $files = scandir(__DIR__ . '/home');
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                rename(__DIR__ . '/home/' . $file, __DIR__ . '/' . $file);
            }
        }
        rmdir(__DIR__ . '/home'); // Удаляем теперь уже пустую папку home
    }
    
    echo '✅ Распаковка завершена! Файлы из папки home перенесены в корень.';
} else {
    echo '❌ Ошибка открытия game.zip';
}
?>
