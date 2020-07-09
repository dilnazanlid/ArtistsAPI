<?php

namespace App\Http\Controllers;

use App\Traits\CommonTrait;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    use CommonTrait;

    public function GetArtistsByLocation($type, $location){
      $responseLocations = $this->getRequestPattern('locations')['index'];
      $responseArtists = $this->getRequestPattern('artists');
      $column = array_column($responseLocations, 'locations');
      $result = [];
      foreach ($column as $key => $value) {
        foreach ($value as $rawLocation) {
          if($type == "country"){
            $toFind = $this->ExtractCountryOrCity('country', $rawLocation);
          }else{
            $toFind = $this->ExtractCountryOrCity('city', $rawLocation);
          }
          if($toFind == $location){
            array_push($result, [$key+1, $responseArtists[$key]['name']]);
            break;
          }
        }
      }
      return view('search_location', ['data' => [$location, $result]]);
    }
}
