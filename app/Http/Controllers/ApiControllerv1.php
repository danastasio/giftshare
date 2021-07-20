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
use App\Models\User_User;
use DB;

class ApiControllerv1 extends Controller
{
    public function hello()
    {
        return "hello";
    }

    public function item_create(Request $request)
    {
        return $request;
        //return json_encode(['message' => 'item_create']);
    }

    public function item_read()
    {
        return json_encode(['message' => 'item_read']);
    }

    public function item_update()
    {
        return json_encode(['message' => 'item_update']);
    }

    public function item_delete()
    {
        return json_encode(['message' => 'item_delete']);
    }

    public function item_claim()
    {
        return json_encode(['message' => 'item_claim']);
    }

    public function item_unclaim()
    {
        return json_encode(['message' => 'item_unclaim']);
    }

    public function share_create(Request $request)
    {
        $usershare = new User_User();
        $sharee_id = DB::table('users')->where('email', '=', $request->sharee_email)->value('id');

        // prevent users from sharing with themselves
        if ($request->owner_id == $sharee_id) {
            return '{"status": "failed", "message": "You cannot add yourself"}';
        }

        // check to see if share exists
        $exists = DB::table('user_users')
                        ->where('owner_id', '=', $request->owner_id)
                        ->where('sharee_id', '=', $sharee_id)
                        ->get();
        if ($exists->count() > 0) {
            return '{"status": "failed", "message": "share already exists"}';
        } else {
            $usershare->owner_id = $request->owner_id;
            $usershare->sharee_id = $sharee_id;
            $usershare->save();
            return '{"status": 204}';
        }
    }

    public function share_read(Request $request)
    {
        /*
         * returns all shares that belong to user
         *
        */
        $share_list = User_User::where('owner_id', '=', $request->user_id)
            ->select('id', 'owner_id', 'sharee_id')
            ->get();
        return $share_list;
    }

    public function share_delete(Request $request)
    {
        /*
         * delete specific share
         * param: share_id
         * returns 204
         */
        $res = User_User::destroy($request->share_id);
        if ($res) {
            return '{"status": 204}';
        } else {
            return json_encode([
                'status' => 'failed',
                'message'=> 'share not found'
            ]);
        }
    }
}
