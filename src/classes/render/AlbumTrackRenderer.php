<?php

namespace iutnc\deefy\render;

use iutnc\deefy\audio\tracks\AlbumTrack;

class AlbumTrackRenderer extends AudioTrackRenderer {
    public function __construct(AlbumTrack $track) {
        parent::__construct($track);
    }

    protected function renderCompact(): string {
        return "<div>
                    <strong>
                        {$this->track->titre}
                    </strong>
                    <audio controls src=\"{$this->track->nomFichierAudio}\"></audio>
                </div>";
    }

    protected function renderLong(): string {
        return "<div>
                    <h2>{$this->track->titre}</h2>
                    <p>Artiste : {$this->track->artiste}</p>
                    <p>Album : {$this->track->nomAlbum}</p>
                    <p>Année : {$this->track->annee}</p>
                    <p>Genre : {$this->track->genre}</p>
                    <p>Durée : {$this->track->duree} secondes</p>
                    <p>Piste : {$this->track->numeroPiste}</p>
                    <audio controls src=\"{$this->track->nomFichierAudio}\"></audio>
                </div>";
    }
}