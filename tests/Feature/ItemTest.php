<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use App\Models\Item;
use Tests\TestCase;

class ItemTests extends TestCase
{
	use DatabaseTransactions;
	/**
	 * Test to make sure you can create an item.
	 *
	 * @return void
	 */
	public function testCreateItemWithAllAttributes(): void
	{
		$user = User::factory()->create();
		$payload = array(
			'name' => 'item name',
			'description' => 'this is a test',
			'url' => 'https://google.com',
		);

		$response = $this->be($user)->post(route('item.store'), $payload);
		$id = Item::where('name', $payload['name'])
			->where('description', $payload['description'])
			->where('url', $payload['url'])
			->value('id');
		$item = Item::find($id);
		$this->assertNotNull($item);
		$response->assertSessionHas(['success' => "Item added"]);
		$this->assertEquals($payload['name'], $item->name);
		$this->assertEquals($payload['description'], $item->description);
		$this->assertEquals($payload['url'], $item->url);
		$response->assertRedirect();
	}

	/**
	 * Test to make sure you can create an item without a description
	 *
	 * @returns void
	 */
	public function testCreateItemWithoutDescription()
	{
		$user = User::factory()->create();
		$payload = array(
			'name' => 'Fake Item',
			'url'  => 'https://xkcd.com',
		);

		$response = $this->be($user)->post(route('item.store'), $payload);
		$id = Item::where('name' , $payload['name'])
			->where('url', $payload['url'])
			->value('id');
		$item = Item::find($id);
		$this->assertNotNull($item);
			$response->assertSessionHas(['success' => "Item added"]);
		$this->assertEquals($payload['name'], $item->name);
		$this->assertEquals(null, $item->description);
		$this->assertEquals($payload['url'], $item->url);
		$response->assertRedirect();
	}

	/**
	 * Test to make sure you can create an item without a url
	 *
	 * @returns void
	 */
	public function testCreateItemWithoutUrl()
	{
		$user = User::factory()->create();
		$payload = array(
			'name' 		=> 'Fake Item',
			'description' => 'The item description goes here',
		);

		$response = $this->be($user)->post(route('item.store'), $payload);
		$id = Item::where('name' , $payload['name'])
			->where('description', $payload['description'])
			->value('id');
		$item = Item::find($id);
		$this->assertNotNull($item);
			$response->assertSessionHas(['success' => "Item added"]);
		$this->assertEquals($payload['name'], $item->name);
		$this->assertEquals(null, $item->url);
		$this->assertEquals($payload['description'], $item->description);
		$response->assertRedirect();
	}
}
