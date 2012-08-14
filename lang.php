<?php

$lang = array(
  'en' => array(
    'Loaded' => 'Loaded',
    'Loading' => 'Loading',
    'Upload' => 'Upload',
    'Download' => 'Download',
    'Create' => 'Create',
    'Copy' => 'Copy',
    'Change' => 'Rename',
    'Delete' => 'Delete',
    'Rename' => 'Rename',
    'Save' => 'Save',
    'Saving' => 'Saving',
    'Name' => 'Name',
    'Type' => 'Type',
    'Directory' => 'Directory',
    'File' => 'File',
    'Access' => 'Access',
    'Ext' => 'Ext',
    'Size' => 'Size',
    'Change date' => 'Change date',
    'Saved' => 'Saved',
    'Error' => 'Error',
    'Reload' => 'Reload',
    'Can\'t open the settion' => 'Can\'t open the settion',
    'Don\'t authorised in Iris CRM' => 'Don\'t authorised in Iris CRM',
    'Authorise' => 'Authorise',
    'Unknown login type' => 'Unknown login type',
    'You must be authorised like admin' => 'You must be authorised like admin',
    'System message' => 'System message',
    'Cancel' => 'Cancel',
    'You must select only one file for this operation' => 'You must select only one file for this operation',
    'You must select one or more files for this operation' => 'You must select one or more files for this operation',
    'Do you really want to delete next files' => 'Do you really want to delete next files',
    'Select files for upload' => 'Select files for upload',
    'File already exists' => 'File already exists',
    'Copy error' => 'Copy error',
    'Files loaded' => 'Files loaded',
    'from' => 'from',
    'Files not selected for upload' => 'Files not selected for upload',
    'Reloading' => 'Reloading',
    'Changed' => 'Changed',
    'Copy files or catalogs' => 'Copy files or catalogs',
    'Specify a name for the copy, relative to the current catalog' => 
      'Specify a name for the copy, relative to the current catalog',
    'Specify a catalog name to copy the selected items' => 
      'Specify a catalog name to copy the selected items',
  ),
  'ru' => array(
    'Loaded' => 'Загружен',
    'Loading' => 'Загрузка',
    'Upload' => 'Загрузить',
    'Download' => 'Скачать',
    'Create' => 'Создать',
    'Copy' => 'Копировать',
    'Change' => 'Переименовать',
    'Delete' => 'Удалить',
    'Rename' => 'Переименовать',
    'Save' => 'Сохранить',
    'Saving' => 'Сохранение',
    'Name' => 'Название',
    'Type' => 'Тип',
    'Directory' => 'Каталог',
    'File' => 'Файл',
    'Access' => 'Доступ',
    'Ext' => 'Доп',
    'Size' => 'Размер',
    'Change date' => 'Изменён',
    'Saved' => 'Сохранён',
    'Error' => 'Ошибка',
    'Reload' => 'Перечитать',
    'Can\'t open the settion' => 'Невозможно открыть сессию',
    'Don\'t authorised in Iris CRM' => 'Необходимо авторизоваться в Iris CRM.',
    'Authorise' => 'Авторизоваться',
    'Unknown login type' => 'Неизвестный способ логина',
    'You must be authorised like admin' => 'Вы должны быть авторизованы под учётной записью администратора Iris CRM',
    'System message' => 'Системное сообщение',
    'Cancel' => 'Отмена',
    'You must select only one file for this operation' => 'Для этой операции необходимо выбрать ровно один файл',
    'You must select one or more files for this operation' => 'Для этой операции необходимо выбрать хотя бы один файл',
    'Do you really want to delete next files' => 'Вы действительно желаете удалить следующие файлы',
    'Select files for upload' => 'Выберите файлы для загрузки',
    'File already exists' => 'Файл с таким именем уже существует',
    'Copy error' => 'Ошибка копирования',
    'Files loaded' => 'Загружено файлов',
    'from' => 'из',
    'Files not selected for upload' => 'Не выбраны файлы для загрузки',
    'Reloading' => 'Повторное открытие',
    'Changed' => 'Изменено',
    'Copy files or catalogs' => 'Копировать файлы или каталоги',
    'Specify a name for the copy, relative to the current catalog' => 
      'Укажите название для копирования (относительно текущего каталога)',
    'Specify a catalog name to copy the selected items' => 
      'Укажите название каталога для копирования выбранных элементов (относительно текущего каталога)',
  ),
);

require_once('settings.php');

//Перевод
function t($name)
{
  global $lang;
  global $settings;
  $res = $lang[$settings->language][$name];
  return $res ? $res : $name;
}



?>