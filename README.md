# spares_management_wih_qr_code

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
php artisan migrate:refresh 
php artisan serve
```
