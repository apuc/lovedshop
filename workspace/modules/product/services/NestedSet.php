<?php

namespace workspace\modules\product\services;

use Illuminate\Database\Capsule\Manager as DB;
use workspace\modules\product\models\Category;

class NestedSet
{
    public static function getTree(){
       return Category::orderBy('left_key')->get();
    }

    public static function getChildren($id){
        $cat = Category::where('id',$id)->first();
        return Category::where([['left_key','>=',$cat->left_key],['right_key','<=',$cat->right_key]])->orderBy('left_key')->get();
    }

    public static function getAllParents($id){
        $cat = Category::where('id',$id)->first();
        return Category::where([['left_key','<=',$cat->left_key],['right_key','>=',$cat->right_key]])->orderBy('left_key')->get();
    }

    public static function getCurrentBranch($id){
        $cat = Category::where('id',$id)->first();
        return Category::where([['right_key','>',$cat->left_key],['left_key','<',$cat->right_key]])->orderBy('left_key')->get();
    }

    public static function getParent($id){
        $cat = Category::where('id',$id)->first();
        return Category::where([['left_key','<=',$cat->left_key],['right_key','>=',$cat->right_key],['level',$cat->level-1]])->orderBy('left_key')->get();
    }

    public static function addItem($id,$data){
        $cat = Category::where('id',$id)->first();
        Category::where('left_key','>',$cat->right_key)->update(['left_key' => DB::raw('left_key+2')]);
        Category::where('right_key','>',$cat->right_key)->update(['right_key' => DB::raw('right_key+2')]);
    }
}