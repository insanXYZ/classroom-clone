<?php

namespace App\Models;

use App\Models\announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;

    protected $guarded = ["id"];

    public function announcement(){
        return $this->belongsTo(announcement::class , "announcement_id");
    }
}
