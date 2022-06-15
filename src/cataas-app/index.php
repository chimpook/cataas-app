<?php

namespace App;

use CataasApiPhp\CataasApiPhp;

require __DIR__ . '/vendor/autoload.php';

$app = CataasApp::factory(CataasApiPhp::factory());
$app->exec();
