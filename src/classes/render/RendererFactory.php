<?php

namespace iutnc\deefy\render;

use iutnc\deefy\audio\lists\AudioList;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;

class RendererFactory {
    public static function getRenderer(AudioTrack|AudioList $track): Renderer {
        return match (true) {
            $track instanceof PodcastTrack => new PodcastTrackRenderer($track),
            $track instanceof AlbumTrack => new AlbumTrackRenderer($track),
            $track instanceof AudioList => new AudioListRenderer($track)
        };
    }
}