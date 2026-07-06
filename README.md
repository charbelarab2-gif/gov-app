# Government E-Services Platform

## Overview

The Government E-Services Platform is a web application developed using Laravel that digitizes government services and simplifies communication between citizens, municipalities, and system administrators.

The platform allows citizens to submit service requests online, municipalities to manage and process those requests efficiently, and administrators to supervise the entire system through a centralized dashboard.

The project was developed by a team of four students as part of a university software engineering course.

---

# Main Features

## Authentication & Security

- Login and Registration
- Social Login
- Two-Factor Authentication (2FA)
- Role-Based Access Control
- Middleware Authorization
- Session Management
- Account Activation and Deactivation
- CSRF Protection

---

## Administrator

- Dashboard with system statistics
- Office Management (Create, Edit, Delete)
- Municipality User Management
- Citizen User Management
- User Activation / Deactivation
- Service Category Management
- Service Management
- Request Monitoring
- Request Approval / Rejection
- Reports and Analytics
- Requests per Office
- Revenue per Office
- Interactive Charts using Chart.js

---

## Municipality

- Secure Login
- Two-Factor Authentication
- Office Profile Management
- Service and Category Management
- Process Citizen Requests
- Update Request Status
- Upload Official Documents
- Appointment Scheduling
- Customer Feedback Management
- In-App Chat
- QR Code Tracking
- Live Notifications

---

## Citizen

- Register using Email or Social Login
- Two-Factor Authentication
- Browse Government Services
- Submit Requests
- Upload Required Documents
- Track Request Status
- Google Maps Office Search
- Appointment Booking
- Online Payments
- Download Certificates
- View Request History
- Rate and Review Services
- Chat with Municipalities
- Email and Push Notifications

---

# Technologies

- Laravel
- PHP
- MySQL
- Blade
- Bootstrap
- HTML
- CSS
- JavaScript
- Chart.js
- Laravel Breeze
- Google Maps API
- Social Authentication APIs
- Git & GitHub

---

# Architecture

The project follows the Laravel MVC architecture.

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

# Team

This project was developed collaboratively by a team of four students.
