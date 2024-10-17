# chinases
Сделано в рамках всероссийского конкурса "PEAK-IT" 2024 года


# мы 🌏who-too-ton🌐
| Роль  | фи | 
| ------------- | ------------- |
| Менеджер 👩‍💼 | Копырина Милена  |
| Дизайнер 👨‍🎨 | Мордовской Аман  |
| Разработчик👨‍💻  | Петров Леонид  |

# Chinases👨‍🎓
Chinases - веб-приложение для китайской сети рестаронов
# 😎функционал прототипа😎
Основные функции:
* Полный список блюд с описаниями, фотографиями и ценами.
* Возможность добавления блюд в корзину.
*  Простая и интуитивно понятная система оформления заказа.
* Возможность выбора времени доставки или самовывоза.
* Регистрация и авторизация через email, телефон или социальные сети.
* История заказов и возможность повторного заказа.
* Возможность прсотавить в избранные
* Отдельный логин для админов
* Админы могут управлять блюдами(создать, изменить, удалить)
* Поддержка видов оплаты, времени доставки, статус доставки, наличие отзывов и рейтинга каждого блюда(не настроен фронт, все прописыватеся в датабазе)


# ⚒️Технологии⚙️
[![My Skills](https://skillicons.dev/icons?i=laravel,vue,vite)](https://skillicons.dev)
* Laravel 
* Inertia.js 
* Vue.js
* Tailwind CSS

* # ❗Как запустить ❓
0) все файлы находятся в бренче 'master'
1) Убедитесь, что у вас правильно настроена среда. Вам понадобятся MySQL, PHP8.1, [Node.js](https://nodejs.org/en/download/package-manager) и [Composer](https://getcomposer.org/download/)
MYsql и PHP обычно идут вместе в [XAMPP](https://www.apachefriends.org/ru/download.html)
2) Загрузите проект (или клонируйте с помощью GIT)
3) Скопируйте .env.example в .env и настройте учетные данные базы данных
4) Перейдите в корневой каталог проекта с помощью терминала
5) Запустите `composer install`
6) Установите ключ шифрования, выполнив команду `php artisan key:generate`
7) `php artisan migrate --seed`
8) Запустите data seeder для тестирования `php artisan db:seed AdminSeeder` и других файлов db seeder, которые вы можете найти в разделе `database/seeders`
9) Запустите локальный сервер `php artisan serve`
10) Откройте новый терминал и перейдите в корневой каталог проекта, запустите `npm install`
    Запустите `npm run dev`, чтобы запустить vite-сервер для фронтенда



(если что-то не получается или лень устанавливать есть ссылка [на демо видео](https://youtu.be/j9YllX5_7oM )
