<?php

namespace App\Http\Controllers;

use App\Traits\CommonTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Input;

class ArtistController extends Controller
{

    use CommonTrait;
    public $searchHint = '';

    public function getAllArtists(Request $request){
      $response = $this->getRequestPattern('artists');
      $deleteFields = ['locations', 'concertDates', 'relations'];
      $membersNumber = [];
      for ($i = 0; $i < sizeof($response); $i++) {
        array_push($membersNumber, sizeof($response[$i]['members']));
        $response[$i] = $this->cleanArray($response[$i], $deleteFields);
        $response[$i] = $this->DateFormat($response[$i]);
      }
      $membersNumber = array_unique($membersNumber);
      sort($membersNumber);

      $distinctLocations = $this->getDistinctLocations();
      sort($distinctLocations);

      $dateFrom = $request->has('dateFrom') ? $request->input('dateFrom') : null;
      $dateTo = $request->has('dateTo') ? $request->input('dateTo') : null;
      $creationDate =  $request->has('creationDate') ? $request->input('creationDate') : null;
      $countMembers = $request->has('memberNumber') ? $request->input('memberNumber') : [];
      $location =  $request->has('location') ? $request->input('location') : null;
      $CheckResult = [];
      $request = $countMembers;
      if(isset($dateFrom) && isset($dateTo)){
        for ($i = 0; $i < sizeof($response); $i++) {
          $album = date("Y-m-d", strtotime($response[$i]['firstAlbum']));
          if($album <= $dateTo && $album >= $dateFrom){
            array_push($CheckResult, $response[$i]);
          }
        }
        $response = $CheckResult;
      }
      if(isset($creationDate)){
        $CheckResult = [];
        for ($i = 0; $i < sizeof($response); $i++) {
          if($response[$i]['creationDate'] == $creationDate){
            array_push($CheckResult, $response[$i]);
          }
        }
        $response = $CheckResult;
      }
      if(isset($countMembers) && $countMembers!=[]){
        $CheckResult = [];
        for ($i = 0; $i < sizeof($response); $i++){
          if(in_array(sizeof($response[$i]['members']), $countMembers)){
            array_push($CheckResult, $response[$i]);
          }
        }
        $response = $CheckResult;
      }
      if(isset($location) && $location!="null"){
        $CheckResult = [];
        for ($i = 0; $i < sizeof($response); $i++) {
          $allLocations = $this->getRequestPattern('locations/' . $response[$i]['id']);
          foreach ($allLocations['locations'] as $key) {
            $country = $this->ExtractCountryOrCity('country', $key);
            if($country == $location){
              array_push($CheckResult, $response[$i]);
              break;
            }
          }
        }
        $response = $CheckResult;
      }
      //dd($response);
      return view('artists', ['data'=>[$membersNumber, $response, $distinctLocations, $request]]);

    }

    public function getOneArtist($id){
      $responseArtist = $this->getRequestPattern('artists/' . $id);
      $responseConcerts = $this->getRequestPattern('relation/' . $id);
      //check if the given 'id' is within the range
      if($responseArtist['id']=='0'){
        return view('not_found');
      }
      $response = $this->DateFormat($responseArtist);

      $dateLocation = [];

      foreach ($responseConcerts['datesLocations'] as $key => $value){
        foreach ($value as $date){
          $city = $this->ExtractCountryOrCity('city', $key);
          $country = $this->ExtractCountryOrCity('country', $key);
          $date = $this->DateFormat($date);
          array_push($dateLocation, [$country, $city, $date]);
        }
      }
      $deleteFields = ['locations', 'concertDates', 'relations', 'datesLocations'];
      $response = $this->cleanArray($response, $deleteFields);
      array_push($response, $dateLocation);

      return view('one_artist', ['data'=>$response]);
    }
}
