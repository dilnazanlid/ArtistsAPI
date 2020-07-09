<?php

namespace App\Http\Controllers;

use App\Traits\CommonTrait;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Http;


class SearchController extends Controller
{
    use CommonTrait;

    public function SearchAll(SearchRequest $request){
      $searchHint = $request->input('searchHint');
      $searchColumns = ['name', 'members', 'creationDate', 'firstAlbum'];

      $data = $this->getRequestPattern('artists');
      $result = [];
      foreach ($searchColumns as $key) {
        $column = array_column($data, $key);
        $foundData = $this->array_find($searchHint, $column);

        for($i = 0; $i < sizeof($foundData); $i++){
          array_push($foundData[$i], $key);
          $textDescription = "";
          if($foundData[$i][2]=="members"){
            $textDescription = "Member of band - ";
          }else if($foundData[$i][2]=="creationDate"){
            $textDescription = "Creation Date of ";
          }else if($foundData[$i][2]=="firstAlbum"){
            $textDescription = "First album of ";
          }
          if($foundData[$i][2]!="name"){
            array_push($foundData[$i], $textDescription . $data[$foundData[$i][0]]["name"]);
          }else{
            array_push($foundData[$i], "Artist/Band name");
          }
          array_push($result, $foundData[$i]);
        }
      }
      $result = $this->AppendCountries($result, $searchHint);
      return view('search_results', ['data' => $result]);
    }

}
