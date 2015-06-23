<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listings extends Model
{
    protected $table = 'listings';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'description', 'category', 'price', 'image_file_name'];
    protected $hidden = ['created_at', 'updated_at', 'image_content_type',  'image_file_sizes', 'user_id'];
    

            
    
    public function user() 
    {
        return $this->belongsTo('App\User');
    }
}
