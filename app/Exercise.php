<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
class Exercise extends Model implements  HasMedia
{
    use HasMediaTrait;

    protected $fillable = ['name','description','instruction','modules','photo_start','photo_end','video'];

    public function media()
    {
        return $this->morphMany(Media::class, 'model');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(250)
            ->height(250);



    }
}
