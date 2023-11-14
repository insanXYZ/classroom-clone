<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnouncementResource extends JsonResource
{
    public static $wrap = 'announcement';

    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "desc" => $this->desc,
            "created_by" => new userResource(User::find($this->user_id)),
            "created_at" => Carbon::parse($this->created_at)->format('d M Y'),
            "file"=> FileResource::collection($this->file)
        ];
    }
}
