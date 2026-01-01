<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Course extends Model
{
    use HasUuids;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'thumbnail',
        'price',
        'level',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    // Relasi ke Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke Tag (Pivot)
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'course_tag');
    }

    // Relasi ke Modules
    public function modules(): HasMany
    {
        return $this->hasMany(Module::class)->orderBy('sort');
    }

    // Relasi Pintas ke Lessons (Lewat Modules)
    public function lessons(): HasManyThrough
    {
        return $this->hasManyThrough(Lesson::class, Module::class);
    }

    // Relasi ke Enrollments (Siapa aja muridnya)
    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }
}
