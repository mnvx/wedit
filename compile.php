<?php

/*
  Компилирование в один файл - в подкаталог wedit

  Список файлов для компоновки
  + html.html - грузкм в переменную $html_html
  + list.html - грузкм в переменную $list_html
  + edit.html - грузкм в переменную $edit_html
  + info.html - грузкм в переменную $info_html

  ! jquery-1.8.0.min.js - встроить в html.html вместо <script src="jquery-1.8.0.min.js"></script>
  + style.css - встроить в html.html вместо <link rel="stylesheet" type="text/css" href="style.css">

  + json_lib.php
  + settings.php - помещаем в самый вверх, чтобы проще было найти настройки
  + lang.php
  + common.php
  + index.php
  + file.php
  + compile.php - не трогаем

  + favicon.png - в base64 вместо favicon.png

  --
  
  + README.md - не трогаем
  + license.txt - не трогаем
  + compile.php - не трогаем
*/

echo <<<EOD
<!DOCTYPE html>
<html lang="ru-RU">
<head>
<title>Iris Webfile Editor</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="SHORTCUT ICON" href="favicon.png" type="image/png">
</head>
<body>
EOD;
echo '<p>Данная утилита предназначена для запаковки wedit в 1 файл (для упрощения установки на сервере).</p>';
echo '<p>Запуск запаковки...</p>';

mkdir('wedit');
copy('jquery-1.8.0.min.js', 'wedit/jquery-1.8.0.min.js');

$content = '';



//html.html
$html_html = file_get_contents('html.html');
$html_html = str_replace('file.php', 'wedit.php', $html_html);
$html_html = str_replace('filename: filename', 'filename: filename, editor: 1', $html_html);
$html_html = str_replace('favicon.png', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAACQkWg2AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAGqSURBVDhPlVJLLwNRFJ7fZ+EfWBAkNhKCICQkVGIhwc5CJGJFSePRNop4RbyJRytVaZHqYzrtPO7Mnbnz8N1OSdn15C7OPed85zvfuVfwGjShwXrvD8B1PZcbb1J1apefGI8LnutpxHxMfCkaRcJxHb/4l7keWQV4XvpDam5dSqQKyFnMtm0Hp1jSRqejpTJBkDHH+Wkh4C5KpK13NZuT6/UQQiMHLwa16tlqDGjT3reWL6pENy/u3uPJfCj6pBH6EM8SYqLo8v5jOxY/vUo7jsNHkqoAzIAiOAsr58vBm7yodA4EZdXYO0lOzO69ZUqRg4RBGQeUK3pHfxAMaNA7vilVCIKWxQYDO5SylfWbkemoP+0fhoKoQvHwVAQAiKYmAGFR0iqy0T0aCszvKyr9r4ExeygQ9hmoaQOQKyjwMcnMwlHP2CYegG/pVzQac4bqKk2LYZJckQN86+hfw3MJeKHMp9TUsphKiyhC1O+KBXQNriO1EXlMZcSL2/fJuX2iWxxQkfXDs1RZ1qHh7DqtqAYYDMOCD1jitbC1+xw7TuIr1DQ09P8a/q3fwjW7uVVwdkMAAAAASUVORK5CYII=', $html_html);

//jquery
//$jquery = file_get_contents('jquery-1.8.0.js');
//$html_html = str_replace('<script src="jquery-1.7.2.min.js"></script>', 
//  '<script type="text/javascript" language="javascript">'.$jquery.'</script>', $html_html);

//style.css
$style = file_get_contents('style.css');
$html_html = str_replace('<link rel="stylesheet" type="text/css" href="style.css">', 
  '<style type="text/css">'.$style.'</style>', $html_html);

$content .= line().line('/*************************** html.html ***************************/');
$content .= line('$html = <<<EOD').line($html_html).line('EOD;');


//list.html
$list_html = file_get_contents('list.html');
$content .= line().line('/*************************** list.html ***************************/');
$content .= line('$html_list = <<<EOD').line($list_html).line('EOD;');


//edit.html
$edit_html = file_get_contents('edit.html');
$edit_html = str_replace('filename: filename', 'filename: filename, editor: 1', $edit_html);
$edit_html = str_replace('file.php', 'wedit.php', $edit_html);
$content .= line().line('/*************************** edit.html ***************************/');
$content .= line('$html_edit = <<<EOD').line($edit_html).line('EOD;');


//info.html
$info_html = file_get_contents('info.html');
$content .= line().line('/*************************** info.html ***************************/');
$content .= line('$html_msg = <<<EOD').line($info_html).line('EOD;');


//json_lib.php
$json_php = file_get_contents('json_lib.php');
$json_php = str_replace('<?php', '', $json_php);
$json_php = str_replace('?>', '', $json_php);
$content .= line().line('/*************************** json_lib.php ***************************/');
$content .= line($json_php);


//settings.php
$settings_php = file_get_contents('settings.php');
$settings_php = str_replace('<?php', '', $settings_php);
$settings_php = str_replace('?>', '', $settings_php);
$content = line('/*************************** settings.php ***************************/').line($settings_php).$content;


//lang.php
$lang_php = file_get_contents('lang.php');
$lang_php = str_replace('<?php', '', $lang_php);
$lang_php = str_replace('?>', '', $lang_php);
$lang_php = str_replace('require_once(\'settings.php\');', '', $lang_php);
$content .= line().line('/*************************** lang.php ***************************/');
$content .= line($lang_php);


//common.php
$common_php = file_get_contents('common.php');
$common_php = str_replace('<?php', '', $common_php);
$common_php = str_replace('?>', '', $common_php);
$common_php = str_replace('require_once(\'settings.php\');', '', $common_php);
$content .= line().line('/*************************** common.php ***************************/');
$content .= line($common_php);


//index.php
$index_php = file_get_contents('index.php');
$index_php = str_replace('<?php', '', $index_php);
$index_php = str_replace('?>', '', $index_php);
$index_php = str_replace('include_once(\'json_lib.php\');', '', $index_php);
$index_php = str_replace('require_once(\'settings.php\');', '', $index_php);
$index_php = str_replace('require_once(\'lang.php\');', '', $index_php);
$index_php = str_replace('include_once(\'common.php\');', '', $index_php);
$index_php = str_replace('$html = file_get_contents(\'html.html\');', '', $index_php);
$index_php = str_replace('$html_list = file_get_contents(\'list.html\');', '', $index_php);
$index_php = str_replace('$html_edit = file_get_contents(\'edit.html\');', '', $index_php);
$index_php = str_replace('$html_msg = file_get_contents(\'info.html\');', '', $index_php);

//file.php
$file_php = file_get_contents('file.php');
$file_php = str_replace('<?php', '', $file_php);
$file_php = str_replace('?>', '', $file_php);
$file_php = str_replace('include_once(\'json_lib.php\');', '', $file_php);
$file_php = str_replace('include_once(\'settings.php\');', '', $file_php);
$file_php = str_replace('include_once(\'lang.php\');', '', $file_php);
$file_php = str_replace('include_once(\'common.php\');', '', $file_php);

$content .= line('if ($_POST[\'editor\'] != 1) {');
$content .= line().line('/*************************** index.php ***************************/');
$content .= line($index_php);
$content .= line('} else {');
$content .= line().line('/*************************** file.php ***************************/');
$content .= line($file_php);
$content .= line('}');


$content = line('<?php').$content.'?>';

file_put_contents('wedit/wedit.php', $content);

echo '<p>Запаковка завершена!</p>';
echo '<hr/>';
echo '<p>Теперь в каталоге <a href="wedit/wedit.php">wedit</a> находятся запакованныве файлы, которые можно установить на сервер.</p>';
echo <<<EOD
</body>
</html>
EOD;

//Добавить строку в файл
function line($line)
{
  return $line."\n\r";
}

?>