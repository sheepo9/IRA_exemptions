<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

public function exemptionVariations()
{
    return $this->belongsToMany(
        ExemptionVariation::class,
        'exemption_variation_section',
        'section_id',
        'exemption_variation_id'
    );
}

}