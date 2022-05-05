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
        return view('sharing')->with([
        	'shared_with_others' => auth()->user()->shares()->withPivot('id')->get(),
        	'shared_with_me' 	 => auth()->user()->shared_with_user()->get(),
        ]);
    }

    public function create()
    {
        //
    }

	public function store(ShareRequest $request)
    {
    	if (count(User::where('email', $request['email'])->get()) == 0 ) {
    		return redirect('share')->with(['error' => 'User not found']);
    	}
        if (count(auth()->user()->shares()->where('email', $request['email'])->get()) != 0) {
        	return redirect('share')->with(['error' => 'Share already exists between you']);
        }
		auth()->user()->shares()->attach(User::where('email', $request['email'])->get());
        return view('sharing')->with([
        	'success' => 'List shared with user',
        	'shared_with_others' => auth()->user()->shares()->withPivot('id')->get(),
        	'shared_with_me' => auth()->user()->shared_with_user()->get()
        ]);
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
		$share = auth()->user()->shares()->wherePivot('id', $request['id'])->withPivot('id')->get();
		auth()->user()->shares()->detach($share);

        return view('sharing')->with([
        	'info' => 'List revoked from user',
        	'shared_with_others' => auth()->user()->shares()->get(),
        	'shared_with_me' => auth()->user()->shared_with_user()->get()
        ]);
    }
}
