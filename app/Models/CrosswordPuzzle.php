<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrosswordPuzzle extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'grid_matrix' => 'array',
        'clues_across' => 'array',
        'clues_down' => 'array',
        'grid_rows' => 'integer',
        'grid_cols' => 'integer',
    ];
}
