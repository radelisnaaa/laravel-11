If the issue persists, you can replace the corrupted system tables:

Stop the MySQL service in the XAMPP Control Panel.
Navigate to C:\xampp\mysql\data.
Rename the mysql folder to something like mysql_backup.
Copy a fresh mysql folder from C:\xampp\mysql\backup to C:\xampp\mysql\data.
Start the MySQL service from the XAMPP Control Panel.