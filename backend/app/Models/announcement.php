<?php

namespace App\Models;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class announcement extends Model
{
    use HasFactory;

    public function class(){
        return $this->belongsTo(Classes::class , "class_id");
    }

    protected $guarded = ["id"];

    public function file(){
        return $this->hasMany(File::class , "announcement_id");
    }
}
