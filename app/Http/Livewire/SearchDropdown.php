<?php

namespace App\Http\Livewire;

use App\Traits\CommonTrait;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $searchHint = '';

    use CommonTrait;

    public function render()
    {
      $searchColumns = ['name', 'members', 'creationDate', 'firstAlbum'];
      $result = [];
      $data = $this->getRequestPattern('artists');

      foreach ($searchColumns as $key) {
        $column = array_column($data, $key);
        $foundData = $this->array_find($this->searchHint, $column);

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
      $result = $this->AppendCountries($result, $this->searchHint);
      return view('livewire.search-dropdown', [
        'data'=>collect($result)->take(7),
      ]);
    }
}
