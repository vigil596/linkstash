<?php

namespace App\Controller;

use App\Storage;

class BookmarkController
{
    private Storage $storage;

    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    public function list(): string
    {
        return json_encode($this->storage->all());
    }

    public function create(array $input): string
    {
        $bookmark = [
            'title' => $input['title'] ?? 'Untitled',
            'url' => $input['url'] ?? '',
        ];

        return json_encode($this->storage->add($bookmark));
    }
}
