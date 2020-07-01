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

    private function cleanArray($array){
      unset($array['locations']);
      unset($array['concertDates']);
      unset($array['relations']);
      return $array;
    }

    public function getAllArtists(){
      $response = $this->getRequestPattern('artists')->json();

      for ($i = 0; $i < sizeof($response); $i++) {
        unset($response[$i]['members']);
        $response[$i] = $this->cleanArray($response[$i]);
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

      $response = array_merge($responseArtist->json(), $responseConcerts->json());
      $response = $this->cleanArray($response);

      return view('one_artist', ['data'=>$response]);
    }
}
