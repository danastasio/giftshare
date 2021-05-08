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
use DB;

class ShareController extends Controller
{
	public function index() {
		$shared_with_others = UserUsers::where('owner_id',auth()->user()->id)->with('owner','sharee')->get();
		$shared_with_me = UserUsers::where('sharee_id',auth()->user()->id)->with('owner','sharee')->get();
		return view('sharing')->with('shared_with_others', $shared_with_others)->with('shared_with_me', $shared_with_me);
	}
	public function create() {
		echo 'create';
	}
	public function store(ShareRequest $request) {
		$request = $request->validated();
    	$sharee_id = User::where('email',$request['email'])->value('id');

		// prevent users from sharing with themselves
		if ($sharee_id === auth()->user()->id) {
			return redirect('share')->withInfo('You cannot add yourself. Nice try though 😉');
		}

		// check to see if share exists
		$exists = UserUsers::where('owner_id',auth()->user()->id)->where('sharee_id',$sharee_id)->get();
		if(!$exists) {
			return redirect('share')->withInfo('Share already exists between you');
		}

		// check to see if user exists
		$exists = User::find($sharee_id);
		if(!$exists) {
			return redirect('share')->withError('User does not exist');
		} else {
    		$usershare = new UserUsers;
		    $usershare->owner_id = auth()->user()->id;
		    $usershare->sharee_id = $sharee_id;
		    $usershare->save();
			return redirect('share')->withSuccess('List shared with user');
		}
	}
	public function show($id) {
		echo 'show';
	}
	public function edit($id) {
		echo 'edit';
	}
	public function update(Request $request, $id) {
		echo 'update';
	}
	public function destroy($id) {
		return (int)auth()->user()->id === (int)UserUsers::find($id)->value('id');
		if (!Gate::allows('delete', UserUsers::find($id)->value('id'))) {
			return abort(403, 'Unauthorized');
		}
	     $share = UserUsers::find($id);
	     $share->delete();
	     return redirect('share')->withInfo('List revoked from user');
	}
}
