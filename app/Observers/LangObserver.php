<?php

namespace App\Observers;

use App\Models\Language;
use Illuminate\Support\Facades\Lang;

class LangObserver
{
    /**
     * Handle the Language "created" event.
     *
     * @param  \App\Models\Language  $language
     * @return void
     */
    public function created(Language $language)
    {
        try {
            if ($language->active)
                copy(base_path('lang/temp.json'), base_path('lang/' . $language->prefix . '.json'));
        } catch (\Exception $ex) {
            toastr()->error($ex->getMessage());
        }
    }

    /**
     * Handle the Language "updated" event.
     *
     * @param  \App\Models\Language  $language
     * @return void
     */
    public function updated(Language $language)
    {

        try {
            if ($language->active)
                copy(base_path('lang/temp.json'), base_path('lang/' . $language->prefix . '.json'));

            if ($language->default)
                Language::withoutEvents(function () use ($language) {
                    Language::where('id', '!=', $language->id)->update(['default' => false]);
                });
        } catch (\Exception $ex) {

            toastr()->error($ex->getMessage());
        }
    }

    /**
     * Handle the Language "deleted" event.
     *
     * @param  \App\Models\Language  $language
     * @return void
     */
    public function deleted(Language $language)
    {
        try {
            unlink(base_path('lang/' . $language->prefix . '.json'));
        } catch (\Exception $ex) {
            toastr()->error($ex->getMessage());
        }
    }

    /**
     * Handle the Language "restored" event.
     *
     * @param  \App\Models\Language  $language
     * @return void
     */
    public function restored(Language $language)
    {
        //
    }

    /**
     * Handle the Language "force deleted" event.
     *
     * @param  \App\Models\Language  $language
     * @return void
     */
    public function forceDeleted(Language $language)
    {
        //
    }
}
