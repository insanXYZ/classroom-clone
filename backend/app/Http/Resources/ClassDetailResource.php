<?php

namespace App\Http\Resources;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class ClassDetailResource extends JsonResource
{
    public static $wrap = "classes";

    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "banner_img" => url("banner/".$this->banner_img),
            "name" => $this->name,
            "code" => $this->code,
            "section" => $this->section,
            "subject" => $this->subject,
            "room" => $this->room,
            "role" => $this->pivot->role,
            "announcement" => AnnouncementResource::collection($this->announcement()->latest()->get())
        ];    
    }
}
