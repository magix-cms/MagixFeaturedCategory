<?php
declare(strict_types=1);

namespace Plugins\MagixFeaturedCategory\db;

use App\Backend\Db\BaseDb;
use Magepattern\Component\Database\QueryBuilder;

class FeaturedCategoryAdminDb extends BaseDb
{
    public function searchActiveCategories(string $term, int $idLang): array
    {
        $qb = new QueryBuilder();
        $qb->select(['c.id_cat', 'cc.name_cat'])
            ->from('mc_catalog_cat', 'c')
            ->join('mc_catalog_cat_content', 'cc', 'c.id_cat = cc.id_cat')
            ->where('cc.id_lang = :lang', ['lang' => $idLang])
            ->where('cc.published_cat = 1')
            ->where('cc.name_cat LIKE :term', ['term' => '%' . $term . '%'])
            ->limit(10);

        return $this->executeAll($qb) ?: [];
    }

    public function getSelectedCategoriesFull(int $idLang): array
    {
        $qb = new QueryBuilder();
        $qb->select(['c.id_cat', 'cc.name_cat', 'cc.url_cat', 'feat.position'])
            ->from('mc_plug_featured_category', 'feat')
            ->join('mc_catalog_cat', 'c', 'feat.id_cat = c.id_cat')
            ->join('mc_catalog_cat_content', 'cc', 'c.id_cat = cc.id_cat AND cc.id_lang = ' . $idLang)
            ->where('cc.published_cat = 1')
            ->orderBy('feat.position', 'ASC');

        return $this->executeAll($qb) ?: [];
    }

    public function saveFeaturedCategories(array $catIds): bool
    {
        $this->executeRawSql('TRUNCATE TABLE mc_plug_featured_category');
        if (empty($catIds)) return true;

        foreach ($catIds as $index => $id) {
            $qb = new QueryBuilder();
            $qb->insert('mc_plug_featured_category', [
                'id_cat'   => (int)$id,
                'position' => $index
            ]);
            $this->executeInsert($qb);
        }
        return true;
    }
}