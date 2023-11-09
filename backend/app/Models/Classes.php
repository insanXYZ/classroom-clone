<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Classes extends Model
{
    use HasFactory, HasUuids;

    protected $keyType = "string";
    public $incrementing = false;

    protected $guarded = ['id'];
    public function user()
    {
        return $this->belongsToMany(User::class,"users_join_classes","class_id","user_id")->withPivot("role");
    }

    public function announcement(){
        return $this->hasMany(announcement::class , "class_id");
    }
}
