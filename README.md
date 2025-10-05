# 📦 AfarRHB Inventory Management System

A web-based inventory and warehouse management system for the Afar Regional Health Bureau (AfarRHB), Ethiopia. This system digitizes item tracking, issuance, and reporting across two government warehouses, with full audit trails, role-based access, and responsive design.

---

## 🚀 Features

- Item registration using Model-19 form
- Item issuance to internal/external customers via Model-22
- Warehouse location tracking and shelf codes
- Internal staff lookup via `emp_list` table
- Reassignment history with item status (Returned, Lost, Damaged, etc.)
- Role-based access: Admin, Store Keeper, Store Head, Manager
- Audit logs and item movement tracking
- Responsive UI for mobile and desktop
- Bilingual support (Amharic/English)
- Ethiopian calendar integration
- Printable reports and export to Excel/PDF

---

## 🧱 Tech Stack

| Layer       | Technology                          |
|-------------|--------------------------------------|
| Backend     | Laravel (PHP/MySQL)                 |
| Frontend    | Blade + Tailwind CSS + Alpine.js    |
| Interactivity| Livewire                           |
| Database    | MySQL (`afarrhb_inventory.sql`)     |
| Calendar    | Ethiopian calendar support          |
| Language    | Amharic and English                 |

---

## 🗃️ Database Schema Overview

- `users`: System users and roles
- `categories`: Item categories
- `items`: Inventory items
- `customers`: Internal and external recipients
- `emp_list`: Bureau staff lookup
- `item_assignments`: Issuance history and status
- `reports`: Model-19 and Model-22 tracking
- `warehouses`: Store metadata
- `item_movements`: Stock changes
- `audit_log`: User actions

---

## 📋 Setup Instructions

1. Clone the repository  
2. Run `composer install`  
3. Set up `.env` with your DB credentials  
4. Run `php artisan migrate`  
5. Seed initial roles and categories (optional)  
6. Start the server: `php artisan serve`

---

## 📄 Forms & Pages

- **Model-19 Form**: Item registration
- **Model-22 Form**: Item issuance
- **Dashboard**: Role-based views
- **Reports**: Printable and exportable
- **Audit Logs**: User activity tracking

---

## 🧠 AI Collaboration Goals

- Generate Laravel migration files
- Build Blade + Tailwind form layouts
- Scaffold Livewire components
- Suggest schema improvements
- Integrate Ethiopian calendar and multilingual UI

---

## 📌 License

This project is developed for public sector use and may be adapted for other governmental inventory systems. Licensing terms to be defined by AfarRHB.

---

## 🤝 Credits

Designed and developed by Ali Abdela Ali, SoftwareEngineer and Backend Developer.
