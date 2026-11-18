<?php

namespace iutnc\deefy\audio\lists;

class AudioList implements \Iterator {
    protected int $nbPiste;
    protected int $duree;
    protected int $pos; // Pour l Iterator

    public function __construct(protected string $nomListe, protected array $pistes = []) {
        $this->nbPiste = count($this->pistes);
        $this->duree = 0;

        foreach ($pistes as $piste) {
            $this->duree += $piste->duree;
        }
    }

    public function __get(string $attr) : mixed {
        return $this->$attr;
    }

    public function rewind(): void {
        $this->pos = 0;
    }

    public function current(): mixed {
        return $this->pistes[$this->pos];
    }

    public function key(): mixed {
        return $this->pos;
    }

    public function next(): void {
        ++$this->pos;
    }

    public function valid(): bool {
        return isset($this->pistes[$this->pos]);
    }

}