<?php
/*************************** settings.php ***************************/


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


/*************************** html.html ***************************/
$html = <<<EOD
<!DOCTYPE html>
<html lang="ru-RU">

<head>
<title>Iris Webfile Editor</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="SHORTCUT ICON" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAIAAACQkWg2AAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsMAAA7DAcdvqGQAAAGqSURBVDhPlVJLLwNRFJ7fZ+EfWBAkNhKCICQkVGIhwc5CJGJFSePRNop4RbyJRytVaZHqYzrtPO7Mnbnz8N1OSdn15C7OPed85zvfuVfwGjShwXrvD8B1PZcbb1J1apefGI8LnutpxHxMfCkaRcJxHb/4l7keWQV4XvpDam5dSqQKyFnMtm0Hp1jSRqejpTJBkDHH+Wkh4C5KpK13NZuT6/UQQiMHLwa16tlqDGjT3reWL6pENy/u3uPJfCj6pBH6EM8SYqLo8v5jOxY/vUo7jsNHkqoAzIAiOAsr58vBm7yodA4EZdXYO0lOzO69ZUqRg4RBGQeUK3pHfxAMaNA7vilVCIKWxQYDO5SylfWbkemoP+0fhoKoQvHwVAQAiKYmAGFR0iqy0T0aCszvKyr9r4ExeygQ9hmoaQOQKyjwMcnMwlHP2CYegG/pVzQac4bqKk2LYZJckQN86+hfw3MJeKHMp9TUsphKiyhC1O+KBXQNriO1EXlMZcSL2/fJuX2iWxxQkfXDs1RZ1qHh7DqtqAYYDMOCD1jitbC1+xw7TuIr1DQ09P8a/q3fwjW7uVVwdkMAAAAASUVORK5CYII=" type="image/png">
<style type="text/css">/* light */

body {
  color: #444;
  font: 13px/1.5em Verdana, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #ddd;
}

input {
  font: 13px/1.5em Verdana, sans-serif;
  margin: 0px;
  padding-left: 5px;
}

textarea {
  width: 100%;
  height: 300px;
  margin: 0;
  background-color: #fff;
}

.textchanged, .texterror {
  color: #c44;
  font-weight: bold;
}
.textsaved {
  color: #4a4;
}

table {
	border-collapse: collapse;
}

table#files tbody tr:hover {
  background-color: #eee;
}

th {
  padding: 5px 6px;
  margin: 0;
  text-align: left;
  font-weight: normal;
  border-bottom: 1px solid #ddd;
}

td {
  padding: 2px 6px;
  margin: 0;
}

a {
  color: #444;
}

h1 {
  font-weight: normal;
  font-size: 20px;
  padding: 0;
  margin: 0;
}

h2 {
  font-weight: normal;
}

#address, #buttons, #status, #dialog {
  padding: 7px 5px;
  background-color: #ddd;
}

#filelist {
  background-color: #fff;
}

#text {
  padding: 7px 5px;
  padding: 0;
  margin: 5px 10px 0px 5px;
}

.field, textarea {
  border: 1px solid #dd;
}

.number {
  text-align: right;
  white-space: nowrap;
}

.arrow {
  text-decoration: none;
}

/* dark */
</style>
<script src="jquery-1.8.0.min.js"></script>

<script type="text/javascript" language="javascript">
function onload()
{
  //Если редактируем файл, то загрузим его с сервера
  var filename = $('#filename').val();
  if (filename != '' && filename != null) {
    $.ajax({
      type: "POST",
      url: "wedit.php",
      data: { 
        operation: "load",
        filename: filename, editor: 1
      }
    }).done(function(msg) {
      var result = jQuery.parseJSON(msg);
      //Загрузим файл
      var content = $('#contents');
      $(content).removeAttr('disabled');
      //Отобразим содержимое
      $(content).val(result.content);
      //Обновим состояние
      $('#status').html(result.status);
      $('input#encoding').val(result.encoding);
    });
    //И установим высоту текстового редактора в полный экран
    onResize();
    $(window).bind('resize', function() {
      onResize();
    });

    $('textarea#contents').keydown(function() {
      $('#status').html('<span class="textchanged">'+t('Changed')+'</span>');
    });
  }
}

function t(text) 
{
  for (var i=0; i<lang.length; i++) {
    if (lang[i].phrase == text) {
      return lang[i].translate;
    }
  }
  return text;
}

function onResize() 
{ 
  $('#contents').height($(document).height() - 
    ($('#address').outerHeight(true) + $('#status').outerHeight(true) + $('#buttons').outerHeight(true)) -
    ($('#text').outerHeight(true) - $('#text').height() + 20)
  );
}

[#lang#]
</script>
</head>

<body onLoad="onload();">

[#body#]

</body>
</html>
EOD;

/*************************** list.html ***************************/
$html_list = <<<EOD
<div>[#info#]</div>
<div id="address">
<table width="100%"><tbody><tr>
<td>[#path#]</td>
<td align="right"><h1><a href="http://iris-crm.ru/wedit" title="Wedit home, about integration with Iris CRM">Wedit</a></h1></td>
</tr></tbody></table>
</div>
<div id="filelist">[#list#]</div>
<div id="buttons">
<input type="button" value="&uarr; [#Upload#]&hellip;" onclick="uploadFile();"/>
<input type="button" value="&darr; [#Download#]" onclick="downloadFile();"/>
<input type="button" value="[#Create#]&hellip;" onclick="createFile();"/>
<input type="button" value="[#Copy#]&hellip;" onclick="copyFile();"/>
<input type="button" value="[#Change#]&hellip;" onclick="changeFile();"/>
<input type="button" value="&empty; [#Delete#]&hellip;" onclick="deleteFile();"/>
</div>

<div id="dialog" style="display: none;">
<form id="dialog" method="post">
</form>
</div>

<div style="display: none;">
<form id="cancel" method="post">
</form>
<form id="download" method="post">
</form>
</div>

<script type="text/javascript" language="javascript">
//Доступность кнопок
function enableButtons(enable)
{
  if (enable) {
    $(':button').removeAttr('disabled');
  }
  else {
    $(':button').attr('disabled', 'true');
  }
}

//Доступность чекбоксов
function enableCheckbox(enable)
{
  if (enable) {
    $('input[type="checkbox"]').removeAttr('disabled');
  }
  else {
    $('input[type="checkbox"]').attr('disabled', 'true');
//    $(':checkbox[id^=f_*]').attr('disabled', 'true');
  }
}


//Создать файл
function createFile()
{
  enableButtons(false);
  enableCheckbox(false);
  $('#files').append('<tr id="files_create_row">'+
  	'<td></td>'+
  	'<td><input class="field" id="_newname" type="string" size=15 value="new.txt"/></td>'+
  	'<td><select class="field" id="_newtype"><option value="Directory">'+t('Directory')+'</option>'+
      '<option value="File" selected>'+t('File')+'</option></select></td>'+
  	'<td></td>'+
  	'<td></td>'+
  	'<td></td>'+
  	'<td><form id="create" method="post">'+
  	  '<input id="operation" name="operation" type="hidden" value="create"/>'+
  	  '<input id="newname" name="newname" type="hidden"/>'+
  	  '<input id="newtype" name="newtype" type="hidden"/>'+
  	  '<input id="newok" type="button" value="'+t('OK')+'" onclick="sendCreateFile();"/>'+
  	  '<input id="newcancel" type="button" value="'+t('Cancel')+'" onclick="cancelCreateFile();"/>'+
  	'</form></td>'+
  	'</tr>');
}

function sendCreateFile()
{
  $('#newname').val($('#_newname').val());
  $('#newtype').val($('#_newtype').val());
  $('#create').submit();
}

function cancelCreateFile()
{
  enableButtons(true);
  enableCheckbox(true);
  $('#files_create_row').remove();
}


//Изменить файл
function changeFile()
{
  if ($('input[type=checkbox]:checked').length != 1) {
    alert(t('You must select only one file for this operation'));
    return;
  }

  enableButtons(false);
  enableCheckbox(false);
  var row = $('input[type=checkbox]:checked').parent().parent();
  var old_filename = row.children('td:eq(1)').children('a').html();
  row.children('td:eq(1)').html(
    '<input class="field" type="text" id="_changename" size=15 value="'+old_filename+'"/>'
  );
  row.children('td:eq(6)').html(
    '<form id="change" method="post">'+
      '<input id="operation" name="operation" type="hidden" value="change"/>'+
      '<input id="oldname" name="oldname" type="hidden" value="'+old_filename+'"/>'+
      '<input id="changename" name="changename" type="hidden"/>'+
      '<input id="change_ok" type="button" value="'+t('OK')+'" onclick="sendChangeFile();"/>'+
      '<input id="change_cancel" type="button" value="'+t('Cancel')+'" onclick="cancelChangeFile();"/>'+
    '</form>'
  );
}

function sendChangeFile()
{
  $('#changename').val($('#_changename').val());
  $('#change').submit();
}

function cancelChangeFile()
{
  $('#cancel').submit();
}


//Удалить файл
function deleteFile()
{
  if ($('input[type=checkbox]:checked').length < 1) {
    alert(t('You must select one or more files for this operation'));
    return;
  }

  enableButtons(false);
  enableCheckbox(false);
  $('#buttons').hide();
  var row;
  var filelist = new Array();
  var filename;
  var filenames = '<h2>'+t('Do you really want to delete next files')+'?</h2>';
  filenames += '<ul>';

  $('input[type=checkbox]:checked').each(function (i, el) {
    row = $(el).parent().parent();
    filename = row.children('td:eq(1)').children('a').html();
    filenames += '<li>'+filename+'</li>';
    filelist[filelist.length] = filename;
  });
  filenames += '</ul>';
  filenames += 
    '<form id="delete" method="post">'+
      '<input id="operation" name="operation" type="hidden" value="delete"/>'+
      '<input id="filelist" name="filelist" type="hidden"/>'+
      '<input id="delete_ok" type="button" value="'+t('Delete')+'" onclick="sendDeleteFile();"/>'+
      '<input id="delete_cancel" type="button" value="'+t('Cancel')+'" onclick="cancelChangeFile();"/>'+
    '</form>';

  $('#dialog').html(filenames);
  $('input#filelist').val(JSON.stringify(filelist));
  $('#dialog').show();
}

function sendDeleteFile()
{
  $('#delete').submit();
}

function cancelDeleteFile()
{
  $('#cancel').submit();
}


//Загрузить файл
function uploadFile()
{
  enableButtons(false);
  enableCheckbox(false);
  $('#buttons').hide();
  var dialog = '<h2>'+t('Select files for upload')+'</h2>';
  dialog += 
    '<form id="upload" method="post" enctype="multipart/form-data">'+
      '<input id="operation" name="operation" type="hidden" value="upload"/>'+
      '<input id="filelist" name="file[]" type="file" multiple="true"/>'+
      '<input id="delete_ok" type="button" value="'+t('Upload')+'" onclick="sendUploadFile();"/>'+
      '<input id="delete_cancel" type="button" value="'+t('Cancel')+'" onclick="cancelUploadFile();"/>'+
    '</form>';

  $('#dialog').html(dialog);
  $('#dialog').show();
}

function sendUploadFile()
{
  $('#upload').submit();
}

function cancelUploadFile()
{
  $('#cancel').submit();
}


//Скачать файлы/каталоги
function downloadFile()
{
  var selected = $('input[type=checkbox]:checked').length;
  if (selected < 1) {
    alert(t('You must select one or more files for this operation'));
    return;
  }

  var filelist = new Array();

  $('input[type=checkbox]:checked').each(function (i, el) {
    row = $(el).parent().parent();
    filename = row.children('td:eq(1)').children('a').html();
    filelist[filelist.length] = filename;
  });

  var file = '';
  if (selected == 1) {
    file = '<input id="filename" name="filename" type="hidden" value="'+filename+'"/>';
  }

  var row = $('input[type=checkbox]:checked').parent().parent();
  var filename = row.children('td:eq(1)').children('a').html();
  $('#download').html(
    '<input id="operation" name="operation" type="hidden" value="download"/>'+
    '<input id="filelist" name="filelist" type="hidden"/>'+
    file
  );
  $('input#filelist').val(JSON.stringify(filelist));
  $('#download').submit();
}



//Копировать файл
function copyFile()
{
  var filescount = $('input[type=checkbox]:checked').length;
  if (filescount < 1) {
    alert(t('You must select one or more files for this operation'));
    return;
  }

  enableButtons(false);
  enableCheckbox(false);
  $('#buttons').hide();
  var row;
  var filelist = new Array();
  var filename;

  var filenames = '<h2>'+t('Copy files or catalogs')+'</h2>';
  filenames += '<ul>';
  $('input[type=checkbox]:checked').each(function (i, el) {
    row = $(el).parent().parent();
    filename = row.children('td:eq(1)').children('a').html();
    filenames += '<li>'+filename+'</li>';
    filelist[filelist.length] = filename;
  });
  filenames += '</ul>';

  if (filescount == 1) {
    filenames += '<p>'+t('Specify a name for the copy, relative to the current catalog')+': </p>';
  }
  else {
    filenames += '<p>'+t('Specify a catalog name to copy the selected items')+': </p>';
  }

  filenames += 
  '<form id="copy" method="post">'+
    '<input id="operation" name="operation" type="hidden" value="copy"/>'+
    '<input id="filelist" name="filelist" type="hidden"/>'+
    '<input id="copyname" name="copyname" type="text" size="60"/>'+
  '</form>'+
  '<p>'+
    '<input id="copy_ok" type="button" value="'+t('Copy')+'" onclick="sendCopyFile();"/>'+
    '<input id="copy_cancel" type="button" value="'+t('Cancel')+'" onclick="cancelCopyFile();"/>'+
  '</p>';

  $('#dialog').html(filenames);
  $('input#filelist').val(JSON.stringify(filelist));
  $('#dialog').show();
}

function sendCopyFile()
{
  $('#copy').submit();
}

function cancelCopyFile()
{
  $('#copy').submit();
}

</script>
EOD;

/*************************** edit.html ***************************/
$html_edit = <<<EOD
<div id="address">
<table width="100%"><tbody><tr>
<td>[#path#]</td>
<td align="right"><h1><a href="http://iris-crm.ru/wedit" title="Wedit home, about integration with Iris CRM">Wedit</a></h1></td>
</tr></tbody></table>
</div>
<div id="status">[#status#]</div>
<div id="text"><textarea id="contents" disabled="true"></textarea></div>

<div id="buttons">
<table id="buttons-table" width="100%"><tbody><tr><td width="33%">
<input type="button" value="[#Save#]" onclick="saveFile();"/>
</td>
<td align="center">
Кодировка: <input class="field" id="encoding" type="text" size="10" value=""/>
</td>
<td width="33%" align="right">
<input type="button" value="[#Reload#]" onclick="reloadFile();"/>
</td></tr></tbody></table>
</div>

<input id="filename" type="hidden" value="[#filename#]"/>

<script type="text/javascript" language="javascript">

//Сохранить файл
function saveFile()
{
  $('#status').html(t('Saving')+'&hellip;');
  content = $('#contents');
  content.attr('disabled', 'true');
  var filename = $('#filename').val();
  if (filename != '' && filename != null) {
    $.ajax({
      type: "POST",
      url: "wedit.php",
      data: { 
        operation: "save",
        filename: filename, editor: 1,
        filecontent: $('textarea#contents').val(),
        encoding: $('input#encoding').val()
      }
    }).done(function(msg) {
      content.removeAttr('disabled');
      var result = jQuery.parseJSON(msg);
      //Обновим состояние
      if (result.code != false) {
        $('#status').html('<span class="textsaved">' + result.status + '</span>');
      }
      else {
        $('#status').html('<span class="texterror">' + result.status + '</span>');
      }
    });
  }
}

//Перечитать файл
function reloadFile()
{
  $('#status').html(t('Reloading'));
  content = $('#contents');
  content.attr('disabled', 'true');
  var filename = $('#filename').val();
  if (filename != '' && filename != null) {
    $.ajax({
      type: "POST",
      url: "wedit.php",
      data: { 
        operation: "load",
        filename: filename, editor: 1,
        encoding: $('input#encoding').val()
      }
    }).done(function(msg) {
      content.removeAttr('disabled');
      var result = jQuery.parseJSON(msg);
      //Обновим состояние
      $('#status').html(result.status);
      $('textarea#contents').val(result.content);
    });
  }
}

</script>
EOD;

/*************************** info.html ***************************/
$html_msg = <<<EOD
<h1>[#header#]</h1>
<div>[#info#]</div>
EOD;

/*************************** json_lib.php ***************************/

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Converts to and from JSON format.
 *
 * JSON (JavaScript Object Notation) is a lightweight data-interchange
 * format. It is easy for humans to read and write. It is easy for machines
 * to parse and generate. It is based on a subset of the JavaScript
 * Programming Language, Standard ECMA-262 3rd Edition - December 1999.
 * This feature can also be found in  Python. JSON is a text format that is
 * completely language independent but uses conventions that are familiar
 * to programmers of the C-family of languages, including C, C++, C#, Java,
 * JavaScript, Perl, TCL, and many others. These properties make JSON an
 * ideal data-interchange language.
 *
 * This package provides a simple encoder and decoder for JSON notation. It
 * is intended for use with client-side Javascript applications that make
 * use of HTTPRequest to perform server communication functions - data can
 * be encoded into JSON notation for use in a client-side javascript, or
 * decoded from incoming Javascript requests. JSON format is native to
 * Javascript, and can be directly eval()'ed with no further parsing
 * overhead
 *
 * All strings should be in ASCII or UTF-8 format!
 *
 * LICENSE: Redistribution and use in source and binary forms, with or
 * without modification, are permitted provided that the following
 * conditions are met: Redistributions of source code must retain the
 * above copyright notice, this list of conditions and the following
 * disclaimer. Redistributions in binary form must reproduce the above
 * copyright notice, this list of conditions and the following disclaimer
 * in the documentation and/or other materials provided with the
 * distribution.
 *
 * THIS SOFTWARE IS PROVIDED ``AS IS'' AND ANY EXPRESS OR IMPLIED
 * WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
 * MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN
 * NO EVENT SHALL CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS
 * OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR
 * TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE
 * USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH
 * DAMAGE.
 *
 * @category
 * @package     Services_JSON
 * @author      Michal Migurski <mike-json@teczno.com>
 * @author      Matt Knapp <mdknapp[at]gmail[dot]com>
 * @author      Brett Stimmerman <brettstimmerman[at]gmail[dot]com>
 * @copyright   2005 Michal Migurski
 * @version     CVS: $Id: JSON.php,v 1.31 2006/06/28 05:54:17 migurski Exp $
 * @license     http://www.opensource.org/licenses/bsd-license.php
 * @link        http://pear.php.net/pepr/pepr-proposal-show.php?id=198
 */

/**
 * Marker constant for Services_JSON::decode(), used to flag stack state
 */
define('SERVICES_JSON_SLICE',   1);

/**
 * Marker constant for Services_JSON::decode(), used to flag stack state
 */
define('SERVICES_JSON_IN_STR',  2);

/**
 * Marker constant for Services_JSON::decode(), used to flag stack state
 */
define('SERVICES_JSON_IN_ARR',  3);

/**
 * Marker constant for Services_JSON::decode(), used to flag stack state
 */
define('SERVICES_JSON_IN_OBJ',  4);

/**
 * Marker constant for Services_JSON::decode(), used to flag stack state
 */
define('SERVICES_JSON_IN_CMT', 5);

/**
 * Behavior switch for Services_JSON::decode()
 */
define('SERVICES_JSON_LOOSE_TYPE', 16);

/**
 * Behavior switch for Services_JSON::decode()
 */
define('SERVICES_JSON_SUPPRESS_ERRORS', 32);

/**
 * Converts to and from JSON format.
 *
 * Brief example of use:
 *
 * <code>
 * // create a new instance of Services_JSON
 * $json = new Services_JSON();
 *
 * // convert a complexe value to JSON notation, and send it to the browser
 * $value = array('foo', 'bar', array(1, 2, 'baz'), array(3, array(4)));
 * $output = $json->encode($value);
 *
 * print($output);
 * // prints: ["foo","bar",[1,2,"baz"],[3,[4]]]
 *
 * // accept incoming POST data, assumed to be in JSON notation
 * $input = file_get_contents('php://input', 1000000);
 * $value = $json->decode($input);
 * </code>
 */
class Services_JSON
{
   /**
    * constructs a new JSON instance
    *
    * @param    int     $use    object behavior flags; combine with boolean-OR
    *
    *                           possible values:
    *                           - SERVICES_JSON_LOOSE_TYPE:  loose typing.
    *                                   "{...}" syntax creates associative arrays
    *                                   instead of objects in decode().
    *                           - SERVICES_JSON_SUPPRESS_ERRORS:  error suppression.
    *                                   Values which can't be encoded (e.g. resources)
    *                                   appear as NULL instead of throwing errors.
    *                                   By default, a deeply-nested resource will
    *                                   bubble up with an error, so all return values
    *                                   from encode() should be checked with isError()
    */
    function Services_JSON($use = 0)
    {
        $this->use = $use;
    }

   /**
    * convert a string from one UTF-16 char to one UTF-8 char
    *
    * Normally should be handled by mb_convert_encoding, but
    * provides a slower PHP-only method for installations
    * that lack the multibye string extension.
    *
    * @param    string  $utf16  UTF-16 character
    * @return   string  UTF-8 character
    * @access   private
    */
    function utf162utf8($utf16)
    {
        // oh please oh please oh please oh please oh please
        if(function_exists('mb_convert_encoding')) {
            return mb_convert_encoding($utf16, 'UTF-8', 'UTF-16');
        }

        $bytes = (ord($utf16{0}) << 8) | ord($utf16{1});

        switch(true) {
            case ((0x7F & $bytes) == $bytes):
                // this case should never be reached, because we are in ASCII range
                // see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                return chr(0x7F & $bytes);

            case (0x07FF & $bytes) == $bytes:
                // return a 2-byte UTF-8 character
                // see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                return chr(0xC0 | (($bytes >> 6) & 0x1F))
                     . chr(0x80 | ($bytes & 0x3F));

            case (0xFFFF & $bytes) == $bytes:
                // return a 3-byte UTF-8 character
                // see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                return chr(0xE0 | (($bytes >> 12) & 0x0F))
                     . chr(0x80 | (($bytes >> 6) & 0x3F))
                     . chr(0x80 | ($bytes & 0x3F));
        }

        // ignoring UTF-32 for now, sorry
        return '';
    }

   /**
    * convert a string from one UTF-8 char to one UTF-16 char
    *
    * Normally should be handled by mb_convert_encoding, but
    * provides a slower PHP-only method for installations
    * that lack the multibye string extension.
    *
    * @param    string  $utf8   UTF-8 character
    * @return   string  UTF-16 character
    * @access   private
    */
    function utf82utf16($utf8)
    {
        // oh please oh please oh please oh please oh please
        if(function_exists('mb_convert_encoding')) {
            return mb_convert_encoding($utf8, 'UTF-16', 'UTF-8');
        }

        switch(strlen($utf8)) {
            case 1:
                // this case should never be reached, because we are in ASCII range
                // see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                return $utf8;

            case 2:
                // return a UTF-16 character from a 2-byte UTF-8 char
                // see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                return chr(0x07 & (ord($utf8{0}) >> 2))
                     . chr((0xC0 & (ord($utf8{0}) << 6))
                         | (0x3F & ord($utf8{1})));

            case 3:
                // return a UTF-16 character from a 3-byte UTF-8 char
                // see: http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                return chr((0xF0 & (ord($utf8{0}) << 4))
                         | (0x0F & (ord($utf8{1}) >> 2)))
                     . chr((0xC0 & (ord($utf8{1}) << 6))
                         | (0x7F & ord($utf8{2})));
        }

        // ignoring UTF-32 for now, sorry
        return '';
    }

   /**
    * encodes an arbitrary variable into JSON format
    *
    * @param    mixed   $var    any number, boolean, string, array, or object to be encoded.
    *                           see argument 1 to Services_JSON() above for array-parsing behavior.
    *                           if var is a strng, note that encode() always expects it
    *                           to be in ASCII or UTF-8 format!
    *
    * @return   mixed   JSON string representation of input var or an error if a problem occurs
    * @access   public
    */
    function encode($var)
    {
        switch (gettype($var)) {
            case 'boolean':
                return $var ? 'true' : 'false';

            case 'NULL':
                return 'null';

            case 'integer':
                return (int) $var;

            case 'double':
            case 'float':
                return (float) $var;

            case 'string':
                // STRINGS ARE EXPECTED TO BE IN ASCII OR UTF-8 FORMAT
                $ascii = '';
                $strlen_var = strlen($var);

               /*
                * Iterate over every character in the string,
                * escaping with a slash or encoding to UTF-8 where necessary
                */
                for ($c = 0; $c < $strlen_var; ++$c) {

                    $ord_var_c = ord($var{$c});

                    switch (true) {
                        case $ord_var_c == 0x08:
                            $ascii .= '\b';
                            break;
                        case $ord_var_c == 0x09:
                            $ascii .= '\t';
                            break;
                        case $ord_var_c == 0x0A:
                            $ascii .= '\n';
                            break;
                        case $ord_var_c == 0x0C:
                            $ascii .= '\f';
                            break;
                        case $ord_var_c == 0x0D:
                            $ascii .= '\r';
                            break;

                        case $ord_var_c == 0x22:
                        case $ord_var_c == 0x2F:
                        case $ord_var_c == 0x5C:
                            // double quote, slash, slosh
                            $ascii .= '\\'.$var{$c};
                            break;

                        case (($ord_var_c >= 0x20) && ($ord_var_c <= 0x7F)):
                            // characters U-00000000 - U-0000007F (same as ASCII)
                            $ascii .= $var{$c};
                            break;

                        case (($ord_var_c & 0xE0) == 0xC0):
                            // characters U-00000080 - U-000007FF, mask 110XXXXX
                            // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                            $char = pack('C*', $ord_var_c, ord($var{$c + 1}));
                            $c += 1;
                            $utf16 = $this->utf82utf16($char);
                            $ascii .= sprintf('\u%04s', bin2hex($utf16));
                            break;

                        case (($ord_var_c & 0xF0) == 0xE0):
                            // characters U-00000800 - U-0000FFFF, mask 1110XXXX
                            // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                            $char = pack('C*', $ord_var_c,
                                         ord($var{$c + 1}),
                                         ord($var{$c + 2}));
                            $c += 2;
                            $utf16 = $this->utf82utf16($char);
                            $ascii .= sprintf('\u%04s', bin2hex($utf16));
                            break;

                        case (($ord_var_c & 0xF8) == 0xF0):
                            // characters U-00010000 - U-001FFFFF, mask 11110XXX
                            // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                            $char = pack('C*', $ord_var_c,
                                         ord($var{$c + 1}),
                                         ord($var{$c + 2}),
                                         ord($var{$c + 3}));
                            $c += 3;
                            $utf16 = $this->utf82utf16($char);
                            $ascii .= sprintf('\u%04s', bin2hex($utf16));
                            break;

                        case (($ord_var_c & 0xFC) == 0xF8):
                            // characters U-00200000 - U-03FFFFFF, mask 111110XX
                            // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                            $char = pack('C*', $ord_var_c,
                                         ord($var{$c + 1}),
                                         ord($var{$c + 2}),
                                         ord($var{$c + 3}),
                                         ord($var{$c + 4}));
                            $c += 4;
                            $utf16 = $this->utf82utf16($char);
                            $ascii .= sprintf('\u%04s', bin2hex($utf16));
                            break;

                        case (($ord_var_c & 0xFE) == 0xFC):
                            // characters U-04000000 - U-7FFFFFFF, mask 1111110X
                            // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                            $char = pack('C*', $ord_var_c,
                                         ord($var{$c + 1}),
                                         ord($var{$c + 2}),
                                         ord($var{$c + 3}),
                                         ord($var{$c + 4}),
                                         ord($var{$c + 5}));
                            $c += 5;
                            $utf16 = $this->utf82utf16($char);
                            $ascii .= sprintf('\u%04s', bin2hex($utf16));
                            break;
                    }
                }

                return '"'.$ascii.'"';

            case 'array':
               /*
                * As per JSON spec if any array key is not an integer
                * we must treat the the whole array as an object. We
                * also try to catch a sparsely populated associative
                * array with numeric keys here because some JS engines
                * will create an array with empty indexes up to
                * max_index which can cause memory issues and because
                * the keys, which may be relevant, will be remapped
                * otherwise.
                *
                * As per the ECMA and JSON specification an object may
                * have any string as a property. Unfortunately due to
                * a hole in the ECMA specification if the key is a
                * ECMA reserved word or starts with a digit the
                * parameter is only accessible using ECMAScript's
                * bracket notation.
                */

                // treat as a JSON object
                if (is_array($var) && count($var) && (array_keys($var) !== range(0, sizeof($var) - 1))) {
                    $properties = array_map(array($this, 'name_value'),
                                            array_keys($var),
                                            array_values($var));

                    foreach($properties as $property) {
                        if(Services_JSON::isError($property)) {
                            return $property;
                        }
                    }

                    return '{' . join(',', $properties) . '}';
                }

                // treat it like a regular array
                $elements = array_map(array($this, 'encode'), $var);

                foreach($elements as $element) {
                    if(Services_JSON::isError($element)) {
                        return $element;
                    }
                }

                return '[' . join(',', $elements) . ']';

            case 'object':
                $vars = get_object_vars($var);

                $properties = array_map(array($this, 'name_value'),
                                        array_keys($vars),
                                        array_values($vars));

                foreach($properties as $property) {
                    if(Services_JSON::isError($property)) {
                        return $property;
                    }
                }

                return '{' . join(',', $properties) . '}';

            default:
                return ($this->use & SERVICES_JSON_SUPPRESS_ERRORS)
                    ? 'null'
                    : new Services_JSON_Error(gettype($var)." can not be encoded as JSON string");
        }
    }

   /**
    * array-walking function for use in generating JSON-formatted name-value pairs
    *
    * @param    string  $name   name of key to use
    * @param    mixed   $value  reference to an array element to be encoded
    *
    * @return   string  JSON-formatted name-value pair, like '"name":value'
    * @access   private
    */
    function name_value($name, $value)
    {
        $encoded_value = $this->encode($value);

        if(Services_JSON::isError($encoded_value)) {
            return $encoded_value;
        }

        return $this->encode(strval($name)) . ':' . $encoded_value;
    }

   /**
    * reduce a string by removing leading and trailing comments and whitespace
    *
    * @param    $str    string      string value to strip of comments and whitespace
    *
    * @return   string  string value stripped of comments and whitespace
    * @access   private
    */
    function reduce_string($str)
    {
        $str = preg_replace(array(

                // eliminate single line comments in '// ...' form
                '#^\s*//(.+)$#m',

                // eliminate multi-line comments in '/* ... */' form, at start of string
                '#^\s*/\*(.+)\*/#Us',

                // eliminate multi-line comments in '/* ... */' form, at end of string
                '#/\*(.+)\*/\s*$#Us'

            ), '', $str);

        // eliminate extraneous space
        return trim($str);
    }

   /**
    * decodes a JSON string into appropriate variable
    *
    * @param    string  $str    JSON-formatted string
    *
    * @return   mixed   number, boolean, string, array, or object
    *                   corresponding to given JSON input string.
    *                   See argument 1 to Services_JSON() above for object-output behavior.
    *                   Note that decode() always returns strings
    *                   in ASCII or UTF-8 format!
    * @access   public
    */
    function decode($str)
    {
        $str = $this->reduce_string($str);

        switch (strtolower($str)) {
            case 'true':
                return true;

            case 'false':
                return false;

            case 'null':
                return null;

            default:
                $m = array();

                if (is_numeric($str)) {
                    // Lookie-loo, it's a number

                    // This would work on its own, but I'm trying to be
                    // good about returning integers where appropriate:
                    // return (float)$str;

                    // Return float or int, as appropriate
                    return ((float)$str == (integer)$str)
                        ? (integer)$str
                        : (float)$str;

                } elseif (preg_match('/^("|\').*(\1)$/s', $str, $m) && $m[1] == $m[2]) {
                    // STRINGS RETURNED IN UTF-8 FORMAT
                    $delim = substr($str, 0, 1);
                    $chrs = substr($str, 1, -1);
                    $utf8 = '';
                    $strlen_chrs = strlen($chrs);

                    for ($c = 0; $c < $strlen_chrs; ++$c) {

                        $substr_chrs_c_2 = substr($chrs, $c, 2);
                        $ord_chrs_c = ord($chrs{$c});

                        switch (true) {
                            case $substr_chrs_c_2 == '\b':
                                $utf8 .= chr(0x08);
                                ++$c;
                                break;
                            case $substr_chrs_c_2 == '\t':
                                $utf8 .= chr(0x09);
                                ++$c;
                                break;
                            case $substr_chrs_c_2 == '\n':
                                $utf8 .= chr(0x0A);
                                ++$c;
                                break;
                            case $substr_chrs_c_2 == '\f':
                                $utf8 .= chr(0x0C);
                                ++$c;
                                break;
                            case $substr_chrs_c_2 == '\r':
                                $utf8 .= chr(0x0D);
                                ++$c;
                                break;

                            case $substr_chrs_c_2 == '\\"':
                            case $substr_chrs_c_2 == '\\\'':
                            case $substr_chrs_c_2 == '\\\\':
                            case $substr_chrs_c_2 == '\\/':
                                if (($delim == '"' && $substr_chrs_c_2 != '\\\'') ||
                                   ($delim == "'" && $substr_chrs_c_2 != '\\"')) {
                                    $utf8 .= $chrs{++$c};
                                }
                                break;

                            case preg_match('/\\\u[0-9A-F]{4}/i', substr($chrs, $c, 6)):
                                // single, escaped unicode character
                                $utf16 = chr(hexdec(substr($chrs, ($c + 2), 2)))
                                       . chr(hexdec(substr($chrs, ($c + 4), 2)));
                                $utf8 .= $this->utf162utf8($utf16);
                                $c += 5;
                                break;

                            case ($ord_chrs_c >= 0x20) && ($ord_chrs_c <= 0x7F):
                                $utf8 .= $chrs{$c};
                                break;

                            case ($ord_chrs_c & 0xE0) == 0xC0:
                                // characters U-00000080 - U-000007FF, mask 110XXXXX
                                //see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                                $utf8 .= substr($chrs, $c, 2);
                                ++$c;
                                break;

                            case ($ord_chrs_c & 0xF0) == 0xE0:
                                // characters U-00000800 - U-0000FFFF, mask 1110XXXX
                                // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                                $utf8 .= substr($chrs, $c, 3);
                                $c += 2;
                                break;

                            case ($ord_chrs_c & 0xF8) == 0xF0:
                                // characters U-00010000 - U-001FFFFF, mask 11110XXX
                                // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                                $utf8 .= substr($chrs, $c, 4);
                                $c += 3;
                                break;

                            case ($ord_chrs_c & 0xFC) == 0xF8:
                                // characters U-00200000 - U-03FFFFFF, mask 111110XX
                                // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                                $utf8 .= substr($chrs, $c, 5);
                                $c += 4;
                                break;

                            case ($ord_chrs_c & 0xFE) == 0xFC:
                                // characters U-04000000 - U-7FFFFFFF, mask 1111110X
                                // see http://www.cl.cam.ac.uk/~mgk25/unicode.html#utf-8
                                $utf8 .= substr($chrs, $c, 6);
                                $c += 5;
                                break;

                        }

                    }

                    return $utf8;

                } elseif (preg_match('/^\[.*\]$/s', $str) || preg_match('/^\{.*\}$/s', $str)) {
                    // array, or object notation

                    if ($str{0} == '[') {
                        $stk = array(SERVICES_JSON_IN_ARR);
                        $arr = array();
                    } else {
                        if ($this->use & SERVICES_JSON_LOOSE_TYPE) {
                            $stk = array(SERVICES_JSON_IN_OBJ);
                            $obj = array();
                        } else {
                            $stk = array(SERVICES_JSON_IN_OBJ);
                            $obj = new stdClass();
                        }
                    }

                    array_push($stk, array('what'  => SERVICES_JSON_SLICE,
                                           'where' => 0,
                                           'delim' => false));

                    $chrs = substr($str, 1, -1);
                    $chrs = $this->reduce_string($chrs);

                    if ($chrs == '') {
                        if (reset($stk) == SERVICES_JSON_IN_ARR) {
                            return $arr;

                        } else {
                            return $obj;

                        }
                    }

                    //print("\nparsing {$chrs}\n");

                    $strlen_chrs = strlen($chrs);

                    for ($c = 0; $c <= $strlen_chrs; ++$c) {

                        $top = end($stk);
                        $substr_chrs_c_2 = substr($chrs, $c, 2);

                        if (($c == $strlen_chrs) || (($chrs{$c} == ',') && ($top['what'] == SERVICES_JSON_SLICE))) {
                            // found a comma that is not inside a string, array, etc.,
                            // OR we've reached the end of the character list
                            $slice = substr($chrs, $top['where'], ($c - $top['where']));
                            array_push($stk, array('what' => SERVICES_JSON_SLICE, 'where' => ($c + 1), 'delim' => false));
                            //print("Found split at {$c}: ".substr($chrs, $top['where'], (1 + $c - $top['where']))."\n");

                            if (reset($stk) == SERVICES_JSON_IN_ARR) {
                                // we are in an array, so just push an element onto the stack
                                array_push($arr, $this->decode($slice));

                            } elseif (reset($stk) == SERVICES_JSON_IN_OBJ) {
                                // we are in an object, so figure
                                // out the property name and set an
                                // element in an associative array,
                                // for now
                                $parts = array();
                                
                                if (preg_match('/^\s*(["\'].*[^\\\]["\'])\s*:\s*(\S.*),?$/Uis', $slice, $parts)) {
                                    // "name":value pair
                                    $key = $this->decode($parts[1]);
                                    $val = $this->decode($parts[2]);

                                    if ($this->use & SERVICES_JSON_LOOSE_TYPE) {
                                        $obj[$key] = $val;
                                    } else {
                                        $obj->$key = $val;
                                    }
                                } elseif (preg_match('/^\s*(\w+)\s*:\s*(\S.*),?$/Uis', $slice, $parts)) {
                                    // name:value pair, where name is unquoted
                                    $key = $parts[1];
                                    $val = $this->decode($parts[2]);

                                    if ($this->use & SERVICES_JSON_LOOSE_TYPE) {
                                        $obj[$key] = $val;
                                    } else {
                                        $obj->$key = $val;
                                    }
                                }

                            }

                        } elseif ((($chrs{$c} == '"') || ($chrs{$c} == "'")) && ($top['what'] != SERVICES_JSON_IN_STR)) {
                            // found a quote, and we are not inside a string
                            array_push($stk, array('what' => SERVICES_JSON_IN_STR, 'where' => $c, 'delim' => $chrs{$c}));
                            //print("Found start of string at {$c}\n");

                        } elseif (($chrs{$c} == $top['delim']) &&
                                 ($top['what'] == SERVICES_JSON_IN_STR) &&
                                 ((strlen(substr($chrs, 0, $c)) - strlen(rtrim(substr($chrs, 0, $c), '\\'))) % 2 != 1)) {
                            // found a quote, we're in a string, and it's not escaped
                            // we know that it's not escaped becase there is _not_ an
                            // odd number of backslashes at the end of the string so far
                            array_pop($stk);
                            //print("Found end of string at {$c}: ".substr($chrs, $top['where'], (1 + 1 + $c - $top['where']))."\n");

                        } elseif (($chrs{$c} == '[') &&
                                 in_array($top['what'], array(SERVICES_JSON_SLICE, SERVICES_JSON_IN_ARR, SERVICES_JSON_IN_OBJ))) {
                            // found a left-bracket, and we are in an array, object, or slice
                            array_push($stk, array('what' => SERVICES_JSON_IN_ARR, 'where' => $c, 'delim' => false));
                            //print("Found start of array at {$c}\n");

                        } elseif (($chrs{$c} == ']') && ($top['what'] == SERVICES_JSON_IN_ARR)) {
                            // found a right-bracket, and we're in an array
                            array_pop($stk);
                            //print("Found end of array at {$c}: ".substr($chrs, $top['where'], (1 + $c - $top['where']))."\n");

                        } elseif (($chrs{$c} == '{') &&
                                 in_array($top['what'], array(SERVICES_JSON_SLICE, SERVICES_JSON_IN_ARR, SERVICES_JSON_IN_OBJ))) {
                            // found a left-brace, and we are in an array, object, or slice
                            array_push($stk, array('what' => SERVICES_JSON_IN_OBJ, 'where' => $c, 'delim' => false));
                            //print("Found start of object at {$c}\n");

                        } elseif (($chrs{$c} == '}') && ($top['what'] == SERVICES_JSON_IN_OBJ)) {
                            // found a right-brace, and we're in an object
                            array_pop($stk);
                            //print("Found end of object at {$c}: ".substr($chrs, $top['where'], (1 + $c - $top['where']))."\n");

                        } elseif (($substr_chrs_c_2 == '/*') &&
                                 in_array($top['what'], array(SERVICES_JSON_SLICE, SERVICES_JSON_IN_ARR, SERVICES_JSON_IN_OBJ))) {
                            // found a comment start, and we are in an array, object, or slice
                            array_push($stk, array('what' => SERVICES_JSON_IN_CMT, 'where' => $c, 'delim' => false));
                            $c++;
                            //print("Found start of comment at {$c}\n");

                        } elseif (($substr_chrs_c_2 == '*/') && ($top['what'] == SERVICES_JSON_IN_CMT)) {
                            // found a comment end, and we're in one now
                            array_pop($stk);
                            $c++;

                            for ($i = $top['where']; $i <= $c; ++$i)
                                $chrs = substr_replace($chrs, ' ', $i, 1);

                            //print("Found end of comment at {$c}: ".substr($chrs, $top['where'], (1 + $c - $top['where']))."\n");

                        }

                    }

                    if (reset($stk) == SERVICES_JSON_IN_ARR) {
                        return $arr;

                    } elseif (reset($stk) == SERVICES_JSON_IN_OBJ) {
                        return $obj;

                    }

                }
        }
    }

    /**
     * @todo Ultimately, this should just call PEAR::isError()
     */
    function isError($data, $code = null)
    {
        if (class_exists('pear')) {
            return PEAR::isError($data, $code);
        } elseif (is_object($data) && (get_class($data) == 'services_json_error' ||
                                 is_subclass_of($data, 'services_json_error'))) {
            return true;
        }

        return false;
    }
}

if (class_exists('PEAR_Error')) {

    class Services_JSON_Error extends PEAR_Error
    {
        function Services_JSON_Error($message = 'unknown error', $code = null,
                                     $mode = null, $options = null, $userinfo = null)
        {
            parent::PEAR_Error($message, $code, $mode, $options, $userinfo);
        }
    }

} else {

    /**
     * @todo Ultimately, this class shall be descended from PEAR_Error
     */
    class Services_JSON_Error
    {
        function Services_JSON_Error($message = 'unknown error', $code = null,
                                     $mode = null, $options = null, $userinfo = null)
        {

        }
    }

}
    


/*************************** lang.php ***************************/


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
    'Sort by name' => 'Sort by name',
    'Sort by type' => 'Sort by type',
    'Sort by access' => 'Sort by access',
    'Sort by size' => 'Sort by size',
    'Sort by date' => 'Sort by date',
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
    'Sort by name' => 'Сортировать по названию',
    'Sort by type' => 'Сортировать по типу',
    'Sort by access' => 'Сортировать по доступу',
    'Sort by size' => 'Сортировать по размеру',
    'Sort by date' => 'Сортировать по дате',
  ),
);



//Перевод
function t($name)
{
  global $lang;
  global $settings;
  $res = $lang[$settings->language][$name];
  return $res ? $res : $name;
}





/*************************** common.php ***************************/




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


if ($_POST['editor'] != 1) {

/*************************** index.php ***************************/








//Загрузка языков
$js_lang = '';
foreach ($lang[$settings->language] as $phrase => $translate) {
  $js_lang .= $js_lang ? ', ' : '';
  $js_lang .= '{phrase: "'.$phrase.'", translate: "'.$translate.'"}';
}
$js_lang = 'var lang = ['.$js_lang.'];';
$html = str_replace('[#lang#]', $js_lang, $html);

//Авторизация
if ($settings->logintype != '') {
  $info = null;
  if (strtolower($settings->logintype) == 'iris') {
    include_once($settings->root_path.'/core/engine/applib.php');
    include_once($settings->root_path.'/core/engine/auth.php');
    if (!session_id()) {
      @session_start();
      if (!session_id()) {
        $info = t('Can\'t open the settion').'!';
      }
    }
    $path = $_SESSION['INDEX_PATH'];

    if (!$info && !isAuthorised()) {
      $info = t('Don\'t authorised in Iris CRM').' '.
        '<a href="'.$settings->root_path.'">'.t('Authorise').'</a>.';
    }
    if (!$info && !IsUserInAdminGroup()) {
      $info = t('You must be authorised like admin').' '.
        '<a href="'.$settings->root_path.'">'.t('Authorise').'</a>.';
    }
  }
  else {
    $info = t('Unknown login type').': '.$settings->logintype;
  }
  if ($info) {
    
    $html = str_replace('[#body#]', $html_msg, $html);
    $html = str_replace('[#header#]', t('System message'), $html);
    $html = str_replace('[#info#]', '<p>'.t($info).'</p>', $html);
    echo $html;
    return;
  }
}


//Определяем путь
$root = str_replace('\\', '/', realpath($settings->root_path));
$wedit = str_replace('\\', '/', realpath('.'));
$p_path = str_replace('\\', '/', $_GET['path']);
//Сортировка (формат: 1a - по первой колонке в алфавитном порядке)
$p_sort = $_GET['sort'];
list($sort_column, $sort_order) = get_sort_params($p_sort);
$p_path = filename_encode($p_path);
$now_sort_link = $p_sort ? '&sort='.$p_sort : '';

//TODO: "/" в зависимости от ОС
$current = str_replace('\\', '/', realpath($root.'/'.$p_path));
if (strlen($current) < strlen($root)) {
  $current = $root;
}
$current_rel = str_replace($root, '', $current);

//Путь к текущему каталогу
$path = '';
$path_simple = '';
$path_array = explode('/', $current_rel);
foreach ($path_array as $val) {
  $val = filename_decode($val);
  $path_simple .= ($path_simple != '/' ? '/' : '').$val;
  $path .= ($path ? '/' : '<a href="?path=.'.$now_sort_link.'">&hellip;</a>').'<a href="?path='.$path_simple.$now_sort_link.'">'.$val.'</a>';
}



//Если надо выполнить какие-то команды над файлами
//TODO: коды ошибок
$info = '';
switch ($_POST['operation']) {

  //Создание файла
  case 'create':
    $new_filename = $current.'/'.filename_encode($_POST['newname']);
    if (!file_exists($new_filename)) {
      if ($_POST['newtype'] == 'Directory') {
        mkdir($new_filename);
      }
      else {
        touch($new_filename);
      }
    }
    break;

  //Изменение файла (переименование)
  case 'change':
    $old_filename = $current.'/'.filename_encode($_POST['oldname']);
    $change_filename = $current.'/'.filename_encode($_POST['changename']);
    if (file_exists($old_filename)) {
      rename($old_filename, $change_filename);
    }
    break;

  //Удаление файлов
  case 'delete':
    $json = new Services_JSON();
    $filenames = $json->decode($_POST['filelist']);
    foreach($filenames as $name) {
      $filename = $current.'/'.filename_encode($name);
      //Воизбежание опасных удалений
      if ($name != '.' && $name != '..') {
        runlink($filename);
      }
    }
    break;

  //Загрузка файлов
  case 'upload':
    if (isset($_FILES)) {
      $loaded = 0;
      foreach($_FILES['file']['name'] as $i => $name) {

        $filename = $current.'/'.$name;
        if (file_exists($filename)) {
          $info .= '<li>'.$filename.' ('.t('File already exists').')</li>';
          continue;
        }
        else {
          if (!move_uploaded_file($_FILES['file']['tmp_name'][$i], $filename)) {
            $info .= '<li>'.$filename.' ('.t('Copy error').')</li>';
            continue;
          }
        }
        $loaded++;
      }
      $info = $info ? '<h3>Не удалось загрузить следующие файлы</h3><ul>'.$info.'</ul>' : $info;
      $info .= '<h3>'.t('Files loaded').': '.$loaded.' '.t('from').' '.count($_FILES['file']['name']).'</h3><hr>';
    }
    else {
      $info .= '<h3>'.t('Files not selected for upload').'</h3>';
    }
    break;

  //Скачивание
  case 'download':
    $filename = $current.'/'.filename_encode($_POST['filename']);
    $basename = filename_encode($_POST['filename']);
    //Скачивание одного файла
    if ($_POST['filename'] && is_file($filename)) {
      file_download($filename, $basename);
    }
    //Скачивание каталога - кладём его в zip
    elseif ($_POST['filename'] && is_dir($filename)) {
      $tmp = str_replace('\\', '/', realpath(ini_get('upload_tmp_dir')));
      $tmpfilename = $tmp.'/'.create_guid().'.zip';
      $zip = new ZipArchiveDir();
      $zip->open($tmpfilename, ZIPARCHIVE::CREATE);
      $zip->addDir($filename, filename_encode(filename_decode($basename), $settings->filename_encoding_zip));
      $zip->close();
      file_download($tmpfilename, $basename.'.zip');
      unset($tmpfilename);
    }
    //Скачивание нескольких файлов/каталогов - кладём их в zip
    elseif ($_POST['filelist']) {
      $tmp = str_replace('\\', '/', realpath(ini_get('upload_tmp_dir')));
      $tmpfilename = $tmp.'/'.create_guid().'.zip';
      $zip = new ZipArchiveDir();
      $zip->open($tmpfilename, ZIPARCHIVE::CREATE);

      $json = new Services_JSON();
      $filenames = $json->decode($_POST['filelist']);
      foreach($filenames as $name) {
        $filename = $current.'/'.filename_encode($name);
        if (file_exists($filename)) {
          if (is_dir($filename)) {
            $zip->addDir($filename, filename_encode($name, $settings->filename_encoding_zip));
          }
          else {
            $zip->addFile($filename, filename_encode($name, $settings->filename_encoding_zip));
          }
        }
      }
      $zip->close();
      file_download($tmpfilename);
      unset($tmpfilename);
    }
    break;

  //Копирование файлов
  case 'copy':
    $json = new Services_JSON();
    $copyname = $current.'/'.filename_encode($_POST['copyname']);
    $filenames = $json->decode($_POST['filelist']);
//    if (count($filenames) > 1 && is_file($copyname)) {
//      break;
//    }
    if (count($filenames) > 1) {
      mkdir($copyname);
    }
    foreach($filenames as $name) {
      $filename = $current.'/'.filename_encode($name);
      if (count($filenames) > 1) {
        rcopy($filename, $copyname.'/'.filename_encode($name));
      }
      else {
        if (!file_exists($copyname)) {
          rcopy($filename, $copyname);
        }
      }
    }
    break;
}


//Если это каталог, то отобразим содержимое
if (!is_file($current)) {

  //Список файлов
  $list = '<table id="files"><thead><tr>'.
    '<th></th>'.
    '<th><a href="?path='.$path_simple.'&sort=1'.get_sort_direction(1, $p_sort).'" '.
      'title="'.t('Sort by name').'">'.t('Name').'</a>'.get_sort_cursor(1, $p_sort).'</th>'.
    '<th><a href="?path='.$path_simple.'&sort=2'.get_sort_direction(2, $p_sort).'" '.
      'title="'.t('Sort by type').'">'.t('Type').'</a>'.get_sort_cursor(2, $p_sort).'</th>'.
    '<th><a href="?path='.$path_simple.'&sort=3'.get_sort_direction(3, $p_sort).'" '.
      'title="'.t('Sort by access').'">'.t('Access').'</a>'.get_sort_cursor(3, $p_sort).'</th>'.
    '<th><a href="?path='.$path_simple.'&sort=4'.get_sort_direction(4, $p_sort).'" '.
      'title="'.t('Sort by size').'">'.t('Size').'</a>'.get_sort_cursor(4, $p_sort).'</th>'.
    '<th><a href="?path='.$path_simple.'&sort=5'.get_sort_direction(5, $p_sort).'" '.
      'title="'.t('Sort by date').'">'.t('Change date').'</a>'.get_sort_cursor(5, $p_sort).'</th>'.
    '<th></th>'.
    '</tr></thead>'.
    '<tbody>[#tbody#]</tbody></table>';

  $rows = '';
  $file_list = read_from_directory($current, $sort_column, $sort_order);
  foreach ($file_list as $item) {
    $link = $current_rel.'/'.$item['name'];
    $link_abs = str_replace('\\', '/', realpath($root.'/'.$link));
    if (strlen($link_abs) < strlen($root)) {
      $link_abs = $root;
    }
    $link_rel = str_replace($root, '', $link_abs);
    if ((($p_path != '.' & $p_path != '/') || $link_rel) && $link_rel != $p_path) {
      $link_rel = $link_rel ? '?path='.$link_rel : '?path=.';

      $item['name'] = filename_decode($item['name']);
      $link_rel = filename_decode($link_rel);
      $rows .= '<tr>'.
        '<td><input type="checkbox" id="f_'.$item['name'].'" name="'.$item['name'].'" value="'.$item['name'].'"></td>'.
        '<td><a href="'.$link_rel.$now_sort_link.'">'.$item['name'].'</a></td>'.
        '<td>'.($item['is_dir'] ? t('Directory'): '').'</td>'.
        '<td>'.$item['access'].'</td>'.
        '<td class="number">'.($item['size'] > 0 || $item['size'] == '0' ? number_format($item['size'], 0, '.', ' ') : '').'</td>'.
        '<td>'.$item['modifydate'].'</td>'.
        '<td></td>'.
        '</tr>';
    }
  }
  $list = str_replace('[#tbody#]', $rows, $list);


  
  $html = str_replace('[#body#]', $html_list, $html);
  $html = str_replace('[#info#]', $info, $html);
  $html = str_replace('[#list#]', $list, $html);
  $html = str_replace('[#Upload#]', t('Upload'), $html);
  $html = str_replace('[#Download#]', t('Download'), $html);
  $html = str_replace('[#Create#]', t('Create'), $html);
  $html = str_replace('[#Copy#]', t('Copy'), $html);
  $html = str_replace('[#Change#]', t('Change'), $html);
  $html = str_replace('[#Delete#]', t('Delete'), $html);
  $html = str_replace('[#Rename#]', t('Rename'), $html);
}
else {
  //Если в $current - файл, то открывать его на редактирование
  $contents = '<textarea></textarea>';

  
  $html = str_replace('[#body#]', $html_edit, $html);
  $html = str_replace('[#filename#]', filename_decode($current), $html);
  $html = str_replace('[#status#]', t('Loading').'...', $html);
  $html = str_replace('[#Save#]', t('Save'), $html);
  $html = str_replace('[#Reload#]', t('Reload'), $html);
}

$html = str_replace('[#path#]', $path, $html);

echo $html;


} else {

/*************************** file.php ***************************/







$json = new Services_JSON();

$operation = $_POST['operation'];
$result = null;

switch ($operation) {

  //Открытие файла
  case 'load':
    $result['content'] = file_get_contents(filename_encode($_POST['filename']));
    $encoding = $_POST['encoding'];
    if (!$encoding) {
      $encoding = detect_encoding($result['content']);
    }
    if ($encoding && $encoding != 'utf-8') {
      $result['content'] = iconv($encoding, 'utf-8', $result['content']);
    }
    $result['status'] = t('Loaded');
    $result['encoding'] = $encoding;
    break;
    
  //Сохранение файла
  case 'save':
    $encoding = $_POST['encoding'];
    $content = $_POST['filecontent'];
    if ($encoding && $encoding != 'utf-8') {
      $content = iconv('utf-8', $encoding, $content);
    }
    $result['code'] = file_put_contents(filename_encode($_POST['filename']), $content);
    if ($result['code'] != false) {
      $result['status'] = t('Saved');
    }
    else {
      $result['status'] = t('Error');
    }
    break;
}

echo $json->encode($result);
return;




}
?>