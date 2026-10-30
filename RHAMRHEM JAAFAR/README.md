# Pure Vanilla PHP & MySQL Website

A clean, modular starter project built with pure vanilla PHP (no frameworks, no external libraries) and MySQL (via PDO).

## Project Structure

```text
├── assets/
│   ├── css/
│   │   └── style.css       # Responsive, modern styling
│   ├── js/
│   │   └── main.js         # Frontend interactivity
│   └── images/             # Static images
├── config/
│   └── db.php              # PDO MySQL connection setup & config
├── includes/
│   ├── functions.php       # Common helpers (CSRF, sanitization, flash messages)
│   ├── header.php          # Shared HTML navigation and header
│   └── footer.php          # Shared HTML footer
├── sql/
│   └── schema.sql          # Database creation and table schemas
├── index.php               # Home page with database status check
├── about.php               # Sample About page
├── contact.php             # Working contact form with validation and CSRF
└── README.md               # Documentation
```

## Getting Started

### 1. Database Setup
1. Launch **XAMPP Control Panel** and start **MySQL** (and **Apache** if you want to use Apache).
2. Open **phpMyAdmin** (`http://localhost/phpmyadmin`) or run the MySQL command line.
3. Import the `sql/schema.sql` file or run its SQL contents:
   - Creates database `my_website`
   - Creates `users` and `messages` tables
4. If your MySQL credentials differ from the defaults (user: `root`, password: empty), update `config/db.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'my_website');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   ```

### 2. Running the Website

You can run the site using the PHP built-in web server:

```powershell
# Using XAMPP's PHP:
& "C:\xampp\php\php.exe" -S localhost:8000
```
Then visit: **`http://localhost:8000`**

Or, if you place this folder inside `C:\xampp\htdocs\my_website`, visit:
**`http://localhost/my_website`**
