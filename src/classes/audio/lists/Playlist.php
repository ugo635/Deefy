<?php

namespace iutnc\deefy\audio\lists;

use iutnc\deefy\audio\tracks\AudioTrack;

class Playlist extends AudioList {
    public function ajouterPiste(AudioTrack $piste): void {
        $this->pistes[] = $piste;
        $this->nbPiste++;
        $this->duree += $piste->duree;
    }

    public function supprimerPiste(int $indice): void {
        $piste = $this->pistes[$indice];
        unset($this->pistes[$indice]);
        $this->pistes = array_values($this->pistes);
        $this->nbPiste--;
        $this->duree -= $piste->duree;
    }

    public function ajouterPistes(array $pistes): void {
        foreach ($pistes as $piste) {
            if (!in_array($piste, $this->pistes, true)) {
                $this->ajouterPiste($piste);
            }
        }
    }
}