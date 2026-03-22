<?php
$zip = new ZipArchive;
$res = $zip->open('gamesreroi.zip');
if ($res === TRUE) {
  $zip->extractTo(__DIR__ . '/');
  $zip->close();
  echo '✅ Все папки и файлы успешно распакованы!';
} else {
  echo '❌ Ошибка: не удалось открыть game.zip';
}
?>
