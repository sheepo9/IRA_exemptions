<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Continuous_operation extends Model implements HasMedia
{
    use HasFactory , InteractsWithMedia;
    protected $fillable = [
    'user_id',
    'employer_name',
    'registration_number',
    'contact_person',
    'postal_address',
    'telephone',
    'email',
    'nature_of_business',
    'motivation',
    'period',
    'employee_categories',
    'number_of_shifts',
    'hours_per_shift',
    'off_days',
    'shift_roster',
    'signature',
    'date_signed',
    'status',
    'approved_document',
];
public function registerMediaCollections(): void
{
    $this->addMediaCollection('documents')->useDisk('public');
}

}
