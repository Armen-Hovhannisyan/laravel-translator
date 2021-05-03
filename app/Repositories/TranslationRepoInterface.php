<?php

namespace App\Repositories;

interface TranslationRepoInterface{

    /**
     * @param string $text
     * @return array
     */
    public function translate(string $text) :array;
}