## В проекте использовуется redis в качестве базы данных для кеширования

``` 
 Для развертывание проекта выполните следующие команды по порядку
 
 
 docker-compose build
 docker-compose up -d
 docker exec php-test composer install
 docker exec php-test php artisan migrate
 docker exec php-test php artisan db:seed
```
```azure
    Выберите любой хост для тестирования API из списка (далее {url})


    http://172.16.238.10:80
    http://172.16.238.9:80
    http://localhost:8088
    http://localhost:8080
    http://127.0.0.1:8088
    http://127.0.0.1:8080
```
```apacheconf
    Эндпоинты без авторизации
    
    [POST] {url}/login - Авторизация
    [POST] {url}/registration - регистрация
    [POST] {url}/restore_password - сброс пароля
```

## 
```apacheconf
    Эндпоинты с авторизацией по токену полученому через эндпоинт авторизации

    [GET] {url}/users/{id} - просмотр пользователя
    [PUT] {url}/users/{id} - обновление данных пользователя
    [DELETE] {url}/users/{id} - удаление пользователя
```

## На все эндпоинты с авторизацией, в запросе необходимо отправлять параметр token, полученый через эндпоинт авторизации, как query_string


```bigquery
Для авторизации необходимо отправить json методом POST в теле которого лежит объект на url {url}/api/login
```

```json 
Пример
{
  "email": "<указать имейл использовавшийся при регистрации>",
  "password": "указать пароль."
}
```
```bigquery
Для регистрации необходимо отправить json методом POST в теле которого лежит объект на url {url}/api/registration
```

```json 
Пример
    {
        "name": "указать имя",
        "email": "<указать имейл использовавшийся при регистрации>",
        "password": "указать пароль.",
        "repeat_password": "повторить пароль."
    }
```
```bigquery
Для восстановления пароля необходимо отправить json методом POST в теле которого лежит объект на url {url}/api/restore_password
```

```json 
Пример
    {
        "email": "<указать имейл использовавшийся при регистрации>",
    }
```