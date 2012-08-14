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

?>