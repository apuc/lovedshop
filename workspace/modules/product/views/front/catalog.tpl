<section class="top_nav">
    <div class="container">
        <div class="breadcrumbs">
            <a href="">Каталог</a>
            <a href="">Бытовая химия</a>
            <a href="">Чистящие средства</a>
        </div>
        <div class="top_nav__title">
            <h1>Чистящие средства</h1>
        </div>
    </div>
</section>

<section class="main_catalog">
    <div class="container">
        <div class="main_catalog__block">
            <div class="main_catalog__block-left">
                <div class="filter_nav">
                    <a href="">Бытовая химия</a>
                    <a href="">Чистящие средства</a>
                    <ul>
                        <li><a href="">Средства для бытовой техники</a></li>
                        <li><a href="">Средства для ванны и туалета</a></li>
                        <li><a href="">Средства для ковров и мебели</a></li>
                        <li><a href="">Средства для кухни</a></li>
                        <li><a href="">Средства для посуды</a></li>
                        <li><a href="">Средства для стекол и зеркал</a></li>
                        <li><a href="">Универсальные средства</a></li>
                    </ul>
                </div>
            </div>
            <div class="main_catalog__block-right">
                <div class="main_catalog__items">
                    {foreach from=$model item=mode}
                    <div class="main_catalog__items-item">
                        <div class="main_catalog__items-item_img">
                            <a href="/testfront/oneproduct/{$mode->id}">
                                <img src="/{$mode->photo->first()->photo}" alt="">
                            </a>
                        </div>
                        <div class="main_catalog__items-item_title">
                            <a href="/testfront/oneproduct/{$mode->id}">{$mode->name}</a>
                        </div>
                        <div class="main_catalog__items-item_price">{$mode->vp->first()->price} &#8381;</div>
                        <div class="main_catalog__items-item_tocart">
                            <a href="/testfront/order/{$mode->id}"><img src="/resources/img/cart.svg" alt=""></a>
                        </div>
                    </div>
                    {/foreach}
                </div>
                <div class="pagination">
                    {$pagination::widget()->setParams('/catalog/', count($all), $options['pagination'], $page)->run()}
                </div>
            </div>
        </div>
    </div>
</section>
