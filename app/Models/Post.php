<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title_ku',
        'title_ar',
        'title_en',
        'content_ku',
        'content_ar',
        'content_en',
        'image',
        'is_published',
    ];

    public function getTitleAttribute(): string
    {
        $locale = \Illuminate\Support\Facades\App::getLocale();
        $colLang = $locale === 'ckb' ? 'ku' : (in_array($locale, ['ar', 'en']) ? $locale : 'ku');
        $column = "title_{$colLang}";
        return $this->{$column} ?? $this->title_ku ?? $this->title_en ?? $this->title_ar ?? '';
    }

    public function getContentAttribute(): string
    {
        $locale = \Illuminate\Support\Facades\App::getLocale();
        $colLang = $locale === 'ckb' ? 'ku' : (in_array($locale, ['ar', 'en']) ? $locale : 'ku');
        $column = "content_{$colLang}";
        return $this->{$column} ?? $this->content_ku ?? $this->content_en ?? $this->content_ar ?? '';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
