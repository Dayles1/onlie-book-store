<?php
namespace App\Services;

use App\Interfaces\Repositories\TranslationRepositoryInterface;
use App\Models\Translation;
use Illuminate\Support\Facades\Cache;
use App\Interfaces\Services\TranslationServiceInterface;

class TranslationService extends BaseService implements TranslationServiceInterface
{
    public function __construct(
        protected TranslationRepositoryInterface $translationRepository
    ) {}

    public function index($request)
    {
        $locale = $request->header('locale');

        $translations = Cache::remember("translations_{$locale}", 3600, function () use ($locale) {
            return $this->translationRepository->index($locale)->get();
        });

        return $translations;
    }

    public function store($request)
    {
        return $this->translationRepository->store($request);
    }

    public function update($request, $id)
    {
        return $this->translationRepository->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->translationRepository->destroy($id);
    }
}
