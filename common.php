<?php

require_once('settings.php');

//Кодировка имени файла в кодировку файловой системы
function filename_encode($name, $encoding = null)
{
  global $settings;
  return iconv('utf-8', $encoding ? $encoding : $settings->filename_encoding, $name);
}


//Декодировка имени файла в utf-8
function filename_decode($name, $encoding)
{
  global $settings;
  return iconv($encoding ? $encoding : $settings->filename_encoding, 'utf-8', $name);
}


//Генерируем GUID
function create_guid() {
	if (function_exists('com_create_guid')){
		//убираем {} и в нижний регистр, чтобы работало и как varchar
		return strtolower(substr(com_create_guid(), 1, 36));
	} 
	else {
		mt_srand((double)microtime()*10000);
		$charid = strtoupper(md5(uniqid(rand(), true)));
		$hyphen = chr(45);// "-"
		$uuid = chr(123)// "{"
			.substr($charid, 0, 8).$hyphen
			.substr($charid, 8, 4).$hyphen
			.substr($charid,12, 4).$hyphen
			.substr($charid,16, 4).$hyphen
			.substr($charid,20,12)
			.chr(125);// "}"
		return strtolower(substr($uuid, 1, 36));
	}
}


//TODO: распознавать кодировку файла по содержимому
function detect_encoding($string)
{
  return 'cp1251';
}


//Получение параметров сортировки
function get_sort_params($sort)
{
  $columns = array('name', 'is_dir', 'access', 'size', 'modifydate');
  $sc_number = substr($sort, 0, strlen($sort)-1);
  $sc_number = $sc_number ? $sc_number - 1 : 0;
  $sc = $columns[$sc_number];
  
  $so_name = substr($sort, strlen($sort)-1, 1);
  $so = $so_name == 'd' ? -1 : 1;
  
  return array($sc, $so);
}


//Получить направление повторной сортироки текущей колонки
function get_sort_direction($number, $sort)
{
  $sc = substr($sort, 0, strlen($sort)-1);
  $sc = $sc ? $sc : 1;
  
  $so = substr($sort, strlen($sort)-1, 1);
  $so = $so == 'd' ? $so : 'a';
  
  return $number == $sc && $so == 'a' ? 'd' : 'a';
}


//Получить указатель текущей сортироки текущей колонки
function get_sort_cursor($number, $sort)
{
  $sc = substr($sort, 0, strlen($sort)-1);
  $sc = $sc ? $sc : 1;
  
  $so = substr($sort, strlen($sort)-1, 1);
  $so = $so == 'd' ? $so : 'a';
  
  return $number == $sc ? '<span class="arrow"> '.($so == 'd' ? '&uarr;' : '&darr;').'</span>' : '';
}


//Чтение содержимого каталога в массив и сортировка
function read_from_directory($directory, $sort_column = 'name', $sort_order = 1)
{
  $array = null;
  //Файлы и каталоги ведём отдельно, чтобы группировать их при сортировке
  $array_dir = array();
  $array_files = array();
  $dir = scandir($directory);
  for ($i=0; $i<count($dir); $i++) {
    $item_abs = $directory.'/'.$dir[$i];
    $is_dir = is_dir($item_abs);
    
    if ($is_dir) {
      $temp =& $array_dir[];
    }
    else {
      $temp =& $array_files[];
    }

    $temp['name'] = $dir[$i];
    $temp['is_dir'] = $is_dir; //0 - файл, 1 - каталог
    $temp['access'] = (is_readable($item_abs) ? 'r' : '-').
      (is_writable($item_abs) ? 'w' : '-').
      (is_executable($item_abs) ? 'x' : '-');
    $temp['size'] = !$is_dir ? filesize($item_abs) : ''; //размер в байтах
    $temp['modifydate'] = date("d.m.Y H:i:s", fileatime($item_abs)); //дата изменения
  }
  
  //Сортируем
  global $sc;
  global $so;
  $sc = $sort_column;
  $so = $sort_order;
  function cmp($a, $b) {
    global $sc;
    global $so;
    return $a[$sc] == $b[$sc] ? 0 : $so * ($a[$sc] < $b[$sc] ? -1 : 1);
  }
  usort($array_files, cmp);
  usort($array_dir, cmp);
  
  //Объединяем список каталогов и файлов
  $array = array_merge($array_dir, $array_files);
  return $array;
}


//Скачать файл
function file_download($filename, $download_as_name = '', $mimetype = 'application/octet-stream') {
  if (file_exists($filename)) {
    if (!$download_as_name) {
      $download_as_name = $filename;
    }
    header($_SERVER["SERVER_PROTOCOL"].' 200 OK');
    header('Content-Type: '.$mimetype);
    header('Last-Modified: '.gmdate('r', filemtime($filename)));
    header('ETag: '.sprintf('%x-%x-%x', fileinode($filename), filesize($filename), filemtime($filename)));
    header('Content-Length: '.(filesize($filename)));
    header('Connection: close');
    header('Content-Disposition: attachment; filename="'.basename($download_as_name).'";');
    //Открываем искомый файл
    $f = fopen($filename, 'r');
    while(!feof($f)) {
      //Читаем килобайтный блок, отдаем его в вывод и сбрасываем в буфер
      echo fread($f, 1024);
      flush();
    }
    //Закрываем файл
    fclose($f);
  } 
  else {
    header($_SERVER["SERVER_PROTOCOL"].' 404 Not Found');
    header('Status: 404 Not Found');
  }
  exit;
}


//Расширение класса ZipArchive для сжатия каталога
class ZipArchiveDir extends ZipArchive { 
  public function addDir($path, $sub) { 
    $this->addEmptyDir($sub); 
    $nodes = glob($path.'/*'); 
    foreach ($nodes as $node) { 
      $filename = str_replace($path.'/', '', $node);
      $subname = $sub.($sub ? '/' : '').$filename;
      //echo $subname.'<br>';
      if (is_dir($node)) { 
        $this->addDir($node, $subname); 
      }
      elseif (is_file($node)) {
        $this->addFile($node, $subname); 
      }
    } 
  }     
} // class ZipArchiveDir 


// copies files and non-empty directories
function rcopy($src, $dst) {
  if (is_dir($src)) {
    mkdir($dst);
    $files = scandir($src);
    foreach ($files as $file)
    if ($file != "." && $file != "..") {
      rcopy("$src/$file", "$dst/$file");
    }
  }
  elseif (file_exists($src)) {
    copy($src, $dst);
  }
}


//Рекурсивное удаление
function runlink($file) {
  if (is_file($file)) {
    unlink($file);
  }
  else {
    $objs = scandir($file);
    foreach($objs as $obj) {
      if ($obj != "." && $obj != "..") {
        is_dir($file.'/'.$obj) ? runlink($file.'/'.$obj) : unlink($file.'/'.$obj);
      }
    }
    rmdir($file);
  }
}

?>