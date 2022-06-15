<?php

namespace App;

use CataasApiPhp\CataasApiPhp;

require __DIR__ . '/vendor/autoload.php';

$app = App::factory(CataasApiPhp::factory());
$app->exec();
