<?php

namespace iutnc\deefy\audio\lists;

class AlbumList extends AudioList {
    private string $artiste;
    private string $dateSortie;

    public function __construct(
        string $nomListe,
        array $pistes,
        string $artiste,
        string $dateSortie
    ) {
        parent::__construct($nomListe, $pistes);
        $this->artiste = $artiste;
        $this->dateSortie = $dateSortie;
    }

    public function __set(string $attr, mixed $value): void {
        if ($attr === "artiste" || $attr === "dateSortie") $this->$attr = $value;
    }
}