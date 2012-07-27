<?php

include_once('json_lib.php');
include_once('lang.php');
include_once('settings.php');

$json = new Services_JSON();

$operation = $_POST['operation'];
$result = null;

switch ($operation) {
  //Открытие файла
  case 'load':
    $result['content'] = load_file($_POST['filename']);
    $encoding = detect_encoding($result['content']);
    if ($encoding && $encoding != 'utf-8') {
      $result['content'] = iconv(detect_encoding($result['content']), 'utf-8', $result['content']);
    }
    $result['status'] = t('Loaded');
    $result['encoding'] = $encoding;
    break;
  //Сохранение файла
  case 'save':
    $encoding = $_POST['encoding'];
    $content = $_POST['filecontent'];
    if ($encoding && $encoding != 'utf-8') {
      $content = iconv('utf-8', $encoding, $content);
    }
    $result['code'] = save_file($_POST['filename'], $content);
    if ($result['code'] != false) {
      $result['status'] = t('Saved');
    }
    else {
      $result['status'] = t('Error');
    }
    break;
}

echo $json->encode($result);
return;


//Кодировка имени файла в кодировку файловой системы
function load_file($name)
{
  return file_get_contents($name);
}


//Декодировка имени файла в utf-8
function save_file($name, $content)
{
  return file_put_contents($name, $content);
}


//TODO: распознавать кодировку файла по содержимому
function detect_encoding($string)
{
  return 'cp1251';
}

?>