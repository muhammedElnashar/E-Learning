<?php
namespace App\Console\Commands;

use App\Models\Playlist;
use App\Models\Video;
use App\Services\YouTubeService;
use Illuminate\Console\Command;

class FetchYouTubePlaylists extends Command
{
    protected $signature = 'youtube:fetch-playlists';
    protected $description = 'Fetch playlists and videos from YouTube and store them in the database';

    protected $youtubeService;

    public function __construct(YouTubeService $youtubeService)
    {
        parent::__construct();
        $this->youtubeService = $youtubeService;
    }

    public function handle()
    {
        // Replace with your channel ID
        $channelId = 'UC_x5XG1OV2P6uZZ5FSM9Ttw';

        // Fetch playlists
        $playlists = $this->youtubeService->getPlaylists($channelId);

        foreach ($playlists as $playlistData) {
            $playlist = PlayList::updateOrCreate(
                ['playlist_id' => $playlistData['id']],
                [
                    'title' => $playlistData['snippet']['title'],
                    'description' => $playlistData['snippet']['description'],
                    'thumbnail' => $playlistData['snippet']['thumbnails']['default']['url'],
                ]
            );

            // Fetch videos for the playlist
            $videos = $this->youtubeService->getVideos($playlistData['id']);

            foreach ($videos as $videoData) {
                Video::updateOrCreate(
                    ['video_id' => $videoData['snippet']['resourceId']['videoId']],
                    [
                        'playlist_id' => $playlist->id,
                        'title' => $videoData['snippet']['title'],
                        'description' => $videoData['snippet']['description'],
                        'thumbnail' => $videoData['snippet']['thumbnails']['default']['url'],
                    ]
                );
            }
        }

        $this->info('YouTube playlists and videos have been fetched and stored successfully.');
    }
}
