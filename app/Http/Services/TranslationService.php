<?php

namespace App\Http\Services;

use Google\Cloud\Translate\V2\TranslateClient;

class TranslationService
{
    /**
     * instance of Google\Cloud\Translate\V2\TranslateClient
     */
    private $translationClient;

    /**
     * TranslationService constructor.
     */
    public function __construct()
    {
        $this->translationClient = new TranslateClient(['key' => env('GOOGLE_TRANSLATE_API_KEY')]);
    }

    /**
     * @return TranslateClient
     */
    public function getInstance()
    {
        return $this->translationClient;
    }
}