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
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\ShareRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\UserUsers;
use App\Models\User;

class ShareController extends ApiController
{
    public function index()
    {
    	$user_id = auth()->user()->id;
        $shared_with_others = UserUsers::my_shares($user_id);
        $shared_with_me = UserUsers::shared_with_me($user_id);

        return response()->json([
        	'shared_with_others' => $shared_with_others,
        	'shared_with_me' 	 => $shared_with_me,
        ]);
    }

    public function create()
    {
        //
    }

    public function store(ShareRequest $request)
    {
        // check to see if share exists
        $sharee = User::where('email', $request->email)->first();
        $exists = UserUsers::where('owner_id', $request->user()->id)->where('sharee_id', $sharee->id)->get();
        if (!$exists->isEmpty()) {
            return response()->json(['message' => 'Share already exists between you'], 400);
        }

		$share = new UserUsers;
		$share->owner()->associate($request->user());
		$share->sharee()->associate($sharee);
		$share->save();

        return response()->json(['message' => 'List shared with user'], 200);
    }

    public function show(int $id)
    {
        //
    }

    public function edit(int $id)
    {
        //
    }

    public function update(Request $request, int $id)
    {
        //
    }

    public function destroy(ShareRequest $request)
    {
        $share = UserUsers::find($request->id);
        $share->delete();
        return response()->json(['message' => 'List revoked from user'], 200);
    }
}
