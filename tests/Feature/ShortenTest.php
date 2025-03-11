<?php

namespace Tests\Feature;

use App\Models\UrlMap;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class ShortenTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_url_can_be_shortened(): void
    {
        $url = 'https://google.com';
        $response = $this->post('/create-url', ['long-url' =>$url]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('url_map', ['long_url' => $url]);
    }

    public function test_url_validation_works(): void
    {
        $url = 'h//wrong_url';
        $response = $this->post('/create-url', ['long-url' =>$url]);
        $response->assertStatus(302);
        $this->assertDatabaseMissing('url_map', ['long_url' => $url]);
    }

    public function test_incomplete_url_can_be_shortened(): void
    {
        $url = 'google.com';
        $response = $this->post('/create-url', ['long-url' =>$url]);
        $response->assertStatus(200);
        $this->assertDatabaseHas('url_map', ['long_url' => 'https://' . $url]);
    }

    public function test_shortend_url_works(): void{
        $long = 'https://google.com';
        $short = Str::random(6);
        $model = new UrlMap();
        $model->short_url = $short;
        $model->long_url = $long;
        $model->save();

        $response = $this->get('/' . $short);
        $response->assertStatus(302);
    }
}
