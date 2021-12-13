<?php

namespace Tests;

use App\Models\Post;
use Carbon\Carbon;

class EloquentTest extends TestCase
{
    // When you use the toBase function on the query you reduce the memory use of the query by forcing Eloquent
    // to put the data into stdClasses instead of Models.
    // If you combine this with the select function to reduce the fields you can save a lot of memory.
    public function test_eloquent_test_fetching_base()
    {
        Post::factory()->count(50)->create();
        $posts = Post::select(['id', 'title'])->toBase()->get();

        $post = $posts->pop();

        $this->assertEquals(null, $post->sub_title ?? null);
        $this->assertEquals(get_class($post), 'stdClass');
    }

    // Showing several handy date related Eloquent functions you can use on the query.
    public function test_eloquent_date_retrieval_functions()
    {
        Post::factory()->create([
            'title' => 'first',
            'sub_title' => 'This is the first post.',
            'created_at' => Carbon::create(2000, 8, 16, 14, 54, 21)->toDate(),
        ]);

        Post::factory()->create([
            'created_at' => Carbon::create(2021, 9, 17, 15, 55, 22)->toDate(),
        ]);

        Post::factory()->create([
            'title' => 'latest',
            'sub_title' => 'This is the latest post.',
            'created_at' => Carbon::create(2022, 10, 18, 16, 56, 23)->toDate(),
        ]);

        $this->assertEquals(1,
            Post::whereTime('created_at', '15:55:22')->count()
        );

        $this->assertEquals(1,
            Post::whereMonth('created_at', 9)->count()
        );

        $this->assertEquals(1,
            Post::whereDate('created_at', '2021-09-17')->count()
        );

        $this->assertEquals(1,
            Post::whereYear('created_at', 2021)->count()
        );

        $this->assertEquals(1,
            Post::whereDay('created_at', 17)->count()
        );

        $this->assertEquals('first',
            Post::oldest()->first()->title
        );

        $this->assertEquals('latest',
            Post::latest()->first()->title
        );
    }

    // Fastest way of incrementing numeric fields.
    public function test_incrementing_values()
    {
        $post = Post::factory()->create();
        Post::find($post->id)->increment('views'); // increment views by 1
        $post->refresh();
        $this->assertEquals(1, $post->views);

        Post::find($post->id)->increment('views', 9); // increment views by 9
        $post->refresh();
        $this->assertEquals(10, $post->views);
    }

    // Shows you how you can duplicate a model.
    public function test_replicating_existing_models()
    {
        $post = Post::factory()->create([
            'title' => 'replicate me',
            'sub_title' => 'can you replicate me?',
        ]);

        $replicatedPost = $post->replicate()->fill([
            'title' => 'replicated me',
        ]);

        $replicatedPost->save();

        $this->assertStringStartsWith($post->title, 'replicate me');
        $this->assertStringStartsWith($replicatedPost->title, 'replicated me');
    }
}
