<?php
namespace workspace\modules\product\services;

use core\App;
use core\Debug;
use workspace\modules\order\services\Ftp;
use workspace\modules\product\models\Category;

class CategoryXML
{
    private $xml;


    public function executeXML($path = 'catalog.xml'){
        //Ftp::run(App::$config['FTP'])->getFile('catalog.xml','orders/catalog.xml');
        $this->xml = simplexml_load_file($path);
        foreach ($this->xml->Category as $cat){
            self::addCategory($cat);
        }
        return 123;
    }

    public static function checkChild($category){
        $counter = 1;
        if(isset($category->Categories)){
            foreach ($category->Categories->Category as $child){
                $counter+=self::checkChild($child);
            }
        }else{
            return 1;
        }
        return $counter;
    }


    public static function addCategory($category, $parent = null){
        $count = self::checkChild($category);
        if(!$parent)
            $max_right = NestedSet::getMaxRight();
        else {
            $max_right = NestedSet::getLastChildRight($parent->slug);
        }
        $new = new Category();
        $new->left_key = $max_right+1;
        $new->right_key = $max_right + ($count*2);
        $new->level = 1;
        $new->name = $category->Name;
        $new->id = $category->Id;
        $new->title = $category->Name;
        $new->description = $category->Name;
        $new->status = 1;
        $new->slug = $category->Id;
        $new->save();
        if(isset($category->Categories)){
            foreach ($category->Categories->Category as $child){
                self::addCategory($child, $new);
            }
        }
    }

    public static function run(){
        return new self();
    }
}