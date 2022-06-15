<?php

require_once 'Cataas.php';
require_once 'CataasApp.php';

$cataasApp = new CataasApp(new Cataas());
$cataasApp->exec();

