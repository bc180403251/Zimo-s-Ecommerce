<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable=[
        'visitor_id',
        'country_ip',
        'countryName',
        'countryCode',
        'currencyCode',
        'regionCode',
        'regionName',
        'cityName',
        'zipCode',
        'isoCode',
        'postalCode',
        'latitude',
        'longitude',
        'metroCode',
        'areaCode',
        'timezone',
        'browser',
        'browserVersion',
        'platform',
        'device',
    ];
}
