<?php

namespace App\Observers;

use App\models\MainCategory;

class maincatObserver
{
    /**
     * Handle the main category "created" event.
     *
     * @param  \App\models\MainCategory  $mainCategory
     * @return void
     */
    public function created(MainCategory $mainCategory)
    {
        //
    }

    /**
     * Handle the main category "updated" event.
     *
     * @param  \App\models\MainCategory  $mainCategory
     * @return void
     */
    public function updated(MainCategory $mainCategory)
    {
        $mainCategory->vendors()->update([ 'active' => $mainCategory->active ]);
    }

    /**
     * Handle the main category "deleted" event.
     *
     * @param  \App\models\MainCategory  $mainCategory
     * @return void
     */
    public function deleted(MainCategory $mainCategory)
    {
        //
    }

    /**
     * Handle the main category "restored" event.
     *
     * @param  \App\models\MainCategory  $mainCategory
     * @return void
     */
    public function restored(MainCategory $mainCategory)
    {
        //
    }

    /**
     * Handle the main category "force deleted" event.
     *
     * @param  \App\models\MainCategory  $mainCategory
     * @return void
     */
    public function forceDeleted(MainCategory $mainCategory)
    {
        //
    }
}
