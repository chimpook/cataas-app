<?php

require_once 'Cataas.php';

$cataas = new Cataas();

//$url = $cataas->getUrl();
//$url = $cataas->tag('cute')->getUrl();
//$url = $cataas->gif()->getUrl();
//$url = $cataas->says('Hello, human!')->getUrl();
//$url = $cataas->says('Hello, human!')->size(22)->color('green')->getUrl();
//$url = $cataas->type('sq')->getUrl();
//$url = $cataas->filter('negative')->getUrl();
//$url = $cataas->width(360)->getUrl();
//$url = $cataas->height(240)->getUrl();
//$url = $cataas->gif()->says('Hello!')->filter('sepia')->color('orange')->size(40)->type('or')->getUrl();

echo <<<HTML
<body style="margin: 0px; background: #0e0e0e; height: 100%">
    <div style="color:yellow;">{$url}</div>
    <img style="display: block;-webkit-user-select: none;margin: auto;background-color: hsl(0, 0%, 90%);transition: background-color 300ms;" src="{$url}">
</body>
HTML;
