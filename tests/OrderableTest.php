<?php

class OrderableTest extends TestCase
{
    /** @test */
    function it_tests_the_orderable_all_call()
    {
        DB::table('articles')->truncate();

        $one = factory(Article::class)->create();
        factory(Article::class)->create();
        factory(Article::class)->create([ 'reads' => 10 ]);
        $two = factory(Article::class)->create([ 'reads' => 20 ]);

        $this->assertEquals($one->id, Article::all()->last()->id);
        $this->assertEquals($two->id, Article::all()->first()->id);
    }

    /** @test */
    function it_tests_the_orderable_call()
    {
        DB::table('articles')->truncate();

        $one = factory(Article::class)->create([ 'reads' => 20 ]);
        factory(Article::class)->create();
        factory(Article::class)->create([ 'reads' => 10 ]);
        $two = factory(Article::class)->create();

        $this->assertEquals($one->id, Article::order([ 'reads' ])->first()->id);
        $this->assertEquals($one->id, Article::order()->first()->id);
        $this->assertEquals($two->id, Article::order([ 'id' ])->first()->id);
    }

    /** @test */
    function it_test_unorderable_without_args()
    {
        DB::table('articles')->truncate();

        $one = factory(Article::class)->create();
        factory(Article::class)->create([ 'reads' => 20 ]);

        $this->assertEquals($one->id, Article::unorderable()->first()->id);
    }

    /** @test */
    function it_test_unorderable_with_args()
    {
        DB::table('articles')->truncate();

        factory(Article::class)->create();
        $one = factory(Article::class)->create([ 'reads' => 20 ]);
        $two = factory(Article::class)->create();

        $this->assertEquals($one->id, Article::unorderable([ 'id' ])->first()->id);
        $this->assertEquals($two->id, Article::unorderable([ 'reads' ])->first()->id);
    }
}