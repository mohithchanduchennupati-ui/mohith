# Student Information System

Simple PHP + MySQL app to register students and list them.

Location: the files are in the `student_system/` folder.

Files included:
- `student.html` — registration form (UI)
- `student.php` — inserts submissions into DB
- `display.php` — lists all students
- `db.php` — PDO database connection (edit credentials)
- `assets/js/app.js` — client-side validation and UX
- `create_table.sql` — SQL script to create database and table

Quick setup (Windows, using XAMPP/WAMP):

1. Copy the `student_system` folder into your web server document root. With XAMPP that's usually `C:\xampp\htdocs\`.
2. Edit `db.php` and set correct `$host`, `$user`, and `$pass`.
3. Create the database and table using one of the following:

   - Using phpMyAdmin: import `create_table.sql`.
   - Or using MySQL command line (PowerShell):

```powershell
mysql -u root -p < create_table.sql
```

4. Open the form in your browser:

   - `http://localhost/student_system/student.html` (or `http://localhost/your-folder/student.html` depending on where you placed it)

5. Submit a student — you'll be redirected to `display.php` which lists records and shows a success message.

Notes & security:
- `db.php` currently uses local credentials; for production, do not store plain credentials in code.
- Use HTTPS in production and add authentication before exposing forms.