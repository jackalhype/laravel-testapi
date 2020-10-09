<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 * @package App\Models
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Document extends Model
{
    use HasFactory;

    protected $casts = [
        'payload' => 'array'
    ];
}
