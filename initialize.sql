CREATE TABLE categories ( id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL, parent_id INT NULL, FOREIGN KEY (parent_id) REFERENCES categories(id) );

CREATE TABLE products ( id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255) NOT NULL, short_description VARCHAR(255) NOT NULL, detailed_description TEXT NOT NULL, specifications TEXT, features TEXT, price DECIMAL(10, 2) NOT NULL );

CREATE TABLE product_categories ( product_id INT, category_id INT, FOREIGN KEY (product_id) REFERENCES products(id), FOREIGN KEY (category_id) REFERENCES categories(id) );

CREATE TABLE users ( id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(255) NOT NULL UNIQUE, password_hash VARCHAR(255) NOT NULL );

INSERT INTO categories (name, parent_id) VALUES ('Electronics', NULL), ('Laptops', 1), ('Smartphones', 1), ('Home Appliances', NULL), ('Vacuum Cleaners', 4);

INSERT INTO products (name, short_description, detailed_description, specifications, features, price) VALUES ('Asus ROG Zephyrus G14', 'High-end gaming laptop with RTX 4060', 'The Asus ROG Zephyrus G14 offers exceptional performance with AMD Ryzen 9 and RTX 4060 graphics. It features a 14" WQHD display with 165Hz refresh rate, advanced cooling system, and a lightweight design.', 'CPU: AMD Ryzen 9, GPU: RTX 4060, RAM: 16GB DDR5, Storage: 1TB SSD', 'Ultra-thin design, 165Hz display, Advanced cooling', 44990), ('Lenovo Legion 5 Pro', 'Powerful gaming laptop with AMD Ryzen 7', 'Lenovo Legion 5 Pro delivers top-tier gaming performance with Ryzen 7 and RTX 3070. It boasts a 16" QHD display, RGB keyboard, and enhanced thermals.', 'CPU: AMD Ryzen 7, GPU: RTX 3070, RAM: 16GB DDR4, Storage: 1TB SSD', '16" QHD display, RGB keyboard, Superior cooling', 39990), ('iPhone 15 Pro Max', 'Top-tier Apple smartphone with advanced camera', 'Apple iPhone 15 Pro Max offers unparalleled performance with the A17 Bionic chip and a state-of-the-art triple-camera system.', 'Display: 6.7" OLED, Chip: A17 Bionic, Storage: 256GB', 'ProMotion 120Hz, Ceramic Shield, MagSafe', 33990);

INSERT INTO product_categories (product_id, category_id) VALUES (1, 2), (2, 2), (3, 3);

INSERT INTO users (username, password_hash) VALUES ('admin', SHA2('admin0', 256));
