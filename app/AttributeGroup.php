<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeGroup extends Model
{
    protected $table="attributesGroup";

    public function attributesValue ()
    {
        return $this->hasMany(AttributeValue::class,'attributeGroup_id');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class,'attributegroup_category','attributeGroup_id','category_id') ;
    }


}
