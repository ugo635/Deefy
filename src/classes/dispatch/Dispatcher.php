<?php

namespace iutnc\deefy\dispatch;

use iutnc\deefy\action\AddPlaylistAction;
use iutnc\deefy\action\AddPodcastTrackAction;
use iutnc\deefy\action\DefaultAction;
use iutnc\deefy\action\DisplayPlaylistAction;

class Dispatcher {
    private ?string $action = null;

    public function __construct() {
        $this->action = $_GET["action"] ?? "default";
    }

    public function run(): void {
        $act = match ($this->action) {
            "add-playlist" => new AddPlaylistAction(),
            "add-track" => new AddPodcastTrackAction(),
            "DisplayPlaylistAction" => new DisplayPlaylistAction(),
            default => new DefaultAction()
        };

        $html = <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <title>Deefy</title>
            </head>
            <body>
        HTML;

        $this->renderPage($html);
        $this->renderPage($act()); // Appel __invoke() de Action
        $this->renderPage("</body></html>");
    }

    private function renderPage(string $html) {
        echo $html;
    }
}