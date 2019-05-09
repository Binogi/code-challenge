<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Spotify;
use Cache;
use SpotifyWebAPI;

class SearchController extends Controller
{

    public function index()
    {
        return view('index');
    }

    public function showartist($id, Request $request, Spotify $spotify)
    {

      //Get Artist object with artist id
      $artist[]=$spotify->getArtist($id);

      //Store artist object
      $artist['artist']=$artist;

      return view('info_artist', $artist);
    }

    public function showalbum($id, Request $request, Spotify $spotify)
    {
      //Get Album object with album id
      $album_tracks[]=$spotify->getAlbum($id);

      //Store album object
      $album['album']=$album_tracks;

      return view('info_album', $album);
    }

    public function showtrack($id, Request $request, Spotify $spotify)
    {
      //Get Track object with track id
      $tracks[]=$spotify->getTrack($id);

      //Store track object
      $track['track']=$tracks;

      return view('info_track', $track);
    }

    public function search(Request $request, Spotify $spotify)
    {
        //Arrays used
        $data=[];

        //Get query data
        $query=$request->input('query');

        //Validate form
        if( $request->isMethod('post') ) {
            $this->validate(
            $request,
            [
            'query'=>'required|min:1',
            ]
            );
        //If validated continue search

        //Store Search term
        $data['searchTerm']=$query;

        //Search the spotify catalog for artists
        $artist = $spotify->searchArtist($query);

        //Store artist item object
        $data['artist_results']=$artist->artists->items;

        //Get the smallest image for list and store
        $data['artist_pics']=$this->getSmallestImage($artist->artists->items);

        //
        //Search the spotify catalog for albums
        //
        $album = $spotify->searchAlbum($query);

        //Store album item object
        $data['album_results']=$album->albums->items;

        //Get the smallest image for list and store
        $data['album_pics']=$this->getSmallestImage($album->albums->items);

        //
        //Search the spotify catalog for tracks
        //
        $track = $spotify->searchTrack($query);

        //Store track item object
        $data['track_results']=$track->tracks->items;

        //return view('search', ['searchTerm' => $query]);
        return view('search', $data);
      }
      //Else return to index
        return view('index');
    }

    private function getSmallestImage($images){
      //Arrays used
      $pics=[];
      //Iterate trough the object
      foreach ($images as $key => $value){
        //Find and check for images
        if ($value->images){
          //Store smallest image
          $pics[]=end($value->images);
        }
        //If no images are available, set some empty data
        else $pics[]=(object)array('height'=>0,'url'=>'#','width'=>0);
      }
      //Return array of small images from spotify
      return $pics;
    }


}
