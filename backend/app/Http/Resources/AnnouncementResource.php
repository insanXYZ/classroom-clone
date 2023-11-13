<?php

namespace App\Http\Resources;

use App\Models\announcement;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class AnnouncementResource extends JsonResource
{
    public static $wrap = 'announcement';

    public function toArray(Request $request): array
    {
        $file = $this->file;
        if(isset($file[0])){
            $file[0]->sendId = $this->class_id;
        }
        Log::info($file);
        return [
            "id" => $this->id,
            "desc" => $this->desc,
            "created_by" => new userResource(User::find($this->user_id)),
            "created_at" => Carbon::parse($this->created_at)->format('d M Y'),
            "file"=> FileResource::collection($file)
        ];
    }
}
