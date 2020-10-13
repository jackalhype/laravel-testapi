<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Document
 * @package App\Models
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Document extends UuidModel
{
    use HasFactory;

    protected $casts = [
        'id' => 'string',
        'payload' => 'array'
    ];
}
