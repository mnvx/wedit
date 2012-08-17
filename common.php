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


//Распознавать кодировку файла по содержимому
function detect_encoding($content, $count=2000)
{
  //Для ускорения будем определять кодировку по первым 2000 символам
  if ($count > 0) {
    $content = substr($content, 0, $count);
  }
  
  $charsets = array ( 'w' => 0, 'k' => 0, 'i' => 0, 'm' => 0, 'a' => 0, 'c' => 0, 'u' => 0 );

  // Windows-1251
  $search_l_w = "~([\270])|([\340-\347])|([\350-\357])|([\360-\367])|([\370-\377])~s";
  $search_U_w = "~([\250])|([\300-\307])|([\310-\317])|([\320-\327])|([\330-\337])~s";

  // Koi8-r
  $search_l_k = "~([\243])|([\300-\307])|([\310-\317])|([\320-\327])|([\330-\337])~s";
  $search_U_k = "~([\263])|([\340-\347])|([\350-\357])|([\360-\367])|([\370-\377])~s";

  // Iso-8859-5
  $search_l_i = "~([\361])|([\320-\327])|([\330-\337])|([\340-\347])|([\350-\357])~s";
  $search_U_i = "~([\241])|([\260-\267])|([\270-\277])|([\300-\307])|([\310-\317])~s";

  // X-mac-cyrillic
  $search_l_m = "~([\336])|([\340-\347])|([\350-\357])|([\360-\367])|([\370-\370])|([\337])~s";
  $search_U_m = "~([\335])|([\200-\207])|([\210-\217])|([\220-\227])|([\230-\237])~s";

  // Ibm866
  $search_l_a = "~([\361])|([\240-\247])|([\250-\257])|([\340-\347])|([\350-\357])~s";
  $search_U_a = "~([\360])|([\200-\207])|([\210-\217])|([\220-\227])|([\230-\237])~s";

  // Ibm855
  $search_l_c = "~([\204])|([\234])|([\236])|([\240])|([\242])|([\244])|([\246])|([\250])|".
  "([\252])|([\254])|([\265])|([\267])|([\275])|([\306])|([\320])|([\322])|".
  "([\324])|([\326])|([\330])|([\340])|([\341])|([\343])|([\345])|([\347])|".
  "([\351])|([\353])|([\355])|([\361])|([\363])|([\365])|([\367])|([\371])|([\373])~s";
  $search_U_c = "~([\205])|([\235])|([\237])|([\241])|([\243])|([\245])|([\247])|([\251])|".
  "([\253])|([\255])|([\266])|([\270])|([\276])|([\307])|([\321])|([\323])|".
  "([\325])|([\327])|([\335])|([\336])|([\342])|([\344])|([\346])|([\350])|".
  "([\352])|([\354])|([\356])|([\362])|([\364])|([\366])|([\370])|([\372])|([\374])~s";

  // Utf-8
  $search_l_u = "~([\xD1\x91])|([\xD1\x80-\x8F])|([\xD0\xB0-\xBF])~s";
  $search_U_u = "~([\xD0\x81])|([\xD0\x90-\x9F])|([\xD0\xA0-\xAF])~s";

  if ( preg_match_all ($search_l_w, $content, $arr, PREG_PATTERN_ORDER)) { $charsets['w'] += count ($arr[0]) * 3; }
  if ( preg_match_all ($search_U_w, $content, $arr, PREG_PATTERN_ORDER)){ $charsets['w'] += count ($arr[0]); }

  if ( preg_match_all ($search_l_k, $content, $arr, PREG_PATTERN_ORDER)) { $charsets['k'] += count ($arr[0]) * 3; }
  if ( preg_match_all ($search_U_k, $content, $arr, PREG_PATTERN_ORDER)){ $charsets['k'] += count ($arr[0]); }

  if ( preg_match_all ($search_l_i, $content, $arr, PREG_PATTERN_ORDER)) { $charsets['i'] += count ($arr[0]) * 3; }
  if ( preg_match_all ($search_U_i, $content, $arr, PREG_PATTERN_ORDER)){ $charsets['i'] += count ($arr[0]); }

  if ( preg_match_all ($search_l_m, $content, $arr, PREG_PATTERN_ORDER)) { $charsets['m'] += count ($arr[0]) * 3; }
  if ( preg_match_all ($search_U_m, $content, $arr, PREG_PATTERN_ORDER)){ $charsets['m'] += count ($arr[0]); }

  if ( preg_match_all ($search_l_a, $content, $arr, PREG_PATTERN_ORDER)) { $charsets['a'] += count ($arr[0]) * 3; }
  if ( preg_match_all ($search_U_a, $content, $arr, PREG_PATTERN_ORDER)){ $charsets['a'] += count ($arr[0]); }

  if ( preg_match_all ($search_l_c, $content, $arr, PREG_PATTERN_ORDER)) { $charsets['c'] += count ($arr[0]) * 3; }
  if ( preg_match_all ($search_U_c, $content, $arr, PREG_PATTERN_ORDER)){ $charsets['c'] += count ($arr[0]); }

  if ( preg_match_all ($search_l_u, $content, $arr, PREG_PATTERN_ORDER)) { $charsets['u'] += count ($arr[0]) * 3; }
  if ( preg_match_all ($search_U_u, $content, $arr, PREG_PATTERN_ORDER)){ $charsets['u'] += count ($arr[0]); }

  arsort ($charsets);
  $key = key($charsets);
  if ( max ($charsets)==0 ){ return 'unknown'; }
  elseif ( $key == 'w' ){ return 'CP1251'; }
  elseif ( $key == 'k' ){ return 'KOI8-R'; } 
  elseif ( $key == 'i' ){ return 'ISO-8859-5'; } //ISO
  elseif ( $key == 'm' ){ return 'CP10007'; } //MAC
  elseif ( $key == 'a' ){ return 'CP866';} //IBM866
  elseif ( $key == 'c' ){ return 'CP855';} //IBM855 
  elseif ( $key == 'u' ){ return 'UTF-8'; } 

  return 'unknown';
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