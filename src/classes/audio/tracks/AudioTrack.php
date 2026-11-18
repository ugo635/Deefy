<?php

namespace iutnc\deefy\audio\tracks;

use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\exception\InvalidPropertyValueException;

class AudioTrack {
    protected ?string $genre = null;
    protected ?int $duree = null;

    public function __construct(
        private string $titre,
        private string $nomFichierAudio
    ) {}

    public function __get(string $attr) : mixed {
        if (property_exists ($this, $attr)) return $this->$attr;

        throw new InvalidPropertyNameException("$attr: Invalid Property");
    }

    /**
     * @throws InvalidPropertyValueException
     * @throws InvalidPropertyNameException
     */
    public function __set(string $attr, mixed $value): void {
        if (property_exists($this, $attr)) {
            if ($attr == "duree" && $value < 90) throw new InvalidPropertyValueException("");

            $this->$attr = $value;
        } else {
            throw new InvalidPropertyNameException("$attr: Invalid Property");
        }
    }
}