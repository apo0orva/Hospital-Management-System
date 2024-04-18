CREATE DATABASE IF NOT EXISTS hospital;

USE hospital;

CREATE TABLE IF NOT EXISTS patient (
    pid INT PRIMARY KEY NOT NULL,
    pname VARCHAR(30) NOT NULL,
    gender CHAR(1) NOT NULL,
    address VARCHAR(50) NOT NULL,
    blood_group VARCHAR(5) NOT NULL,
    reg_pat_date DATETIME NOT NULL,
    CHECK (gender IN ('M','F','O')),
    CHECK (blood_group IN ('A+ve','A-ve','B+ve','B-ve','AB+ve','AB-ve','O+ve','O-ve'))
    );

CREATE TABLE IF NOT EXISTS doctor (
    did INT PRIMARY KEY NOT NULL,
    dname VARCHAR(30) NOT NULL,
    speciality VARCHAR(50) NOT NULL,
    gender CHAR(1) NOT NULL,
    CHECK (gender IN ('M','F','O'))
    );

CREATE TABLE IF NOT EXISTS d_patient (
    pid INT REFERENCES patient(pid),
    did INT REFERENCES doctor(did),
    disease VARCHAR(30) NOT NULL,
    admitted CHAR(1) NOT NULL,
    status CHAR(1) NOT NULL,
    CHECK (admitted IN ('Y','N'))
    );

CREATE TABLE IF NOT EXISTS login (
    username CHAR(20) PRIMARY KEY,
    password CHAR(20),
    role INT(1),
    id INT,
    CHECK (role IN (1,2,3))
    );

INSERT INTO login (username, password, role) VALUES
    ('u1', 'p1', 1),
    ('u2', 'p2', 2);

INSERT INTO login VALUES ('u3', 'p3', 3, 1);

INSERT INTO doctor VALUES (1, 'Test doctor', 'Test Speciality', 'O');
