<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasUuids;

    protected $fillable = [
        'module_id',
        'title',
        'type',
        'content',
        'duration',
        'is_preview',
        'sort',
    ];

    protected $casts = [
        'is_preview' => 'boolean',
    ];

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}
