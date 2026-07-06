# Government E-Services Platform

A web-based Government E-Services Platform developed using **Laravel** to digitize government services and improve communication between citizens, municipalities, and administrators.

The platform allows citizens to submit service requests online, municipalities to process and manage requests efficiently, and administrators to oversee the entire system through a centralized dashboard.

This project was developed as a **team project by four students** as part of a university software engineering course.

---

# Technologies Used

- Laravel
- PHP
- MySQL
- Blade
- HTML5
- CSS3
- Bootstrap
- JavaScript
- Chart.js
- Laravel Breeze Authentication
- Two-Factor Authentication (2FA)
- Google Maps API
- Social Login
- Git & GitHub

---

# Project Features

## Authentication & Security

- Email & Password Authentication
- Social Login
- Two-Factor Authentication (2FA)
- Role-Based Authorization
- Account Activation / Deactivation
- Middleware Protection
- Session Management

---

## Administrator Module

The administrator has complete control over the platform.

Features include:

### Dashboard

- View system statistics
- Total users
- Total government offices
- Total service requests
- Charts using Chart.js

### Office Management

- Create offices
- Edit offices
- Delete offices
- Assign offices to municipalities

### User Management

- Create municipality users
- Activate user accounts
- Deactivate user accounts
- Manage citizen and municipality users

### Service Management

- Create service categories
- Edit service categories
- Delete service categories
- Create services
- Edit services
- Delete services

### Request Management

- View all submitted requests
- Approve requests
- Reject requests
- Monitor request status

### Reports & Analytics

- Total Requests
- Approved Requests
- Pending Requests
- Rejected Requests
- Requests Per Office
- Revenue Per Office

---

## Municipality (Government Office)

- Login
- Two-Factor Authentication
- Manage office information
- Manage services
- Manage categories
- Process citizen requests
- Update request status
- Upload official documents
- Chat with citizens
- Appointment management
- QR Code tracking
- Customer feedback
- Live notifications

---

## Citizen Module

- Register using Email or Social Login
- Two-Factor Authentication
- Browse services
- Submit requests
- Upload required documents
- Track request status
- Google Maps office search
- Appointment booking
- Online payment support
- Download certificates
- View request history
- Rate services
- Chat with municipalities
- Notifications

---

# APIs Used

- Google Maps API
- Social Authentication APIs

---

# Security

- Laravel Authentication
- Laravel Breeze
- Two-Factor Authentication (2FA)
- Middleware Authorization
- CSRF Protection
- Password Hashing
- Session Authentication

---

# Project Architecture

The application follows the Laravel MVC architecture.

```
Browser
        │
        ▼
Routes (web.php)
        │
        ▼
Middleware
        │
        ▼
Controllers
        │
        ▼
Models
        │
        ▼
MySQL Database
        │
        ▼
Controllers
        │
        ▼
Blade Views
        │
        ▼
Browser
```

---

# Team

This project was developed collaboratively by **four students**.

### My Contribution

I was primarily responsible for the **Administrator Module**, including:

- Admin Dashboard
- Office Management (CRUD)
- User Management
- User Activation / Deactivation
- Service Management
- Category Management
- Request Approval & Rejection
- Reports & Analytics
- Dashboard Charts (Chart.js)
- Admin Middleware
- Admin Routes
- Admin Blade Views
- Integration of authentication and authorization features within the admin module

The remaining modules—including Municipality features, Citizen features, authentication enhancements such as Two-Factor Authentication (2FA), chat, maps, appointments, notifications, QR tracking, and other platform components—were developed collaboratively with my teammates.

---

# Development Requirements

The project satisfies the following requirements:

- Laravel Framework
- MySQL Database
- Bootstrap Frontend
- Git Version Control
- Modular MVC Architecture
- Secure Authentication
- Two-Factor Authentication (2FA)
- Google Maps Integration
- Social Login
- Reporting & Analytics
- CRUD Operations
- Role-Based Access Control

---

# Installation

```bash
git clone https://github.com/charbelarab2-gif/gov-app.git

cd gov-app

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate

npm install

npm run dev

php artisan serve
```

---

# Repository

https://github.com/charbelarab2-gif/gov-app
