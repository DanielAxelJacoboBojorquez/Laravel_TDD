<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Post;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostManagementTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function a_post_can_be_created(){
        $this->withoutExceptionHandling();
        $response = $this->post('/posts', [
            'title' => 'test title',
            'content' => 'test content'
        ]);
        $response->assertOK();
        $this->assertCount(1, Post::all());

        $post = Post::first();

        $this->assertEquals($post->title, 'test title');
        $this->assertEquals($post->content, 'test content');
    }
}
