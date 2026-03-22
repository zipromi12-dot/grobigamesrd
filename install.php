<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$filename = 'game.zip';

if (file_exists($filename)) {
    // Даем права на чтение/запись файлу перед открытием
    chmod($filename, 0777); 
    
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
            @rmdir(__DIR__ . '/home');
        }
        echo "✅ Успех! Игра распакована. Можешь переходить на главную.";
    } else {
        echo "❌ Ошибка открытия: Код $res. Попробуй пересоздать ZIP на телефоне через ZArchiver.";
    }
} else {
    echo "❌ Файл game.zip не найден. Проверь имя на GitHub!";
}
?>
