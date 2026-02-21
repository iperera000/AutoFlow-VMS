**AutoFlow** – Modern Vehicle Management System

AutoFlow is a web-based Vehicle Management System designed to manage and optimize vehicle operations within a fleet management environment. 
This project highlights collaborative software development using GitHub, demonstrating structured version control, team contribution tracking, and modular web design.

## Key Features
* **Cinematic Hero Section:** Immersive full-width video background with typography.
* **Dynamic Fleet Management:** Visualized modules for tracking maintenance, sales, and availability.
* **Responsive Design:** Fully optimized for desktop, tablet, and mobile devices using CSS Media Queries.
* **Interactive UI:** Smooth scroll-reveal animations and hover effects for an engaging user experience.
* **Inventory Management:** CRUD (Create, Read, Update, Delete) capability concept for vehicle listings and sales data.
* **Driver Management** – Assign drivers to vehicles, and manage contact information.
* **User Roles & Permissions** – Admin and driver roles with granular access control.
* 
## Tech Stack
- **Frontend:** HTML5, CSS3, JavaScript
- **Backend:** PHP
- **Database:** MySQL (managed via phpMyAdmin)
- **Version Control:** Git & GitHub
- **Development Environment:** XAMPP

## Requirements
- A local web server (XAMPP, WAMP, MAMP, etc.)
- PHP 7.4 or higher
- MySQL
  
## Installation
1. **Download the project**  
   - Clone this repository or download the ZIP and extract it into your web server's document root (e.g., `htdocs` for XAMPP).

2. **Set up the database**  
   - Open phpMyAdmin (`http://localhost/phpmyadmin`).  
   - Create a new database (e.g., `my_project_db`).  
   - Select the new database, click the **Import** tab, and choose the file `database/project_dump.sql`. Then click **Go**.

3. **Configure the database connection**  
   - In the project folder, you'll find `config.sample.php`. Make a copy of it and rename the copy to `config.php`.  
   - Open `config.php` and fill in your database details:  
     ```php
     $db_host = 'localhost';
     $db_user = 'root';          // your MySQL username
     $db_pass = '';              // your MySQL password
     $db_name = 'my_project_db'; // the database you created
     ```

4. **Run the project**  
   - Open your browser and go to `http://localhost/my_project/` (adjust the folder name if needed).

  
