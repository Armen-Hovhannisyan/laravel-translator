<?php

namespace App\Repositories;

use App\Http\Services\TranslationService;
use Exception;

class TranslationRepo implements TranslationRepoInterface{

    private $translationService;

    /**
     * TranslationRepo constructor.
     */
    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService->getInstance();
    }


    /**
     * @param string $text
     * @return array
     */
    public function translate(string $text) :array
    {
        try{
            $translation = $this->translationService->translate($text);
        }
        catch (Exception $e)
        {
            return ['error' => 'Unable to connect to Google API'];
        }

        return ['translation' => $translation['text']];
    }
}
