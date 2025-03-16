<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class templateDetails extends Model
{
    /** @use HasFactory<\Database\Factories\TemplateDetailsFactory> */
    use HasFactory;
    protected $table = 'template_details';
    public function template():BelongsTo
    {
        return $this->belongsTo(template::class);
    }
    public function exercise():BelongsTo
    {
        return $this->belongsTo(exercise::class);
    }
}
