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
        $share = UserUsers::where('owner_id', $user->id)
            ->where('sharee_id', $shared_user->id)
            ->with(['owner','sharee'])
            ->first();
        $response->assertRedirect('share');
        $this->assertNotNull($share);
        $response->assertSessionHas(['success' => 'List shared with user']);
        $this->assertTrue($user->is($share->owner));
        $this->assertTrue($shared_user->is($share->sharee));
    }

    /**
     * Test creating a share without an email
     *
     * @return void
     */
    public function testFailCreateShareWithoutEmail()
    {
        $user = User::factory()->create();

        $response = $this->be($user)->post(route('share.store'));
        $response->assertSessionHasErrors(['email']);
    }

    /**
     * Fail creating a share without logging in
     *
     * @return void
     */
    public function testFailCreatingShareWithoutLoggingIn()
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

    /**
     * Test destroying your own share
     *
     * @return void
     */
    public function testDestroyValidShare()
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

        //Destroy the share
        $response = $this->be($user)->delete(route('share.destroy', ['share' => $share, 'id' => $share->id]));
        $response->assertSessionHas(['info' => 'List revoked from user']);
        $response->assertRedirect('share');

        //Check to see if share still in DB
        $share = UserUsers::find($id);
        $this->assertNull($share);
    }

    /**
     * Test destroying your own share
     *
     * @return void
     */
    public function testFailDestroyingValidShareWithoutLoggingIn()
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
        $this->assertNotNull($share);

        //Destroy the share
        $response = $this->delete(route('share.destroy', ['share' => $share]));

        //Check to see if share still in DB
        $this->assertNotNull($share);
    }

    /**
     * You should not be able to destroy a share unless you own it.
     *
     * @return void
     */
    public function testFailDestroyingShareBelongingToDifferentUser()
    {
        $user = User::factory()->create();
        $shared_user = User::factory()->create();
        $bad_actor = User::factory()->create();

        // Create a valid share. Test to make sure it worked
        $createShare = $this->be($user)->post(route('share.store'), $shared_user->toArray());
        $createShare->assertSessionHas(['success' => 'List shared with user']);
        $id = UserUsers::where('owner_id', $user->id)
            ->where('sharee_id', $shared_user->id)
            ->value('id');
        $share = UserUsers::find($id);

        //Destroy the share from the bad actor
        $this->assertFalse($bad_actor->is($share->owner));
        $response = $this->be($bad_actor)->delete(route('share.destroy', ['share' => $share]));
        $response->assertForbidden();

        //Check to see if share still in DB
        $share = UserUsers::find($id);
        $this->assertNotNull($share);
    }
}
