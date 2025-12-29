<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    // Need This protection to Submit the data to the database 
    protected $fillable = ['title','company','location','website','email','description','tags','logo','user_id'];

    // Filter method for tag
    public function scopeFilter($query, array $filters){
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        // Filter method for search
        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')

                   ->orWhere('description', 'like', '%' . request('search') . '%')

                   ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }


    //Relationship to User -- Product belongs to user
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    
 
}
