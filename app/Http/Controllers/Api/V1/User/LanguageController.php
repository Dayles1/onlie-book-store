<?php
namespace App\Http\Controllers\Api\V1\User;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LanguageResorce;
use App\Http\Requests\LanguageStoreRequest;
use App\Http\Requests\LanguageUpdateRequest;
use App\Interfaces\Services\LanguageServiceInterface;

class LanguageController extends Controller
{
     public function __construct(protected LanguageServiceInterface $languageService)
    {
    }
    public function index()
    {
      $languages = $this->languageService->index();
      return $this->success(  LanguageResorce::collection($languages), __('message.lang.show_success'));
    }
    public function show($id)
    {
        $language=$this->languageService->show($id);
        return $this->success(new LanguageResorce($language), __('message.lang.show_success'));
    }
   
}
