<?php

include_once('json_lib.php');
include_once('settings.php');
include_once('lang.php');
include_once('common.php');

$json = new Services_JSON();

$operation = $_POST['operation'];
$result = null;

//Авторизация
if (wedit_login($settings, $info)) {

  //Полный путь к имени файла
  $filename = str_replace('\\', '/', $_POST['filename']);
  $root = str_replace('\\', '/', realpath($settings->root_path));
  $current = realpath($root.'/'.filename_encode(
    substr($filename, 0, 1) == '/' ? substr($filename, 1, strlen($filename)-1) : $filename
  ));
  //Не вышли ли за пределы домашнего каталога?
  if (substr($current, 0, strlen($root)) != $root) {
    $result['code'] = false;
    $result['status'] = t('Attempt to go beyond your home directory');
    $current = $root;
  }
  else {
    switch ($operation) {

      //Открытие файла
      case 'load':
        $result['content'] = file_get_contents($current);
        $encoding = $_POST['encoding'];
        if (!$encoding) {
          $encoding = detect_encoding($result['content']);
          if ($encoding == 'unknown') {
            $encoding = $settings->default_encoding;
          }
        }
        if ($encoding && $encoding != 'utf-8') {
          $result['content'] = iconv($encoding, 'utf-8', $result['content']);
        }
        $result['status'] = t('Loaded');
        $result['encoding'] = $encoding;
        $result['code'] = $result['content'] != false;
        break;
        
      //Сохранение файла
      case 'save':
        $encoding = $_POST['encoding'];
        $content = $_POST['filecontent'];
        if ($encoding && $encoding != 'utf-8') {
          $content = iconv('utf-8', $encoding, $content);
        }
        $result['code'] = file_put_contents($current, $content);
        if ($result['code'] != false) {
          $result['status'] = t('Saved');
        }
        else {
          $result['status'] = t('Error');
        }
        break;
    }
  }
}
else {
  $result['code'] = false;
  $result['status'] = t('Don\'t authorised in Iris CRM');
}

echo $json->encode($result);
return;



?>