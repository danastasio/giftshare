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
		$item = [
			'name' => 'item name',
			'description' => 'this is a test',
			'url' => 'https://google.com',
		];

		$response = $this->be($user)->post(route('item.store'), $item);
		$id = Item::where('name', $item['name'])->where('description', $item['description'])->value('id');
		$dbitem = Item::find($id);
		$this->assertNotNull($dbitem);
		$response->assertSessionHas(['success' => "Item added"]);
		$this->assertEquals($item['name'], $dbitem->name);
		$this->assertEquals($item['description'], $dbitem->description);
		$this->assertEquals($item['url'], $dbitem->url);
		$response->assertRedirect();
	}
}
