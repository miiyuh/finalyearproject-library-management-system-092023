# Final Year Project - 012021090027 - 092023

# Online Library Management System (PHP)

This repository contains a simple Library Management System designed for schools. The system is divided into two main modules:

1. **Admin Features:**
   
    - Admin dashboard
    - Add / update / delete categories
    - Add / update / delete authors
    - Add / update / delete books
    - Issue books to a student and update details upon return
    - Search for a student using their student ID
    - View student details
    - Change their own password

2. **Students:**
   
    - Register account and then receive a unique student ID after registration
    - View their own dashboard after logging in
    - Update their own profile
    - View issued books
    - Change their own password
    - Recover their own password

## How to run the project

1. Download and unzip the file on your local system, copy the "library" folder.
2. Place the "library" folder inside the root directory. If you are using XAMPP, put it in C:\xampp\htdocs.

### Database Configuration

- Open phpMyAdmin or type 'localhost/phpmyadmin' in the URL of your browser if you are using XAMPP.
- Create a database named "library"
- Import the database using "library.sql" (available inside the folder).

### For User

- Open your browser and enter "http://localhost/library" or "http://localhost/library/library" depending on which one works for you.
  
   **Login Details for User:**
   - Username: test@gmail.com
   - Password: Test@123

### For Admin Panel

- Open your browser and enter "http://localhost/library/admin" or "http://localhost/library/library/admin" depending on which one works for you.

   **Login Details for Admin:**
   - Username: admin
   - Password: admin@123

The features of this library management system are clearly laid out for administrators and students alike. Follow the given guidelines to ensure a smooth setup and usage experience.
