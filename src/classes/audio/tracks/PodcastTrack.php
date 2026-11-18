<?php

namespace iutnc\deefy\audio\tracks;

use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\exception\InvalidPropertyValueException;

class PodcastTrack extends AudioTrack {
    private ?string $auteur = null;
    private ?string $date = null;

    public function __construct(
        private string $titre,
        private string $nomFichierAudio
    ) {
        parent::__construct($titre, $nomFichierAudio);
    }

    public function __set(string $attr, mixed $value): void {
        if (property_exists($this, $attr)) {
            if ($attr == "duree" && $value < 90) throw new InvalidPropertyValueException("");

            $this->$attr = $value;
        } else {
            throw new InvalidPropertyNameException("$attr: Invalid Property");
        }
    }

    public function __get(string $attr) : mixed {
        if (property_exists ($this, $attr)) return $this->$attr;

        throw new InvalidPropertyNameException("$attr: Invalid Property");
    }
}