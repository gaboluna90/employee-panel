# Employee Attendance Panel

A web-based admin panel for managing employees and tracking daily attendance.  
Built with **Laravel 13**, **PostgreSQL**, **Nginx**, and **Docker** — runs with a single command.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Language | PHP 8.4 |
| Framework | Laravel 13 |
| Database | PostgreSQL 15 |
| Web Server | Nginx + PHP-FPM |
| Containerization | Docker & Docker Compose |
| Frontend | Blade + Tailwind CSS |

---

## Features

**Employee Management**
- Create, edit, and deactivate employees
- Fields: name, email, phone, department, position, status
- Avatar generated from employee initials
- Active/inactive status with visual badge

**Attendance Tracking**
- Record daily check-in and check-out times
- Status tracking: present, late, or absent
- Filter attendance records by date
- One record per employee per day (enforced at database level)
- Optional notes per record

**System**
- Automatic database migrations on startup
- Seeders with 15 employees and 20 days of attendance records
- Pagination on all listing views
- Form validation with inline error messages
- Success notifications after every action

---

## Quick Start

> Requirements: [Docker](https://www.docker.com/) and [Docker Compose](https://docs.docker.com/compose/)

```bash
git clone https://github.com/gabolune90/employee-panel.git
cd employee-panel
docker compose up -d --build
```

The application will be available at **http://localhost:8082**

On first start, the container automatically:
- Copies `.env.example` to `.env`
- Generates the `APP_KEY`
- Runs all database migrations
- Seeds the database with sample data

---

## Docker Services

| Service | Description | Port |
|---|---|---|
| nginx | Reverse proxy web server | 8082 |
| app | Laravel PHP-FPM 8.4 | 9000 (internal) |
| queue | Laravel queue worker | — |
| db | PostgreSQL 15 | 5441 |

---

## Project Structure

```
app/
├── Http/Controllers/
│   ├── EmployeeController.php
│   └── AttendanceController.php
├── Models/
│   ├── Employee.php
│   └── Attendance.php
database/
├── factories/
│   ├── EmployeeFactory.php
│   └── AttendanceFactory.php
├── migrations/
│   ├── create_employees_table.php
│   └── create_attendances_table.php
└── seeders/
    └── DatabaseSeeder.php
resources/views/
├── layouts/
│   └── app.blade.php
├── employees/
│   ├── index.blade.php
│   ├── create.blade.php
│   ├── edit.blade.php
│   └── show.blade.php
└── attendances/
    ├── index.blade.php
    ├── create.blade.php
    └── edit.blade.php
docker/
└── nginx/
    └── nginx.conf
```

---

## Database Design

### employees
| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| name | string | Full name |
| email | string | Unique email |
| phone | string | Optional phone |
| department | string | Department name |
| position | string | Job position |
| status | enum | active / inactive |

### attendances
| Column | Type | Description |
|---|---|---|
| id | bigint | Primary key |
| employee_id | bigint | Foreign key → employees |
| date | date | Attendance date |
| check_in | time | Entry time |
| check_out | time | Exit time |
| status | enum | present / late / absent |
| notes | text | Optional observations |

**Business rules enforced:**
- One attendance record per employee per day (unique constraint)
- Check-out must be after check-in (validated at application level)
- Only active employees appear in attendance forms

---

## Useful Commands

```bash
# View application logs
docker compose logs app -f

# Reset database and reseed
docker compose exec app php artisan migrate:fresh --seed

# Access the container
docker compose exec app sh

# Stop all services
docker compose down

# Stop and remove database volume
docker compose down -v
```

---

## Author

**Gabriel Luna**  
PHP & Laravel Developer | PostgreSQL | Docker  
[github.com/gabolune90](https://github.com/gabolune90)