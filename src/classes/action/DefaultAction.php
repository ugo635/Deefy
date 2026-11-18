<?php

namespace iutnc\deefy\action;

class DefaultAction extends Action {
    public function get(): string {
        return "Bienvenue!";
    }

    public function post(): string {
        return "";
    }
}