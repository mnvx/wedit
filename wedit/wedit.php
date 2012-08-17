<?php
/*************************** settings.php ***************************/


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

div#info {
  padding: 5px;
}
div.error {
  padding: 5px;
  background-color: #daa;
  border-radius: 5px;
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

div.info {
  width: 400px;
  align: center;
}

div.info h1 {
  font-size: 22pt;
}
div.info h2 {
  font-size: 12pt;
  padding-top: 10px;
}
hr {
  border: none;
  border-top: 1px solid #aaa;
}
div.info hr {
  margin-top: 25px;
}

img {
  border: none;
}


#btn_create {
  background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQCzYES2XQJwAAAnVJREFUaN7tmDtoFEEYx39JfCCGKIgGRIhCDIixEFNZJOALi4ggIphCe1HsJCBYWIiVlVY2glglEeKLoKUnCmKCYiH4wBDUFJ4JFhLlbtfmPzAs3OUyu7ezt+wfhhlmv29m/8w332OgQIECBVoNx4E5IFxhWwSuZomICwm7XcoKkaWYRALgTB6IhMA/4GAeiJg7058HIiHwBej2QaJNRNYmuOYn4GuKHH4A15tBxAc+5IUI7XmJ6rkhsqpJ634DpoB3wKzizFZgJ3AY2CtHk1n3OwMcamDPHuAuUE1q76QuewhcAa4pZQHoAoaA7cAaYB54qVhjMAiMA5uzcCIV4JS13m5grM66b4CTlmntAD4ncCqxiZyzSFwQsUb0JoFO6fUBCz6JTFokLjvovwDWSf+sLyJLMgtTnAU15IblAF7V+H7HSpdKPohM6AdWAx/ryK2X3KM69cyAZE67EokTEO+rPwr0xkxcz2v8WDEn1chesojEhVnjt4JoapE9AL5bHsdgHngQka2on1LEN+gH9mvcDWxUcTZnmVrT48iipT9tzT9fwb4XI2sa87ztckdcT6RL2cBfoGzNdwL7IrIzOsFeYIM1vy0i91O9c5R39Vo90r+5jNxyXitUlWfwOm2vdUD9wwQuu7lXm5QZp+q1htU/k/m4ogLc0PgI0JG2aVWUIJofqDqa1i197wDeZiHXGq0hswD8UqCLfitZJYS3XMu00QSy3wHgj28imahHfFeIQyKdiQrRbu+BEw2kPntEIMhazR5FWV5qOvKK0gccA3a1wtuvtwe6ag7e54J24EkOiDxtk1mNAFtalEQZuEeBAgUKtBT+A7DlzD4JGZj1AAAAAElFTkSuQmCC) no-repeat center;
  width: 65px;
  height: 60px;
  border: none;
}
#btn_create:hover {
  background-color: #eee;
  border-radius: 3px;
}

#btn_upload {
  background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAAhCAYAAACFtMg3AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQCjYGpKnbPAAAAkZJREFUWMPl2U+ITlEYx/HPXCOFWFlNiLDRlJiFjVAyTZQsbFC2ZDELJYQslPyZkhUbsaWQsTCl0SilLMwUJUqiWDDI32FmXjbn6vY272ved+693jvzq6f7/z7ne849z3nOuU2y0wK0Y0PYb8Fs/MAgHuEBroTjwmoVevB7nDaES5hfNNCZoeClGmCT9g37ERUBdjEG6gQtt17MaWTYFrxOCTa2+6G/N5zm4knKsLF1oyntAk+b4POnsTmjylyGd3iYOBdhEVaiLXSlWfgVon+masVwRq0b20fMw5oQED9VuG8EfegMX10mupkxbGzv67h/H2akHahGcwKu1wbC55+KOhscNrY3WJ4G8NWCAP/GyxAH/ka9erSkQBngQlys9+HpYUj4MsFaH/0PMaCjFtAVuFxlWKg1Z16H9WE/L+DH40lkmkNykVZrDGFj4v3t4Vxe0G3/gr2RorNhbBnDz9YcEpjYjlcDPpuio1Fsr+JrR059uq9SAdZOYF5bbiXsHkec2JMD8PNKM6B7KTo5UENwPJQx8Ndy0PP4maKDk3UMfacyBP6QzI2fpfzy3jrns024m9XQ1Byi8TUszWD6eCE4gjshJR1L28LqZgzcmlHW9QJ25TQkdFUpSFdOZdgbYaepo+4o5MZTAhavokZdHUxZI2HNW4S3UwD4BJ7GwL2THPYWjiUXAM6F9G8yqifk6aUkcH9o8smkEs5gEz6XTwHhaNgeVJCfWVV0O3D0j3UxStTIYazGdXwvEOBg+DtxJKxQdlSChT9jXhi1faAJGAAAAABJRU5ErkJggg==) no-repeat center;
  width: 65px;
  height: 60px;
  border: none;
}
#btn_upload:hover {
  background-color: #eee;
  border-radius: 3px;
}

#btn_download {
  background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAAhCAYAAACFtMg3AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQCjk3cu/HyQAAAjtJREFUWMPl2b1rFGEQx/HPrSeCihZioUFFURGDIEbtggpiEARfSuMfoI0BBRGxUkF8SS8WQVsVhaTQNBELIWghAW0lIKTQiIIEY+IlFnlWjsBdLpt94t35g4G9ZXdnvvvszs7MFcTTRnTgcNhuwUr8xFe8wyAehd8Nqzb0Y7pGG8cDbGg00OUh8Kl5wJbbGC4haQTYLRjKCDrbBrCqnmFb8Ckn2NReh/e97rQaH3KGTa0PhbwDXrLA8+/gWKSbuR1f8LZsX4LN2IO94VVagYmQ/aNqFyYjrW5q37AW7SEhfq9w3G+8Qld46qKoNzJsaqMZjr+IZXknqtIiAWe1ofD456KuOodNbQSteQA/bhDgaQyHPPA362XR1gaqADehJ+vJS8Mn4ccC73rpH+SAo/MB3Y2HVT4LtVh3let3LwLwexSKc4AWcRMXGqWor6JWtBXngH2C45pHJ6qt2t0mg4X2SsAHcF7zaX1SoQO6HqNTqQOtS2aB3sPnUKw3oyaKZbXxS2zT3BpJQjZ++h/AwscEndjv/1B/EWciXXwUz0KVw8wMupIGcT9sF3AKayLE1MfMEDxGKTeQMdMXQj7JO57e1MGviPXrrQzAtyPEMYkdqYPhyEX75XnAXokUw7VyJz2RgadwtgbYcxHHvcns1i92b1rC6SqwnZFieKHCvxg3FqEfnazQjJyMMO4thZl5xbl7EqBjr/Q4jpT57Qj78vTxPDy1NWlfqLrGIkKP4SAO5eRnFG9wFTvnAvwDxggI54mo3/oAAAAASUVORK5CYII=) no-repeat center;
  width: 65px;
  height: 60px;
  border: none;
}
#btn_download:hover {
  background-color: #eee;
  border-radius: 3px;
}

#btn_rename {
  background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAYAAAAe2bNZAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQDDs5o+z0/gAAAU5JREFUWMPt2E0rRFEYAOBnJtla2FtZmbJS8gPI50Ip+QNKFmKn/AjJwgIbCxTWSjY+llYWs7C0YaGkNBgZm3trmsY1dD9o5q230+ne7vv0nm73nkN6kcM8irjHKXplEG3YRaUmXzGRNmSvDiR1UA4FPEdgKsH17iQheWziDGMNgHaShoSFGgFdpwEJ8xzjEaCjtCBhXnwBekdfmpBq0CCegvkbprKAhHmJITzEDclh7QeQME/QEXdHtn4BeQnerhbkT0JGW5CmgWz/d8hIC9IUEFj/BaQcx9c3XzMfw+0Pn1HGDA7i7Eg7HrGPOXw00JFSEksDw1VF9rH4DSgxCGzUFIsCJQrJ465O0XqgUtDFxGIgYjn2sBSAEoW0BeNkxD3TwbiMGxwnvScuRnTmI/ib70ljc174AnCBWXSmeWSxUoW4wgK6ZBSHWEW/jOMTwvV0pZHuejYAAAAASUVORK5CYII=) no-repeat center;
  width: 65px;
  height: 60px;
  border: none;
}
#btn_rename:hover {
  background-color: #eee;
  border-radius: 3px;
}

#btn_copy {
  background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADMAAAAuCAYAAACF6SFvAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQCwocK/oxjgAAATxJREFUaN7tmL9Kw1AUxn+2QShtAp2ETF07FTp08T269SEcfY4u4u5g17yALiXtWuhaKDh00ioiDkaXCCEojddz86/ng7vc4dz8ku98994AXADPwKfheAWmlEQv/wBJDr9okAbQEarlFQ1zEr9VCc2AJwvPGAF3wG2eMDb1AbSB90M2q4KawGmWnqmNnF/mAyCMP69JqAyAcWzjXJWO2ECo7pVQ5H8P18RmoRDMogw2i4RqvwGPwg76s80uqxoAtUqzo4jmtHxgAnQN19kDN8A272j+qWfWAtG6se2ELMVdoC+wVg84K9pmkrt4D2hZOlk/ODn36Nxi7WWd0myk+4zCKIzCKIzCKMyxwuzqdDk7B4aJuVVVYbIc7734pqg9ozAKozAKozAKozAKUzxMVBGWKOt/5OvUybqMuv8CWq90jlN1HdoAAAAASUVORK5CYII=) no-repeat center;
  width: 65px;
  height: 60px;
  border: none;
}
#btn_copy:hover {
  background-color: #eee;
  border-radius: 3px;
}

#btn_delete {
  background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQDC8veZaW+gAAAwJJREFUaN7t2NuLlVUYx/HPqBmdhrCmM1hEilQXgtVFkZ1vIoLKoAS7T4UuIoQgISL6B7wXpYuwEbSwMAii8UwjTSfDjESrEZ2SjlPOzO7m98JiIzKN2/3u2ewHXta7116n77vWep7fWvSsZz3r2WyzJ3EMjf/5nMbrnQQyE4jyeaVTQMbPE2QKq7oBpIF/8XA3gFR75o5uAGnge1xbB0RfQC5uYZvf4Yc2MvyMty4ESB12qFtAzOmWqN41IPMuULs/4kOM4GjizA24DY9iaRxNx7rfg3hkGn0uxGZMtqrvVm32Bl7Dm5Es0I/luBnzMYo9iTWV3Y93MdAJMzKBZ4v2bseWc7T7GZ4pltYtONKCWTlvkBcLiLUBm069bbg89Rbh1zpBthUQrxb5J/A1jmeAY8k7hJNFuV24JPVfqAtkPMuiOpxNJb/aB0ciJJvrfB5vVuVtLOTSUB0ggxnARThc5H+J7ViftJyBj7A6gx8uzjPL0tZzdYCsTOdP5PeBpF9lsDdhRQHzAe7FguylocxcOSv9+KfdIAvT+YamODKOtzPoCmY97sbcuOSt+An7Um+02GsH2gkymSUly6XK/7t434JbU2Z+0rvwMf4ollVV/sqU2ToTkJlqrd9xJu9XFfmj1dfB43gaV0SiDOABXI/LirNLZVcnHWunaOwv1EDZ8Yki0H2CT/Fnyk/G/R7GqQBfWtQ9lXSgnSB9uC7v3xb59+CXCMY3sD97ZVWW2cForP34LUuxmsnTeb+x3TL+oaTvJd2VdBjvYC/uwxq8jJfiIEayoY8WwXB7sUyXtltrDRYfY7jpvxE8iJ3Fxm4EcAU2FW72DBbXGUcmIhDhsbNI8kF8U3inifS1O/KlKrchbcxN1K9da607R7l9+CLBsoz0Q4XTqE1rVc+6FqjfZfirbpCOOI/UfUJcHuiOOCE2mpTvU9O41LgzAFOddmZvtjG8H7dc3qIsilpeMhvufmu7oJvsgvu5qTnY0QUgO/uyrJ7HNbMUYiwHuZ71rGc9m0X2HxbnK0GzXnnKAAAAAElFTkSuQmCC) no-repeat center;
  width: 65px;
  height: 60px;
  border: none;
}
#btn_delete:hover {
  background-color: #eee;
  border-radius: 3px;
}

#btn_save {
  background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQCyMb8dg7xgAAAYNJREFUWMPt2D1LHUEUh/HfvfiCJhBExEIwxiaFAYuIjTZqIaRKY2pRSBn8CCnSCIKFRYoUJkVKUQsVCy0FWxElsREVEQRBJCB54aYZ4SKil7urO8IeGHZn9+yfZ2fOnDO7RG4F1GE3QrZZfKoJkJ04xQJKVQo2YSRFwGaoKbuwgvcJRf9c00xsxbLzUowxWIx9keSAOWBGdoifMQPO4/N1wCcJRRtTfOEeDF116kMOjK1NP4pFklZZ+o11HITa3ovutCCTTvEaXtygO4zjpFOcFHDpjlnowElWMXiOUfy9xWcfH7JK1IthD3mXzeEsC8CtCv3+YTsLwMI9+aYGWGkaqcVTtODLQwK+RWsFfu/wHK/D8UHzYNRpBt5g9ZZEvVHhKN9rqRvED2xiL3xn9+BlTLW4Fv2h5Vv+am0KDejCUWyAJXzEJXbCf5XoAH+V9S/yGMwBc8BHBlhEW1m/PcYR/IY+jGE8LdFCqKPfq3x+Bq8wcMO9S0xgEs+q0F7G19hD0H+9k69p4yz7RwAAAABJRU5ErkJggg==) no-repeat center;
  width: 65px;
  height: 60px;
  border: none;
}
#btn_save:hover {
  background-color: #eee;
  border-radius: 3px;
}

#btn_reload {
  background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAYAAAAe2bNZAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQDQICHaH6VwAAAjFJREFUWMPF2MtqFUEQxvFfJF4TwRskSBAUowFxIYILwQshbsQY0QcQ30FElCiKeMEncOFGEN/AhQYEBRVFUBBFyC4BIWCSE02Mtxw3fcIw5MzNmeMHvRimuurfzXRV9bTJp+XoxwHsxQ6sj7yfwie8wTM8wa+Mvo9lhejGLUygnmNM4DY2p/gfxHwaxGpcwVxOiPiYx2WsWCLGcfzAQhLILrz/R4j4eIu+SIyhAFJPghnATMkgjTGDwzGQpjD9YVvrFY65GMiSMH2oVQzSbCy0RUBW4RV2Zzhd03iIRxgLC1iHHhzB0diRz6J69OFSBvppXEBHiuM1GMbXPDvTmNyF2RTjD9iec7V9GM0Lcz3F8GOBbW/oTB6YdnxOMKqhtyDIiSVOTSLMQIrRcEGQk/iZ95u5kWAwhc4CIKdygizCjCQY3CsAchq/i+SZ9pTvYSQnSBf24W6BRdThWwLtQS3UspB5m2my1TDfE95vajVM0uq3VBBzD+6E2nYzdJGLepzwzdwvGWQw9MTRGJPY2jCoIs80K57jTeI8iHZ1VWTguM4mxBhvGFVZmxraltLGvosaV1m1N4ZgSf6vxTNnFf1Mb4YbRg0b4hPL7PQ6cD5jP32xManMHrgTO8PVdwhrM/h5jf2hsPqft4PpAJ+oVtybZsMOZtIhfKkIZCrktlzqwcuSQZ4Hv4VU1l+IGs5hZRmpvOj/mTFcDXksVW0l/LnqDkVwMpSV0ZAiXuAp/mR1/hcNHD78BVU4kQAAAABJRU5ErkJggg==) no-repeat center;
  width: 65px;
  height: 60px;
  border: none;
}
#btn_reload:hover {
  background-color: #eee;
  border-radius: 3px;
}

#newok, #change_ok, #delete_ok, #upload_ok, #copy_ok {
  background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAYAAAAe2bNZAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQDQ0xJemHjgAAAYpJREFUWMPt17FKXEEUxvHfbjSBCCKCkBRJ1EoFLRSsUiSQJkjS2KWwDCpYivgEWqiPYGGtvWAjiPgAK1HSpLDYwiYmmCBG1+YKy3Lv3V1d79yAH0wxw8zwnzlnON/wqP9AT1q4VwETGMAPXIc82CoqUdtDV0iYvSqYCjbyBHONwWY2KD4gXAEfQ8HE7fUyBMwQxmPGKyFgVtAWM17OOnE/1SRudXufJchTfEsAuUJnljCLKbdSvsvz68VmypwlbMWM9+EQzxPW/cMk/tRhuMR+NF87LlJOOJ0QnoOUNc22HRTaIrJjjDRQVNfxBv141cJwf0Df7XMsNQBTxNQD5d4V/harYELpF76inAeY+Sj88gAzU1sOTvAzEMyzuNoU4nbOMJsHmHO8w24eYDqwlmQhQoSpJwnmsFkzdE+dYi4J5ix6VVmoFBXo3TSnl1WohvG2nu0s1Sn1r7GM3y0A6q834UuDFqIbC/h+R8twGvdzKNT0X+BzzOfsKMWcjWG0iRupYDvD/HxUa3UDaw+Endfc03oAAAAASUVORK5CYII=) no-repeat center;
  width: 65px;
  height: 60px;
  border: none;
}
#newok:hover, #change_ok:hover, #delete_ok:hover, #upload_ok:hover, #copy_ok:hover {
  background-color: #eee;
  border-radius: 3px;
}

#newcancel, #change_cancel, #delete_cancel, #upload_cancel, #copy_cancel {
  background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAYAAAAe2bNZAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQDQ4CsRS1WwAAAbRJREFUWMPN2MFLFVEUx/GPF0WtNiHme+SqRRS1khatSp7154SrNi0MChcF/RP1H7iJIBFcFVGkheCiRdEiRbPCXpJSbe6APGyamebNzIHfauCe75w7957zmwH5YgjTmMFlnEEbg9jBAdbwAk+wjJ9KjjbuYRu/c2gTDzBZBsQw5vA9J0Sv9jAf1ysUF7D6nxC9WsHZvCBX8aVkkERf43eXGaTbJ5BEXXT+BXIO3/oMcrhCF9M+1tWKQBK9xehRMPMVgyS62wvSwo+aYHZxCkKEmcWIeuI4bhy+4jdrqkqijcjhes0giTohy3mvKK4FXGoIzBS8TyndQskJF1JyvQsYa0hlxsPfbsAaYjTEptWE6A7iM06kjJknS0w4lPJsW5xVm3DPPA541ZBtehmw2BCYp0mz/FjzFn1ACPiFRzVX5WHkABMVzL1p88x4L92tmmBuHlWqEbypGOR1mrE7H6f2KkB2shi6TrSj/QTZy2PkpguY/KzawpW8x20Sz0sGeYbThds67pRgY7q4XZYDaeN+ARexEf/rtLIkGSgwAnTink/F09DCsfj2n7Aem+8ylrCfdfE/NG1isY5Eb14AAAAASUVORK5CYII=) no-repeat center;
  width: 65px;
  height: 60px;
  border: none;
}
#newcancel:hover, #change_cancel:hover, #delete_cancel:hover, #upload_cancel:hover, #copy_cancel:hover {
  background-color: #eee;
  border-radius: 3px;
}

/* dark */
</style>
<script src="jquery-1.8.0.min.js"></script>

<script type="text/javascript" language="javascript">

$(document).ready(function(){
	/*
	 * Выбираем все строки таблицы.
	 * Тип селектора можно изменить, главное,
	 * чтобы под его влияние попали контейнеры, 
	 * в пределах которых осуществляются клики. 
	 */
	$('table#files tr').bind('click', function(event) {
		/*
		 * Проверяеи тип узла. 
		 * Нас интересует только ELEMENT_NODE, идентификатор которого равен 1. 
		 * (во всех броузерах, включая IE)
		 */
		if (1 == event.target.nodeType) {
			/*
			 * Если клик пришелся не на чекбокс, 
			 * то инвертируем значение чекбокса, размещенного в контейнере. 
			 */
			if ('INPUT' != event.target.nodeName.toUpperCase() && 'A' != event.target.nodeName.toUpperCase()) {
				$(this).find('input[type=checkbox]').each(function() {
          if (!$(this).attr('disabled')) {
            $(this).attr('checked', !this.checked);
          }
				});
			}
		}
	});	
});

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
      $('#contents_oldvalue').val(result.content);
      //Обновим состояние
      $('#status').html(result.status);
      $('input#encoding').val(result.encoding);
    });
    //И установим высоту текстового редактора в полный экран
    onResize_editor();
    $(window).bind('resize', function() {
      onResize_editor();
    });

    $('textarea#contents').keyup(function() {
      if ($('#contents_oldvalue').val() != $('textarea#contents').val()) {
        $('#status').html('<span class="textchanged">'+t('Changed')+'</span>');
      }
      else {
        $('#status').html('<span>&nbsp;</span>');
      }
    });
  }
  if ($('div.info')) {
    onResize_info();
    $(window).bind('resize', function() {
      onResize_info();
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

function onResize_editor() 
{ 
  $('#contents').height($(window).height() - 
    ($('#address').outerHeight(true) + $('#status').outerHeight(true) + $('#buttons').outerHeight(true)) -
    ($('#text').outerHeight(true) - $('#text').height() + 20)
  );
}

function onResize_info() 
{
  //Текст будем держать по центру экрана
  $('div.info').css('margin-top', $(window).height() / 2 - $('div.info').height() / 2);
  $('div.info').css('margin-left', $(window).width() / 2 - $('div.info').width() / 2);
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
<div id="info">[#info#]</div>
<div id="address">
<table width="100%"><tbody><tr>
<td>[#path#]</td>
<td align="right"><h1><a href="http://iris-crm.ru/wedit" title="Wedit home, about integration with Iris CRM">Wedit</a></h1></td>
</tr></tbody></table>
</div>
<div id="filelist">[#list#]</div>
<div id="buttons">
<input type="button" id="btn_upload" title="&uarr; [#Upload#]&hellip;" onclick="uploadFile();"/>
<input type="button" id="btn_download" title="&darr; [#Download#]" onclick="downloadFile();"/>
<input type="button" id="btn_create" title="[#Create#]&hellip;" onclick="createFile();"/>
<input type="button" id="btn_copy" title="[#Copy#]&hellip;" onclick="copyFile();"/>
<input type="button" id="btn_rename" title="[#Change#]&hellip;" onclick="changeFile();"/>
<input type="button" id="btn_delete" title="&empty; [#Delete#]&hellip;" onclick="deleteFile();"/>
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
  	  '<input id="newok" type="button" title="'+t('OK')+'" onclick="sendCreateFile();"/>'+
  	  '<input id="newcancel" type="button" title="'+t('Cancel')+'" onclick="cancelCreateFile();"/>'+
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
      '<input id="change_ok" type="button" title="'+t('OK')+'" onclick="sendChangeFile();"/>'+
      '<input id="change_cancel" type="button" title="'+t('Cancel')+'" onclick="cancelChangeFile();"/>'+
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
      '<input id="delete_ok" type="button" title="'+t('Delete')+'" onclick="sendDeleteFile();"/>'+
      '<input id="delete_cancel" type="button" title="'+t('Cancel')+'" onclick="cancelChangeFile();"/>'+
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
      '<input id="upload_ok" type="button" title="'+t('Upload')+'" onclick="sendUploadFile();"/>'+
      '<input id="upload_cancel" type="button" title="'+t('Cancel')+'" onclick="cancelUploadFile();"/>'+
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
    '<input id="copy_ok" type="button" title="'+t('Copy')+'" onclick="sendCopyFile();"/>'+
    '<input id="copy_cancel" type="button" title="'+t('Cancel')+'" onclick="cancelCopyFile();"/>'+
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
<input type="button" id="btn_save" title="[#Save#]" onclick="saveFile();"/>
</td>
<td align="center">
Кодировка: <input class="field" id="encoding" type="text" size="10" value=""/>
</td>
<td width="33%" align="right">
<input type="button" id="btn_reload" title="[#Reload#]" onclick="reloadFile();"/>
</td></tr></tbody></table>
</div>

<input id="filename" type="hidden" value="[#filename#]"/>
<input id="contents_oldvalue" type="hidden"/>

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
      if (result.code != false) {
        $('#status').html(result.status);
      }
      else {
        $('#status').html('<span class="texterror">' + result.status + '</span>');
      }
      $('textarea#contents').val(result.content);
      $('#contents_oldvalue').val(result.content);
    });
  }
}

</script>
EOD;

/*************************** info.html ***************************/
$html_msg = <<<EOD
<div class="info">
<h1>Wedit</h1>
<p>Простой легковесный веб менеджер и редактор файлов.</p>
<h2 class="info">[#header#]</h2>
<div>[#info#]</div>
<hr/>
<p>&copy; <a href="http://iris-crm.ru/wedit" title="Wedit home, about integration with Iris CRM">Iris CRM</a> team</p>
</div>
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
    'Can\'t open the session' => 'Can\'t open the session',
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
    'Can\'t load next files' => 'Can\'t load next files',
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
    'Home' => 'Home',
    'Can\'t create the path' => 'Can\'t create the path',
    'Can\'t create the file' => 'Can\'t create the file',
    'Can\'t rename the file' => 'Can\'t rename the file',
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
    'Can\'t open the session' => 'Невозможно открыть сессию',
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
    'Can\'t load next files' => 'Не удалось загрузить следующие файлы',
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
    'Home' => 'Домой',
    'Can\'t create the path' => 'Невозможно создать каталог',
    'Can\'t create the file' => 'Невозможно создать файл',
    'Can\'t rename the file' => 'Невозможно переименовать файл',
    'Can\'t delete some files' => 'Невозможно удалить некоторые файлы',
    'Download error' => 'Ошибка скачивания файлов',
    'Not found' => 'Не найден',
    'Can\'t download next files' => 'Невозможно скачать следующие файлы',
    'Couldn\'t find Iris CRM files' => 'Не найдены файлы Iris CRM',
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
function filename_decode($name, $encoding = null)
{
  global $settings;
  return iconv($encoding ? $encoding : $settings->filename_encoding, 'utf-8', $name);
}


//Генерируем GUID
function wedit_create_guid() {
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
  $result = true;
  if (is_dir($src)) {
    $result = $result && mkdir($dst);
    $files = scandir($src);
    foreach ($files as $file)
    if ($file != "." && $file != "..") {
      $result = $result && rcopy("$src/$file", "$dst/$file");
    }
  }
  elseif (file_exists($src)) {
    if (!file_exists($dst)) {
      $result = $result && copy($src, $dst);
    }
    else {
      $result = false;
    }
  }
  else {
    $result = false;
  }
  return $result;
}


//Рекурсивное удаление
function runlink($file) {
  $result = true;
  if (is_file($file)) {
    return $result && unlink($file);
  }
  else {
    $objs = scandir($file);
    foreach($objs as $obj) {
      if ($obj != "." && $obj != "..") {
        $result = $result && (is_dir($file.'/'.$obj) ? runlink($file.'/'.$obj) : unlink($file.'/'.$obj));
      }
    }
    return $result && rmdir($file);
  }
  return $result;
}


//Авторизация
function wedit_login($settings, &$info) {
  if ($settings->logintype != '') {
    $info = null;
    if (strtolower($settings->logintype) == 'iris') {
      if (file_exists($settings->iriscrm_path.'/core/engine/applib.php') 
      && file_exists($settings->iriscrm_path.'/core/engine/auth.php')) {
        include_once($settings->iriscrm_path.'/core/engine/applib.php');
        include_once($settings->iriscrm_path.'/core/engine/auth.php');
      }
      else {
        $info = t('Couldn\'t find Iris CRM files');
        return $info == null;
      }
      if (!session_id()) {
        @session_start();
        if (!session_id()) {
          $info = t('Can\'t open the session').'!';
        }
      }
      $path = $_SESSION['INDEX_PATH'];

      if (!$info && !isAuthorised()) {
        $info = t('Don\'t authorised in Iris CRM').' '.
          '<a href="'.$settings->iriscrm_path.'">'.t('Authorise').'</a>.';
      }
      if (!$info && !IsUserInAdminGroup()) {
        $info = t('You must be authorised like admin').' '.
          '<a href="'.$settings->iriscrm_path.'">'.t('Authorise').'</a>.';
      }
    }
    else {
      $info = t('Unknown login type').': '.$settings->logintype;
    }
  }
  return $info == null;
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
if (!wedit_login($settings, $info)) {
  
  $html = str_replace('[#body#]', $html_msg, $html);
  $html = str_replace('[#header#]', t('System message'), $html);
  $html = str_replace('[#info#]', '<p>'.t($info).'</p>', $html);
  echo $html;
  return;
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
  $path .= ($path ? '/' : '<a href="?path=.'.$now_sort_link.'"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEMAAAAUCAYAAADWQYA8AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQDRkRMClwEwAAAy9JREFUWMPt2E2IllUUB/Cfb1LKfEGmlZjaJMakWfZC4iIJNaSSFoWbKAIroUVKtGgRRqibpM1sihI0+hJBIonAapMVBDFWYy2KSotARBfWSH6OY5vzwOn6jvO+o+VIHnjgufeecz/+9/zPOc/D/0euxSGciecUVmaF8U1ONAEv4AEcwWb8MYYPfjtW4DBewnuYimuKs9/S6sQLsTcheik+2zENW4v+l5sFYRxW41jhWpcSCHm/P2MBHkx0+QcYtXPw60P0BkXgU3TjEQyM8fjwF57AdHwcfTfhC/TgtjjfiHIfDhToPo8rgmMTA5Qvx6g37MbNuApzw8OfxYmkswszMWc4ENrxZjHxdzFhG17DaezDklhkDU6OERAG8WIExrvxC4Zi3+3hEd8m/QGsagTEHfihmLw3vGBR8C2PVYt04E78dJGB+D0AqC5tqBjfi8VB+d5ifDuuroC4MbjUh/2hsAV1rMdxfILn8DCejvHD+BH3455k+18/h3AvluH7ETxnY5zrlej7Nc69scoYWdZhbWq/gQ3hco1o9XiMt6f+U3g1stD1WB7gDQZHlyfdM3GTf6ILj2JT8Ls7aoUsB8KDp2FWgz0dxethPyO85a3whDqWFvqrYr2Gsi4h+VQEmSpo1mPDszA7AKhHutpfpLBKrsQHqT2vuK2ycPsovU8tdN+JoFjJMw1uvy+NT8bbqb2ogf6TzaRWeDdQ/SoQ7Yub2xG0eSj6urEn2bVF5oHOeKS2AqwJqcqdlPZU6u6KG69k5zDeWmty7bNkpHJ8RWz4YOTpg1Ha1iJmfB6u+1iyuS7AORaBaXpE8cG47SwT0R8lfmd4XX8cesoo6ovZyX5yrPd10OSGVifLNOlqwW5nsvut8JJ8g/XCTY+kuFXDZ0l3RqFbpsGeBm7fX9BsW2ovOR+ajFaGivehYcakTVXvp8+he6HXbpkmo5GZ+CYO1hYxpQpskwrdjijsTkRw7Elu3TWKtecl+86gRrX2lIsBRvUJraDHcDK3aM8/j3VrDezrrRhflvSZvha3RntO+uHxfhRQzchdkUX+TdkdZXVOlcsu4Jx7xsUHS8dlvzDwN7iX1NWKZQFiAAAAAElFTkSuQmCC" title="'.t('Home').'"></a>').'<a href="?path='.$path_simple.$now_sort_link.'">'.$val.'</a>';
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
        if (!mkdir($new_filename)) {
          $info = '<div class="error">'.
            '<h3>'.t('Can\'t create the path').'</h3>'.
            '<ul><li>'.$_POST['newname'].'</li></ul>'.
            '</div>';
        }
      }
      else {
        if (!touch($new_filename)) {
          $info = '<div class="error">'.
            '<h3>'.t('Can\'t create the file').'</h3>'.
            '<ul><li>'.$_POST['newname'].'</li></ul>'.
            '</div>';
        }
      }
    }
    else {
      $info = '<div class="error">'.
        '<h3>'.t('File already exists').'</h3>'.
        '<ul><li>'.$_POST['newname'].'</li></ul>'.
        '</div>';
    }
    break;

  //Изменение файла (переименование)
  case 'change':
    $old_filename = $current.'/'.filename_encode($_POST['oldname']);
    $change_filename = $current.'/'.filename_encode($_POST['changename']);
    if (!file_exists($change_filename)) {
      if (substr($old_filename, strlen($old_filename)-1, 1) == '.' 
      || substr($change_filename, strlen($change_filename)-1, 1) == '.') {
        break;
      }
      if (!rename($old_filename, $change_filename)) {
        $info = '<div class="error">'.
          '<h3>'.t('Can\'t rename the file').'</h3>'.
          '<ul><li>'.$_POST['oldname'].' &rarr; '.$_POST['changename'].'</li></ul>'.
          '</div>';
      }
    }
    else {
      $info = '<div class="error">'.
        '<h3>'.t('File already exists').'</h3>'.
        '<ul><li>'.$_POST['changename'].'</li></ul>'.
        '</div>';
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
        if (!runlink($filename)) {
          $info = '<div class="error">'.
            '<h3>'.t('Can\'t delete some files').'</h3>'.
            '</div>';
        }
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
      $info = $info ? '<div class="error"><h3>'.t('Can\'t load next files').'</h3><ul>'.$info.'</ul></div>' : $info;
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
      $tmpfilename = $tmp.'/'.wedit_create_guid().'.zip';
      $zip = new ZipArchiveDir();
      $zip->open($tmpfilename, ZIPARCHIVE::CREATE);
      $zip->addDir($filename, filename_encode(filename_decode($basename), $settings->filename_encoding_zip));
      $zip->close();
      file_download($tmpfilename, $basename.'.zip');
      unlink($tmpfilename);
    }
    //Скачивание нескольких файлов/каталогов - кладём их в zip
    elseif ($_POST['filelist']) {
      $tmp = str_replace('\\', '/', realpath(ini_get('upload_tmp_dir')));
      $tmpfilename = $tmp.'/'.wedit_create_guid().'.zip';
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
        else {
          //$info .= '<li>'.$filename.' ('.t('Not found').')</li>';
        }
      }
      //$info = $info ? '<div class="error"><h3>'.t('Can\'t download next files').'</h3><ul>'.$info.'</ul></div>' : $info;
      $zip->close();
      file_download($tmpfilename);
      unlink($tmpfilename);
    }
    else {
      $info = '<div class="error">'.
        '<h3>'.t('Download error').'</h3>'.
        '</div>';
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
      if (!file_exists($copyname)) {
        if (!mkdir($copyname)) {
          $info = '<div class="error">'.
            '<h3>'.t('Can\'t create the path').'</h3>'.
            '<ul><li>'.$_POST['copyname'].'</li></ul>'.
            '</div>';
        }
      }
    }
    foreach($filenames as $name) {
      $filename = $current.'/'.filename_encode($name);
      if (count($filenames) > 1) {
        if (!rcopy($filename, $copyname.'/'.filename_encode($name))) {
          $info .= '<ul><li>'.$name.' &rarr; '.$_POST['copyname'].'/'.$name.'</li></ul>';
        }
      }
      else {
        if (!file_exists($copyname)) {
          if (!rcopy($filename, $copyname)) {
            $info .= '<ul><li>'.$name.' &rarr; '.$_POST['copyname'].'</li></ul>';
          }
        }
        else {
          $info .= '<ul><li>'.$_POST['copyname'].' ('.t('File already exists').')</li></ul>';
        }
      }
    }
    $info = $info ? '<div class="error">'.
      '<h3>'.t('Can\'t copy').'</h3>'.
      $info.
      '</div>' : $info;
    
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

//Авторизация
if (wedit_login($settings, $info)) {

  switch ($operation) {

    //Открытие файла
    case 'load':
      $result['content'] = file_get_contents(filename_encode($_POST['filename']));
      $encoding = $_POST['encoding'];
      if (!$encoding) {
        $encoding = detect_encoding($result['content']);
        if ($encoding == 'unknown') {
          $encoding = $settings->default_encoding;
        }
      }
      if ($encoding && $encoding != 'utf-8') {
        $result['content'] = iconv($encoding, 'utf-8', $result['content']);
      }
      $result['status'] = t('Loaded');
      $result['encoding'] = $encoding;
      $result['code'] = $result['content'] != false;
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
}
else {
  $result['code'] = false;
  $result['status'] = t('Don\'t authorised in Iris CRM');
}

echo $json->encode($result);
return;




}
?>