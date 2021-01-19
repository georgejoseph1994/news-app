<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class PinFeatureTest extends TestCase
{
    /**
     * Test to check if a user pins an article is it persisted.
     *
     * @return void
     */
    public function testUserPiningArticle()
    {
        $user = User::find(1);
        Auth::login($user);
        // pre test
        if (News::find('sample test id')) {
            News::find('sample test id')->users()->detach(Auth::user()->id);
            News::find('sample test id')->delete();
        }
       

        $response = $this->call(
            'post',
            'pin',
            ['id' => 'sample test id',
            'title'=>"sample title",
            'url'=>'asd.com',
            'publication_date'=>'2017-12-21T13:33:25.494Z'
            ]
        );

        $this->assertTrue(auth()->user()->news->where('id', '=', 'sample test id')->count()==1);
        //post test cleanup
        News::find('sample test id')->users()->detach(Auth::user()->id);
        News::find('sample test id')->delete();
    }
}
