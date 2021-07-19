<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClaimTests extends TestCase
{
    /**
     * A test to see if you can claim an item.
     *
     * @return void
     */
	public function test_valid_claim(): void
	{
	}

    /**
     * A test to see if you can claim an item that doesn't belong to you
     *
     * @returns void
     */
	public test_invalid_claim(): void
	{

	}
}
