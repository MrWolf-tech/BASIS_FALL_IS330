DROP DATABASE team2dbsite;
CREATE DATABASE team2dbsite;
CREATE TABLE team2dbsite.messages(message_id INT PRIMARY KEY AUTO_INCREMENT, message TEXT);
INSERT INTO team2dbsite.messages(message) VALUES ('hellworld'), ('item 2');