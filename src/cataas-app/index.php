<?php

require_once 'Cataas.php';
require_once 'CataasApp.php';

$cataasApp = CataasApp::factory(Cataas::factory());
$cataasApp->exec();

