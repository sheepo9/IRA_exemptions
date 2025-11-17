<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exemption_Variation extends Model
{
    use HasFactory;
    
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
}
