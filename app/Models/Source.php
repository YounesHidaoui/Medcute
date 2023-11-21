<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    use HasFactory;
    protected $fillable = [
        'continent',
        'country',
        'sigle',
        'sigle',
        'website',
      ];
    public function alerts()
{
    return $this->hasMany(Alert::class);
}
}
