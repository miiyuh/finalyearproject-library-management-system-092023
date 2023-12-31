# Final Year Project - 012021090027 - 092023

<h2> Library Management System </h2>

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

1. Download and unzip the file on your local system, copy the "library_v0" folder.
2. Place the "library_v0" folder inside the root directory. If you are using XAMPP, put it in C:\xampp\htdocs.

### Database Configuration

- Open phpMyAdmin or type 'localhost/phpmyadmin' in the URL of your browser if you are using XAMPP.
- Create a database named "library_v0"
- Import the database using "library_v0.sql" (available inside the folder).

### For User

- Open your browser and enter "http://localhost/library_v0" or "http://localhost/library_v0/library" depending on which one works for you.
  
   **Login Details for User:**
   - Username: test@gmail.com
   - Password: Test@123

### For Admin Panel

- Open your browser and enter "http://localhost/library_v0/admin" or "http://localhost/library_v0/library/admin" depending on which one works for you.

   **Login Details for Admin:**
   - Username: admin
   - Password: Test@123

### Update reCAPTCHA Keys

For enhanced security, it is recommended that you update both the reCAPTCHA secret keys and site keys in the following PHP files to use your own keys:

- **adminlogin.php, change-password.php, login-form.php, user-forgot-password.php:**
   1. Locate the reCAPTCHA integration section in each file.
   2. Update the `data-sitekey` attribute with your reCAPTCHA site key.
   3. Update the `data-secretkey` attribute with your reCAPTCHA secret key.

#### How to Obtain reCAPTCHA Keys:

1. Visit the [reCAPTCHA website](https://www.google.com/recaptcha) and log in or create an account if you don't have one.
2. Create a new site by selecting "reCAPTCHA v2" and then "I'm not a robot" Checkbox.
3. Choose the "invisible" reCAPTCHA type if preferred.
4. Complete the necessary settings and obtain your site key and secret key.
5. Replace the placeholder keys in the mentioned PHP files with your newly acquired reCAPTCHA keys.

Ensure that you follow these steps to maintain the security of your Library Management System. If you encounter any issues, refer to the reCAPTCHA documentation for assistance.

The features of this library management system are clearly laid out for administrators and students alike. Follow the given guidelines to ensure a smooth setup and usage experience.
