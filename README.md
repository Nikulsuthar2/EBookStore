# E-Bookstore Project

A simple E-Bookstore platform developed in PHP and MySQL. The project has two primary modules: **User** and **Admin**, providing functionalities for managing books, categories, purchases, and user profiles.

---

## Features

### User Module
- **User Registration & Login**: signup and login for users.
- **Homepage**: Displays all books categorized for easy navigation.
- **Search Bar**: Allows users to search for books by title.
- **Book Details**:
  - View book details (e.g., title, author, description).
  - Read the book in PDF format (if purchased).
- **Shopping Cart**:
  - Add books to the cart.
  - Proceed to checkout (no actual payment gateway integrated; simple payment confirmation UI).
- **User Profile**:
  - View all purchased books.
  - Manage account details.

### Admin Module
- **Admin Login**: Secure login system for the admin.
- **Dashboard**: Overview of key statistics (e.g., total users, total books, purchase reports).
- **Manage Books**:
  - Add, edit, update, and delete book details.
  - Upload books in PDF format.
- **Manage Categories**:
  - Add, edit, and update book categories.
- **User Management**: View and manage registered users.
- **Purchase Reports**: View detailed purchase history.

---

## Technology Stack
- **Backend**: PHP
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript
- **Server**: XAMMP Apache (local server)

---

## Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/yourusername/e-bookstore.git
   ```

2. **Setup the Database**
   - Create `ebookstore` database in phpMyAdmin 
   - Import the `ebookstore.sql` file from `SQL` folder into your MySQL server (phpMyAdmin).
   - Update database connection details in the `db.php` file:
    ```php
    $hostname = "localhost";
    $username = "your_database_username";
    $password = "your_database_password";
    $database = "ebookstore";
    ```

3. **Start the Local Server**
   - Ensure Apache and MySQL are running.
   - Place the project folder in the `htdocs` directory (if using XAMPP).
   - Access the website via `http://localhost/e-bookstore`.

4. **Admin Credentials**
   - Default admin credentials can be updated in the database under the `admin` table.

---

## Limitations
- No actual payment gateway integration; only a mock checkout process is implemented.
- Books are hosted locally and may require further optimization for large-scale deployment.

---

## Future Enhancements
- Integrate a payment gateway (e.g., Stripe or PayPal) for real purchases.
- Implement user reviews and ratings for books.
- Add recommendations based on user preferences.
- Improve UI/UX using modern frameworks like React or Bootstrap.
- Enable bulk upload of books and categories.


---

## Author
**Nikul Suthar** -> [Nikulsuthar2](https://github.com/Nikulsuthar2)

---
## Screenshots

![index](https://github.com/Nikulsuthar2/EBookStore/blob/main/Screenshot/index.png?raw=true)

![signup](https://github.com/Nikulsuthar2/EBookStore/blob/main/Screenshot/usersignin.png?raw=true)

![login](https://github.com/Nikulsuthar2/EBookStore/blob/main/Screenshot/user%20login.png?raw=true)

![home](https://github.com/Nikulsuthar2/EBookStore/blob/main/Screenshot/home.png?raw=true)

![cart](https://github.com/Nikulsuthar2/EBookStore/blob/main/Screenshot/cart.png?raw=true)

![profile](https://github.com/Nikulsuthar2/EBookStore/blob/main/Screenshot/userprofile.png?raw=true)

![details](https://github.com/Nikulsuthar2/EBookStore/blob/main/Screenshot/bookdetail.png?raw=true)

![paydtl](https://github.com/Nikulsuthar2/EBookStore/blob/main/Screenshot/payment.png?raw=true)

![admin dashboard](https://github.com/Nikulsuthar2/EBookStore/blob/main/Screenshot/adminhome.png?raw=true)

![booklist](https://github.com/Nikulsuthar2/EBookStore/blob/main/Screenshot/bookslist.png?raw=true)

![addbook](https://github.com/Nikulsuthar2/EBookStore/blob/main/Screenshot/addbook.png?raw=true)

![category](https://github.com/Nikulsuthar2/EBookStore/blob/main/Screenshot/bookcategorylist.png?raw=true)

![userlist](https://github.com/Nikulsuthar2/EBookStore/blob/main/Screenshot/userlist.png?raw=true)

![purchasereport](https://github.com/Nikulsuthar2/EBookStore/blob/main/Screenshot/bookpurchasereport.png?raw=true)