<?php

namespace App;

class Storage
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
        $dir = dirname($path);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        if (!file_exists($path)) {
            file_put_contents($path, '[]');
        }
    }

    public function all(): array
    {
        return json_decode(file_get_contents($this->path), true) ?: [];
    }

    public function add(array $item): array
    {
        $items = $this->all();
        $item['id'] = count($items) + 1;
        $items[] = $item;
        file_put_contents($this->path, json_encode($items, JSON_PRETTY_PRINT));

        return $item;
    }
}
