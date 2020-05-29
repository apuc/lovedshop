<?php
use core\App;

App::$collector->get('product/download', ['workspace\modules\product\controllers\ProductController','actionDownload']);
App::$collector->gridView('product', ['workspace\modules\product\controllers\ProductController']);
App::$collector->get('catalog', ['workspace\modules\product\controllers\TestFrontController', 'actionCatalog']);
App::$collector->any('testfront/order/{id}', ['workspace\modules\product\controllers\TestFrontController', 'actionOrder']);
//App::$collector->get('product',['workspace\modules\product\controllers\ProductController','actionIndex']);