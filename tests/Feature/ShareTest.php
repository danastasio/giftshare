<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\UserUsers;
use Tests\TestCase;

class ShareTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Create a valid share
     *
     * @return void
     */
    public function testCreateValidShare()
    {
        $user = User::factory()->create();
        $shared_user = User::factory()->create();

        $response = $this->be($user)->post(route('share.store'), $shared_user->toArray());
        $id = UserUsers::where('owner_id', $user->id)
            ->where('sharee_id', $shared_user->id)
            ->value('id');
        $share = UserUsers::find($id);
        $response->assertRedirect('share');
        $this->assertNotNull($share);
        $response->assertSessionHas(['success' => 'List shared with user']);
        $this->assertEquals($share['owner_id'], $user->id);
        $this->assertEquals($share['sharee_id'], $shared_user->id);
    }

    /**
     * Test creating a share without an email
     *
     * @return void
     */
    public function testCreateShareWithoutEmail()
    {
        $user = User::factory()->create();

        $response = $this->be($user)->post(route('share.store'));
        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Create a valid share without logging in (should fail)
     *
     * @return void
     */
    public function testCreateShareWithoutLoggingIn()
    {
        $user = User::factory()->create();
        $shared_user = User::factory()->create();

        $response = $this->post(route('share.store'), $shared_user->toArray());
        $id = UserUsers::where('owner_id', $user->id)
            ->where('sharee_id', $shared_user->id)
            ->value('id');
        $share = UserUsers::find($id);
        $response->assertRedirect('login');
        $this->assertNull($share);
    }
}
