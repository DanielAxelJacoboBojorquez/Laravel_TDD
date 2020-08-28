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
    public function list_of_posts_can_be_retrieved(){
        $this->withoutExceptionHandling();
        factory(Post::class, 3)->create();
        $response = $this->get('/posts');
        $response->assertOK();
        $posts = Post::all();
        $response->assertViewIs('posts.index');
        $response->assertViewHas('posts', $posts);
    }

    /** @test */
    public function a_post_can_be_retrieved(){
        $this->withoutExceptionHandling();
        $post = factory(Post::class)->create();
        $response = $this->get('/posts/'.$post->id);
        $response->assertOK();
        $post = Post::first();
        $response->assertViewIs('posts.show');
        $response->assertViewHas('post', $post);
    }

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
