<?php

namespace workspace\modules\product\services;

use core\Debug;
use Illuminate\Database\Capsule\Manager as DB;
use workspace\modules\product\models\Category;

class NestedSet
{
    public static function getMaxRight() {
        $category = Category::orderBy('right_key', 'DESC')->first();
        if(!$category)
            return 0;
        else
            return $category->right_key;
    }

    public static function getTree(){
       return Category::orderBy('left_key')->get();
    }

    public static function getChildren($id){
        $cat = Category::where('id',$id)->first();
        return Category::where([['left_key','>=',$cat->left_key],['right_key','<=',$cat->right_key]])->orderBy('left_key')->get();
    }

    public static function getLastChildRight($id){
        $cat = Category::where('id',$id)->first();
        $child = Category::where([['left_key','>=',$cat->left_key],['right_key','<',$cat->right_key]])->orderBy('right_key', 'DESC')->first();
        if($child)
            return $child->right_key;
        else
            return $cat->left_key;
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
        $cat->right_key = $cat->right_key + 2;
        $cat->left_key = $cat->left_key + 2;
        $cat->save();
        $new = new Category();
        $new->left_key = $cat->right_key - 2;
        $new->right_key = $cat->right_key - 1;
        $new->level = $cat->level + 1;
        $new->name = $data->Name;
        $new->id = $data->Id;
        $new->title = $data->Name;
        $new->description = $data->Name;
        $new->status = 1;
        $new->slug = $data->Id;
        $new->save();
    }
}