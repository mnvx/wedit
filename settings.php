<?php

  class Settings {
    //Кореневой каталог, относительно которого будет проводиться обзор файлов, за его пределы выйти нельзя
    var $root_path = "./..";

    //Способ логина (Iris или пусто)
    var $logintype = "";
//    var $logintype = "Iris";

    //Кодировка имён файлов в фаловой системе
    var $filename_encoding = "CP1251";
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
  };
  
  $settings = new Settings;
?>