<?php

namespace workspace\modules\product\services;

use core\App;
use core\Debug;
use Illuminate\Support\Facades\DB;
use SplFileInfo;
use workspace\modules\order\services\Ftp;
use workspace\modules\product\models\Product;
use workspace\modules\product\models\ProductPhoto;
use workspace\modules\product\models\VirtualProduct;

class ProductCSV
{
    private $csv;

    public function executeCSV($path = 'product.csv')
    {
       // Ftp::run(App::$config['FTP'])->getFile('product.csv','orders/product.csv');
        $i = 0;
        foreach (file('product.csv') as $prod){
            if($i === 0) {
                $i++;
                continue;
            }
            $prod =  str_getcsv($prod);
            $id = Product::where('id',$prod[1])->first();
            if(empty($id)) {
                if (isset($prod[1]) && isset($prod[2])) {
                    $product = new Product();
                    $product->id = $prod[1];
                    $product->name = $prod[2];
                    $product->title = $prod[2];
                    $product->description = $prod[5];
                    $product->status = 1;
                    $product->save();

                    $vp = new VirtualProduct();
                        $vp->product_id = $prod[1];
                        $vp->price = 250;
                        $vp->save();

                    $file_name = md5(time(). rand(0, 999999));
                    $dir = "resources".DIRECTORY_SEPARATOR."img".DIRECTORY_SEPARATOR."product".DIRECTORY_SEPARATOR."product_".$product->id.DIRECTORY_SEPARATOR;
                    if (!file_exists($dir))
                        mkdir($dir, 0775);
                    $info =  new SplFileInfo("goods".DIRECTORY_SEPARATOR.$prod[4]);
                    Ftp::run(App::$config['FTP'])->getFile(ROOT_DIR.DIRECTORY_SEPARATOR.$dir.$file_name.".".$info->getExtension(), "goods".DIRECTORY_SEPARATOR.$prod[4], FTP_BINARY);
                    $photo = new ProductPhoto();
                    $photo->product_id = $prod[1];
                    $photo->photo = $dir.$file_name.".".$info->getExtension();
                    $photo->save();
                }
            }
        }
//       $k = 0;
//        foreach (file('price.csv') as $price){
//            if($k === 0) {
//                $k++;
//                continue;
//            }
//            $price = str_getcsv($price,';');
//            $id = VirtualProduct::where('product_id',$price[0])->first();
//            if(empty($id)){
//                if($price[0] && $price[4]) {
//                    if(!empty(Product::where('id',$price[0])->first())) {
//                        $vp = new VirtualProduct();
//                        $vp->product_id = $price[0];
//                        $vp->price = $price[4];
//                        $vp->save();
//                    }
//                }
//            }
//        }
    }

    public static function run(){
        return new self();
    }
}
