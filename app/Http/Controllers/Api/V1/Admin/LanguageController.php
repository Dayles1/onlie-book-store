<?php
namespace App\Http\Controllers\Api\V1\Admin;

use App\Interfaces\Services\LanguageServiceInterface;
use App\Models\Language;
use App\Services\LanguageService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Http\Resources\LanguageResorce;
use App\Http\Requests\LanguageStoreRequest;
use App\Http\Requests\LanguageUpdateRequest;

class LanguageController extends Controller
{
    public function __construct(protected LanguageServiceInterface $languageService)
    {
    }
    public function store(LanguageStoreRequest $request)
    {
        $language=$this->languageService->store($request->validated());
        return $this->success(new LanguageResorce($language), __('message.lang.create_success'), 201);
    }

    public function update(LanguageUpdateRequest $request, $id)
    {
        $language=$this->languageService->update($request->validated(), $id);

        return $this->success(new LanguageResorce($language), __('message.lang.update_success'));
    }

    public function destroy($id)
    {
        $language= $this->languageService->destroy($id);
        if($language['status']== 'success'){
            return $this->success([], __('message.lang.delete_success'));
        }
    }
}
