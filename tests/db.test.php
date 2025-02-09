<?php
require_once __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../app/config/environment.php';
use Core\Database;
print_r(Database::getInstance()->getConnection());