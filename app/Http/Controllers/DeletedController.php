<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserUsers;
use App\Models\Item;

class DeletedController extends Controller
{
	public function index()
	{
		$deleted_items = Item::withTrashed()->where('owner_id', auth()->user()->id)->where('deleted_at', ">", 0)->get();
		$deleted_shares = UserUsers::withTrashed()->where('id', auth()->user()->id)->where("deleted_at", ">", 0)->get();
		return view('deleted-items')->with('deleted_items', $deleted_items)->with('deleted_shares', $deleted_shares);
	}
}
