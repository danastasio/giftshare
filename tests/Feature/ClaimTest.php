<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Claim;
use App\Models\User;
use Tests\TestCase;

class ClaimTests extends TestCase
{
	use DatabaseTransactions;
	/**
	 * A test to see if you can claim an item.
	 *
	 * @returns void
	 */
	public function testClaimItem(): void
	{
		// How to test livewire. Hmmmm.
		$this->markTestSkipped('Livewire');
	}

	/**
	 * A test to see if you can claim an item that is already claimed
	 *
	 * @returns void
	 */
	public function testFailClaimAlreadyClaimedItem(): void
	{
		// How to test livewire. Hmmm.
		$this->markTestSkipped('Livewire');
	}

	/**
	 * A test to see if you can delete your own claim
	 *
	 * @returns void
	 */
	public function testDestroyClaim(): void
	{
		// How to test livewire. Hmmm.
		$this->markTestSkipped('Livewire');
	}

	/**
	 * You should not be able to delete another users claim
	 *
	 * @return void
	 */
	public function testFailDestroyingAnotherUsersClaim(): void
	{
		// How to test livewire. Hmmm.
		$this->markTestSkipped('Livewire');
	}
}
