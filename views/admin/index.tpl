{extends file="layout.tpl"}

{block name='head:title'}Catégories en page d'accueil{/block}

{block name='article'}
    <div class="row">
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-search"></i> Ajouter une catégorie</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3 position-relative">
                        <label class="form-label text-muted small">Rechercher par nom</label>
                        <input type="text" id="ajaxSearchInput" class="form-control" placeholder="Taper au moins 2 caractères..." autocomplete="off">
                        <div id="ajaxSearchResults" class="list-group position-absolute w-100 shadow mt-1" style="z-index: 1050; display: none; max-height: 250px; overflow-y: auto;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="bi bi-folder-star text-warning"></i> Catégories en page d'accueil</h5>
                    <span class="badge bg-primary" id="countSelected">{$selected_categories|count}</span>
                </div>
                <div class="card-body">
                    <form method="post" action="index.php?controller=MagixFeaturedCategory">
                        <input type="hidden" name="hashtoken" value="{$hashtoken}">
                        <div class="alert alert-info py-2 small">
                            <i class="bi bi-info-circle me-1"></i> Utilisez les flèches pour modifier l'ordre d'affichage.
                        </div>
                        <ul class="list-group mb-4" id="selectedCategoryList">
                            {foreach $selected_categories as $c}
                                <li class="list-group-item d-flex justify-content-between align-items-center bg-light border-bottom cursor-move" data-id="{$c.id_cat}">
                                    <input type="hidden" name="featured_category[]" value="{$c.id_cat}">
                                    <div class="d-flex align-items-center w-100">
                                        <i class="bi bi-grip-vertical text-muted me-3 fs-5"></i>
                                        <div>
                                            <strong class="d-block text-dark">{$c.name_cat}</strong>
                                            <small class="text-muted">{$c.url_cat|default:'/'}</small>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove ms-2" title="Retirer"><i class="bi bi-x-lg"></i></button>
                                </li>
                            {/foreach}
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
{/block}

{block name="javascripts" append}
    <script src="templates/js/MagixItemSelector.min.js?v={$smarty.now}"></script>
    <script>
        {literal}
        document.addEventListener('DOMContentLoaded', function() {
            const token = document.querySelector('input[name="hashtoken"]').value;

            new MagixItemSelector({
                searchInputId: 'ajaxSearchInput',
                searchResultsId: 'ajaxSearchResults',
                selectedListId: 'selectedCategoryList',
                countBadgeId: 'countSelected',
                searchUrl: 'index.php?controller=MagixFeaturedCategory&action=search&q=',
                saveUrl: 'index.php?controller=MagixFeaturedCategory',
                inputName: 'featured_category[]',
                token: token,

                renderResultItem: (item) => `<strong>${item.name_cat}</strong>`,

                renderAddedItem: (item) => `
                    <div class="d-flex align-items-center w-100">
                        <i class="bi bi-grip-vertical text-muted me-3 fs-5 cursor-move"></i>
                        <div>
                            <strong class="d-block text-dark">${item.name_cat}</strong>
                            <small class="text-muted">Nouvelle catégorie ajoutée</small>
                        </div>
                    </div>
                `
            });
        });
        {/literal}
    </script>
{/block}