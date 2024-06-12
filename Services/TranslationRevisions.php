<?php

namespace Modules\Translation\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Modules\Translation\Repositories\TranslationRepository;

class TranslationRevisions
{
    /**
     * @var TranslationRepository
     */
    private $translation;

    public function __construct(TranslationRepository $translation)
    {
        $this->translation = $translation;
    }

    /**
     * Get revisions for the given key and locale.
     */
    public function get($key, $locale)
    {
        $translation = $this->translation->findTranslationByKey($key);
        $translation = $translation->translate($locale);

        if ($translation === null) {
            return response()->json(['<tr><td>'.trans('translation::translations.No Revisions yet').'</td></tr>']);
        }

        return response()->json(
            $this->formatRevisionHistory(
                $translation->revisionHistory->reverse()
            )
        );
    }

    /**
     * Format revision history.
     */
    private function formatRevisionHistory(Collection $revisionHistory)
    {
        return $revisionHistory->reduce(function ($formattedHistory, $history) {
            $formattedHistory[] = view('translation::admin.translations.partials.revision', compact('history'))->render();

            return $formattedHistory;
        });
    }
}
