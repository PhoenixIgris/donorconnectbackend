<?php

namespace App\Observers;

use App\Models\RequestQueue;

class RequestQueueObserver
{
    /**
     * Handle the RequestQueue "created" event.
     */
    public function created(RequestQueue $requestQueue): void
    {
        //
    }

    /**
     * Handle the RequestQueue "updated" event.
     */
    public function updated(RequestQueue $requestQueue): void
    {
        if ($requestQueue->isDirty('status')) {
            $post = $requestQueue->post;
            $post->status = $requestQueue->status;
            $post->save();
            dd($post);

        }


    }

    /**
     * Handle the RequestQueue "deleted" event.
     */
    public function deleted(RequestQueue $requestQueue): void
    {
        //
    }

    /**
     * Handle the RequestQueue "restored" event.
     */
    public function restored(RequestQueue $requestQueue): void
    {
        //
    }

    /**
     * Handle the RequestQueue "force deleted" event.
     */
    public function forceDeleted(RequestQueue $requestQueue): void
    {
        //
    }
}
