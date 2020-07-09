<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait CommonTrait{

  public function ExtractCountryOrCity($type, $location){
    if($type=='country'){
      $location = substr($location, strpos($location, "-") + 1);
    }else{
      $location = strtok($location, '-');
    }
    $location = str_replace("_", " ", $location);
    $location = ucwords($location);
    return $location;
  }

  public function cleanArray($array, $fieldsToDelete){
    foreach ($fieldsToDelete as $key) {
      unset($array[$key]);
    }
    return $array;
  }

  public function getRequestPattern($url){
    $response = Http::get('https://groupietrackers.herokuapp.com/api/' . $url);
    return $response->json();
  }
  public function array_find($searchHint, $array){
    $resultIDs = [];
    foreach ($array as $key => $value) {
      if(is_array($value)){
        foreach ($value as $member) {
          if (false !== stripos($member, $searchHint)) {
                array_push($resultIDs, [$key, $member]);
          }
        }
      }else if (false !== stripos($value, $searchHint)) {
            array_push($resultIDs, [$key, $value]);
      }
    }
    return $resultIDs;
  }

  public function DateFormat($data){
    if(is_array($data)){
    $data['firstAlbum'] = $data['firstAlbum'][0].$data['firstAlbum'][1]."."
                            .$data['firstAlbum'][3].$data['firstAlbum'][4]."."
                            .$data['firstAlbum'][6].$data['firstAlbum'][7].$data['firstAlbum'][8].$data['firstAlbum'][9];
    }else{
      $data = $data[0].$data[1]."."
              .$data[3].$data[4]."."
              .$data[6].$data[7].$data[8].$data[9];
    }
    return $data;
  }

  public function getLocations($searchHint){
    $response = $this->getRequestPattern('locations');
    $resultCountries = [];
    $resultCities = [];

    foreach ($response['index'] as $key => $value) {
      foreach ($value['locations'] as $location) {
        array_push($resultCountries, $this->ExtractCountryOrCity('country', $location));
        array_push($resultCities, $this->ExtractCountryOrCity('city', $location));
      }
    }
    $resultCountries = array_unique($resultCountries);
    $foundCountries = $this->array_find($searchHint, $resultCountries);
    $resultCities = array_unique($resultCities);
    $foundCities = $this->array_find($searchHint, $resultCities);
    return [$foundCountries, $foundCities];
  }

  public function AppendCountries($result, $searchHint){
    $distinctLocations = $this->getLocations($searchHint);
    foreach ($distinctLocations as $key => $value) {
      if($key == 0){
        $lable = "Country of concerts";
        $CityOrCountry = "country";
      }else{
        $lable = "City of concert";
        $CityOrCountry = "city";
      }
      foreach ($value as $match) {
        array_push($match, $CityOrCountry);
        array_push($match, $lable);
        array_push($result, $match);
      }
    }
    return $result;
  }

  public function getDistinctLocations(){
    $response = $this->getRequestPattern('locations');
    $result = [];

    foreach ($response['index'] as $key => $value) {
      foreach ($value['locations'] as $location) {
        array_push($result, $this->ExtractCountryOrCity('country', $location));
      }
    }
    $result = array_unique($result);
    return $result;
  }
}

 ?>
