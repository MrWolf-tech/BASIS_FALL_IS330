DROP DATABASE IF EXISTS team2dbsite;
CREATE DATABASE team2dbsite;
USE team2dbsite;
CREATE TABLE team2dbsite.customers(customer_id INT PRIMARY KEY AUTO_INCREMENT, name TEXT,address TEXT, city TEXT, province TEXT, country TEXT, zip int, phone_number VARCHAR(12), email TEXT);
CREATE TABLE team2dbsite.orders(order_id INT PRIMARY KEY AUTO_INCREMENT, customer_id INT, FOREIGN KEY(customer_id) REFERENCES customers(customer_id), destination_address TEXT, destination_city TEXT, destination_province TEXT, destination_country TEXT, destination_zip INT, quote_discount FLOAT, payment_method varchar(16));
CREATE TABLE team2dbsite.items(item_id INT PRIMARY KEY AUTO_INCREMENT, item_name TEXT, price INT);
CREATE TABLE team2dbsite.order_items(order_item_id INT PRIMARY KEY AUTO_INCREMENT, order_id INT, FOREIGN KEY(order_id) REFERENCES orders(order_id), item_id INT, FOREIGN KEY(item_id) REFERENCES items(item_id), quote_price FLOAT);
CREATE TABLE team2dbsite.requested_quotes(quote_id INT PRIMARY KEY AUTO_INCREMENT, customer_id INT, FOREIGN KEY(customer_id) REFERENCES customers(customer_id), email TEXT, phone_number VARCHAR(12), quote_text TEXT);
CREATE TABLE team2dbsite.account_info(customer_id INT PRIMARY KEY AUTO_INCREMENT, username TEXT, pass_hash VARCHAR(1024), salt TEXT);



INSERT INTO team2dbsite.customers(name, address, city, province, country, zip, phone_number, email) VALUES ('helloworld', '4500 16th Street', 'Port Orchard', 'Washington', 'USA', '98367', '3603454456', 'true@whatever.com');
INSERT INTO team2dbsite.orders(customer_id, destination_address, destination_city, destination_province, destination_country, destination_zip, quote_discount, payment_method) VALUES (1, '7870 Lions Road', 'Seattle', 'Washington', 'USA', 10903, 1000000, 'credit');
INSERT INTO team2dbsite.items(item_name, price) VALUES ('stuff', 500.50);
INSERT INTO team2dbsite.order_items(order_id, item_id, quote_price) VALUES (1, 1, 2500.01);
INSERT INTO team2dbsite.requested_quotes(customer_id, email, phone_number, quote_text) VALUES (1, 'why@not.us', '3789065905','Give me big speakers');
INSERT INTO team2dbsite.account_info(customer_id, username, pass_hash, salt) VALUES (1,'Us3RN4m3', '9', '9')








