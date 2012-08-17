<?php

  class Settings {
    //Кореневой каталог, относительно которого будет проводиться обзор файлов, за его пределы выйти нельзя
    var $root_path = "./..";
    //Путь к Iris CRM, если он отличен от $root_path. Пример: "/var/www/iriscrm".
    var $iriscrm_path = null;

    //Способ логина (Iris или пусто)
    var $logintype = "";
    //var $logintype = "Iris";

    //Кодировка имён файлов в фаловой системе
    var $filename_encoding = "UTF-8";
    //Кодировка имён файлов в zip архивах
    var $filename_encoding_zip = "CP866";
    //Кодировка содержимого файлов по умолчанию (когда не удаётся определить автоматически)
    var $default_encoding = "UTF-8";

    //Язык
    var $language = "ru";

    //Список файлов и каталогов для игнорирования
    var $ignore = array(
      "wedit",
    );
    
    function __construct()
    {
      if ($this->iriscrm_path == null) {
        $this->iriscrm_path = $this->root_path;
      }
    }
  };
  
  $settings = new Settings;
?>