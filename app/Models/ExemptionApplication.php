<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExemptionApplication extends Model
{
    use HasFactory;
    protected $fillable = [
        'applicant_name',
        'physical_address',
        'postal_address',
        'phone',
        'fax',
        'email',
        'sector',
        'num_employees',
        'submitted_first_report',
        'report_reason',
        'report_date',
        'supporting_statement',
        'actions_taken',
        'representative_name',
        'position',
        'date_submitted',
         'status',
    'approved_document'
        
    ];
}
