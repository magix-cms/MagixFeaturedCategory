CREATE TABLE IF NOT EXISTS `mc_plug_featured_category` (
    `id_cat` int UNSIGNED NOT NULL,
    `position` int UNSIGNED NOT NULL DEFAULT '0',
PRIMARY KEY (`id_cat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;