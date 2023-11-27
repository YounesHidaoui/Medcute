<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerts extends Model
{
    use HasFactory;
    protected $fillable = [
        'dci_id',
        'source_id',
        'news_link',
        'summary',
        'risk',
        'category_id',
        'news_date',
        'country_concerned',
        'id'
      ];
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
            return $this->belongsTo(Categories::class,'category_id');
        }
}
