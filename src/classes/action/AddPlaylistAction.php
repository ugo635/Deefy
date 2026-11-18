<?php

namespace iutnc\deefy\action;

use iutnc\deefy\action\Action;
use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\render\Renderer;

class AddPlaylistAction extends Action {
    public function get(): string {
        ob_start();
        ?>

        <form method="post" action="?action=add-playlist">
            <fieldset>
                <legend>
                    Nom de la playlist
                </legend>
                <label>
                    <input type="text" name="playlist-name" placeholder="Summer 2027">
                </label>
            </fieldset>

            <br>
            <button type="submit">Soumettre</button>
        </form>

        <?php
        return ob_get_clean();
    }

    public function post(): string {
        session_start();
        $playlist = new Playlist(filter_var($_POST["playlist-name"], FILTER_SANITIZE_SPECIAL_CHARS));
        $_SESSION["playlist-1"] = $playlist;

        return (new AudioListRenderer($playlist))->render(Renderer::LONG) .
        "<a href='?action=add-track'>Ajouter une piste</a>";
    }
}