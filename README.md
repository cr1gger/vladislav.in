<p align="center">
        <img src="https://sun9-67.userapi.com/impg/_KsTDHTT4ncA_x4yPrl78aoyPHzL_irpUcTuJQ/i0UsnX21COw.jpg?size=722x348&quality=96&sign=9e029b9cc3a6c2543cb4876aea40e3ab&type=album" height="100px">
    <h1 align="center">Админ панель vladislav.in</h1>
</p>

# Установка через докер
1. Скопировать файл `.env.example` в файл `.env`
2. Если разворачиваете проект на проде, то изменить в `.env` пароль от базы данных в `MYSQL_PASSWORD`
   * Изменить домен, на котором будет запускаться проект: `DOMAIN_NAME`
     * Если запускается на локальной машине, то внести домен в `hosts`
   * Настроить окружение `YII_ENV` и `YII_DEBUG`
   * Если нужно, изменить секретный ключ для генерации токенов пользователя: `USER_TOKEN_SECRET_KEY`
3. Выдать права на папки и файлы:
   * `chmod -R 776 runtime/`
   * `chmod -R 776 web/assets`
   * `chmod -R +x docker/migration/migrate.sh`
4. Запустить: `docker compose up -d`

# Запуск без докера
1. Установить PHP 7.4, MySQL, сервер
2. Скопировать файл `.env.example` в файл `.env` и отредактировать его (настройка базы данных)
3. Запустить: `composer build-project`

# Создание супер-пользователя
`php yii control/user/create-root` - создается с логином и паролем `root`

# Создание пользователя
`php yii control/user/create admin admin12345`
