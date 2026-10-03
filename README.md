# 📦 Laravel Push Notification Panel

This is a Laravel project with an API and a Blade + Tailwind CSS frontend. Users can register, log in, subscribe to push notifications, and manage notifications through the admin panel (Filament).

---

## 🔐 Firebase Credentials

Create the `storage/firebase-credentials.json` file based on `storage/firebase-credentials.example.json` and add your Firebase service credentials.

## 🚀 Installation

## 1. If necessary, update the paths in the `/docker/app/docker-compose.yml` file.

## 2. Navigate to the `docker/app` directory and run the following commands:

```bash
docker-compose build
docker-compose up -d
```

## 3. Check whether the containers are running:

```bash
docker ps -a
```

The output should look like this:

```text
c641f3a91181   nginx:1.13-alpine      "nginx -g 'daemon of…"   10 hours ago   Up 10 hours   0.0.0.0:8080->80/tcp     test_nginx
953d9acbc614   php:8.2.1-fpm          "docker-php-entrypoi…"   10 hours ago   Up 10 hours   0.0.0.0:9000->9000/tcp   test_php
81fe68292b66   postgres:14.7-alpine   "docker-entrypoint.s…"   10 hours ago   Up 10 hours   0.0.0.0:5432->5432/tcp   test_postgres
```

## 4. Access the PHP container's bash shell:

```bash
docker exec -it test_php bash
```

## 5. Install all dependencies:

```bash
composer install
```

## 6. Copy `.env.example` to `.env`.

## 7. Run the database migrations:

```bash
php artisan migrate
```

## 8. Run the database seeders:

```bash
php artisan db:seed
```

## 9. Start the queue worker:

```bash
php artisan queue:work
```

## 10. Start the scheduler:

```bash
php artisan schedule:work
```

## 11. Install and run the frontend:

```bash
npm install
npm run dev
```

## 12. Open the following URL in your browser:

```text
http://localhost:8087
```

---

## 📄 Pages

### 🔐 `/login`

Login form:

* The user enters their `email` and `password`. Default credentials: `user@test.com` / `12345`
* After successful login, the token is stored in `localStorage`, and the user is redirected to `/`.

### 📝 `/register`

Registration form:

* Fields: name, email, password, and password confirmation.
* After successful registration, the user is redirected to `/login`.

### 🏠 `/`

Home page:

* Displays the user's name from the `/api/v1/profile` API endpoint.
* **Logout** button.
* **Subscribe to notifications** button.

🔒 Available only to authenticated users.
If the token is missing, the user is redirected to `/login`.

## 🛠️ Admin Panel (Filament)

### 🔐 `/admin/login`

Login form:

* The administrator enters their `email` and `password`. Default credentials: `admin@test.com` / `12345`

### 🔔 Notifications (`/admin/notifications`)

* List of notifications with the following columns:

  * Title
  * Text
  * Scheduled date and time
  * Status (`Pending`, `Sent`)

* Available actions:

  * Create a new notification:

    * Specify the title, text, and `send_at` date/time.
    * At the specified time, the notification is automatically sent to all registered devices.
  * View delivery status:

    * Each notification has a button that opens the list of push notifications sent for that notification.

### 📱 Sent Notifications (`/admin/push-notifications`)

* List of all push notifications.
* Can be filtered by `notification_id` (usually accessed from the notification details).
* Columns:

  * Device
  * Status (`Delivered`, `Pending`, `Error`)
  * Firebase response (if an error occurred)

> ⚙️ This section is not available directly from the navbar and can only be accessed through the Notifications section.
