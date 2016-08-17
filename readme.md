My Personal Blog %)
===================

Код проекта будет вам интересен, если вы ищите проекты, которые содержат:

### Сервер

- Laravel 5.1 LTS
- PHP 7.0+
- Whoops интеграцию
- Использование Twig в Laravel
- Относительно грамотное использование паттерна Repository
- Проект, использующий SleepingOwlAdmin
- Uuid primary keys в Eloquent
- Использование Enum в PHP
- Использование контрактного программирования (Design by Contract)
- Alice фикстурки (database/fixtures/*)
- ~~Генератор моделей по Propel-like схемам (database/schema/* и app/Domains/Base/*)~~

### Клиент

- ~~WebGL (OpenGL ES 2.0)~~ Убрано к чертям, я рукожоп и не умею его оптимизить
- MVVM паттерн поверх KnockoutJS
- Babel EcmaScript 2016 (ES7)
- Sass и всякие плюшки оного

_И многое другое..._

## Установка (ну мало ли кому взбредёт в голову)

- Удостовериться в наличии php 7.0+
- `git clone git@github.com:SerafimArts/SerafimArts.git`
- `php -r "copy('.env.example', '.env');"`
- Настроить `app/config/database.php` (См. мануал по ларке)
- `php artisan key:generate`
- `php artisan migrate`
- `php artisan db:fixtures`
