<?php declare(strict_types=1);

use \PHPUnit\Framework\TestCase;
use \CataasApiPhp\CataasApiPhp;

class CataasApiPhpTest extends TestCase
{
    private CataasApiPhp $api;
    private string $test_image_filename = 'tests/images/test.png';

    protected function setUp(): void
    {
        $this->api = CataasApiPhp::factory();
    }

    public function testInstantiationOfApi()
    {
        $this->assertInstanceOf('\CataasApiPhp\CataasApiPhp', $this->api);
    }

    public function testSimpleCatUrlGeneration()
    {
        $this->assertEquals('https://cataas.com/cat', $this->api->getUrl());
    }

    public function testComplexCatUrlGeneration()
    {
        $this->assertEquals(
            'https://cataas.com/cat/gif/says/Hello!?filter=sepia&color=orange&size=40&type=or', 
            $this->api->gif()->says('Hello!')->filter('sepia')->color('orange')->size(40)->type('or')->getUrl()
        );
    }

    public function testImageLoad()
    {
        $this->api->get($this->test_image_filename);
        $this->assertFileExists($this->test_image_filename);
    }

    protected function tearDown(): void
    {
        if (file_exists($this->test_image_filename)) {
            unlink($this->test_image_filename);
        }
    }

}