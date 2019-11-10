<?php
namespace App;

use Illuminate\Http\Request;
use SpotifyWebAPI;
// Session;
class Spotify {

    private static $baseUrl = 'https://api.spotify.com';
    private $guzzleClient;
    private $accessToken;
    private $session;
    private $api;

    public function __construct(){
    require '../vendor/autoload.php';
    $this->session = new SpotifyWebAPI\Session(
        '7646cabbafd349ed8d97af809f503543',
        '9872a46300d0452eb88c9232ebe727d5'
    );
    $this->session->requestCredentialsToken();
    $this->accessToken = $this->session->getAccessToken();
    
    // Fetch the saved access token from somewhere.
    $this->api = new SpotifyWebAPI\SpotifyWebAPI();
    $this->api->setAccessToken($this->accessToken);
    
}
public function getAllInfo($artistName)
{
    $res = $this->api->search($artistName, 'artist,track,album');
//    print_r($res );
    return $res;
}
    public function getAllartists($artistName)
    {
        $res = $this->api->search($artistName, 'artist');
    //    print_r($artists );
        return $res;
    }
    public function getartistsbyID($id)
    {
        $res = $this->api->getArtist($id);
        return $res;
    }

    public function getartistTopTracks($artistId)
    {
    
        $tracks = $this->api->getArtistTopTracks($artistId, [
            'country' => 'ca',
        ]);
        $res = $this->api->getArtistAlbums($artistId, 'CA');
        return $tracks;
    }
    public function getArtistAlbums($artistId)
    {
        $albums = $this->api->getArtistAlbums($artistId, [
            'country' => 'ca',
        ]);
        return $albums;
    }

    public function artistRelatedArtists($artistId)
    {
        $res = $this->api->getArtistRelatedArtists($artistId);
        return $res;
    }
    
//  public function getAllAlubms(Request $request)
//     {
  
//     }

//     public function getAllTracks(Request $request)
//     {
//     }

//     public function getAlbumbyid(){

//     }
//     public function getTrackbyid(){

//     }

}