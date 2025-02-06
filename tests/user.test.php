<?php
require_once __DIR__.'/../vendor/autoload.php';

use App\Models\Patient;
print_r(new Patient(1, 'test', 'test', 'test@test.com', 'testtest', '0600887766'));