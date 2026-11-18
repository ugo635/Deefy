<?php

namespace iutnc\deefy\render;

abstract class AudioTrackRenderer implements Renderer {
    protected object $track;

    public function __construct(object $track) {
        $this->track = $track;
    }

    public function render(int $selector): string {
        return match ($selector) {
            Renderer::COMPACT => $this->renderCompact(),
            Renderer::LONG => $this->renderLong(),
            default => "erreur"
        };
    }

    public function __get(string $attr) : mixed {
        if (property_exists ($this, $attr)) return $this->$attr;
        throw new \Exception("$attr: Invalid Property");
    }

    abstract protected function renderCompact(): string;

    abstract protected function renderLong(): string;
}