<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $data = DB::table("users_join_classes")->select("*")->where("user_id","9a89398d-d200-4ac1-81c9-43820d3c77dc")->groupBy("role")->get();

        Log::info($data);
    }
}
