## Backend Developer Assessment

### Technology Versions

- Laravel Framework: 10
- PHP: 8.1

### Instalation

1. Copy file `.env.example` to `.env` and setup your database.
2. Run `composer install`
3. Run `php artisan key:generate`
4. Run `php artisan optimize`
5. Run `php artisan migrate`
6. Run `php artisan serve`

### Documentation

- ERD (Entity-Relationship Diagram): https://drive.google.com/file/d/19DZ9QatpyknJA0KarUKxNTRRlM_fyd7I/view?usp=sharing
- API Scribe Documentation - Access the API documentation by visiting: <i><b>http://{your local address}/docs</b></i>
- Postman Collection JSON (.postman_collection.json): https://drive.google.com/file/d/1xa4maED2D6VU3GvzB6KTxZvctbxS3Lyl/view?usp=drive_link

### Running Test

```
php artisan test
```
