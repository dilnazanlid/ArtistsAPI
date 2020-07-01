<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ArtistController extends Controller
{

    private function getRequestPattern($url){
      $response = Http::get('https://groupietrackers.herokuapp.com/api/' . $url);
      return $response;
    }

    private function cleanArray($array, $fieldsToDelete){
      foreach ($fieldsToDelete as $key) {
        unset($array[$key]);
      }
      return $array;
    }

    public function getAllArtists(){
      $response = $this->getRequestPattern('artists')->json();
      $deleteFields = ['locations', 'concertDates', 'relations', 'members'];

      for ($i = 0; $i < sizeof($response); $i++) {
        $response[$i] = $this->cleanArray($response[$i], $deleteFields);
      }
      
      return view('artists', ['data'=>$response]);
    }

    public function getOneArtist($id){
      $responseArtist = $this->getRequestPattern('artists/' . $id);
      $responseConcerts = $this->getRequestPattern('relation/' . $id);
      //check if the given 'id' is within the range
      if($responseArtist->json()['id']=='0'){
        return view('not_found');
      }

      $deleteFields = ['locations', 'concertDates', 'relations'];
      $response = array_merge($responseArtist->json(), $responseConcerts->json());
      $response = $this->cleanArray($response, $deleteFields);

      return view('one_artist', ['data'=>$response]);
    }
}
