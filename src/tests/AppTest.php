<?php

use \App\App;
use \CataasApiPhp\CataasApiPhp;

class AppTest extends \PHPUnit\Framework\TestCase
{
    public function testInstantiationOfApp()
    {
        $app = App::factory(CataasApiPhp::factory());
        $this->assertInstanceOf('\App\App', $app);
    }

}