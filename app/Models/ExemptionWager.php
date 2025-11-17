<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExemptionWager extends Model
{
    use HasFactory;
    protected $fillable = [
        'applicant_name',
        'physical_address',
        'postal_address',
        'phone',
        'fax',
        'email',
        'sector_industry',
        'wage_order_name',
        'detailed_statement',
        'representative_name',
        'position',
        'application_date',
         'status',
    'approved_document'
    ];
}
