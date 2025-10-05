# Quick Setup Guide - AfarRHB Inventory System

## Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js 16+ and NPM
- MySQL 5.7+ or MariaDB
- Git

## Step-by-Step Setup

### 1. Clone or Download the Repository
```bash
git clone https://github.com/aliabdela47/afarrhb_inventory.git
cd afarrhb_inventory
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Install JavaScript Dependencies
```bash
npm install
```

### 4. Environment Configuration
```bash
# Copy the example environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

### 5. Configure Database
Edit the `.env` file and set your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=afarrhb_inventory
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 6. Create Database
Create a new MySQL database:
```sql
CREATE DATABASE afarrhb_inventory CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 7. Run Migrations and Seeders
```bash
# Run migrations
php artisan migrate

# Seed the database with sample data
php artisan db:seed
```

### 8. Build Frontend Assets
```bash
# For development
npm run dev

# For production
npm run build
```

### 9. Set Permissions (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
```

### 10. Start Development Server
```bash
php artisan serve
```

The application will be available at: http://localhost:8000

## Default Login Credentials

After seeding, you can login with these accounts:

### Administrator
- **Email**: admin@afarrhb.gov.et
- **Password**: password
- **Access**: Full system access

### Warehouse Manager
- **Email**: warehouse@afarrhb.gov.et
- **Password**: password
- **Access**: Manage inventory, create issuances

### Auditor
- **Email**: auditor@afarrhb.gov.et
- **Password**: password
- **Access**: View-only access to all records

**⚠️ IMPORTANT**: Change these passwords immediately in production!

## Quick Test

1. Visit http://localhost:8000
2. Click "Login" or go to http://localhost:8000/login
3. Use admin credentials to login
4. You should see the dashboard with statistics

## Troubleshooting

### "Class not found" Errors
```bash
composer dump-autoload
php artisan config:clear
php artisan cache:clear
```

### Permission Errors
```bash
# Linux/Mac
sudo chmod -R 775 storage bootstrap/cache
sudo chown -R www-data:www-data storage bootstrap/cache

# Or give ownership to your user
sudo chown -R $USER:$USER storage bootstrap/cache
```

### Database Connection Errors
- Verify MySQL is running
- Check `.env` database credentials
- Ensure database exists
- Test connection: `php artisan tinker` then `DB::connection()->getPdo();`

### Assets Not Loading
```bash
# Clear cache and rebuild
npm run build
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Livewire Components Not Working
```bash
# Make sure Livewire is properly installed
composer require livewire/livewire
php artisan livewire:publish --config
```

## Production Deployment

### 1. Optimize Application
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
composer install --optimize-autoloader --no-dev
```

### 2. Set Environment
In `.env`:
```env
APP_ENV=production
APP_DEBUG=false
```

### 3. Build Production Assets
```bash
npm run build
```

### 4. Configure Web Server
Point document root to `/public` directory

#### Apache (.htaccess is included)
```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    DocumentRoot /path/to/afarrhb_inventory/public
    
    <Directory /path/to/afarrhb_inventory/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

#### Nginx
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /path/to/afarrhb_inventory/public;
    
    index index.php;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
}
```

### 5. Set Proper Permissions
```bash
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

### 6. Setup SSL (Recommended)
Use Let's Encrypt with Certbot:
```bash
sudo certbot --apache  # or --nginx
```

## Features to Explore

### Language Switching
- Click the language toggle in the top navigation
- Switch between English and Amharic

### Dashboard
- View real-time statistics
- Check low stock items
- See recent issuances

### Items Management
- Add new items with bilingual names
- Set reorder levels
- Track inventory across warehouses

### Issuance Forms
- Create Model-19 or Model-22 forms
- Search for employees
- Add multiple items
- Print professional reports

### Audit Logs (Admin)
- Track all system changes
- View user actions
- Monitor security

## Daily Operations

### Adding New Items
1. Go to Items → Add New Item
2. Fill in item details (English and Amharic names)
3. Set category, unit, price, and reorder level
4. Save

### Creating Issuance
1. Go to Issuances → Create New Issuance
2. Fill reference number, type (Model-19/22), warehouse, date
3. Search and select employee
4. Add items with quantities
5. Add purpose/remarks
6. Submit

### Checking Low Stock
1. Dashboard shows low stock count
2. View detailed list on dashboard
3. Take action to reorder

## Backup & Maintenance

### Database Backup
```bash
# Create backup
mysqldump -u username -p afarrhb_inventory > backup_$(date +%Y%m%d).sql

# Restore backup
mysql -u username -p afarrhb_inventory < backup_20240101.sql
```

### File Backup
```bash
# Backup storage directory
tar -czf storage_backup_$(date +%Y%m%d).tar.gz storage/

# Backup .env file
cp .env .env.backup
```

## Getting Help

- Check `IMPLEMENTATION.md` for detailed technical documentation
- Review `README.md` for feature overview
- Laravel Documentation: https://laravel.com/docs/10.x
- Livewire Documentation: https://livewire.laravel.com

## License
MIT License - See LICENSE file

## Support
For issues or questions, contact: admin@afarrhb.gov.et
