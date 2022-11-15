## <div align="center">Font Group System Using PHP, MySQL & JS (Vuejs 3)</div>

<p align="center">
<img src="./github/php.png" width="150" alt="PHP logo"></a>&nbsp;&nbsp;&nbsp;&nbsp;
<img width="200" src="./github/mysql.png" alt="MySQL logo"></a>
<img alt="PostgreSQL" width="150" src="./github/vue_3.png" alt="VUE logo">
</p>

## Features

> Using Core PHP, MySQL and Vuejs 3, implemented a system to create font groups. That is a one-page solution without reloading.
> 
> - [x] Font can be uploaded without a Button and  only with the TTF file extension.
> - [x] Show the Uploaded Font List.
> - [x] Make a Font Group with multiple fonts. On load, just one field will be  there. After clicking Add Row, another row will be added.  You must have to select two fonts If you want to create a group.
> - [x] Show the list of All Fonts Group. Edit and Delete those Fonts Group. 



## Local Installation

Clone the repository in your local machine using `git clone https://github.com/razibalmamun/font-group-systems.git`

### Requirements for Local Environment

-   [x] PHP Version 7.4 | 8.1
-   [x] Node Version 16.13.0

### Running the Application

1.  Open `api/app/DB/MySQL.php` file from inside the `project folder` folder
2.  update `MySQL.php` file database information according to your local machine.
3.  Import `font_group.sql` in MySQL from iside the `project folder`
4.  Go to `apps` folder and Open terminal/command promt from inside the `project folder` folder
5.  run command `npm install` 
6.  run command `npm run dev`
7.  Now it's ready to browse. Just open your browser and enter `http://127.0.0.1:5173/`

## Development Features
-   PHP part
    -   Developed by following **SOLID Principles**    
    -   PHP **OOP**
-   Used MySQL PDO
-   Used VUE Js 3
-   Used Bootstrap 
