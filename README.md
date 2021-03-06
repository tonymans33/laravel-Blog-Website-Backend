# What is it?

This is a Blog website backend 

A website with posts and comments and rating answers, open and close posts you you will find the main functions in **App/Http/Controllers/API**

And you will find the models "classes" and it's own relation in **App/Models/Blog**

You will find all the apis in **routes/api.php**


## how to use the code:

- Download the code 
- Run **composer install** inside code directory 
- Run **php artisan jwt:secret**
- You will find a .env hidden file --> you will have to update it👇:
    - Database username
    - Database password
    - Database name

- Run **php artisan migrate --seed** in your code directory 
- Run **php artisan serve**
- Install postman if you haven't it's an **API testing tool**
    - In api doc you will find some routes that dosen't require auth then you can type the api directly in postman and see the result
    - In auth require case you will have to user login api first 
    - Put the jwt token key in each api **Headers -> Key = Authorization , Value = Bearer + {your token}**
    - Some apies requires params you will have to enter the name of the param and the value for each one 

- Test apis and see the output you can create, show, edit, delete for posts and comments you will find all apis in **Api-doc/api-doc.xlsx**




<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
