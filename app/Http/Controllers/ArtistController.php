<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class ArtistController extends Controller
{
    public function getAllArtists(){
      $response = Http::get('https://groupietrackers.herokuapp.com/api/artists');

      return view('artists', ['data'=>$response->json()]);
    }

    public function getOneArtist($id){
      $response = Http::get('https://groupietrackers.herokuapp.com/api/artists/' . $id);
      //check if the given 'id' is within the range
      if($response->json()['id']=='0'){
        return view('not_found');
      }
      return view('one_artist', ['data'=>$response->json()]);
    }

    public function getOneArtistConcerts($id){
      $response = Http::get('https://groupietrackers.herokuapp.com/api/relation/' . $id);
      //check if the given 'id' is within the range
      if($response->json()['id']=='0'){
        return view('not_found');
      }
      return view('one_artist_concerts', ['data'=>$response->json()['datesLocations']]);
    }
}
