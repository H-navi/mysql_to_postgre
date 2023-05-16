
# Migrate from Mysql to Postgre Database

This tool can migrate data from mysql to postgre database with all values without defining them.




## Usage/Examples

```php
//change the mysql connection here:
$mysql_host = "mysql_host";
$mysql_database = "mysql_db";
$mysql_user = "mysql_user";
$mysql_password = "mysql_password";

//change the postgre connection here:
$pg_host = "postgre_host";
$pg_database = "postgre_db";
$pg_user = "postgre_user";
$pg_password = "postgre_password";

//change table list
$tables = array(
    'table_1',
    'table_2',
    'table_3'
);
```


## Installation

Run with xampp

```bash
  1. git clone https://github.com/H-navi/postgre_to_mysql.git
  2. cd postgre_to_mysql
  3. create idenctic table in postgre
  4. open browser and type "localhost/postgre_to_mysql/index.php"
```
    
