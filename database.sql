-- Create Database
CREATE DATABASE iot_dashboard;

-- Use Database
USE iot_dashboard;

-- Table for IoT sensor data
CREATE TABLE sensor_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    temperature INT NOT NULL,
    humidity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table for user login
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Insert demo user (sunil / 12345)
INSERT INTO users (username, password)
VALUES ('sunil', '12345');
