<?php

namespace App\Services;
use Cache;
use Session;
use SpotifyWebAPI;

class Spotify
{
  protected $apiKey;
  protected $spotifyClient;
  protected $spotifyApi;

  public function __construct()
  {
    // Create Spotify Client Session
    $this->spotifyClient = new SpotifyWebAPI\Session(
        config('services.spotify.client_id'),
        config('services.spotify.client_secret')
    );
    // Request Spotify Token
    $this->spotifyClient->requestCredentialsToken();
    $this->apiKey = $this->spotifyClient->getAccessToken();
    // Create connection to Spotify Api
    $this->spotifyApi = new SpotifyWebAPI\SpotifyWebAPI();
    $this->spotifyApi->setAccessToken($this->apiKey);

  }
  // Search artist
  public function searchArtist($query)
  {
    return $this->spotifyApi->search($query,'artist');
  }
  // Search album
  public function searchAlbum($query)
  {
    return $this->spotifyApi->search($query,'album');
  }
  // Search Track
  public function searchTrack($query)
  {
    return $this->spotifyApi->search($query,'track');
  }
  // Get Artist with id
  public function getArtist($id)
  {
    return $this->spotifyApi->getArtist($id);
  }
  // Get Album with id
  public function getAlbum($id)
  {
    return $this->spotifyApi->getAlbum($id);
  }
  // Get Track with id
  public function getTrack($id)
  {
    return $this->spotifyApi->getTrack($id);
  }

}
 ?>
