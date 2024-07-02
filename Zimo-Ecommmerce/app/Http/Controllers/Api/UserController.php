<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use Stevebauman\Location\Facades\Location;


class UserController extends Controller
{
    //
    public function getUserInfo(Request $request)
    {
        $ipAddress='192.168.10.5';

        $geoipLocation=Location::get();

        $agent= new Agent();
        $userAgent=$agent->getUserAgent();
        $browser= $agent->browser();
        $browserVersion=$agent->version($browser);
        $platform=$agent->platform();
        $device=$agent->device();


//        dd($ipAddress);

        return response()->json([
            'Ip Address'=> $ipAddress,
            'location'=> $geoipLocation->regionName,
            'user agent'=> $userAgent,
            'browser'=> $browser,
            'browser Version'=> $browserVersion,
            'platform'=> $platform,
            'device'=> $device
        ]);

    }

    public function storeVisitor(Request $request)
    {
        $visitorId = $request->input('visitor_id');
        $ip = '192.168.10.5';

        $location = Location::get();

//        return response()->json(['ip'=> $location]);


        $user = Visitor::where('visitor_id', $visitorId)->first();
        if (!$user) {
            $visitorId = Str::random(16);
//            $location = Location::get($ip);
            $agent = new Agent();
            $browser = $agent->browser();
            $browserVersion = $agent->version($browser);
            $platform = $agent->platform();
            $device = $agent->device();

            Visitor::create([
                'visitor_id' => $visitorId,
//                'country_ip' => $location->ip,
                'countryName' => $location->countryName,
                'currencyCode' => $location->currencyCode,
                'countryCode' => $location->countryCode,
                'regionCode' => $location->regionCode,
                'regionName' => $location->regionName,
                'cityName' => $location->cityName,
                'zipCode' => $location->zipCode,
                'isoCode' => $location->isoCode,
                'postalCode' => $location->postalCode,
                'latitude' => $location->latitude,
                'longitude' => $location->longitude,
                'metroCode' => $location->metroCode,
                'areaCode' => $location->areaCode,
                'timezone' => $location->timezone,
                'browser' => $browser,
                'browserVersion' => $browserVersion,
                'platform' => $platform,
                'device' => $device
            ]);

            return response()->json(['visitor_id' => $visitorId, 'message' => 'Visitor created successfully!']);
        } else {
            return response()->json(['message' => 'Visitor already exists!']);
        }
    }
}
