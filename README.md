# FUHSA DIRD — PHP + MySQL Website

## Project Structure

```
fuhsa_project/
├── config.php          # Database connection & helpers
├── index.php           # Main website (all sections)
├── admin_actions.php   # Admin CRUD backend (login, add/delete)
├── setup.sql           # Database schema + sample data
├── uploads/            # Image uploads directory
│   ├── Fuhsa_1.jpg ... Fuhsa_6.jpg
│   └── VC_Fuhsa.webp
└── README.md           # This file
```

## Setup Instructions

### 1. Requirements
- PHP 7.4+ (with PDO MySQL extension)
- MySQL 5.7+ or MariaDB 10.3+
- Apache/Nginx web server (XAMPP, WAMP, LAMP, or Laragon recommended)

### 2. Database Setup
1. Open phpMyAdmin or MySQL CLI
2. Import `setup.sql`:
   ```bash
   mysql -u root -p < setup.sql
   ```
   Or paste the contents into phpMyAdmin's SQL tab.

### 3. Configure Database Connection
Edit `config.php` and update these values if needed:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'fuhsa_dird');
define('DB_USER', 'root');
define('DB_PASS', '');  // your MySQL password
```

### 4. Admin Credentials
Default login:
- **Username:** `admin`
- **Password:** `Fuhsa@DIRD2025`

Change these in `config.php` for production.

### 5. File Permissions
Ensure the `uploads/` directory is writable by the web server:
```bash
chmod 755 uploads/
```

### 6. Run the Application
Place the project folder in your web server's document root (e.g., `htdocs/` for XAMPP) and open:
```
http://localhost/fuhsa_project/
```

## Features

### Navigation
- **Dropdown menu** under "Research" with:
  - IBR Platform (with collapsible IBR Guide)
  - NRF Platform (dummy/coming soon)
  - Grant Beneficiaries list

### Admin Panel (after login)
- **Add/Delete Gallery Photos** (with file upload)
- **Add/Delete News Articles**
- **Add/Delete Publications**
- **Add/Delete Beneficiaries** (with year, amount, project title)

### Leadership Profiles
- **Vice-Chancellor** section with photo, name, titles, bio
- **DDIRD** section with photo, name, titles, bio
- Managed via the `leadership` database table

### Dynamic Content
All gallery, news, publications, and beneficiaries are stored in MySQL and rendered dynamically with PHP.

## Customization

### Update VC/DDIRD Profiles
Run this SQL to update leadership info:
```sql
UPDATE leadership SET full_name='New Name', titles='New Titles', bio='New bio text', image_path='uploads/new_photo.jpg' WHERE role_key='vc';
UPDATE leadership SET full_name='New Name', titles='New Titles', bio='New bio text', image_path='uploads/new_photo.jpg' WHERE role_key='ddird';
```

### Change Admin Password
Edit `config.php`:
```php
define('ADMIN_PASS', 'YourNewSecurePassword');
```
