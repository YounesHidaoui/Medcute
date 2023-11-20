<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerts extends Model
{
    use HasFactory;
        public function dci()
        {
            return $this->belongsTo(Dci::class);
        }

        public function source()
        {
            return $this->belongsTo(Source::class);
        }

        public function categories()
        {
            return $this->belongsTo(Categories::class);
        }
}
