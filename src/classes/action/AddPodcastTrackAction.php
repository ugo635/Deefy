<?php

namespace iutnc\deefy\action;

use iutnc\deefy\action\Action;
use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\audio\tracks\AudioTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\render\Renderer;

class AddPodcastTrackAction extends Action {
    public function get(): string {
        ob_start();
        ?>

        <form method="post" action="?action=add-track" enctype="multipart/form-data">
            <fieldset>
                <legend>
                    Titre de la piste
                </legend>
                <label>
                    <input type="text" name="titre-piste" placeholder="Blinding Lights">
                </label>
            </fieldset>
            <fieldset>
                <legend>
                    Nom du fichier audio
                </legend>
                <label>
                    <input type="file" name="piste" placeholder="Upload">
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

        if (!isset($_SESSION["playlist-1"])) {
            return "<a href=\"?action=add-playlist\">Aucune playlist n'a été créée, crée-en une ici</a>";
        }

        if (!isset($_FILES["piste"])) {
            return "Aucun fichier n'a été envoyé";
        }

        if ($_FILES["piste"]["error"] !== UPLOAD_ERR_OK) {
            return "Erreur lors du téléchargement du fichier, erreur: " . $_FILES["piste"]["error"];
        }

        $titre = filter_var($_POST["titre-piste"], FILTER_SANITIZE_SPECIAL_CHARS);
        $file = $_FILES["piste"];
        $tmp = $file["tmp_name"];

        if (!is_uploaded_file($tmp)) {
            return "Le fichier n'a pas été transféré avec une requête POST";
        }

        if (strtolower(pathinfo($file["name"], PATHINFO_EXTENSION)) !== "mp3") {
            return "Le fichier n'est pas un .mp3";
        }

        if ($file["type"] !== "audio/mpeg") {
            return "Le fichier n'est pas un fichier audio";
        }

        $uploadDir = __DIR__ . "/../../../assets/audio/";

        if (!is_dir($uploadDir)) {
            return "Le dossier de destination n'existe pas "/* . $uploadDir*/;
        }

        $filename = uniqid() . ".mp3";
        $dest = $uploadDir . $filename;

        if (!move_uploaded_file($tmp, $dest)) {
            return "Erreur lors du déplacement du fichier";
        }

        $playlist = $_SESSION["playlist-1"];
        $playlist->ajouterPiste(new PodcastTrack($titre, "assets/audio/" . $filename));
        $_SESSION["playlist-1"] = $playlist;

        return "Fichier téléchargé avec succès" .
            (new AudioListRenderer($playlist))->render(Renderer::LONG) .
            "<a href='?action=add-track'>Ajouter encore une piste</a>";
    }

}