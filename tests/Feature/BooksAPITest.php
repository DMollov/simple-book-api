<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class BooksAPITest extends TestCase
{
    public function testBooksAPIIndexMethod()
    {
        $response = $this->getJson('/api/books')
            ->assertJsonStructure(['data', 'links', 'meta']);

        $response->assertStatus(200);
    }

    public function testBooksAPIStoreMethod() {
        $user = factory(User::class)->create();
        $file = UploadedFile::fake()->create('image.jpg', 500);
        $response = $this->postJson('/api/books', [
            'title' => 'Javascript',
            'description' => 'A lorem ipsum text',
            'author_id' => $user->id,
            'cover' => $file,
        ])->assertJsonStructure([
            'title',
            'description',
            'author_id',
            'cover',
        ]);
    }

    public function testBooksAPIStoreMethodValidation() {
        $user = factory(User::class)->create();
        $file = UploadedFile::fake()->create('image.jpg', 500);
        $response = $this->postJson('/api/books', [
            'title' => '',
            'description' => '',
            'author_id' => $user->id,
            'cover' => $file,
        ])->assertJsonStructure([
            'errors' => [
                'title',
                'description'
            ],
        ]);
    }
}
