CREATE DATABASE IF NOT EXISTS attendance_db;

USE attendance_db;

CREATE TABLE IF NOT EXISTS attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_name VARCHAR(100) NOT NULL,
    employee_id VARCHAR(20) NOT NULL,
    attendance_date DATE NOT NULL,
    status ENUM('Present', 'Absent', 'Leave') NOT NULL
);
