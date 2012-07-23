<?php

$lang = array(
  'en' => array(
    'Loaded' => 'Loaded',
    'Loading' => 'Loading',
    'Upload' => 'Upload',
    'Download' => 'Download',
    'Create' => 'Create',
    'Change' => 'Change',
    'Delete' => 'Delete',
    'Rename' => 'Rename',
    'Save' => 'Save',
    'Saving' => 'Saving',
    'Name' => 'Name',
    'Type' => 'Type',
    'Directory' => 'Directory',
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
  ),
  'ru' => array(
    'Loaded' => 'Загружен',
    'Loading' => 'Загрузка',
    'Upload' => 'Загрузить',
    'Download' => 'Скачать',
    'Create' => 'Создать',
    'Change' => 'Изменить',
    'Delete' => 'Удалить',
    'Rename' => 'Переименовать',
    'Save' => 'Сохранить',
    'Saving' => 'Сохранение',
    'Name' => 'Название',
    'Type' => 'Тип',
    'Directory' => 'Каталог',
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
    'You must select only one file for this operation' => 'Для этой операции необходимо выбрать ровно 1 файл',
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