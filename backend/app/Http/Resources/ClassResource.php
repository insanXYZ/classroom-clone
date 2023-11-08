<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassResource extends JsonResource
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
            "section" => $this->section,
            "subject" => $this->subject,
            "room" => $this->room,
        ];
    }
}
