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
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\ShareRequest;
use Illuminate\Support\Facades\Gate;
use App\Models\UserUsers;
use App\Models\User;

class ShareController extends Controller
{
    public function index()
    {
    	$user_id = auth()->user()->id;
        $shared_with_others = UserUsers::my_shares($user_id);
        $shared_with_me = UserUsers::shared_with_me($user_id);

        return view('sharing')->with([
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
        $request['sharee_id'] = User::where('email', $request->email)->value('id');
        $exists = UserUsers::where('owner_id', $request->owner_id)->where('sharee_id', $request['sharee_id'])->get();
        if (!$exists->isEmpty()) {
            return redirect('share')->withInfo('Share already exists between you');
        }

		$share = new UserUsers;
		$share->owner()->associate($request->user());
		$share->sharee()->associate( User::find($request['sharee_id']) );
		$share->save();

        return redirect('share')->withSuccess('List shared with user');
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

    public function destroy(int $id)
    {
        $share = UserUsers::find($id);
        $share->delete();
        return redirect('share')->withInfo('List revoked from user');
    }
}
