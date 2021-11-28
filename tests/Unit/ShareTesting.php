<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\UserUsers;
use Tests\TestCase;

class ShareTest extends TestCase
{
    use DatabaseTransactions;

    public function testShareOwner()
    {
        $user = User::factory()->create();
        $shared_user = User::factory()->create();

        // Create a valid share. Test to make sure it worked
        $createShare = $this->be($user)->post(route('share.store'), $shared_user->toArray());
        $createShare->assertSessionHas(['success' => 'List shared with user']);
        $id = UserUsers::where('owner_id', $user->id)
            ->where('sharee_id', $shared_user->id)
            ->value('id');
        $share = UserUsers::find($id);
        $this->assert($user->is($share->owner));
    }
