<?php
declare(strict_types=1);

namespace Plugins\MagixFeaturedCategory;

use App\Component\Hook\HookManager;

class Boot
{
    public function register(): void
    {
        HookManager::register(
            'displayHomeBottom',
            'MagixFeaturedCategory',
            [\Plugins\MagixFeaturedCategory\src\FrontendController::class, 'renderWidget']
        );
    }
}