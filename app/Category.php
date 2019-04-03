<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function children()
    {
     return $this->hasMany(Category::class,'parent_id');
    }

    public function childrenRecursive()
    {
      return $this->children()->with('childrenRecursive');
    }
    public function products()
    {
        $this->hasMany(Product::class()) ;
    }
    public function attributesGroup()
    {
        $this->hasMany(AttributeGroup::class(),'attributeGroup_id') ;
    }
}
