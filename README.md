<<<<<<< HEAD
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
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

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
=======
# Pre-final Exam in Application Lifecycle Management (BSIT-3B)

> Pre-requisites
> 
- PHP version must be 8.2 or greater
- git
- [fork this repository](https://github.com/ACLC-Tacloban/student-management-api.git)

### Student Management API

The Student Management API is a tool for managing student data across a variety of systems. It allows for efficient storage, retrieval, and modification of student records. The API could handle data such as student information and academic records.

> **Note:** This may not follow real world database structure (i.e relational) just to simplify things.
> 

### User Stories

1. As a User, I am able to manage student info (register, update, and retrieve with filters).
    - Requirements
        - endpoints
            - `GET /api/students`
            - `POST /api/students`
            - `GET /api/students/{id}`
            - `PATCH /api/students/{id}`
        - Student attributes
            - `string` firstname
            - `string` lastname
            - `string` birthdate *(format: Y-m-d)*
            - `string` sex
                - MALE
                - FEMALE
            - `string` address
            - `int` year
            - `string` course
            - `string` section
    - Acceptance Criteria
        - Implement a seeder
        - Implement filtering
            - sort
            - search
            - limit
            - offset
            - fields
            - year
            - course
            - section
        - Response structure for student
        
        ```json
        {
        	"id": 1,
        	"firstname": "John",
        	"lastname": "Doe",
        	"birthdate": "2001-01-01",
        	"sex": "MALE",
        	"address": "Tacloban",
        	"year": 3,
        	"course": "BSIT",
        	"section": "B"
        }
        ```
        
        - Response structure for students
        
        ```json
        {
        "metadata": [
        		"count": 2,
        		"search": null,
        		"limit": 0,
        		"offset": 5,
        		"fields": []
        	],
        "students": [
        				{...},
        				{...}
        	]
        }
        ```
        
2. As a User, I can manage student’s academic records (add, update, retrieve with filters).
    - Requirements
        - endpoints
            - `GET /api/students/{id}/subjects`
            - `POST /api/students/{id}/subjects`
            - `GET /api/students/{id}/subjects/{subject_id}`
            - `PATCH /api/students/{id}/subjects/{subject_id}`
        - Subject attributes
            - `string` subject_code
            - `string` name
            - `string` description
            - `string` instructor
            - `string` schedule
            - `array` grades
                - `double` prelims
                - `double` midterms
                - `double` pre_finals
                - `double` finals
            - `double` average_grade
            - `string` remarks
                - PASSED ***average_grade ≥ 3.0***
                - FAILED ***average_grade < 3.0***
            - `string` date_taken *(format: Y-m-d)*
    - Acceptance Criteria
        - Implement a seeder
        - `remarks` must be based on the student’s average grade
        - Implement filtering
            - sort
            - search
            - limit
            - offset
            - fields
            - remarks
        - Response structure for subject
        
        ```json
        {
        	"id": 1,
        	"subject_code": "T3B-123",
        	"name": "Application Lifecyle Management",
        	"description": "Lorem ipsum dolor sit amet.",
        	"instructor": "Mr. John Doe",
        	"schedule": "MW 7AM-12PM",
        	"grades": [
        		"prelims": 2.75,
        		"midterms": 2.0,
        		"pre_finals": 1.75,
        		"finals": 1.0
        	],
        	"average_grade": 1.87,
        	"remarks": "PASSED",
        	"date_taken": "2024-01-01",
        }
        ```
        
        - Response structure for subjects
        
        ```json
        {
        "metadata": [
        		"count": 2,
        		"search": null,
        		"limit": 0,
        		"offset": 5,
        		"fields": []
        	],
        "students": [
        				{...},
        				{...}
        	]
        }
        ```
        
    
    > Once you’re done, kindly create a Pull Request to this [repository](https://github.com/ACLC-Tacloban/student-management-api.git) by feature (student-management, subject-management, and student-subject-management [this is the combination of the two]). Provide the necessary details such as the Title and the Description.
    >
>>>>>>> 28861232f560eefee5273d4de51d29b3ce51be40
