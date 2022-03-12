<?php

namespace Tests\Feature\Models;

use App\Models\Media;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MediaTest extends TestCase
{
    use RefreshDatabase , ModelHelperTesting;

    public function model()
    {
        return new Media();
    }

    public function test_media_relation_with_user()
    {
        $media = Media::factory()->for(User::factory())->create();

        $this->assertTrue(isset($media->user->id));
        $this->assertInstanceOf(User::class , $media->user);
    }
}
