# Task Manager

Build a simple task management system where users can:
1. Add tasks with due date and priority.
2. View a list of tasks.
3. Mark tasks as completed.
4. View total pending and completed tasks.
5. Sort and filter tasks.
6. Show only pending tasks by default.
7. Highlight tasks due within the next 24 hours.
8. Prevent adding tasks with a past due date.
9. Display counts: Total, Completed, Pending.

**Tech Stack:**  
- PHP 7  
- CodeIgniter 3

## Setup Instructions

1. **Create the Database**

   Create a database named `task-manager`.

2. **Create the Table**

   ```sql
   CREATE TABLE tasks (
       id INT AUTO_INCREMENT PRIMARY KEY,
       title VARCHAR(255) NOT NULL,
       description TEXT,
       status ENUM('pending','completed') DEFAULT 'pending',
       due_date DATE,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );

   ALTER TABLE tasks 
   ADD COLUMN priority ENUM('low', 'medium', 'high') DEFAULT 'medium';
   ```

3. **Configure CodeIgniter**

   - Check your database connection in `application/config/database.php`.
   - Ensure other CodeIgniter project settings are correct, such as:
     - Set your `base_url` in `application/config/config.php`.
     - Enable error reporting for development (`index.php` or `config.php`).
     - Set the correct timezone in `application/config/config.php`.
     - Configure session settings in `application/config/config.php`.
     - Set encryption key in `application/config/config.php` for sessions.
     - Adjust autoload settings in `application/config/autoload.php` if needed.
     - Update `application/config/routes.php` for custom routes if

4. **Run the Application**

   - Start your local server (e.g., XAMPP).
   - Access the project in your browser: `http://localhost/task-manager`.

5. **Features to Test**

   - Add task (with due date and priority).
   - View, sort, and filter tasks.
   - Mark tasks as completed.
   - Show only pending tasks by default.
   - Highlight tasks due within the next 24 hours.
   - Prevent adding tasks with a past due date.
   - Display counts: Total, Completed, Pending.

## Requirements

- PHP 7.x
- CodeIgniter 3.x
- MySQL/MariaDB

## Notes

- Make sure your database is running and accessible.
- Test all features to ensure everything works as