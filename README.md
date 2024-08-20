
<p align="center"><a href="#" target="_blank"><img src="public/assets/wave.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Wave Leaves

Wave Leaves is a system designed to manage leave requests and track the leaves of employees within a company. Built on top of the Laravel framework, Wave Leaves leverages several modern technologies to deliver a seamless and intuitive experience for both employees and administrators.

## Project Description

This project utilizes the following frameworks and libraries:

- **Laravel:** A powerful PHP framework for web application development.
- **Livewire:** A full-stack framework for Laravel that makes building dynamic interfaces simple, without leaving the comfort of Laravel.
- **GSAP (GreenSock Animation Platform):** A robust JavaScript library for creating high-performance animations.
- **Alpine.js:** A lightweight JavaScript framework for composing behavior directly in your HTML.
- **Toast:** A simple and elegant toast notification library for JavaScript.
- **Calendar Component:** An intuitive and customizable calendar component.
- **Flowbite:** A library of components built on top of Tailwind CSS.
- **Tailwind CSS:** A utility-first CSS framework for rapid UI development.

## Installation

To install and run this project, follow these steps:

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/yourusername/wave-leaves.git
   cd wave-leaves
   ```

2. **Install Dependencies:**
   Ensure you have [Composer](https://getcomposer.org/) installed, then run:
   ```bash
   composer install
   ```

3. **Environment Configuration:**
   Copy the `.env.example` file to `.env` and set your environment variables:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Setup:**
   Set your database credentials in the `.env` file, then run the migrations and seed the database with dummy data from factories:
   ```bash
   php artisan migrate
   php artisan migrate:fresh --seed
   ```

5. **Install Node.js Dependencies:**
   Ensure you have [Node.js](https://nodejs.org/) installed, then run:
   ```bash
   npm install
   npm run dev
   ```

6. **Serve the Application:**
   Start the local development server:
   ```bash
   php artisan serve
   ```

   Your application should now be running at [http://localhost:8000](http://localhost:8000).

[//]: # (## Learning Laravel)

[//]: # ()
[//]: # (Laravel has the most extensive and thorough [documentation]&#40;https://laravel.com/docs&#41; and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.)

[//]: # ()
[//]: # (You may also try the [Laravel Bootcamp]&#40;https://bootcamp.laravel.com/&#41;, where you will be guided through building a modern Laravel application from scratch.)

[//]: # ()
[//]: # (If you don't feel like reading, [Laracasts]&#40;https://laracasts.com&#41; can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.)

[//]: # ()
[//]: # (## Laravel Sponsors)

[//]: # ()
[//]: # (We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program]&#40;https://partners.laravel.com&#41;.)

[//]: # ()
[//]: # (### Premium Partners)

[//]: # ()
[//]: # (- **[Vehikl]&#40;https://vehikl.com/&#41;**)

[//]: # (- **[Tighten Co.]&#40;https://tighten.co&#41;**)

[//]: # (- **[WebReinvent]&#40;https://webreinvent.com/&#41;**)

[//]: # (- **[Kirschbaum Development Group]&#40;https://kirschbaumdevelopment.com&#41;**)

[//]: # (- **[64 Robots]&#40;https://64robots.com&#41;**)

[//]: # (- **[Curotec]&#40;https://www.curotec.com/services/technologies/laravel/&#41;**)

[//]: # (- **[Cyber-Duck]&#40;https://cyber-duck.co.uk&#41;**)

[//]: # (- **[DevSquad]&#40;https://devsquad.com/hire-laravel-developers&#41;**)

[//]: # (- **[Jump24]&#40;https://jump24.co.uk&#41;**)

[//]: # (- **[Redberry]&#40;https://redberry.international/laravel/&#41;**)

[//]: # (- **[Active Logic]&#40;https://activelogic.com&#41;**)

[//]: # (- **[byte5]&#40;https://byte5.de&#41;**)

[//]: # (- **[OP.GG]&#40;https://op.gg&#41;**)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

[//]: # (## Code of Conduct)

[//]: # ()
[//]: # (In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct]&#40;https://laravel.com/docs/contributions#code-of-conduct&#41;.)

[//]: # (## Security Vulnerabilities)

[//]: # ()
[//]: # (If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com]&#40;mailto:taylor@laravel.com&#41;. All security vulnerabilities will be promptly addressed.)

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
