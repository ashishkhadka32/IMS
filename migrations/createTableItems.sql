CREATE DATABASE oop;

USE oop;

CREATE TABLE items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(50),
    category_id INT,
    Foreign Key (category_id) REFERENCES categories(id)
);

drop DATABASE oop;
ALTER TABLE items DROP COLUMN category;