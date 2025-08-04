# Drivers-Scheduling-System
A PHP & MySQL-based system that automates driver and vehicle scheduling, distance-based salary computation, and PDF report generation for Gombe State University.

📌 Gombe State University Drivers & Vehicles Scheduling System
A web-based application built to streamline driver and vehicle scheduling, route assignments, salary calculation, and report generation for Gombe State University. The system enhances operational efficiency by automating tasks traditionally handled manually.

🚀 Features
✅ Admin authentication and role-based access

✅ Add/edit/delete drivers and vehicles

✅ Assign routes and track distance covered

✅ Auto-calculate salaries based on kilometers

✅ Generate and export salary reports (PDF via TCPDF)

✅ File upload support (e.g., driver licenses, route slips)

✅ Clean and intuitive UI with Bootstrap

🛠️ Tech Stack
Technology	Description
HTML5/CSS3	Front-end markup and styling
PHP	Core backend scripting
MySQL	Relational database
Bootstrap	Responsive design
JavaScript	Interactivity and validations
TCPDF	PDF report generation

📁 Project Structure
📁 gsu_driver_scheduling_system/
├── 📁 admin/         → Admin dashboards and management pages
├── 📁 auth/          → Login/logout and session control
├── 📁 config/        → Database configuration
├── 📁 exports/       → Salary and route PDF exports
├── 📁 includes/      → Reusable PHP scripts (navbars, footers, etc.)
├── 📁 public/        → Frontend views, images, JS/CSS assets
├── 📁 tcpdf/         → TCPDF library for PDF generation
├── 📁 uploads/       → Uploaded driver/vehicle documents
├── 📄 gsu_drivers_system.sql → Database export
├── 📄 README.md

⚙️ Setup Instructions
1. Clone or download the repository:
git clone https://github.com/your-username/gsu-driver-scheduling-system.git

2. Import the database:

Use phpMyAdmin or CLI to import gsu_drivers_system.sql into MySQL.

3. Configure DB credentials:

Open config/db_config.php and update with your local DB host, username, password, and DB name.

define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'gsu_drivers_system');

4. Launch the app:

Place the folder in your server root (e.g., htdocs for XAMPP).

Visit: http://localhost/gsu_driver_scheduling_system

Default login
Username: admin
Password: admin123

📤 Export Sample
Generate PDF reports of:

Driver salaries

Route summaries

Powered by TCPDF

Stored temporarily in the exports/ folder



