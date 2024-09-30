<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Services\YouTubeService;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{

    protected $youtubeService;

    public function __construct(YouTubeService $youtubeService)
    {
        $this->youtubeService = $youtubeService;
    }

    public function index()
    {
//// Replace with your channel ID
//        $channelId = 'UC_x5XG1OV2P6uZZ5FSM9Ttw'; // Replace with your actual channel ID
//        $playlists = $this->youtubeService->getPlaylists($channelId);
////dd($playlists);
//        if (isset($playlists['error'])) {
//            return view('youtube.index')->with('error', $playlists['error']);
//        }

        return PlayList::all();
    }

    public function show($playlistId)
    {
//        $videos = $this->youtubeService->getVideos($playlistId);
        $playlist= Playlist::findorfail($playlistId);
        $playlist->videos;

        if (isset($videos['error'])) {
            return $videos['error'];
        }

        return $playlist;
    }
}
