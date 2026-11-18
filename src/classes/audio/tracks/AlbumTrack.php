<?php

namespace iutnc\deefy\audio\tracks;

use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\exception\InvalidPropertyValueException;
class AlbumTrack extends AudioTrack {
    private ?string $artiste = null;
    private ?int $annee = null;

    public function __construct(
        private string $titre,
        private string $nomFichierAudio,
        private string $nomAlbum,
        private int $numeroPiste
    ) {
        parent::__construct($titre, $nomFichierAudio);
    }

    /**
     * @throws InvalidPropertyValueException
     * @throws InvalidPropertyNameException
     */
    public function __set(string $attr, mixed $value): void {
        if (property_exists($this, $attr)) {
            if ($attr == "duree" && $value < 90) throw new InvalidPropertyValueException("Invalid Property Value: $value\n");

            $this->$attr = $value;
        } else {
            throw new InvalidPropertyNameException("$attr: Invalid Property\n");
        }
    }

    public function __get(string $attr) : mixed {
        if (property_exists ($this, $attr)) return $this->$attr;

        throw new InvalidPropertyNameException("$attr: Invalid Property");
    }

    public function __toString(): string {
        return json_encode(get_object_vars($this));
    }
}