# AfarRHB Inventory Management System

A comprehensive Laravel + Blade + Tailwind CSS + Livewire system for AfarRHB (Afar Regional Health Bureau) to manage inventory, item issuance (Model-19/Model-22), and audit logs across two warehouses.

## Features

- **Multi-Warehouse Inventory Management**: Track items across two warehouses
- **Role-Based Access Control**: Admin, Warehouse Manager, and Auditor roles
- **Item Issuance**: Support for Model-19 and Model-22 issuance forms
- **Staff Directory**: Internal employee lookup via `emp_list` table
- **Reassignment Tracking**: Track item reassignments between employees
- **Ethiopian Calendar Support**: Date picker and display with Ethiopian calendar
- **Bilingual Interface**: Switch between Amharic and English
- **Audit Logs**: Complete tracking of all system changes
- **Responsive Design**: Mobile-friendly interface with Tailwind CSS
- **Printable Reports**: Print-ready views for all reports
- **Dynamic Dropdowns**: Livewire-powered dynamic forms
- **Real-time Search**: Live search for items and employees

## Technology Stack

- **Backend**: Laravel 10
- **Frontend**: Blade Templates, Livewire 3, Tailwind CSS 3
- **Database**: MySQL
- **Build Tools**: Vite
- **Authentication**: Laravel Sanctum

## Requirements

- PHP >= 8.1
- Composer
- Node.js >= 16
- MySQL >= 5.7
- NPM or Yarn

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/aliabdela47/afarrhb_inventory.git
   cd afarrhb_inventory
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure Database**
   
   Edit `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=afarrhb_inventory
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the Database**
   ```bash
   php artisan db:seed
   ```

8. **Build Assets**
   ```bash
   npm run build
   ```

9. **Start Development Server**
   ```bash
   php artisan serve
   ```

Visit `http://localhost:8000` in your browser.

## Default Users

After seeding, you can login with these accounts:

| Role | Email | Password |
|------|-------|----------|
| Administrator | admin@afarrhb.gov.et | password |
| Warehouse Manager | warehouse@afarrhb.gov.et | password |
| Auditor | auditor@afarrhb.gov.et | password |

**⚠️ Important**: Change these passwords in production!

## Database Structure

### Core Tables

- `users` - System users with role-based access
- `warehouses` - Warehouse information (2 warehouses)
- `categories` - Item categories
- `items` - Item master data
- `inventory` - Stock levels per warehouse
- `emp_list` - Employee directory
- `issuances` - Item issuance records (Model-19/Model-22)
- `issuance_items` - Line items for issuances
- `reassignments` - Item reassignment tracking
- `audit_logs` - System audit trail

## User Roles

### Admin
- Full system access
- User management
- View all audit logs
- System configuration

### Warehouse Manager
- Manage inventory
- Create and approve issuances
- View warehouse reports
- Manage item transfers

### Auditor
- View-only access to all records
- Generate reports
- View audit logs
- No create/edit/delete permissions

## Features Detail

### Inventory Management
- Add/edit/delete items
- Track quantities across warehouses
- Low stock alerts
- Item categorization
- Multi-language item names (English/Amharic)

### Issuance Forms
- **Model-19**: Standard item issuance form
- **Model-22**: Special requisition form
- Support for multiple items per issuance
- Employee lookup and selection
- Approval workflow
- Print-ready formats

### Ethiopian Calendar
- Automatic date conversion
- Display dates in Ethiopian calendar format
- Both Amharic and English month names
- Compatible with Gregorian calendar input

### Audit Trail
- Track all create/update/delete operations
- Record user, timestamp, and IP address
- Store old and new values
- Filter by user, action, or date range

### Reports
- Inventory status reports
- Issuance history
- Low stock report
- Employee issuance history
- Printable formats

## Development

### Run Development Server
```bash
# PHP Development Server
php artisan serve

# Vite Dev Server (in separate terminal)
npm run dev
```

### Code Style
```bash
# Run Laravel Pint (PHP)
./vendor/bin/pint

# Run ESLint (JavaScript)
npm run lint
```

### Testing
```bash
# Run PHPUnit tests
php artisan test
```

## Production Deployment

1. **Environment Configuration**
   ```bash
   APP_ENV=production
   APP_DEBUG=false
   ```

2. **Optimize Application**
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   ```

3. **Build Assets**
   ```bash
   npm run build
   ```

4. **Set Permissions**
   ```bash
   chmod -R 755 storage bootstrap/cache
   ```

## Localization

The system supports English and Amharic languages. Users can switch languages using the language toggle in the navigation bar.

### Adding Translations
Edit translation files in:
- `resources/lang/en/messages.php` (English)
- `resources/lang/am/messages.php` (Amharic)

## Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

For support, email admin@afarrhb.gov.et or create an issue in the repository.

## Acknowledgments

- Developed for Afar Regional Health Bureau
- Built with Laravel, Livewire, and Tailwind CSS
- Ethiopian calendar conversion support

---

**Note**: This system is designed specifically for AfarRHB's inventory management needs, including support for Ethiopian calendar, Amharic language, and local administrative processes.
