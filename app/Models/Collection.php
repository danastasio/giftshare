<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserCollection;
use App\Models\User;
use App\Models\Item;
use App\Models\ItemCollection;

class Collection extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function user_collections()
    {
		return $this->belongsTo(UserCollection::class);
    }

    public function items()
    {
		return $this->belongsToMany(Item::class)->orderByDesc('priority');
    }

	public function owner()
	{
		return $this->belongsToMany(User::class, 'collection_user', 'collection_id', 'owner_id')
			->where('access_type', '2');
	}

	public function users()
	{
		return $this->belongsToMany(User::class, 'collection_user', 'collection_id', 'sharee_id')->orderBy('id');
	}
}
