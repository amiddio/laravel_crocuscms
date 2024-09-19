# CrocusCMS

## Описание

CrocusCMS каркас на основе фреймворка Laravel для разработки многоязычных веб сайтов. Включает в себя Админ Панель с закрытым доступом и Access Control List (ACL).

## Стек технологий

Docker, Apache2, PHP 8.1, Laravel 10, MySql 8, Redis, Node.js, Npm, Tailwindcss

## Сторонние пакеты

* barryvdh/laravel-debugbar
* barryvdh/laravel-ide-helper
* astrotomic/laravel-translatable

## Описание функционала и модулей

### Admin

Создана модель Admin по образу и подобию идущей из коробки User. 
Она используется для доступа в Admin Panel (далее AP).

В AP существует модуль для CRUD операций над админами.

### Admin ACL

Разработан функционал для разграничения прав доступа админам, на основе Role и Permission. 

При запуске проекта создается уже одна роль "Administrator". 
Админы, которые принадлежат этой роли, имеют неограниченный доступ к AP.

В AP существует модуль для CRUD операций над ролями. 

Разграничение прав доступа в AP основан на методах запроса и роутах админ панели. 
Для каждой роли мы указываем какие методы и роуты разрешены. 
Следовательно, все админы связанные с этой ролью получат ее ограничения.

В AP реализован модуль для установки ограничений ролям.

### Консольные команды

Реализованы четыре консольные команды (как альтернатива веб интерфейсу в АР) для работы с админами:

* admin:create - создает админа, пароль для него и назначает роль
* admin:active - включить/отключить админа
* admin:password - поменять пароль админу
* admin:role - поменять роль админу

### Модуль Pages

Модуль для статичных страниц. 
Имеется необходимый CRUD функционал в AP.

### Screenshots

![Screenshot_1](/screenshots/Screenshot_1.png)
![Screenshot_2](/screenshots/Screenshot_2.png)
![Screenshot_3](/screenshots/Screenshot_3.png)
![Screenshot_4](/screenshots/Screenshot_4.png)
![Screenshot_5](/screenshots/Screenshot_5.png)
![Screenshot_6](/screenshots/Screenshot_6.png)
![Screenshot_7](/screenshots/Screenshot_7.png)
![Screenshot_8](/screenshots/Screenshot_8.png)
![Screenshot_9](/screenshots/Screenshot_9.png)
![Screenshot_10](/screenshots/Screenshot_10.png)
