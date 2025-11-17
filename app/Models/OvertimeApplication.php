<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OvertimeApplication extends Model
{
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
        'employee_consent_link',
        'period_sought',
        'signature_date',
         'status',
    'approved_document'

    ];
}
