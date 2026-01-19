<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class ExemptionVariation extends Model implements HasMedia
{
      use HasFactory, InteractsWithMedia;
    
    protected $fillable = [
        'applicant_name',
        'address',
        'sections_sought',
        'categories_affected',
        'representative_name',
        'position',
        'application_date',
            'status',
    'approved_document'
    ];
    protected $casts = [
    'application_date' => 'date',
];

 public function sections()
{
    return $this->belongsToMany(
        Section::class,
        'exemption_variation_section',
        'exemption_variation_id',
        'section_id'
    );
}
public function registerMediaCollections(): void
{
    $this
        ->addMediaCollection('submission_document')->useDisk('public')->singleFile();
}


}
