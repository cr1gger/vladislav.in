<p align="center">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    <h1 align="center">Админ панель vladislav.in</h1>

</p>

#Установка 
1. `cp config/db.example.php config/db.php`
1. `composer install`
2. `php yii migrate && php yii migrate-control`

#Создание пользователя
`php yii control/user/create admin admin12345`
