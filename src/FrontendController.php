<?php
declare(strict_types=1);

namespace Plugins\MagixFeaturedCategory\src;

use Plugins\MagixFeaturedCategory\db\FeaturedCategoryFrontDb;
use App\Frontend\Db\CategoryDb;
use App\Frontend\Model\CategoryPresenter;
use Magepattern\Component\Tool\SmartyTool;

class FrontendController
{
    public static function renderWidget(array $params = []): string
    {
        // 🟢 1. SÉCURITÉ / AIGUILLAGE
        $hookName = $params['name'] ?? '';
        if (!str_starts_with($hookName, 'displayHome')) {
            return ''; // S'il n'est pas sur la page d'accueil, on bloque l'affichage
        }

        // 🟢 2. TRAITEMENT NORMAL
        try {
            $currentLang = $params['current_lang'] ?? ['id_lang' => 1, 'iso_lang' => 'fr'];
            $idLang      = (int)$currentLang['id_lang'];
            $siteUrl     = $params['site_url'] ?? 'http://localhost';
            $companyInfo = $params['companyData'] ?? [];
            $skinFolder  = $params['mc_settings']['theme']['value'] ?? 'default';

            $featuredDb = new FeaturedCategoryFrontDb();
            $catIds = $featuredDb->getFeaturedCategoryIds();

            if (empty($catIds)) return '';

            $categoryDb = new CategoryDb();
            $rawCategories = $categoryDb->getCategoriesByIds($catIds, $idLang);

            if (empty($rawCategories)) return '';

            $formattedCategories = [];
            foreach ($rawCategories as $row) {
                $formatted = CategoryPresenter::format($row, $currentLang, $siteUrl, $companyInfo, $skinFolder);
                if ($formatted) {
                    $formattedCategories[] = $formatted;
                }
            }

            $view = SmartyTool::getInstance('front');
            $view->assign('featured_categories', $formattedCategories);

            $templatePath = ROOT_DIR . 'plugins/MagixFeaturedCategory/views/front/widget.tpl';

            if (!file_exists($templatePath)) {
                throw new \Exception("Le fichier template widget.tpl est introuvable.");
            }

            return $view->fetch($templatePath);

        } catch (\Throwable $e) {
            return '';
        }
    }
}