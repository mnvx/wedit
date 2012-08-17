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

if (!is_dir('wedit')) {
  mkdir('wedit');
}
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
$style = str_replace('img/cancel.png', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAYAAAAe2bNZAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQDQ4CsRS1WwAAAbRJREFUWMPN2MFLFVEUx/GPF0WtNiHme+SqRRS1khatSp7154SrNi0MChcF/RP1H7iJIBFcFVGkheCiRdEiRbPCXpJSbe6APGyamebNzIHfauCe75w7957zmwH5YgjTmMFlnEEbg9jBAdbwAk+wjJ9KjjbuYRu/c2gTDzBZBsQw5vA9J0Sv9jAf1ysUF7D6nxC9WsHZvCBX8aVkkERf43eXGaTbJ5BEXXT+BXIO3/oMcrhCF9M+1tWKQBK9xehRMPMVgyS62wvSwo+aYHZxCkKEmcWIeuI4bhy+4jdrqkqijcjhes0giTohy3mvKK4FXGoIzBS8TyndQskJF1JyvQsYa0hlxsPfbsAaYjTEptWE6A7iM06kjJknS0w4lPJsW5xVm3DPPA541ZBtehmw2BCYp0mz/FjzFn1ACPiFRzVX5WHkABMVzL1p88x4L92tmmBuHlWqEbypGOR1mrE7H6f2KkB2shi6TrSj/QTZy2PkpguY/KzawpW8x20Sz0sGeYbThds67pRgY7q4XZYDaeN+ARexEf/rtLIkGSgwAnTink/F09DCsfj2n7Aem+8ylrCfdfE/NG1isY5Eb14AAAAASUVORK5CYII=', $style);
$style = str_replace('img/ok.png', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAYAAAAe2bNZAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQDQ0xJemHjgAAAYpJREFUWMPt17FKXEEUxvHfbjSBCCKCkBRJ1EoFLRSsUiSQJkjS2KWwDCpYivgEWqiPYGGtvWAjiPgAK1HSpLDYwiYmmCBG1+YKy3Lv3V1d79yAH0wxw8zwnzlnON/wqP9AT1q4VwETGMAPXIc82CoqUdtDV0iYvSqYCjbyBHONwWY2KD4gXAEfQ8HE7fUyBMwQxmPGKyFgVtAWM17OOnE/1SRudXufJchTfEsAuUJnljCLKbdSvsvz68VmypwlbMWM9+EQzxPW/cMk/tRhuMR+NF87LlJOOJ0QnoOUNc22HRTaIrJjjDRQVNfxBv141cJwf0Df7XMsNQBTxNQD5d4V/harYELpF76inAeY+Sj88gAzU1sOTvAzEMyzuNoU4nbOMJsHmHO8w24eYDqwlmQhQoSpJwnmsFkzdE+dYi4J5ix6VVmoFBXo3TSnl1WohvG2nu0s1Sn1r7GM3y0A6q834UuDFqIbC/h+R8twGvdzKNT0X+BzzOfsKMWcjWG0iRupYDvD/HxUa3UDaw+Endfc03oAAAAASUVORK5CYII=', $style);
$style = str_replace('img/ok.png', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAYAAAAe2bNZAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQDQ0xJemHjgAAAYpJREFUWMPt17FKXEEUxvHfbjSBCCKCkBRJ1EoFLRSsUiSQJkjS2KWwDCpYivgEWqiPYGGtvWAjiPgAK1HSpLDYwiYmmCBG1+YKy3Lv3V1d79yAH0wxw8zwnzlnON/wqP9AT1q4VwETGMAPXIc82CoqUdtDV0iYvSqYCjbyBHONwWY2KD4gXAEfQ8HE7fUyBMwQxmPGKyFgVtAWM17OOnE/1SRudXufJchTfEsAuUJnljCLKbdSvsvz68VmypwlbMWM9+EQzxPW/cMk/tRhuMR+NF87LlJOOJ0QnoOUNc22HRTaIrJjjDRQVNfxBv141cJwf0Df7XMsNQBTxNQD5d4V/harYELpF76inAeY+Sj88gAzU1sOTvAzEMyzuNoU4nbOMJsHmHO8w24eYDqwlmQhQoSpJwnmsFkzdE+dYi4J5ix6VVmoFBXo3TSnl1WohvG2nu0s1Sn1r7GM3y0A6q834UuDFqIbC/h+R8twGvdzKNT0X+BzzOfsKMWcjWG0iRupYDvD/HxUa3UDaw+Endfc03oAAAAASUVORK5CYII=', $style);
$style = str_replace('img/reload.png', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAYAAAAe2bNZAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQDQICHaH6VwAAAjFJREFUWMPF2MtqFUEQxvFfJF4TwRskSBAUowFxIYILwQshbsQY0QcQ30FElCiKeMEncOFGEN/AhQYEBRVFUBBFyC4BIWCSE02Mtxw3fcIw5MzNmeMHvRimuurfzXRV9bTJp+XoxwHsxQ6sj7yfwie8wTM8wa+Mvo9lhejGLUygnmNM4DY2p/gfxHwaxGpcwVxOiPiYx2WsWCLGcfzAQhLILrz/R4j4eIu+SIyhAFJPghnATMkgjTGDwzGQpjD9YVvrFY65GMiSMH2oVQzSbCy0RUBW4RV2Zzhd03iIRxgLC1iHHhzB0diRz6J69OFSBvppXEBHiuM1GMbXPDvTmNyF2RTjD9iec7V9GM0Lcz3F8GOBbW/oTB6YdnxOMKqhtyDIiSVOTSLMQIrRcEGQk/iZ95u5kWAwhc4CIKdygizCjCQY3CsAchq/i+SZ9pTvYSQnSBf24W6BRdThWwLtQS3UspB5m2my1TDfE95vajVM0uq3VBBzD+6E2nYzdJGLepzwzdwvGWQw9MTRGJPY2jCoIs80K57jTeI8iHZ1VWTguM4mxBhvGFVZmxraltLGvosaV1m1N4ZgSf6vxTNnFf1Mb4YbRg0b4hPL7PQ6cD5jP32xManMHrgTO8PVdwhrM/h5jf2hsPqft4PpAJ+oVtybZsMOZtIhfKkIZCrktlzqwcuSQZ4Hv4VU1l+IGs5hZRmpvOj/mTFcDXksVW0l/LnqDkVwMpSV0ZAiXuAp/mR1/hcNHD78BVU4kQAAAABJRU5ErkJggg==', $style);
$style = str_replace('img/rename.png', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACMAAAAjCAYAAAAe2bNZAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQDDs5o+z0/gAAAU5JREFUWMPt2E0rRFEYAOBnJtla2FtZmbJS8gPI50Ip+QNKFmKn/AjJwgIbCxTWSjY+llYWs7C0YaGkNBgZm3trmsY1dD9o5q230+ne7vv0nm73nkN6kcM8irjHKXplEG3YRaUmXzGRNmSvDiR1UA4FPEdgKsH17iQheWziDGMNgHaShoSFGgFdpwEJ8xzjEaCjtCBhXnwBekdfmpBq0CCegvkbprKAhHmJITzEDclh7QeQME/QEXdHtn4BeQnerhbkT0JGW5CmgWz/d8hIC9IUEFj/BaQcx9c3XzMfw+0Pn1HGDA7i7Eg7HrGPOXw00JFSEksDw1VF9rH4DSgxCGzUFIsCJQrJ465O0XqgUtDFxGIgYjn2sBSAEoW0BeNkxD3TwbiMGxwnvScuRnTmI/ib70ljc174AnCBWXSmeWSxUoW4wgK6ZBSHWEW/jOMTwvV0pZHuejYAAAAASUVORK5CYII=', $style);
$style = str_replace('img/delete.png', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQDC8veZaW+gAAAwJJREFUaN7t2NuLlVUYx/HPqBmdhrCmM1hEilQXgtVFkZ1vIoLKoAS7T4UuIoQgISL6B7wXpYuwEbSwMAii8UwjTSfDjESrEZ2SjlPOzO7m98JiIzKN2/3u2ewHXta7116n77vWep7fWvSsZz3r2WyzJ3EMjf/5nMbrnQQyE4jyeaVTQMbPE2QKq7oBpIF/8XA3gFR75o5uAGnge1xbB0RfQC5uYZvf4Yc2MvyMty4ESB12qFtAzOmWqN41IPMuULs/4kOM4GjizA24DY9iaRxNx7rfg3hkGn0uxGZMtqrvVm32Bl7Dm5Es0I/luBnzMYo9iTWV3Y93MdAJMzKBZ4v2bseWc7T7GZ4pltYtONKCWTlvkBcLiLUBm069bbg89Rbh1zpBthUQrxb5J/A1jmeAY8k7hJNFuV24JPVfqAtkPMuiOpxNJb/aB0ciJJvrfB5vVuVtLOTSUB0ggxnARThc5H+J7ViftJyBj7A6gx8uzjPL0tZzdYCsTOdP5PeBpF9lsDdhRQHzAe7FguylocxcOSv9+KfdIAvT+YamODKOtzPoCmY97sbcuOSt+An7Um+02GsH2gkymSUly6XK/7t434JbU2Z+0rvwMf4ollVV/sqU2ToTkJlqrd9xJu9XFfmj1dfB43gaV0SiDOABXI/LirNLZVcnHWunaOwv1EDZ8Yki0H2CT/Fnyk/G/R7GqQBfWtQ9lXSgnSB9uC7v3xb59+CXCMY3sD97ZVWW2cForP34LUuxmsnTeb+x3TL+oaTvJd2VdBjvYC/uwxq8jJfiIEayoY8WwXB7sUyXtltrDRYfY7jpvxE8iJ3Fxm4EcAU2FW72DBbXGUcmIhDhsbNI8kF8U3inifS1O/KlKrchbcxN1K9da607R7l9+CLBsoz0Q4XTqE1rVc+6FqjfZfirbpCOOI/UfUJcHuiOOCE2mpTvU9O41LgzAFOddmZvtjG8H7dc3qIsilpeMhvufmu7oJvsgvu5qTnY0QUgO/uyrJ7HNbMUYiwHuZ71rGc9m0X2HxbnK0GzXnnKAAAAAElFTkSuQmCC', $style);
$style = str_replace('img/create.png', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQCzYES2XQJwAAAnVJREFUaN7tmDtoFEEYx39JfCCGKIgGRIhCDIixEFNZJOALi4ggIphCe1HsJCBYWIiVlVY2glglEeKLoKUnCmKCYiH4wBDUFJ4JFhLlbtfmPzAs3OUyu7ezt+wfhhlmv29m/8w332OgQIECBVoNx4E5IFxhWwSuZomICwm7XcoKkaWYRALgTB6IhMA/4GAeiJg7058HIiHwBej2QaJNRNYmuOYn4GuKHH4A15tBxAc+5IUI7XmJ6rkhsqpJ634DpoB3wKzizFZgJ3AY2CtHk1n3OwMcamDPHuAuUE1q76QuewhcAa4pZQHoAoaA7cAaYB54qVhjMAiMA5uzcCIV4JS13m5grM66b4CTlmntAD4ncCqxiZyzSFwQsUb0JoFO6fUBCz6JTFokLjvovwDWSf+sLyJLMgtTnAU15IblAF7V+H7HSpdKPohM6AdWAx/ryK2X3KM69cyAZE67EokTEO+rPwr0xkxcz2v8WDEn1chesojEhVnjt4JoapE9AL5bHsdgHngQka2on1LEN+gH9mvcDWxUcTZnmVrT48iipT9tzT9fwb4XI2sa87ztckdcT6RL2cBfoGzNdwL7IrIzOsFeYIM1vy0i91O9c5R39Vo90r+5jNxyXitUlWfwOm2vdUD9wwQuu7lXm5QZp+q1htU/k/m4ogLc0PgI0JG2aVWUIJofqDqa1i197wDeZiHXGq0hswD8UqCLfitZJYS3XMu00QSy3wHgj28imahHfFeIQyKdiQrRbu+BEw2kPntEIMhazR5FWV5qOvKK0gccA3a1wtuvtwe6ag7e54J24EkOiDxtk1mNAFtalEQZuEeBAgUKtBT+A7DlzD4JGZj1AAAAAElFTkSuQmCC', $style);
$style = str_replace('img/save.png', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQCyMb8dg7xgAAAYNJREFUWMPt2D1LHUEUh/HfvfiCJhBExEIwxiaFAYuIjTZqIaRKY2pRSBn8CCnSCIKFRYoUJkVKUQsVCy0FWxElsREVEQRBJCB54aYZ4SKil7urO8IeGHZn9+yfZ2fOnDO7RG4F1GE3QrZZfKoJkJ04xQJKVQo2YSRFwGaoKbuwgvcJRf9c00xsxbLzUowxWIx9keSAOWBGdoifMQPO4/N1wCcJRRtTfOEeDF116kMOjK1NP4pFklZZ+o11HITa3ovutCCTTvEaXtygO4zjpFOcFHDpjlnowElWMXiOUfy9xWcfH7JK1IthD3mXzeEsC8CtCv3+YTsLwMI9+aYGWGkaqcVTtODLQwK+RWsFfu/wHK/D8UHzYNRpBt5g9ZZEvVHhKN9rqRvED2xiL3xn9+BlTLW4Fv2h5Vv+am0KDejCUWyAJXzEJXbCf5XoAH+V9S/yGMwBc8BHBlhEW1m/PcYR/IY+jGE8LdFCqKPfq3x+Bq8wcMO9S0xgEs+q0F7G19hD0H+9k69p4yz7RwAAAABJRU5ErkJggg==', $style);
$style = str_replace('img/copy.png', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADMAAAAuCAYAAACF6SFvAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQCwocK/oxjgAAATxJREFUaN7tmL9Kw1AUxn+2QShtAp2ETF07FTp08T269SEcfY4u4u5g17yALiXtWuhaKDh00ioiDkaXCCEojddz86/ng7vc4dz8ku98994AXADPwKfheAWmlEQv/wBJDr9okAbQEarlFQ1zEr9VCc2AJwvPGAF3wG2eMDb1AbSB90M2q4KawGmWnqmNnF/mAyCMP69JqAyAcWzjXJWO2ECo7pVQ5H8P18RmoRDMogw2i4RqvwGPwg76s80uqxoAtUqzo4jmtHxgAnQN19kDN8A272j+qWfWAtG6se2ELMVdoC+wVg84K9pmkrt4D2hZOlk/ODn36Nxi7WWd0myk+4zCKIzCKIzCKMyxwuzqdDk7B4aJuVVVYbIc7734pqg9ozAKozAKozAKozAKUzxMVBGWKOt/5OvUybqMuv8CWq90jlN1HdoAAAAASUVORK5CYII=', $style);
$style = str_replace('img/download.png', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAAhCAYAAACFtMg3AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQCjk3cu/HyQAAAjtJREFUWMPl2b1rFGEQx/HPrSeCihZioUFFURGDIEbtggpiEARfSuMfoI0BBRGxUkF8SS8WQVsVhaTQNBELIWghAW0lIKTQiIIEY+IlFnlWjsBdLpt94t35g4G9ZXdnvvvszs7MFcTTRnTgcNhuwUr8xFe8wyAehd8Nqzb0Y7pGG8cDbGg00OUh8Kl5wJbbGC4haQTYLRjKCDrbBrCqnmFb8Ckn2NReh/e97rQaH3KGTa0PhbwDXrLA8+/gWKSbuR1f8LZsX4LN2IO94VVagYmQ/aNqFyYjrW5q37AW7SEhfq9w3G+8Qld46qKoNzJsaqMZjr+IZXknqtIiAWe1ofD456KuOodNbQSteQA/bhDgaQyHPPA362XR1gaqADehJ+vJS8Mn4ccC73rpH+SAo/MB3Y2HVT4LtVh3let3LwLwexSKc4AWcRMXGqWor6JWtBXngH2C45pHJ6qt2t0mg4X2SsAHcF7zaX1SoQO6HqNTqQOtS2aB3sPnUKw3oyaKZbXxS2zT3BpJQjZ++h/AwscEndjv/1B/EWciXXwUz0KVw8wMupIGcT9sF3AKayLE1MfMEDxGKTeQMdMXQj7JO57e1MGviPXrrQzAtyPEMYkdqYPhyEX75XnAXokUw7VyJz2RgadwtgbYcxHHvcns1i92b1rC6SqwnZFieKHCvxg3FqEfnazQjJyMMO4thZl5xbl7EqBjr/Q4jpT57Qj78vTxPDy1NWlfqLrGIkKP4SAO5eRnFG9wFTvnAvwDxggI54mo3/oAAAAASUVORK5CYII=', $style);
$style = str_replace('img/upload.png', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAAhCAYAAACFtMg3AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQCjYGpKnbPAAAAkZJREFUWMPl2U+ITlEYx/HPXCOFWFlNiLDRlJiFjVAyTZQsbFC2ZDELJYQslPyZkhUbsaWQsTCl0SilLMwUJUqiWDDI32FmXjbn6vY272ved+693jvzq6f7/z7ne849z3nOuU2y0wK0Y0PYb8Fs/MAgHuEBroTjwmoVevB7nDaES5hfNNCZoeClGmCT9g37ERUBdjEG6gQtt17MaWTYFrxOCTa2+6G/N5zm4knKsLF1oyntAk+b4POnsTmjylyGd3iYOBdhEVaiLXSlWfgVon+masVwRq0b20fMw5oQED9VuG8EfegMX10mupkxbGzv67h/H2akHahGcwKu1wbC55+KOhscNrY3WJ4G8NWCAP/GyxAH/ka9erSkQBngQlys9+HpYUj4MsFaH/0PMaCjFtAVuFxlWKg1Z16H9WE/L+DH40lkmkNykVZrDGFj4v3t4Vxe0G3/gr2RorNhbBnDz9YcEpjYjlcDPpuio1Fsr+JrR059uq9SAdZOYF5bbiXsHkec2JMD8PNKM6B7KTo5UENwPJQx8Ndy0PP4maKDk3UMfacyBP6QzI2fpfzy3jrns024m9XQ1Byi8TUszWD6eCE4gjshJR1L28LqZgzcmlHW9QJ25TQkdFUpSFdOZdgbYaepo+4o5MZTAhavokZdHUxZI2HNW4S3UwD4BJ7GwL2THPYWjiUXAM6F9G8yqifk6aUkcH9o8smkEs5gEz6XTwHhaNgeVJCfWVV0O3D0j3UxStTIYazGdXwvEOBg+DtxJKxQdlSChT9jXhi1faAJGAAAAABJRU5ErkJggg==', $style);
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
$index_php = str_replace('img/home.png', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEMAAAAUCAYAAADWQYA8AAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAA3XAAAN1wFCKJt4AAAAB3RJTUUH3AgQDRkRMClwEwAAAy9JREFUWMPt2E2IllUUB/Cfb1LKfEGmlZjaJMakWfZC4iIJNaSSFoWbKAIroUVKtGgRRqibpM1sihI0+hJBIonAapMVBDFWYy2KSotARBfWSH6OY5vzwOn6jvO+o+VIHnjgufeecz/+9/zPOc/D/0euxSGciecUVmaF8U1ONAEv4AEcwWb8MYYPfjtW4DBewnuYimuKs9/S6sQLsTcheik+2zENW4v+l5sFYRxW41jhWpcSCHm/P2MBHkx0+QcYtXPw60P0BkXgU3TjEQyM8fjwF57AdHwcfTfhC/TgtjjfiHIfDhToPo8rgmMTA5Qvx6g37MbNuApzw8OfxYmkswszMWc4ENrxZjHxdzFhG17DaezDklhkDU6OERAG8WIExrvxC4Zi3+3hEd8m/QGsagTEHfihmLw3vGBR8C2PVYt04E78dJGB+D0AqC5tqBjfi8VB+d5ifDuuroC4MbjUh/2hsAV1rMdxfILn8DCejvHD+BH3455k+18/h3AvluH7ETxnY5zrlej7Nc69scoYWdZhbWq/gQ3hco1o9XiMt6f+U3g1stD1WB7gDQZHlyfdM3GTf6ILj2JT8Ls7aoUsB8KDp2FWgz0dxethPyO85a3whDqWFvqrYr2Gsi4h+VQEmSpo1mPDszA7AKhHutpfpLBKrsQHqT2vuK2ycPsovU8tdN+JoFjJMw1uvy+NT8bbqb2ogf6TzaRWeDdQ/SoQ7Yub2xG0eSj6urEn2bVF5oHOeKS2AqwJqcqdlPZU6u6KG69k5zDeWmty7bNkpHJ8RWz4YOTpg1Ha1iJmfB6u+1iyuS7AORaBaXpE8cG47SwT0R8lfmd4XX8cesoo6ovZyX5yrPd10OSGVifLNOlqwW5nsvut8JJ8g/XCTY+kuFXDZ0l3RqFbpsGeBm7fX9BsW2ovOR+ajFaGivehYcakTVXvp8+he6HXbpkmo5GZ+CYO1hYxpQpskwrdjijsTkRw7Elu3TWKtecl+86gRrX2lIsBRvUJraDHcDK3aM8/j3VrDezrrRhflvSZvha3RntO+uHxfhRQzchdkUX+TdkdZXVOlcsu4Jx7xsUHS8dlvzDwN7iX1NWKZQFiAAAAAElFTkSuQmCC', $index_php);

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
function line($line = '')
{
  return $line."\n\r";
}

?>