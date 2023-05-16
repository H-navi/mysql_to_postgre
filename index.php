<?php
// Connect to MySQL database
$mysql_host = "mysql_host";
$mysql_database = "mysql_db";
$mysql_user = "mysql_user";
$mysql_password = "mysql_password";

$mysql_conn = mysqli_connect($mysql_host, $mysql_user, $mysql_password, $mysql_database);

if (!$mysql_conn) {
    die("Connection to MySQL failed: " . mysqli_connect_error());
}

// Connect to Postgres database
$pg_host = "postgre_host";
$pg_database = "postgre_db";
$pg_user = "postgre_user";
$pg_password = "postgre_password";

$pg_conn = pg_connect("host=$pg_host dbname=$pg_database user=$pg_user password=$pg_password");

if (!$pg_conn) {
    die("Connection to Postgres failed: " . pg_last_error());
}

// Define the tables to be migrated
$tables = array(
    'table_1',
    'table_2',
    'table_3'
);

// Loop through each table and migrate the data
foreach ($tables as $table) {
    // Get the data from the MySQL table
    $mysql_query = "SELECT * FROM $table";
    $mysql_result = mysqli_query($mysql_conn, $mysql_query);

    // Loop through each row of data and insert it into the PostgreSQL table
    while ($row = mysqli_fetch_assoc($mysql_result)) {
        // Check for null or empty values
        foreach ($row as $key => $value) {
            if ($value === null || $value === "") {
                $row[$key] = "NULL";
            } else {
                $row[$key] = "'" . pg_escape_string($value) . "'";
            }
        }

        // Build the PostgreSQL insert statement
        $pg_query = "INSERT INTO $table (" . implode(', ', array_keys($row)) . ") VALUES (" . implode(', ', $row) . ")";

        // Execute the PostgreSQL insert statement
        $pg_result = pg_query($pg_conn, $pg_query);

        if (!$pg_result) {
            echo "Error inserting data into PostgreSQL table $table\n";
        }
    }
}

// Close the database connections
mysqli_close($mysql_conn);
pg_close($pg_conn);