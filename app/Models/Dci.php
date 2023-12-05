<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dci extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'id'
      ];
    public function alerts()
        {
            return $this->hasMany(Alerts::class);
        }
}
