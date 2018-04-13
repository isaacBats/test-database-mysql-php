CREATE DATABASE tests;
USE tests; 
CREATE TABLE users (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name VARCHAR(30) NOT NULL, lastname VARCHAR(30) NOT NULL, email VARCHAR(50), created_at TIMESTAMP);
INSERT INTO users (name, lastname, email) VALUES ('Isaac', 'Batista', 'isaac@pengo.com'), ('Mar', 'Perez', 'mar@pengo.com'), ('Daniel', 'Batista', 'daniel@pengo.com'); 