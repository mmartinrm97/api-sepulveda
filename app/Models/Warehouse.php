<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Warehouse extends Model
{
    use HasFactory;

    public static array $relationships = ['users', 'goods'];

    protected $fillable = [
        'description',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'string',
        'created_at' => 'date:Y-m-d H:i:s',
        'updated_at' => 'date:Y-m-d H:i:s',
    ];

    public function goods(): HasMany
    {
        return $this->hasMany(Good::class, 'warehouse_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'user_warehouse')
            ->withPivot(['is_active'])
            ->withTimestamps()
            ->as('user_warehouse');
    }
    public function managers(){
        return $this->wherePivot('is_active', 1);
    }
}
