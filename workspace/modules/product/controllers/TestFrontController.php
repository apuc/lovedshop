<?php


namespace workspace\modules\product\controllers;

use core\App;
use core\Controller;
use core\Debug;
use core\Pagination;
use workspace\modules\order\models\OrderProduct;
use workspace\modules\order\models\Order;
use workspace\modules\order\services\Ftp;
use workspace\modules\order\services\OrderXml;
use workspace\modules\product\models\Product;
use workspace\modules\product\models\ProductPhoto;
use workspace\modules\product\models\VirtualProduct;
use workspace\modules\product\requests\FrontRequest;

class TestFrontController extends Controller
{
    public $viewPath = '/modules/product/views/front';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/product/views/front';
        $this->layoutPath = '/modules/product/views/front/layouts/';
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Список товаров', 'url' => 'testfront']);
    }

    public function actionCatalog($page = 1){
        {
            $options = [
                'pagination' => [
                    'per_page' => 10,
                    'class' => '',
                    'class-active' => 'active',
                    'class-control' => '',
                ]
            ];
            $start = $page-1;
            if($start != 0){
                $start = $start*$options['pagination']['per_page'];
            }
            $all =  Product::all();
            $model = Product::offset($start)->limit($options['pagination']['per_page'])->get();
            $pagination = Pagination::class;

            return $this->render('catalog.tpl', ['h1' => 'Товары', 'model' => $model, 'pagination' => $pagination, 'options' => $options, 'page' => $page, 'all' => $all]);
        }
    }
    public function actionOrder($id)
    {
        $product = Product::where('id',$id)->first();
        $request = new FrontRequest();
        if($request->isPost() && $request->validate()) {
            $model = new Order();
            $product = Product::where('id',$id)->first();
            $vproduct = VirtualProduct::where('product_id',$id)->first();
            $model->city = $request->city;
            $model->email = $request->email;
            $model->fio = $request->fio;
            $model->phone = $request->phone;
            $model->pay = $request->pay;
            $model->delivery = 1;
            $model->shop_id = 522;
            $model->delivery_date = $request->delivery_date;
            $model->delivery_time = $request->delivery_time;
            $model->address = $request->address;
            $model->comment = $request->comment;
            $model->total_price = $vproduct->price*$request->quantity;
            $model->save();
            $prodmodel = new OrderProduct();
            $prodmodel->order_id = $model->id;
            $prodmodel->product_id = $product->id;
            $prodmodel->quantity = $request->quantity;
            $prodmodel->save();
            $xml =  OrderXml::run()->createXml($model,$prodmodel);
            $xml->save();
            Ftp::run(App::$config['FTP'])->putFile(ROOT_DIR.DIRECTORY_SEPARATOR.'test.xml', 'orders'.DIRECTORY_SEPARATOR.'order_'.$model->id.'.xml');
            $this->redirect('catalog');
        } else
            return $this->render('order.tpl', [
                'product'=>$product,
                'errors' => $request->getMessagesArray(),
                ]);
    }

    public function actionOneProduct($id)
    {
        $model = Product::where('id', $id)->first();
        return $this->render('product.tpl', ['model' => $model]);
    }

}