<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
  
//get bootstrap code
require __DIR__ . '/../bootstrap/app.php';

// Define app routes
require __DIR__ . '/../app/routes.php';

// Run app
$app->run();