<?php

  class Settings {
    //Кореневой каталог, относительно которого будет проводиться обзор файлов, за его пределы выйти нельзя
    var $root_path = "./..";

    //Способ логина (Iris или пусто)
    var $logintype = "";
//    var $logintype = "Iris";

    //Кодировка имён файлов в фаловой системе
    var $filename_encoding = "cp1251";
    var $filename_encoding_zip = "cp866";

    //Язык
    var $language = "ru";

    //Список файлов и каталогов для игнорирования
    var $ignore = array(
      "wedit",
    );
  };
  
  $settings = new Settings;
?>