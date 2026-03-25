<?php
declare(strict_types=1);

namespace Plugins\MagixFeaturedCategory\src;

use App\Backend\Controller\BaseController;
use Plugins\MagixFeaturedCategory\db\FeaturedCategoryAdminDb;
use Magepattern\Component\HTTP\Request;

class BackendController extends BaseController
{
    public function run(): void
    {
        $db = new FeaturedCategoryAdminDb();
        $idLang = (int)($this->defaultLang['id_lang'] ?? 1);

        if (isset($_GET['action']) && $_GET['action'] === 'search') {
            $term = $_GET['q'] ?? '';
            if (strlen($term) > 1) {
                echo json_encode($db->searchActiveCategories($term, $idLang));
            } else {
                echo json_encode([]);
            }
            exit;
        }

        if (Request::isMethod('POST')) {
            $token = $_POST['hashtoken'] ?? '';
            if (!$this->session->validateToken($token)) {
                $this->jsonResponse(false, 'Session expirée.');
            }

            $selectedIds = $_POST['featured_category'] ?? [];
            if ($db->saveFeaturedCategories($selectedIds)) {
                $this->jsonResponse(true, 'Catégories mises en avant sauvegardées.');
            } else {
                $this->jsonResponse(false, 'Erreur de sauvegarde.');
            }
            return;
        }

        $this->view->assign([
            'selected_categories' => $db->getSelectedCategoriesFull($idLang),
            'hashtoken'           => $this->session->getToken()
        ]);

        $this->view->display('index.tpl');
    }
}