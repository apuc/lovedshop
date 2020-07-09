<?php


namespace workspace\modules\product\models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package workspace\modules\product\models
 */
class Category extends Model
{
    protected $table = "category";
    public $fillable = ['name', 'title', 'description', 'status', 'slug', 'left_key', 'right_key', 'level'];
}