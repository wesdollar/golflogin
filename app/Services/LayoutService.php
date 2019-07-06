<?php

namespace App\Services;

class LayoutService {

    public static function mainNavItems() {

        $items = [
            [
                'title' => 'Dashboard',
                'route' => 'dashboard',
                'icon' => 'dashboard',
            ],
            [
                'title' => 'Add Round',
                'route' => 'rounds.createGui',
                'icon' => 'compass',
            ],
            [
                'title' => 'Groups',
                'route' => 'dashboard',
                'icon' => 'users',
                'subNav' => [
                    [
                        'route' => 'groups.switch',
                        'title' => 'Switch Groups',
                        'icon' => 'superpowers',
                    ],
                    [
                        'route' => 'groups.createGui',
                        'title' => 'Create Group',
                        'icon' => 'plus',
                    ],
                ],
            ],
            [
                'title' => 'Add Course',
                'route' => 'courses.createGui',
                'icon' => 'compass',
            ],

        ];

        return $items;
    }

    public static function printHref($route = false) {

        if ($route === false) {

            return '#';
        }
        else {

            return route($route);
        }
    }
}