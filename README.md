# eComm - Custom PHP MVC CMS

A robust eCommerce Content Management System (CMS) built with **Native PHP 8** using a custom **Model-View-Controller (MVC)** architecture. This project demonstrates advanced web development concepts including custom routing, security middleware, and a RESTful API for dashboard analytics, without relying on third-party frameworks like Laravel or Symfony.

## 🚀 Features

### Core Architecture
* [cite_start]**Custom MVC Framework:** Full separation of concerns with a custom directory structure (Controllers, Models, Views, Repositories)
* [cite_start]**Regex-Based Routing:** A custom `Router` class that handles dynamic URLs and parameters (e.g., `members/{id}/edit`)
* [cite_start]**Repository Pattern:** Database logic is abstracted into repositories (e.g., `UserRepository`, `ItemRepository`) to maintain clean controller code
* [cite_start]**Dependency Injection:** Services and repositories are injected into controllers

### 🛡️ Security
* [cite_start]**CSRF Protection:** Built-in middleware (`VerifyCsrfToken`) and token generation services to prevent Cross-Site Request Forgery
* [cite_start]**Secure Authentication:** Session-based login system with password hashing
* [cite_start]**Input Sanitization:** Global helper functions (e.g., `e()`) to prevent XSS attacks
* [cite_start]**PDO Prepared Statements:** All database queries use prepared statements to prevent SQL injection

### 📊 Dashboard & Analytics
* [cite_start]**Real-Time Visualization:** Interactive charts powered by **Chart.js** and fed by an internal API
* **Analytics:**
    * [cite_start]User registration trends (Yearly/Monthly
    * [cite_start]Item rating analysis
    * [cite_start]Category distribution stats
* [cite_start]**Notification System:** Asynchronous notification fetching via API

### 📦 Management Modules
* [cite_start]**User Management:** Add, edit, delete, and approve pending members
* [cite_start]**Items (Products):** Full CRUD for products with support for ratings, status (New/Used), and country of origin
* [cite_start]**Categories:** hierarchical category management with visibility and ad settings
* [cite_start]**Comments:** Moderation system to approve or delete user comments

## 🛠️ Technology Stack
* **Backend:** PHP 8+
* **Database:** MySQL
* **Frontend:** HTML5, CSS3, JavaScript (ES6 Modules)
* **Libraries:** Chart.js, FontAwesome

## 📂 Installation

1.  **Clone the Repository**
    ```bash
    git clone https://github.com/h-samer97/PHP-ECommerce-OOP-MVC
    ```

2.  **Database Setup**
    * Create a MySQL database named `shop`.
    * Import the provided SQL schema (not included in this text file, but required for `users`, `items`, `categories`, `comments`, and `notifications` tables).

3.  **Configuration**
    * [cite_start]Update your database credentials in `Core/Abstracts/AbstractDBConnection.php` (or `Core/Database/DBConnection.php` depending on implementation details)[cite: 115].
    * Default configuration found in analysis:
        * User: `root`
        * Password: `root`
        * Host: `eComm.local` (Change this to `localhost` if needed)
        * DB Name: `shop`

4.  **Web Server**
    * Point your web server (Apache/Nginx) to the `Public` directory.
    * Ensure URL rewriting is enabled to route all requests to `index.php`.

## 🔌 API Endpoints

[cite_start]The system includes an internal API used by the frontend dashboard[cite: 107]:
* `GET /api/getUsersWithDates` - User registration statistics.
* `GET /api/analiysRating` - Item rating distribution.
* [cite_start]`GET /api/searchData?q={query}` - Global search for Users, Items, and Categories[cite: 1453].
* `GET /api/monthlyRegistrationCount` - Monthly user stats.
* [cite_start]`GET /api/getNotifs` - Fetch user notifications[cite: 1526].
