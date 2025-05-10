<?php namespace App\Http\Controllers\Api\V1\User;

use App\Interfaces\Services\TranslationServiceInterface;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\TranslationStoreRequest;
use App\Http\Requests\TranslationUpdateRequest;

class TranslationController extends Controller
{
    public function __construct(protected TranslationServiceInterface $translationService)
    {
    }
    public function index(Request $request)
    {
            $translations=$this->translationService->index($request);
        return $this->success($translations, __('message.translation.show_success'));
    }


   
}
