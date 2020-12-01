<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';
    public $timestamps = true;
     public $primaryKey = 'id';
   /* protected $casts = [
        'cost' => 'float'
    ];*/

    protected $fillable = [
        'user_id',
        'body',
        'audio'
    ];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    
}
