<div class="magix-featured-category-widget py-5 py-5 bg-body-tertiary">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold">{#featured_category_title#|default:'Catégories à la une'}</h2>
        {include file="catalog/loop/category-grid.tpl" data=$featured_categories classType="normal"}
    </div>
</div>