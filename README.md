### Cara Menjalankan Project Laravel

1. **Clone repository**

```bash
git clone https://github.com/username/project.git
cd project
```

2. **Install dependency**

```bash
composer install
```

3. **Copy file environment**

```bash
cp .env.example .env
```

4. **Generate key**

```bash
php artisan key:generate
```

5. **Setting database**

- buka file `.env`
- sesuaikan:

```
DB_DATABASE=presma
DB_USERNAME=root
DB_PASSWORD=
```

6. **Import database**

- buka phpMyAdmin
- buat database `presma`
- import file `.sql` yang sudah disediakan

7. **Run migration (opsional kalau sudah import SQL)**

```bash
php artisan migrate
```

8. **Storage link (penting buat upload file)**

```bash
php artisan storage:link
```

9. **Jalankan server**

```bash
php artisan serve
```

10. **Akses di browser**
    http://127.0.0.1:8000
