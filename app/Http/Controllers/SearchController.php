<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;
use Session;
use SpotifyWebAPI;

class SearchController extends Controller
{

  public function __construct()
    {
      // Get access token from Spotify
        if (!Cache::has('accessToken')) {
            // Create Spotify Client
            $this->spotifyClient = new SpotifyWebAPI\Session(
                '3a52d9ecb7ed47f3a37c664169059b87',
                'd965454609944a80ad9ad7768fea534b'
            );
            // Attempt to get client_credentials token
            if ($this->spotifyClient->requestCredentialsToken()) {
                Cache::put(
                    'accessToken',
                    $this->spotifyClient->getAccessToken()
                );
            }
        }

    }

    public function index()
    {
        return view('index');
    }

    public function showartist($id, Request $request)
    {
      //New connection to Spotify API
      $api = new SpotifyWebAPI\SpotifyWebAPI();
      $api->setAccessToken(Cache::get('accessToken'));

      //Get Artist object with artist id
      $artist[]=$api->getArtist($id);

      //Store artist object
      $artist['artist']=$artist;

      return view('info_artist', $artist);
    }

    public function showalbum($id, Request $request)
    {
      //New connection to Spotify API
      $api = new SpotifyWebAPI\SpotifyWebAPI();
      $api->setAccessToken(Cache::get('accessToken'));

      //Get Album object with album id
      $album_tracks[]=$api->getAlbum($id);

      //Store album object
      $album['album']=$album_tracks;

      return view('info_album', $album);
    }

    public function showtrack($id, Request $request)
    {
      //New connection to Spotify API
      $api = new SpotifyWebAPI\SpotifyWebAPI();
      $api->setAccessToken(Cache::get('accessToken'));

      //Get Track object with track id
      $tracks[]=$api->getTrack($id);

      //Store track object
      $track['track']=$tracks;

      return view('info_track', $track);
    }

    public function search(Request $request)
    {
        //Arrays used
        $data=[];

        //Get query data
        $query=$request->input('query');

        //Validate form
        if( $request->isMethod('post') )
        {
          $this->validate(
            $request,
            [
              'query'=>'required|min:3',
            ]
          );
        //If validated
        
        //Store Search term
        $data['searchTerm']=$query;

        //New connection to Spotify API
        $api = new SpotifyWebAPI\SpotifyWebAPI();
        $api->setAccessToken(Cache::get('accessToken'));

        //Search the spotify catalog for artists
        $artist = $api->search($query, 'artist');

        //Store artist item object
        $data['artist_results']=$artist->artists->items;

        //Get the smallest image for list and store
        $data['artist_pics']=$this->getSmallestImage($artist->artists->items);

        //
        //Search the spotify catalog for albums
        //
        $album = $api->search($query, 'album');

        //Store album item object
        $data['album_results']=$album->albums->items;

        //Get the smallest image for list and store
        $data['album_pics']=$this->getSmallestImage($album->albums->items);

        //
        //Search the spotify catalog for tracks
        //
        $track = $api->search($query, 'track');

        //Store track item object
        $data['track_results']=$track->tracks->items;

        //return view('search', ['searchTerm' => $query]);
        return view('search', $data);
      }
      //Else return to
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
