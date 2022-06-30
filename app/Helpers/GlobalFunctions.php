<?php

use Illuminate\Support\Facades\View;


    function sidebar_active()
    {
        $route = Route::current()->getName();
        return $route;
    }

    function active_nav($value) {
        $url = URL::current();

        if (str_contains($url, $value)) {
            return 'active';
        } else {
            return '';
        }
    }

