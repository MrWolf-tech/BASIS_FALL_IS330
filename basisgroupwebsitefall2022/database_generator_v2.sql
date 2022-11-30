DROP DATABASE IF EXISTS team2dbsite;
CREATE DATABASE team2dbsite;
USE team2dbsite;
CREATE TABLE team2dbsite.customers
			(
			customer_id INT PRIMARY KEY AUTO_INCREMENT,
			name TEXT,address TEXT,
			city TEXT,
			state TEXT,
			country TEXT,
			zip int,
			phone_number VARCHAR(12),
			email TEXT
			);
CREATE TABLE team2dbsite.orders
			(
			order_id INT PRIMARY KEY AUTO_INCREMENT,
			customer_id INT,
			FOREIGN KEY(customer_id) REFERENCES customers(customer_id),
			destination_address TEXT,
			destination_city TEXT,
			destination_state TEXT,
			destination_country TEXT,
			destination_zip INT,
			quote_discount FLOAT,
			payment_method varchar(16)
			);
CREATE TABLE team2dbsite.items
			(
			item_id INT PRIMARY KEY AUTO_INCREMENT,
			item_name TEXT,
			price INT,
			photo VARCHAR(255)
			);
CREATE TABLE team2dbsite.order_items
			(
			order_item_id INT PRIMARY KEY AUTO_INCREMENT,
			order_id INT,
			FOREIGN KEY(order_id) REFERENCES orders(order_id),
			item_id INT,
            quantity INT,
			FOREIGN KEY(item_id) REFERENCES items(item_id),
			quote_price FLOAT
			);
CREATE TABLE team2dbsite.requested_quotes
			(
			quote_id INT PRIMARY KEY AUTO_INCREMENT,
			customer_id INT,
			FOREIGN KEY(customer_id) REFERENCES customers(customer_id),
			email TEXT,
			phone_number VARCHAR(12),
			quote_text TEXT
			);
CREATE TABLE team2dbsite.account_info
			(
			customer_id INT PRIMARY KEY AUTO_INCREMENT,
			username TEXT,
			pass_hash TEXT,
            is_admin BOOLEAN
			);



INSERT INTO team2dbsite.customers
		(
        name, 
        address, 
        city, 
        state, 
        country, 
        zip, 
        phone_number, 
        email
        ) 
        VALUES 
            (
            'Admin', 
            '4500 16th Street', 
            'Port Orchard', 
            'Washington', 
            'USA', 
            '98367', 
            '3603454456', 
            'true@whatever.com'
            ),(
            'John PHP', 
            'Anywhere', 
            'Anyplace', 
            'Washington', 
            'USA', 
            '98367', 
            '3603454456', 
            'true@whatever.com'
            ),(
            'John PHP', 
            'Anywhere', 
            'Anyplace', 
            'Washington', 
            'USA', 
            '98367', 
            '3603454456', 
            'true@whatever.com'
            );
INSERT INTO team2dbsite.orders
		(
		customer_id,
		destination_address,
		destination_city,
		destination_state,
		destination_country,
		destination_zip,
		quote_discount,
		payment_method
		)
		VALUES
			(
			1,
			'7870 Lions Road',
			'Seattle',
			'Washington',
			'USA',
			10903,
			1000000,
			'credit'
			);
INSERT INTO team2dbsite.items
		(
		item_name, 
		price,
        photo
		) 
		VALUES 
			(
			'stuff',
			500.50,
            'test.jpg'
			), (
			'thing',
			200,
            'test2.jpg'
			);
INSERT INTO team2dbsite.order_items
		(
		order_id,
		item_id,
        quantity,
		quote_price
		)
		VALUES
			(
			1,
			1,
            5,
			2500.01
			);
INSERT INTO team2dbsite.requested_quotes
		(
		customer_id, 
		email, 
		phone_number, 
		quote_text
		) 
        VALUES 
			(
			1, 
			'why@not.us', 
			'3789065905',
			'Give me big speakers'
			);
INSERT INTO team2dbsite.account_info
		(
		customer_id,
		username,
		pass_hash,
        is_admin
        
		) 
        VALUES 
			(1,
			'admin', 
			'$2y$10$kZzhofy7hXXlzxRhwouZs.Fh0e/29b5Hecxq.SeeEsGb.Voo0uLN6', TRUE
			), (2,
			'Us3RN4m3', 
			'9', FALSE
			);



SELECT * 
FROM team2dbsite.order_items
JOIN team2dbsite.items ON team2dbsite.order_items.item_id = team2dbsite.items.item_id
JOIN team2dbsite.orders ON team2dbsite.order_items.order_id = team2dbsite.orders.order_id
JOIN team2dbsite.customers ON team2dbsite.orders.customer_id = team2dbsite.orders.customer_id
JOIN team2dbsite.account_info ON team2dbsite.customers.customer_id = team2dbsite.account_info.customer_id;

UPDATE team2dbsite.account_info
SET customer_id = 2, username = "I'm different", pass_hash = 2
WHERE customer_id = 2;


DELETE FROM team2dbsite.requested_quotes
	WHERE quote_id =1;