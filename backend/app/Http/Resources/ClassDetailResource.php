<?php

namespace App\Http\Resources;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
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
            "announcement" => Classes::find($this->id)->announcement
        ];    
    }
}
