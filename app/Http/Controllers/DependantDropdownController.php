<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DependantDropdownController extends Controller
{
    public function provinces()
    {
        return \Indonesia::allProvinces();
    }

    public function cities(Request $request)
{
    $province = \Indonesia::findProvince($request->id, ['cities']);

    if ($province && isset($province->cities)) {
        return $province->cities->pluck('name', 'id');
    } else {
        return [];
    }
}



public function districts(Request $request)
{
    $city = \Indonesia::findCity($request->id, ['districts']);

    // Periksa apakah objek 'city' tidak null dan memiliki properti 'districts'
    if ($city && isset($city->districts)) {
        return $city->districts->pluck('name', 'id');
    } else {
        return [];
    }
}


public function villages(Request $request)
{
    $district = \Indonesia::findDistrict($request->id, ['villages']);

    // Periksa apakah objek 'district' tidak null dan memiliki properti 'villages'
    if ($district && isset($district->villages)) {
        return $district->villages->pluck('name', 'id');
    } else {
        return [];
    }
}

}