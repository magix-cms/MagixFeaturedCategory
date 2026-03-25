<?php
declare(strict_types=1);

namespace Plugins\MagixFeaturedCategory\db;

use App\Frontend\Db\BaseDb;
use Magepattern\Component\Database\QueryBuilder;

class FeaturedCategoryFrontDb extends BaseDb
{
    public function getFeaturedCategoryIds(): array
    {
        $qb = new QueryBuilder();
        $qb->select('id_cat')
            ->from('mc_plug_featured_category')
            ->orderBy('position', 'ASC');

        $results = $this->executeAll($qb);

        if (empty($results)) return [];
        return array_column($results, 'id_cat');
    }
}