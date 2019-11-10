<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spotify;
// use DB;
use Session;
class SearchController extends Controller
{
    public function index()
    {
        return view('index');
    }


    public function search(Request $request)
    {
        $query = $request->get('query');
        return searchAll($request); //view('search', ['searchTerm' => $query,'result'=>$result]);
    }


    public function searchAll(Request $request)
    {
        $query = $request->input('query');
        $spotify = new Spotify();
        $results = $spotify->getAllInfo($query);
        $artists = [];
        if ($results->artists && $results->artists->items) {
            $artists = $results->artists->items;
        }
        $albums = [];
        if ($results->albums && $results->albums->items) {
            $albums = $results->albums->items;
        }
        $tracks = [];
        if ($results->tracks && $results->tracks->items) {
            $tracks = $results->tracks->items;
        }
        // print_r($albums);
      return view('search', ['searchTerm' => $query, 'artists' => $artists,'albums'=>$albums, 'tracks'=>$tracks, 'title' => 'Search Results']);
    }

    public function findartists(Request $request)
    {
        $query = $request->input('query');
        $spotify = new Spotify();
        $results = $spotify->getAllArtists($query);
        $artists = [];
        if ($results->artists && $results->artists->items) {
            $artists = $results->artists->items;
        }

      return view('search', ['searchTerm' => $query, 'artists' => $artists, 'title' => 'Search Results']);
    }

    public function artist(Request $request, $id)
    {
        $spotify = new Spotify();
        $artist=$spotify->getartistsbyID($id);
        $toptracks = $spotify->getartistTopTracks($id);
        $tracks = [];
        if ($toptracks->tracks) {
            $tracks = $toptracks->tracks;
        }
       $relatedartists = $spotify->artistRelatedArtists($id);
       $relartists = [];
        if ($relatedartists) {
            $relartists = $relatedartists->artists;
        }
        return view('artist-details', ['artist' => $artist, 'tracks' => $tracks,'relartists' => $relartists]);
    }

}
