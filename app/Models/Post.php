<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'slug',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //doesnot follow convention
    // public function testRelation()
    // {
    //     return $this->belongsTo(User::class,'post_creator');
    // }




    //terminal : 
    // composer require cviebrock/eloquent-sluggable:*
    // php artisan vendor:publish --provider="Cviebrock\EloquentSluggable\ServiceProvider"
    // php artisan make:migration add_slug_to_posts_table --table=posts
    // edit col in vs -> new created migration 
    // php artisan migrate


    use Sluggable;
    function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
                // for cascade updating : change in config\slugger ==> OnUpdate = true  
            ]
        ];
    }
    
}
