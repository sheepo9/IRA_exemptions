<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExemptionDeclaration extends Model
{
    use HasFactory;
    protected $fillable = [
        'minister_name',
        'applicant_name',
        'physical_address',
        'exemption_sections',
        'variation_sections',
        'effective_from',
        'effective_to',
        'signed_date',
         'status',
    'approved_document'
    ];
}
