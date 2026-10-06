<?php

namespace App\Controller;

class HomeController
{
    public function index(): string
    {
        return json_encode([
            'app' => 'linkstash',
            'endpoints' => ['GET /bookmarks', 'POST /bookmarks'],
        ]);
    }
}
