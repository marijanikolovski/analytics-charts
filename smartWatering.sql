CREATE DATABASE smartWatering;
USE smartWatering;

CREATE TABLE devices (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    location VARCHAR(100) NOT NULL
);

CREATE TABLE sensor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    device_id INT NOT NULL,
    sensor_type VARCHAR(20) NOT NULL,
    timestamp DATETIME NOT NULL,
    value DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (device_id) REFERENCES devices (id)
);

INSERT INTO devices (name, location) VALUES
('Device1', 'Location1'),
('Device2', 'Location2'),
('Device3', 'Location3'),
('Device4', 'Location4'),
('Device5', 'Location5');

INSERT INTO sensor (device_id, sensor_type, timestamp, value) VALUES
(1, 'Humidity', '2023-08-04 11:00:00', 80.50),
(1, 'Ph', '2023-08-04 11:00:00', 6.5),
(2, 'Humidity', '2023-08-04 11:00:00', 65.10),
(2, 'Ph', '2023-08-04 11:00:00', 3.8),
(3, 'Humidity', '2023-08-04 11:00:00', 32.80),
(3, 'Ph', '2023-08-04 11:02:00', 6.9),
(4, 'Humidity', '2023-08-04 11:00:00', 78.10),
(4, 'Ph', '2023-08-04 11:00:00', 4.2),
(5, 'Humidity', '2023-08-04 11:00:00', 85.80),
(5, 'Ph', '2023-08-04 11:00:00', 8.7),
(1, 'Humidity', '2023-08-04 10:00:00', 50.50),
(1, 'Ph', '2023-08-04 10:00:00', 6.5),
(2, 'Humidity', '2023-08-04 10:00:00', 45.10),
(2, 'Ph', '2023-08-04 10:00:00', 5.8),
(3, 'Humidity', '2023-08-04 10:00:00', 65.80),
(3, 'Ph', '2023-08-04 10:02:00', 6.9),
(4, 'Humidity', '2023-08-04 10:00:00', 55.10),
(4, 'Ph', '2023-08-04 10:00:00', 7.2),
(5, 'Humidity', '2023-08-04 10:00:00', 48.80),
(5, 'Ph', '2023-08-04 10:00:00', 4.7),
(1, 'Humidity', '2023-08-04 09:00:00', 70.50),
(1, 'Ph', '2023-08-04 09:00:00', 6.6),
(2, 'Humidity', '2023-08-04 09:00:00', 56.10),
(2, 'Ph', '2023-08-04 09:00:00', 7.2),
(3, 'Humidity', '2023-08-04 09:00:00', 72.80),
(3, 'Ph', '2023-08-04 09:02:00', 4.8),
(4, 'Humidity', '2023-08-04 09:00:00', 45.10),
(4, 'Ph', '2023-08-04 09:00:00', 6.2),
(5, 'Humidity', '2023-08-04 09:00:00', 82.80),
(5, 'Ph', '2023-08-04 09:00:00', 5.4),
(1, 'Humidity', '2023-08-04 08:00:00', 35.50),
(1, 'Ph', '2023-08-04 08:00:00', 4.6),
(2, 'Humidity', '2023-08-04 08:00:00', 56.10),
(2, 'Ph', '2023-08-04 08:00:00', 8.2),
(3, 'Humidity', '2023-08-04 08:00:00', 72.80),
(3, 'Ph', '2023-08-04 08:02:00', 6.8),
(4, 'Humidity', '2023-08-04 08:00:00', 56.10),
(4, 'Ph', '2023-08-04 08:00:00', 4.2),
(5, 'Humidity', '2023-08-04 08:00:00', 75.80),
(5, 'Ph', '2023-08-04 08:00:00', 8.4);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
