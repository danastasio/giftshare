<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserCollection;
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
		return $this->belongsToMany(Item::class);
    }
}
