<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $primaryKey = 'id'; // or null
    public $incrementing = false;
    protected $keyType = 'string';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'url',
        'publication_date',
    ];
    
    /**
     * Many to many relationship with users
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
