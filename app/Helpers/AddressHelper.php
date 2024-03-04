<?php
namespace App\Helpers;

use App\Models\Address;

class AddressHelper{
    static function add($address){
        $address = (object) $address;
        return Address::create([
            'type' => $address->type,
            'country' => $address->country,
            'province' => $address->province,
            'city' => $address->city,
            'district' => $address->district,
            'lane' => $address->lane,
            'house' => $address->house,
            'zip' => $address->zip,
            'formatted_address' =>$address->formatted_address,
        ]);
    }
    
    static function edit($address,$id){
        $add = Address::find($id);
        $address = (object) $address;
        $add->country = $address->country;
        $add->province = $address->province;
        $add->city = $address->city;
        $add->district = $address->district;
        $add->lane = $address->lane;
        $add->house = $address->house;
        $add->zip = $address->zip;
        $add->type =$address->type;
        $add->formatted_address = $address->formatted_address;
        $add->update();
        return $add;
    }
    static function get($id){
        return Address::find($id);
    }
}