<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ClassController extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->only(["name","section","subject","room"]);

        $validators = Validator::make($credentials,[
            "name" => "required",
            "section" => "min:3",
            "subject" => "min:3",
            "room" => "min:3"
        ]);

        if($validators->fails()){
            return response()->json([
                "success"=> true,
                "message" => $validators->getMessageBag()
            ],400);
        }

        Classes::create([$credentials]);
    }
}
