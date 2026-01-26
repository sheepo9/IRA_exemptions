<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
class OvertimeApplication extends Model implements HasMedia
{
    use InteractsWithMedia;

    use HasFactory;
       protected $fillable = [
        'employer_name',
        'contact_person',
        'postal_address',
        'tel_no',
        'email',
        'motivation',
        'proposed_daily_limit',
        'proposed_weekly_limit',
        'work_on_sundays',
        'class_of_employees',
        'period_sought',
        'signature_date',
         'status',
    'approved_document'

    ];
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('employee_consent')
             ->singleFile(); // only ONE consent document
    }
}
