# spares_management_wih_qr_code

<h2 align="center">Pre-requisites Setup Steps</h2>
<br/>

```yaml
For new user who don't have experience of working with Laravel framework

Install and setup Xampp control panel in your system.

Download and setup  composer, you can refer to any youtube videos or documentation available online.

Now you can proceed to clone this repo and move ahead
```

<h2 align="center">Installation Steps</h2>
<br/>

```yaml
Use the git and composer to install

cd spares_management_with_qr_code/
cp .env.example .env

Edit .env file for your Spares management app information.
```

```yaml
composer install
php artisan key:generate
php artisan config:cache
php artisan migrate --seed
php artisan serve
```
