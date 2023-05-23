
## Installation

You need to insert this to Git Bash console:
```
git clone https://github.com/Dragokas-afk/test_task_junior.git
```
Need to change configuration file '.env'
```
DB_CONNECTION=mysql
DB_HOST={YOUR_HOST}
DB_PORT={YOUR_PORT}
DB_DATABASE={YOUR_DATABASE_NAME}
DB_USERNAME={YOUR_USERNAME}
DB_PASSWORD={YOUR_PASSWORD}

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME={YOUR_EMAIL}
MAIL_PASSWORD={PASSWORD}
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS={EMAIL_FROM}
MAIL_FROM_NAME={TEST_TASK_JUNIOR}
```
Need to use this commands into terminal:
```
php artisan migrate
php artisan db:seed
```
