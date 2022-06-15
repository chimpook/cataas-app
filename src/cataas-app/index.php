<?php

require_once 'Cataas.php';

$cataas = new Cataas();

//$url = $cataas->getUrl();
//$url = $cataas->json()->getUrl();
//$url = $cataas->tag('cute')->getUrl();
//$url = $cataas->gif()->getUrl();
//$url = $cataas->says('Hello, human!')->getUrl();
//$url = $cataas->says('Hello, human!')->size(22)->color('green')->getUrl();
//$url = $cataas->type('sq')->getUrl();
//$url = $cataas->filter('negative')->getUrl();
//$url = $cataas->width(360)->getUrl();
//$url = $cataas->height(240)->getUrl();
//$url = $cataas->gif()->says('Hello!')->filter('sepia')->color('orange')->size(40)->type('or')->getUrl();

//$url = $cataas->api()->cats()->tags('cute,fail')->skip(0)->limit(10)->getUrl();
//$url = $cataas->api()->tags()->getUrl();
/*
echo <<<HTML
<body style="margin: 0px; background: #0e0e0e; height: 100%">
    <div style="color:yellow;">{$url}</div>
    <!--<img style="display: block;-webkit-user-select: none;margin: auto;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;" src="{$url}">-->
</body>
HTML;
*/


try {
    //$cataas->tag('cute')->html()->get();
    //$cataas->get('/var/www/cataas-app/images/randomCat.png');
    //$cataas->tag('cute')->get('/var/www/cataas-app/images/randomCat.png');
    //$cataas->gif()->get('/var/www/cataas-app/images/randomCat.png');
    //$cataas->says('Hello, human!')->get('/var/www/cataas-app/images/randomCat.png');
    //$cataas->says('Hello, human!')->size(22)->color('green')->get('/var/www/cataas-app/images/randomCat.png');
    //$cataas->type('sq')->get('/var/www/cataas-app/images/randomCat.png');
    //$cataas->filter('negative')->get('/var/www/cataas-app/images/randomCat.png');
    //$cataas->width(360)->get('/var/www/cataas-app/images/randomCat.png');
    //$cataas->height(240)->get('/var/www/cataas-app/images/randomCat.png');
    //$cataas->gif()->says('Hello!')->filter('sepia')->color('orange')->size(40)->type('or')->get('/var/www/cataas-app/images/randomCat.png');
    
    //$cataas->api()->cats()->tags('cute,fail')->skip(0)->limit(10)->get();
    //$cataas->api()->tags()->get();
/*
    echo <<<HTML
    <body style="margin: 0px; background: #0e0e0e; height: 100%">
        <img style="display: block;-webkit-user-select: none;margin: auto;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;" src="/images/randomCat.png">
    </body>
    HTML;
*/    
} catch (Exception $e) {
    echo $e;
}


