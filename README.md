# Hospital-Management-System

This repository contains the source code for a PHP and MySQL-based clinic/hospital management system developed as part of the COMP 351: Advanced Website Programming course at the University of the Fraser Valley. The system is designed to streamline administrative tasks and enhance patient care through efficient management functionalities.

## Abstract
The report presents the development and implementation of a PHP and MySQL-based clinic/hospital management system aimed at streamlining administrative tasks and improving patient care. The system encompasses user authentication, patient registration, appointment scheduling, medical record management, and administrative functionalities. Leveraging PHP for server-side scripting and MySQL for database management, the system ensures secure user access through session management and guards against common security threats like SQL injection. The user interface is designed for intuitive navigation, with screenshots provided to illustrate key pages. Testing methodologies are outlined, along with challenges faced during development and potential future enhancements. Overall, the project demonstrates the successful integration of technology to enhance healthcare administration and patient services.

## Introduction
This report details the creation and implementation of a PHP and MySQL-based clinic/hospital management system, aimed at optimizing healthcare administration and patient care. The system, initiated from the index.php page, streamlines user authentication via the user_login.php page, ensuring secure access to tailored functionalities for MANAGEMENT, RECEPTIONISTS, and DOCTORS.

<img width="720" alt="Screenshot 2024-04-18 at 22 02 18" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/84ba9126-4233-4088-9210-23b5969eadaa">

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

### C. Directory
Following is directory of application.

<img width="500" alt="image" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/7cba33f7-8755-4cf8-a9e9-3f59259c00bc">

### D. Menu for Users
* Management
   * Register Doctor
   * Remove Doctor
   * Doctor Report
   * Disease Report
   * Logout
* Receptionist
   * Register Patient
   * Search Patient
   * Check Appointment
   * Logout
* Doctor
   * Diagnosis
   * Logout

## DEMO
Let’s go through a live demo to better understand the whole application.

Throughout the application, sessions are used to check user to give authorized access to the page.

### Login Page
Incorrect username and password.

<img width="720" alt="Screenshot 2024-04-19 at 11 23 04" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/ae9fa0bf-5320-4317-b8a9-0481521f4317">

Enter both username and password for access.
<img width="720" alt="Screenshot 2024-04-19 at 11 24 51" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/90f10fb3-f457-4632-ba8e-7eb3ccac4e33">

### Login Management
Management landing page.

<img width="720" alt="Screenshot 2024-04-19 at 11 25 46" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/a5aa28bf-688f-4736-9af7-6b77cf5a1a48">

__1. Register a doctor.__

<img width="720" alt="Screenshot 2024-04-19 at 11 26 26" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/76a4c297-b0af-45b1-8383-e25ac8569d90">

Registration successful. Credentials will be downloaded here. 
<img width="720" alt="Screenshot 2024-04-19 at 11 27 20" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/f4844fe8-141f-4769-90c3-b8cc8a8271aa">

*Future Improvement: Above credential can be update by using email service instead of downloading text file.*

Credential for doctor 'Albert ABC' (doc_26)

<img width="560" alt="Screenshot 2024-04-19 at 11 30 03" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/a7f96741-8498-4b15-938d-8f3002c192b6">


Doctor 'Albert ABC' is added to doctor table.

<img width="613" alt="Screenshot 2024-04-19 at 11 34 36" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/a6161166-6a4b-4e15-9b1b-b6c3a8656638">

Doctor 'Albert ABC' credential and role access added to login table.
<img width="613" alt="Screenshot 2024-04-19 at 11 38 15" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/a01118cc-e6b6-40ee-b231-94591cce86bf">

__2. Remove doctor.__

E.g. Albert ABC.
*This only removes login access for doctor. A simple rule of internet, nothing is deleted but disabled.*
<img width="720" alt="Screenshot 2024-04-19 at 12 10 00" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/cd662c8f-ce64-4ff8-9d65-95f3e223d806">
<img width="720" alt="Screenshot 2024-04-19 at 12 12 19" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/4a3b382b-7aae-49fc-9b1c-227aeea8df14">


Error handling in remove doctor.

*For instance, I have a user: doc_17 & id: 17.*
Following is the invalid data input.
<img width="720" alt="Screenshot 2024-04-19 at 12 28 28" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/29d4aa56-5934-4382-82b2-59802d17dc7b">


Error message is displayed below.

<img width="720" alt="Screenshot 2024-04-19 at 12 29 05" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/b597986e-effe-4d08-9bfc-c864036675fc">

__3. Monthly Report Doctor.__

Now next is view doctor report, but for doc_26 we don’t have any data, so I will be using doc_1 for illustration purpose.

<img width="720" alt="Screenshot 2024-04-19 at 12 44 25" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/036ef2b3-02ee-409c-9269-0d02e511b3f5">

Report for doc_1.

<img width="720" alt="Screenshot 2024-04-19 at 12 44 53" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/e683c83d-f15a-47db-9f82-7391aed18a1c">

__4. Disease Registration Report__
Similarly is for Disease Registration Report.

<img width="720" alt="Screenshot 2024-04-19 at 12 46 07" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/643ff287-6fd7-4556-98b1-28907cd4b709">

Logout brings us back to index page including login.

### Login Doctor.
Doctor's landing page.

<img width="720" alt="Screenshot 2024-04-19 at 17 37 26" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/3587fee8-ccb9-4bc5-a453-929a45f7c2cc">

__1. Diagnose Patient.__

Enter patient id to diagnose patient. If patient exist, then only the remaining page is loaded.
For illustration purpose, patient id is 11. Details for patient 11 is loaded on left half and diagnosis form on the right.

<img width="720" alt="Screenshot 2024-04-19 at 17 40 15" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/ea7d5e78-9d71-49ee-8303-741a8f84c03f">

Error data input message is displayed and prevents diagnosing that data.

This one is for discharge date with infected patient.
<img width="720" alt="Screenshot 2024-04-19 at 17 45 43" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/2e840260-b4b8-478f-973d-91ecf21457f9">

If cured and discharged (valid case), record diagnosis.

<img width="720" alt="Screenshot 2024-04-19 at 17 48 00" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/636aea13-70de-46ae-9b2a-7093d70054b5">

Updated data for table patient (d_pat_11).

<img width="720" alt="Screenshot 2024-04-19 at 17 48 31" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/1181794e-789c-4ae7-bf57-937e06845b19">

Updated data for table d_patient.

<img width="720" alt="Screenshot 2024-04-19 at 17 50 27" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/1e815661-3bc6-4650-8976-671d0cb226b2">

### Login Receptionist.
Receptionist Landing page.

<img width="720" alt="Screenshot 2024-04-19 at 18 17 07" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/e38c3d67-58e1-48a2-b039-fb3e01855a40">

__1. Register Patient.__

Registering a patient.

<img width="720" alt="Screenshot 2024-04-19 at 18 19 35" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/6ef7d167-a3bb-4593-89f5-eb679ab9abfe">

It downloads a receipt in form of text file for patient on successful registration.

*It can be further improved with an email or sms service!*

<img width="720" alt="Screenshot 2024-04-19 at 18 33 14" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/88a6dc66-fd1a-4921-ad2a-1b335708f69c">
<img width="720" alt="Screenshot 2024-04-19 at 18 33 55" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/40c3d945-cb96-4794-9174-a7e16301363f">


__2. Search Patient.__

You can search a patient from any combination in the form. The gender is the requied field.
<img width="720" alt="Screenshot 2024-04-19 at 18 36 48" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/bb596408-08e1-45e7-b5da-a4cb1c6e7e8b">

Results in form of table, which is scrollable.
<img width="720" alt="Screenshot 2024-04-19 at 18 40 54" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/c96b800b-0ead-4d60-ba70-ae536b4a46f3">

__3. Check Appointments.__

To check patient's appointment, enter patient id and it will show latest appointment for the patient.
<img width="720" alt="Screenshot 2024-04-19 at 18 43 34" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/186066cc-6f54-4348-99e4-7a736ca4ee17">

If patient don't exist, following error message is displayed.
<img width="720" alt="Screenshot 2024-04-19 at 18 44 23" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/59d4cb96-c298-4a39-b564-d57e958a1b88">

If invalid input data is provided, displays invalid patient id.
<img width="720" alt="Screenshot 2024-04-19 at 18 44 36" src="https://github.com/apo0orva/Hospital-Management-System/assets/67102493/3afff7c1-d7aa-4b92-b5cf-f91a762bd59e">

## Conclusion

The development and implementation of the PHP and MySQL-based clinic/hospital management system mark a significant achievement in the realm of healthcare administration technology. Through meticulous design and execution, the system offers a robust solution aimed at enhancing operational efficiency and elevating patient care standards.

By leveraging PHP for dynamic scripting and MySQL for robust database management, the system provides tailored functionalities to meet the diverse needs of MANAGEMENT, RECEPTIONISTS, and DOCTORS. From patient registration to appointment scheduling and medical record management, each user group benefits from intuitive tools and secure access controls.
The emphasis on security is paramount, with stringent authentication measures and access controls in place to safeguard sensitive patient information. Continuous testing and refinement ensure data integrity and system reliability, paving the way for future enhancements and iterative improvements.
The live demonstration underscores the system's effectiveness in real-world scenarios, highlighting its seamless user experience and functional capabilities. From user authentication to patient diagnosis and appointment management, the system demonstrates its ability to streamline operations and facilitate efficient healthcare delivery.
The clinic/hospital management system presented in this report represents a significant advancement in healthcare administration technology. By integrating technology with healthcare practices, the system holds the promise of revolutionizing clinic and hospital operations, ultimately contributing to improved patient outcomes and organizational efficiency.


For web based application, use following link
https://github.com/apo0orva/Hospital-Management-System-Python
