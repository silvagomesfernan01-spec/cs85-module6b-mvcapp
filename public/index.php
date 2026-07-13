<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\RestaurantController;

$controller = new RestaurantController();
$controller->index();