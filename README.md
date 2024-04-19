# Hospital-Management-System

This repository contains the source code for a PHP and MySQL-based clinic/hospital management system developed as part of the COMP 351: Advanced Website Programming course at the University of the Fraser Valley. The system is designed to streamline administrative tasks and enhance patient care through efficient management functionalities.

## Abstract
The report presents the development and implementation of a PHP and MySQL-based clinic/hospital management system aimed at streamlining administrative tasks and improving patient care. The system encompasses user authentication, patient registration, appointment scheduling, medical record management, and administrative functionalities. Leveraging PHP for server-side scripting and MySQL for database management, the system ensures secure user access through session management and guards against common security threats like SQL injection. The user interface is designed for intuitive navigation, with screenshots provided to illustrate key pages. Testing methodologies are outlined, along with challenges faced during development and potential future enhancements. Overall, the project demonstrates the successful integration of technology to enhance healthcare administration and patient services.

## Introduction
This report details the creation and implementation of a PHP and MySQL-based clinic/hospital management system, aimed at optimizing healthcare administration and patient care. The system, initiated from the index.php page, streamlines user authentication via the user_login.php page, ensuring secure access to tailored functionalities for MANAGEMENT, RECEPTIONISTS, and DOCTORS.

<img width="1440" alt="Screenshot 2024-04-18 at 22 02 18" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/84ba9126-4233-4088-9210-23b5969eadaa">

Built upon PHP for dynamic scripting and MySQL for robust database management, the system offers a tailored experience for each user group. MANAGEMENT benefits from comprehensive administrative tools, while RECEPTIONISTS manage patient interactions efficiently, and DOCTORS access patient records seamlessly.

With a focus on security, the system employs stringent authentication measures and access controls to safeguard patient information. Continuous testing and refinement ensure data integrity, while user feedback guides future enhancements. Ultimately, this system aims to redefine healthcare administration, driving efficiency and elevating patient care standards.

## Designing
Database and Server configuration.

### A. Database

*	Patient Table (patient):
    * This table stores information about patients registered in the hospital.
    * Fields include patient ID (pid), patient name (pname), gender, address, blood group, and registration date (reg_pat_date).
    * Constraints ensure data integrity, such as gender and blood group validations.
*	Doctor Table (doctor):
    * The doctor table contains details of doctors working in the hospital.
    * Attributes include doctor ID (did), doctor name (dname), speciality, and gender.
    * Gender constraint ensures values are either 'M', 'F', or 'O' (other).
*	Doctor-Patient Relationship Table (d_patient):
    * This table establishes the relationship between doctors and their patients.
    * It links patient IDs (pid) from the patient table with doctor IDs (did) from the doctor table.
    * Additional fields include disease diagnosed, admission status, and treatment status.
*	Login Credentials Table (login):
    * The login table manages user authentication and access control for the system.
    * It stores usernames, passwords (insecure for demonstration purposes), user roles, and corresponding IDs.
    * User roles (role) indicate the level of access: 1 for MANAGEMENT, 2 for RECEPTIONISTS, and 3 for DOCTORS.
*	Sample Data Insertions:
    * Initial data inserts into the login table demonstrate user credentials for different roles (u1, u2, u3) with corresponding passwords (p1, p2, p3) and roles.
    * Additionally, a sample doctor record is inserted into the doctor table for testing purposes.

### B. Xammp Server
XAMPP, an acronym for cross-platform, Apache, MySQL, PHP, and Perl, is a widely used open-source software package that facilitates the setup and management of a local web development environment. It includes all the necessary components required for web development, such as the Apache web server, MySQL database server, PHP programming language, and Perl scripting language.

*	Configuration:
    * Configuring Apache: Users can adjust settings such as the server port, virtual hosts, and directory permissions by editing the httpd.conf and httpd-vhosts.conf configuration files located in the apache directory within the XAMPP installation.
    * Configuring MySQL: MySQL configuration settings, such as database storage directories, buffer sizes, and authentication methods, can be modified by editing the my.ini file in the mysql directory.
    * Enabling PHP extensions: XAMPP allows users to enable or disable PHP extensions by modifying the php.ini configuration file found in the php directory.
  
*	Installlation:
    * Import ‘installation.sql’ script that creates basic tables and sample user for database.
    * Three sample users are made.
        * Management – u1.
        * Receptionist – u2.
        * Doctor – u3.

A
