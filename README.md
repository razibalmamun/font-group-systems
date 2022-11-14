## <div align="center">Font Group System Using PHP, MySQL & JS (Vuejs 3)</div>

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

### Running the Application

1.  Open `api/app/DB/MySQL.php` file from inside the `project folder` folder
2.  update `MySQL.php` file database information according to your local machine.
3.  Go to `apps` folder and Open terminal/command promt from inside the `project folder` folder
4.  run command `npm install` 
5.  run command `npm run dev`
6.  Now it's ready to browse. Just open your browser and enter `http://127.0.0.1:5173/`

## Development Features
-   PHP part
    -   Developed by following **SOLID Principles**    
    -   PHP **OOP**
-   Used MySQL PDO
-   Used VUE Js 3
-   Used Bootstrap 
