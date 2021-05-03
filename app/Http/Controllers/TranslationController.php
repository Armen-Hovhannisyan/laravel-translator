<?php

namespace App\Http\Controllers;

use App\Http\Requests\TranslationRequest;
use App\Repositories\TranslationRepoInterface;
use Illuminate\Http\JsonResponse;

class TranslationController extends Controller
{
    /**
     * instance of TranslationRepo
     */
    private $translationRepo;

    /**
     * TranslationController constructor.
     */
    public function __construct(TranslationRepoInterface $translationRepo)
    {
        $this->translationRepo = $translationRepo;
    }


    /**
     * @param TranslationRequest $request
     * @return JsonResponse
     */
    public function translate(TranslationRequest $request) :JsonResponse
    {
        $text = $request->text;
        $response = $this->translationRepo->translate($text);
        if(isset($response['error'])) return $this->response(['success' => false, 'error' => $response['error']], 422);
        return $this->response($response, 200);
    }
}
