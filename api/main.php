<?php
include './app/Interface/DB.php';
include './app/DB/MySQL.php';
include './app/DB/DBConnection.php';

include './app/Interface/FontOperation.php';
include './app/Interface/FontGroupOperation.php';
include './app/Interface/PrintResponse.php';
include './app/Interface/Upload.php';

include './app/Trait/UploadFont.php';

include './app/Models/FontModel.php';
include './app/Models/FontGroupModel.php';
include './app/Classes/JsonPrint.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");