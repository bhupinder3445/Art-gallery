# 🎨 Art Gallery Management System

A web-based PHP & MySQL application to manage an online collection of paintings and artists. Users can add, view, edit, and delete paintings and artist details using a clean, stylish UI.

---

## 📁 Features

- **View Paintings:** List of recent artworks with artist name and year.
- **Add Painting:** Add new artwork with title, year, artist, and description.
- **Edit/Delete Painting:** Update or remove existing painting entries.
- **View Artists:** List all registered artists with full details.
- **Add Artist:** Add a new artist with name, nationality, and life years.
- **Edit/Delete Artist:** Manage artist records.
- **Modern UI:** Clean and responsive interface with easy navigation.

---

## 🧰 Technologies Used

- **Frontend:** HTML, CSS (custom + Google Fonts)
- **Backend:** PHP 8.x
- **Database:** MySQL (with `art-3rd.sql` schema)
- **Web Server:** PHP built-in server or Apache

---

## 🛠 Installation & Setup

1. Import the `art-3rd.sql` file into your MySQL server to create the database and tables.
```bash
mysql -u your_user -p < art-3rd.sql
```
2. Update the `db.php` file with your database credentials.
3. Place all project files in your web server's document root.
4. Run the PHP server or access via your web server.

```bash
php -S localhost:8000
```
5. Navigate to `index.php` in your browser to start using the app.

```bash
http://localhost:8000/index.php 
```
---

6. Use the Application

   - View Paintings: See latest paintings on homepage.

   - Add Artist: Use "Add Artist" page to add new artists.

   - Add Painting: Add new paintings linked to artists.

   - Edit/Delete: Manage artists and paintings with edit/delete options.

7. Troubleshooting Tips

   - Ensure your database credentials in db.php are correct.

   - Check PHP error logs for any issues.

   - Make sure your MySQL service is running.

   - Use modern browsers like Chrome or Firefox for testing.

   - Clear browser cache if styles or changes don’t show up

## 📂 Project Structure

project03

 ├── screenshots            # all required screenshots of the project

 ├── add_artist.php          # Form to add new artist

 ├── add_painting.php        # Form to add new painting

 ├── artists.php             # List all artists

 ├── db.php                  # DB connection

 ├── delete_artist.php       # Delete artist logic

 ├── delete_painting.php     # Delete painting logic

 ├── edit_painting.php       # Edit painting form

 ├── index.php               # View paintings (Home)

 ├── css/style.css           # All styling rules

 ├── art-3rd.sql             # MySQL DB schema

 └── README.md              
 
---

## 📌 Sample Artist Entry

| Field         | Value    |
|---------------|----------|
| First Name    | Pablo    |
| Last Name     | Picasso  |
| Nationality   | Spain    |
| Year of Birth | 1881     |
| Year of Death | 1973     |

---

## 📌 Sample Data to Fill the "Add Painting" Form

| Field        | Example Value                                |
|--------------|---------------------------------------------|
| Title        | Starry Night                                |
| Year of Work | 1889                                        |
| Artist       | (Select from dropdown, e.g. "Vincent van Gogh") |
| Description  | A famous depiction of a swirling night sky over a quiet village. |

---

## 📃 License

This project is for educational use only. No license applied.

---

If you have any questions or want to contribute, feel free to reach out!
