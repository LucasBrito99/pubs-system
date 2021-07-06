<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pub extends Model
{
    use HasFactory;

    protected $table = 'pubs';

    protected $primary_key = 'id';

    protected $fillable = ['user_id', 'pub', 'pos'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //protected $dateFormat = 'h:m:s';
}
