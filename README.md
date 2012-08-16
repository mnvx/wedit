Wedit
=====

Простой легковесный веб менеджер и редактор файлов.

Домашняя страничка: [Wedit](http://iris-crm.ru/wedit).

Скриншоты
---------
Менеджер файлов:

![File browser](http://storage8.static.itmages.ru/i/12/0816/h_1345134156_6989463_23492a6956.png)

Редактирование файла:

![Edit file](http://storage1.static.itmages.ru/i/12/0816/h_1345134169_7515233_d6fd958ebd.png)

Основные функции
----------------
 * Просмотр файлов и каталогов.
 * Загрузка файлов.
 * Скачивание файлов и каталогов (автоматическое сжатие в zip).
 * Создание файлов.
 * Копирование файлов.
 * Переименование файлов.
 * Удаление файлов.
 * Редактирование текстовых файлов.
 * Автоматическое определение кодировки файлов.
 * Управление кодировками файлов.
 * Интеграция с [Iris CRM](http://iris-crm.ru).

Лицензия
--------
MIT (см. `license.txt`).

Установка
---------
Просто скопируйте каталог wedit в каталог Вашего веб-проекта.
После этого откройте ссылку вида `http://yourproject/wedit/wedit.php`.
При необходимости измените настройки, они находятся в самом начале файла `wedit.php`.

Доступные настройки
-----
Настройки находятся в файле `settings.php` или в начале файла `wedit.php` в запакованном варианте.
 * `root_path` - Каталог, который будет отображаться как корневой, за его пределы выйти нельзя, по умолчанию задаётся относительно каталога, в котором находится Wedit.
 * `filename_encoding` - Кодировка имён файлов в фаловой системе.
 * `filename_encoding_zip` - Кодировка имён файлов в zip архивах.
 * `default_encoding` - Кодировка содержимого файлов по умолчанию (когда не удаётся определить автоматически).
 * `language` - Язык (`ru`, `en`).
 * `logintype` - Способ логина ('Iris' - интгеграция с [Iris CRM](http://iris-crm.ru); Если не задан, то логин не требуется, авторизацию необходимо настраивать, например, средствами веб сервера.

Для логина средствами веб сервера создайте в каталоге `wedit` файл `.htaccess` со следующим содержимым.

```
AuthType Basic
AuthName "Enter login and password"
AuthUserFile "/полный_путь/htpasswd"
Require valid-user
```

И файл `htpasswd` со следующим содержимым.

```
имя_пользователя:хеш_пароля
```

Хеш пароля можно сгенерировать с помощью утилиты `htpasswd.exe`.



Wedit
=====

Simple lightweight web file browser and editor.

Home page: [Wedit](http://iris-crm.ru/wedit).

Screenshots
-----------
Browse files:

![File browser](http://storage5.static.itmages.ru/i/12/0815/h_1345021737_8924627_4bbb7cdcce.png)

Edit file:

![Edit file](http://storage6.static.itmages.ru/i/12/0815/h_1345021754_9051636_b3cd481d93.png)

Main functions
--------------
 * Browse server file system up to specified path.
 * Upload files.
 * Download files and folders.
 * Create files.
 * Copy files.
 * Rename files.
 * Delete files.
 * Edit text files.
 * Manipulate with encoding of files.
 * Integration with Iris CRM, http://iris-crm.ru.

License
-------
MIT (see `license.txt`).

Installation
------------
Just copy wedit folder into catalog of your web project.
Whan open url `http://your_project/wedit/index.php`.
See `settings.php` or begin of file `wedit.php` for setings.