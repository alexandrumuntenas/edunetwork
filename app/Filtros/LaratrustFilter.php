<?php

namespace App\Filtros;

use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;
use Laratrust\Laratrust;
use Illuminate\Support\Facades\Auth;

class LaratrustFilter implements FilterInterface
{
    public function transform($item)
    {
        $user = Auth::user();

        if (isset($item['role']) && !$user->hasRole($item['role'])) {
            $item['restricted'] = true;
        }

        return $item;
    }
}
