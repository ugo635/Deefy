<?php

namespace iutnc\deefy\render;

use iutnc\deefy\audio\tracks\PodcastTrack;

class PodcastTrackRenderer extends AudioTrackRenderer {
    public function __construct(PodcastTrack $track) {
        parent::__construct($track);
    }

    protected function renderCompact(): string {
        return "<div>
                    <strong>
                        {$this->track->titre}
                    </strong>
                    - {$this->track->auteur}
                </div>";
    }

    protected function renderLong(): string {
        return "<div>
                    <strong>{$this->track->titre}</strong>
                    <p>Artiste : {$this->track->auteur}</p>
                    <p>Durée : {$this->track->duree} secondes</p>
                    <audio controls src=\"{$this->track->nomFichierAudio}\"></audio>
                </div>";
    }
}