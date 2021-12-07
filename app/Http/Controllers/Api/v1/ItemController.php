<?php

/*
    Copyright (C) 2020  David D. Anastasio

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU Affero General Public License as published
    by the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU Affero General Public License for more details.

    You should have received a copy of the GNU Affero General Public License
    along with this program.  If not, see <https://www.gnu.org/licenses/>.
*/

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Models\UserUsers;
use App\Models\Item;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ItemRequest;

class ItemController extends ApiController
{
	/**
	 * Get information about a specific object
	 */
	public function info(ItemRequest $request)
	{
		return response()->json(Item::find($request->id), 200);
	}
	/**
	* Get a list of all items shared with the logged in user based on what is shared with them.
	*
	* @return Response
	*/
	public function index(ItemRequest $request)
	{
		return response()->json(UserUsers::shared_items($request->user()->id), 200);
	}

	/**
		* Show the form for creating a new resource.
		*
		* @return Response
		*/
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ItemRequest $request)
	{
		//TODO: Figure out how to image scrape amazon
		$item = new Item($request->validated());
		$item->owner()->associate($request->user());
		$item->save();
		return response()->json(['message' => 'Item Added'], 200);
	}

	/**
	 * Destroy an item from the DB
	 *
	 * @param ItemRequest $request
	 * @returns Response
	 */
	public function destroy(ItemRequest $request)
	{
		$item = Item::find($request['id']);
		$item->delete();
		return response()->json(['message'  => 'Item deleted',], 200);
	}
	/**
		* Display the specified resource.
		*
		* @param  int  $id
		* @return Response
		*/
	public function show($id)
	{
		//
	}

	/**
		* Show the form for editing the specified resource.
		*
		* @param  int  $id
		* @return Response
		*/
	public function edit($id)
	{
		//
	}

	/**
		* Update the specified resource in storage.
		*
		* @param  int  $id
		* @return Response
		*/
	public function update(ItemRequest $request)
	{
		$item = Item::find($request->id);
		$item->update($request->validated());
		return response()->json(["message" => "Item Updated"], 200);
	}

	/**
	 * Show the list of items that I personally own. Used by the "My List" button
	 */
	public function list(ItemRequest $request)
	{
		return response()->json([
			"availability_warning" => Item::low_availability_warning($request->user()->id),
			'items' => Item::own_items($request->user()->id),
		]);
	}

	/**
	 * Lists the currently deleted items for a user
	 */
	public function deleted()
	{
		$deleted_items = Item::withTrashed()->where('owner_id', auth()->user()->id)->where('deleted_at', ">", 0)->get();
		$deleted_shares = UserUsers::withTrashed()->where('id', auth()->user()->id)->where("deleted_at", ">", 0)->get();
		return response()->json([
			'deleted_items' => $deleted_items,
			'deleted_shares', $deleted_shares,
		], 200);
	}
	/**
	 * Try and get an image from the items url. Only supports Amazon right now.
	 */
	private function get_image(string $url = null)
	{
		if (preg_match("/amazon.com|newegg.com|target.com|gamestop.com/", $url) === 1) {
			$c = curl_init();
			curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($c, CURLOPT_ENCODING, "");
			curl_setopt($c, CURLOPT_URL, $url);
			$string = curl_exec($c);
			curl_close($c);
			if (preg_match('/"landingImageUrl":"(.*)"/', $string, $matches) > 0) { // Amazon
				return $matches[1];
			} elseif (preg_match('/class="product-view-img-original" src="(.*?)"/', $string, $matches) > 0) { // Newegg
				return $matches[1];
			} elseif (preg_match('/"primary_image_url":"(.*?)"/', $string, $matches) > 0) { // Target
				return $matches[1];
			} elseif (preg_match('/property="og:image" content="(.*?)"/', $string, $matches) > 0) { // GameStopg
				return $matches[1];
			} else {
				dd($string);
				return null;
			}
	   	} else {
			return null;
		}
	}

	public function restore(Item $item)
	{
		$item->restore();
	}
}
