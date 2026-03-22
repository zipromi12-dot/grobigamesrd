<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$filename = 'game.zip';

if (!file_exists($filename)) {
    echo "❌ Ошибка: Файл <b>$filename</b> не найден в корневой директории!<br>";
    echo "Список файлов в папке: <pre>";
    print_r(scandir(__DIR__));
    echo "</pre>";
} else {
    $zip = new ZipArchive;
    $res = $zip->open($filename);
    if ($res === TRUE) {
        $zip->extractTo(__DIR__ . '/');
        $zip->close();
        
        // Перенос из папки home, если она есть
        if (is_dir(__DIR__ . '/home')) {
            $files = array_diff(scandir(__DIR__ . '/home'), array('.', '..'));
            foreach ($files as $file) {
                rename(__DIR__ . '/home/' . $file, __DIR__ . '/' . $file);
            }
            rmdir(__DIR__ . '/home');
        }
        echo "✅ Ура! Все файлы успешно распакованы.";
    } else {
        echo "❌ ZipArchive не смог открыть файл. Код ошибки: " . $res;
    }
}
?>
