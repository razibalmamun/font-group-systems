## <div align="center">Font Group System Using Core PHP, MySQL & JS (Vuejs 3)</div>

<p align="center">
<img src="./github/php.png" width="150" alt="PHP logo"></a>&nbsp;&nbsp;&nbsp;&nbsp;
<img width="200" src="./github/mysql.png" alt="MySQL logo"></a>
<img alt="PostgreSQL" width="150" src="./github/vue_3.png" alt="VUE logo">
</p>

## Featuresa

> Using Core PHP, MySQL and Vuejs 3, implemented a system to create font groups. That is a one-page solution without reloading.
> 
> Matching result is cached in Redis for 60 seconds. Following requests for the same combination of filtering parameters (birth year, birth month) do not query database before cache expires. 
> 
> - [x] Font can uploading without a Button and uploading only the TTF file extension.
> - [x] Shown the Uploaded Font List.
> - [x] Making a Font Group with multiple fonts. On load, just one Field has there. After clicking Add Row, another row is added.  You must have to select two fonts If you want to create a group.
> - [x] Shown the list of All Font Group. Edit and Delete that Font Group. 



## Local Installation

Clone the repository in your local machine using `git clone https://github.com/razibalmamun/font-group-systems.git`

### Requirements for Local Environment

-   [x] PHP Version 7.4 | 8.1
-   [x] Node Version 16.13.0

### Redis on Laragon
Redis is no longer supported in Windows, but the version 3.2.1 is still available to use [(ref)](https://redis.com/blog/redis-on-windows-8-1-and-previous-versions/#:~:text=Officially%2C%20Redis%20is%20not%20supported,ported%20to%20Windows%20by%20MSOpenTech.), so that's why laragon contains version 3.* only.
So, if you are using Laragon, you can follow this link to install `Redis` --> [Redis on Laragon](https://dev.to/dendihandian/installing-php-redis-extension-on-laragon-2mp3)

### Adding PostgreSQL to Laragon
You can find any version you want to install from [enterprisedb.com/download-postgresql-binaries](https://www.enterprisedb.com/download-postgresql-binaries) and make sure it supports your windows machine. So, if you are using Laragon you can follow this link to install `PostgreSQL` --> [PostgreSQL on Laragon](https://dev.to/dendihandian/adding-postgresql-to-laragon-2kde)

### Running the Application

1.  Open terminal/command promt from inside the `project folder` folder
2.  run command `cp .env.example .env`
3.  update `.env` file database information according to your local machine.
4.  run command `composer install`
5.  run command `php artisan migrate`
6.  run command `php artisan serve`
7.  Now it's ready to browse. Just open your browser and enter `http://localhost:8000`
8.  Run command `php artisan test` (Unit & Feature Testing)

>Note: if you face any issue about `pdo_pgsql` extension like laravel error `extension not found`, please write full extension name like `php_pdo_pgsql.dll`, >not only `pdo_pgsql` in your `php ini` file.
>
>`extension=php_pdo_pgsql.dll`
>`extension=php_pgsql.dll`

### Import Customer Data From CSV to PostgreSQL
You can find `test-data\test-data.csv` csv file inside the `project folder`. Then you can run `SQL Shell (psql)` or login into your `PostgreSQL`. To connect using database, right click on database name. Now you can click `PSQL Tool`. After clicking `PSQL Tool` a tarminal will open on your right side to write sql command.

<img width="820" src="./github/fsql.jpg" alt="PSQL Tool">

>Note: If you face `PSQL Tool` issue like warning `Please configure the PostgreSQL Binary Path in the Preferences dialog.` So, following the steps.

1. Click Files -> preferences -> Binary path
2. ProgresSQL Binary path on Database server PostgreSQL 13: `C:\laragon\bin\postgresql\pgsql\bin`
3. Finally `Save`

So, for example my `test-data.csv` file location is `H:\data-filtering-system\test-data\test-data.csv`. So, run following command on your terminal.

`COPY customers (id, email, name, birthday, phone, ip, country) FROM 'H:\data-filtering-system\test-data\test-data.csv' DELIMITER ',' CSV HEADER;`

> :warning: If you face any error like `ERROR: missing data for column "email" CONTEXT: COPY customers, line 100002: ""` after run psql command.
> Open `test-data.csv` csv file on Notepad or Notepad++ then go line number 100003. Please remove here free space that's line number is 100002 and 100003 and save. Now you can try again to run psql copy command.

<img src="./github/psql_command_01.png" width="820">
<img src="./github/psql_command_02.png" width="820">

## Development Features
-   Laravel part
    -   Developed by following **SOLID Principles**    
    -   Seperated **Form Request** classes for filtering form
    -   Followed **Service Pattern** in the application
-   Used PostgreSQL
-   Used Redis
-   Unit and Feature Testing implemented. run command `php artisan test` 
