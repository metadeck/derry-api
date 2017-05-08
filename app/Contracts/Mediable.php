<?php

namespace App\Contracts;


interface Mediable
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function manyMedia();

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function oneMedia();
}