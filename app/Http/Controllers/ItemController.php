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

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Database\Eloquent\Model;
use App\Models\UserUsers;
use App\Models\Item;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ItemRequest;
use App\Models\ItemCollection;
use App\Models\Collection;

class ItemController extends Controller
{
	/**
		* Get a list of all items shared with the logged in user based on what is shared with them.
		*
		* @return Response
		*/
	public function index()
	{
		return view('dashboard')->with([
			'shared_items' => auth()->user()->shared_with_user()->with(['visible_collections', 'visible_collections.items'])->get(),
		]);
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
		$item = new Item($request->validated());
		$item->save();
		foreach($request['collections'] as $collection_id) {
			// TODO validate that the owner is the user before attaching
			$collection = Collection::find($collection_id);
			$collection->items()->attach($item);
			$collection->save();
		}
		return redirect('items')->with(['success', 'Item added']);
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
		return redirect('list')->with(['info', 'Item deleted']);
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
		$item = Item::find($request['id']);
		$item->update($request->validated());
		return back();
	}

	/**
	 * Show the list of items that I personally own. Used by the "My List" button
	 */
	public function owned_items(ItemRequest $request)
	{
		return view('items.index')->with([
			'collections' => auth()->user()->collections()->with(['items'])->get(),
			'availability_warning' => Item::low_availability_warning($request->user()->id),
		]);
	}

	/**
	 * Lists the currently deleted items for a user
	 */
	public function deleted()
	{
		$deleted_items = Item::withTrashed()->where('owner_id', auth()->user()->id)->where('deleted_at', ">", 0)->get();
		$deleted_shares = UserUsers::withTrashed()->where('id', auth()->user()->id)->where("deleted_at", ">", 0)->get();
		return view('deleted-items')->with([
			'deleted_items' => $deleted_items,
			'deleted_shares', $deleted_shares
		]);
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
