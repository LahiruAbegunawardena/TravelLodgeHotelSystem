----------------------------------------------------------------------------------------
-----------------------                                          -----------------------
-----------------------   Travel Lodge Hotel Management System   -----------------------
-----------------------                                          -----------------------
----------------------------------------------------------------------------------------

--------------------------------   Project Initiation   --------------------------------

    1). composer update
    2). npm install
    3). create .env file and set values
    4). php artisan key:generate
    5). php artisan migrate
    6). php artisan db:seed (admin db table)
    7). php artisan jwt:secret
    8). php artisan serve --port=8100

----------------------------------------------------------------------------------------

Admin registered through seed. (email:- admin@gmail.com pwd: admn1234).
I didn't implememnt seperate admin registration. You can add more through seed.

Customer can register via -> http://localhost:8100/api/customer/register api.



------------------------------------- Admin  Panel -------------------------------------

    -------- Hotel Management --------

    1. Add your hotel details
    2. Add room details.
    3. View Reservations for each hotel room
    4. If(no_of_rooms > 0 in selected hotel)
        Check If there is available Room in given date range
    5. Reserve from above list of rooms at hotel desk 

    -------- Customers Management --------
    1. View Registered customers
    2. View reservations done by customers

    -------- Invoice Management --------
    1. Invoice details and setlle them

    Assumptions
        1. There are only 2 kinds of bedrooms (Single/Double)
        2. Fixed Price per night (Single bedroom - 2500 / Double bedroom - 4000)


------------------------------------- Customer Api  -------------------------------------

    Non - Authenticated api endpoints
        1. Customer Registration http://localhost:8100/api/customer/register
        2. Customer Login http://localhost:8100/api/customer/login

    Authenticated api endpoints -->
        
        ***
            Add Token recieved through login api with "bearer " prefix 
            and it into request header as Authorization
        ***
        
        1. Customer Profile Details
        2. Customer Profile Update
        3. Customer Profile logout
    
        4. View Hotel Details and rooms (Hotel details, no of rooms)
        5. View My reservation list
        6. View available rooms on duration of selected hotel
        7. Reserve hotel rooms (request body -> room_no, checkin date, checkout date)

    Assumptions
        1. Default Checkin/Checkout time 1200 Hrs

----------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------
----------------------------------------------------------------------------------------


<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
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

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
