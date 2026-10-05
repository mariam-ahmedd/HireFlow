# HireFlow

A full-stack job platform built with Laravel that connects job seekers with employers through a simple and modern interface.

## About the Project

**HireFlow** is a job recruitment platform designed to make the hiring process easier for both job seekers and employers.

Job seekers can browse available jobs, search for opportunities, create professional profiles, and submit applications.

Employers can create company profiles, publish and manage job listings, and review applications from candidates.

The platform also supports **English and Arabic**, including RTL support for Arabic.

## Features

### For Job Seekers

* Browse available job listings
* Search jobs by title and location
* View detailed job information
* Apply for jobs
* Track submitted applications
* Create and edit a professional profile
* Upload a profile photo
* Add skills, education, experience, languages, and social links
* Access a personalized dashboard

### For Employers

* Create a company profile
* Upload a company logo
* Create job listings
* Edit and delete job listings
* Manage published jobs
* View applications from candidates
* Update application status
* Access an employer dashboard

### General Features

* Authentication and registration
* Role-based access control
* English / Arabic language switching
* RTL support for Arabic
* Responsive design
* Job search
* Company listings and company profiles
* Custom navigation and dashboards
* Profile photo and company logo uploads
* Protected employer and job seeker routes

## User Roles

### Job Seeker

Job seekers can:

* Search for jobs
* View job details
* Apply for jobs
* Manage their applications
* Build their professional profile

### Employer

Employers can:

* Create a company profile
* Publish jobs
* Manage their jobs
* Review applications
* Accept or reject candidates

## Tech Stack

* **Laravel 13**
* **PHP 8.4**
* **MySQL**
* **Blade**
* **Tailwind CSS**
* **Vite**
* **JavaScript**
* **Git & GitHub**

## Project Structure

```text
HireFlow/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   └── Models/
│
├── database/
│   ├── factories/
│   └── migrations/
│
├── lang/
│   ├── ar/
│   └── en/
│
├── public/
│   └── images/
│
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
│
├── routes/
│   └── web.php
│
└── README.md
```

## Installation

Clone the repository:

```bash
git clone https://github.com/mariam-ahmedd/HireFlow.git
```

Navigate to the project directory:

```bash
cd HireFlow
```

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

Create the environment file:

```bash
cp .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

Configure the database in `.env`, then run the migrations:

```bash
php artisan migrate
```

Create the storage link:

```bash
php artisan storage:link
```

Build frontend assets:

```bash
npm run build
```

Start the Laravel development server:

```bash
php artisan serve
```

The application will be available at:

```text
http://127.0.0.1:8000
```

## Screenshots

Screenshots of the application can be added here to showcase:

* Home page
* Job listings
* Job details
* Job seeker dashboard
* Employer dashboard
* Company profile
* User profile
* Arabic RTL interface

## Future Improvements

Possible future improvements include:

* Email notifications
* Advanced job filtering
* Password reset
* Saved jobs
* Employer profile editing
* Application email notifications
* Admin dashboard
* Job categories and tags
* Deployment with a production database and domain

## Learning Goals

This project was built as a practical Laravel project to strengthen my skills in:

* Laravel MVC architecture
* Eloquent relationships
* Authentication and authorization
* Middleware
* Database migrations
* Form validation
* File uploads
* Blade components
* Localization and RTL support
* CRUD operations
* Git and GitHub

## Author

**Mariam Ahmed**

GitHub:
https://github.com/mariam-ahmedd
