<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ku',
        'name_ar',
        'name_en',
        'description_ku',
        'description_ar',
        'description_en',
        'icon',
        'image',
    ];

    public function getNameAttribute(): string
    {
        $locale = \Illuminate\Support\Facades\App::getLocale();
        $colLang = $locale === 'ckb' ? 'ku' : (in_array($locale, ['ar', 'en']) ? $locale : 'ku');
        $column = "name_{$colLang}";
        return $this->{$column} ?? $this->name_ku ?? $this->name_en ?? $this->name_ar ?? '';
    }

    public function getDescriptionAttribute(): ?string
    {
        $locale = \Illuminate\Support\Facades\App::getLocale();
        $colLang = $locale === 'ckb' ? 'ku' : (in_array($locale, ['ar', 'en']) ? $locale : 'ku');
        $column = "description_{$colLang}";
        return $this->{$column} ?? $this->description_ku ?? $this->description_en ?? $this->description_ar ?? null;
    }

    public function doctors()
    {
        return $this->hasMany(DoctorProfile::class);
    }
}