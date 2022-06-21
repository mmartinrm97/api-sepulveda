<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'is_active',
    ];

    public function goodsClass(){
        return $this->belongsTo(GoodsClass::class, 'goods_class_id');
    }

    public function goodsGroup(){
        return $this->belongsTo(GoodsGroup::class, 'goods_group_id');
    }
}
