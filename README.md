# Hotel Management System

A PHP and MySQL hotel booking and management app with public pages, reservations, user accounts, and an admin dashboard.

## Features

- Public pages: home, rooms, room details, about, survey
- Room browsing and reservation flow
- User signup/login and profile/reservations
- Admin dashboard with charts
- Admin management for rooms, users, and reservations
- Payment and bill views
- Image assets for rooms and branding

## Tech Stack

- PHP (server-side)
- MySQL/MariaDB (database)
- HTML/CSS/SCSS
- JavaScript, jQuery, Chart.js
- PHPMailer (optional, for email verification)

## Project Structure

- `index.php`, `rooms.php`, `roomdetails.php`: public pages
- `reservation.php`, `payment.php`, `bill_view.php`: booking/payment views
- `admin/`: admin dashboard and management pages
- `core/`: controllers, auth, utilities, mail
- `config.php`: app constants and environment-based config
- `database.sql`: database schema and seed data
- `media/`: images and logos

## Requirements

- XAMPP (Apache + MySQL) or equivalent LAMP/WAMP stack
- PHP 7.4+ recommended
- MySQL/MariaDB

## Setup

1. Clone or copy the project into your web root:
	- `C:\\xampp\\htdocs\\hotel-management`
2. Create a database (default dump uses `hotel`).
3. Import the schema and seed data:
	- Use phpMyAdmin or MySQL CLI to import `database.sql`.
4. Set environment variables used by `config.php`:
	- `env_db_name`
	- `env_user_name`
	- `env_password`
	- `env_db_host`

### Example Apache env setup (XAMPP)

Add these lines to `httpd.conf` or your virtual host, then restart Apache:

```
SetEnv env_db_name hotel
SetEnv env_user_name root
SetEnv env_password ""
SetEnv env_db_host localhost
```

Optional FTP env vars (used by image upload helpers):

```
SetEnv env_ftp_server your-ftp-host
SetEnv env_ftp_user your-ftp-user
SetEnv env_ftp_pass your-ftp-pass
```

## Run

Open in a browser:

```
http://localhost/hotel-management
```

Admin dashboard:

```
http://localhost/hotel-management/admin
```

## Admin Access

Default credentials are not included in this README. To create an admin user:

1. Sign up via the UI to create a user.
2. Promote the user in the database:

```
UPDATE users
SET user_admin = 1, user_verified = 1
WHERE user_email = 'you@example.com';
```

## Email Verification (Optional)

- Email sending is implemented in `core/mail.php` using PHPMailer.
- The call to send mail is commented out in `core/signup_user.php`.
- To enable email verification:
  1. Install PHPMailer (Composer):
	  - `composer require phpmailer/phpmailer`
  2. Ensure `vendor/autoload.php` exists.
  3. Set `email_password` as an environment variable for the SMTP account.

## Database Notes

- Tables include: `users`, `rooms`, `reservations`, `payment`.
- `database.sql` contains sample room data and users.

## License

No license specified.