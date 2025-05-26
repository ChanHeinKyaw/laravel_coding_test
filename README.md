# Project Name

This is a blog system web application.

## 🛠️ Installation & Setup

Follow the steps below to set up this project on your local machine.

Clone the repo locally:
```
git clone https://github.com/ChanHeinKyaw/laravel_coding_test.git
```
`cd` into cloned directory and install dependencies. run below command one by one.

```bash
composer update
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install && npm run build
php artisan storage:link
php artisan serve
```

### Configuration in `.env` file

Database **eg.**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_coding_test
DB_USERNAME=root
DB_PASSWORD=
```

### This is provide URL List 
```
Admin_POST_LISTS=http://127.0.0.1:8000/admin/posts
Admin_COMMENT_LISTS=http://127.0.0.1:8000/admin/comments
Front_HOME_PAGE=http://127.0.0.1:8000/home
Front_POST_DETAIL=http://127.0.0.1:8000/posts/{post_id}
```