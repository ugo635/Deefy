<?php

namespace iutnc\deefy\render;

use iutnc\deefy\audio\lists\AudioList;

class AudioListRenderer implements Renderer {
    private AudioList $audioList;

    public function __construct(AudioList $audioList) {
        $this->audioList = $audioList;
    }

    public function render(int $selector): string {
        $nomListe = $this->audioList->nomListe;
        $nbPiste = $this->audioList->nbPiste;
        $duree = $this->audioList->duree;

        $html = "<h2>$nomListe</h2>";

        // On utilise le fait que AudioList est un Iterator
        foreach ($this->audioList as $piste) {
            $html .= RendererFactory::getRenderer($piste)->render($selector);
        }

        $html .= "<p>$nbPiste pistes - $duree</p>";

        return $html;
    }
}