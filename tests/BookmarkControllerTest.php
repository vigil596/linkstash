<?php

namespace Tests;

use App\Controller\BookmarkController;
use App\Storage;
use PHPUnit\Framework\TestCase;

final class BookmarkControllerTest extends TestCase
{
    public function testCreateReturnsStoredBookmark(): void
    {
        $file = tempnam(sys_get_temp_dir(), 'links') . '.json';
        $controller = new BookmarkController(new Storage($file));

        $created = json_decode($controller->create([
            'title' => 'Example',
            'url' => 'https://example.com',
        ]), true);

        $this->assertSame('Example', $created['title']);
        $this->assertSame('https://example.com', $created['url']);
        $this->assertSame(1, $created['id']);

        unlink($file);
    }

    public function testListReturnsCreatedBookmarks(): void
    {
        $file = tempnam(sys_get_temp_dir(), 'links') . '.json';
        $controller = new BookmarkController(new Storage($file));

        $controller->create(['title' => 'First', 'url' => 'https://first.test']);
        $controller->create(['title' => 'Second', 'url' => 'https://second.test']);

        $list = json_decode($controller->list(), true);

        $this->assertCount(2, $list);
        $this->assertSame('Second', $list[1]['title']);

        unlink($file);
    }
}
