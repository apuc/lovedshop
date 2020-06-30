<section class="top_nav">
    <div class="container">
        <div class="breadcrumbs">
            <a href="">Каталог</a>
            <a href="">Бытовая химия</a>
            <a href="">Чистящие средства</a>
            <a href="">Средства для ванны и туалета</a>
        </div>
        <div class="top_nav__title">
            <h1>{$model->name}</h1>
        </div>
    </div>
</section>

<section class="card">
    <div class="container">
        <div class="card_block">
            <div class="card_main">
                <div class="card_main__img">
                    <img src="/{$model->photo->first()->photo}" alt="">
                </div>
                <div class="card_main__info">
                    <div class="card_main__info-code">Код товара: <span>#{$model->id}</span></div>
                    <div class="card_main__info-feature">
                        <div class="card_title">Характеристики:</div>
                        <div class="product_features">
                            <div class="product_features__item">
                                <p>С дозатором:</p>
                                <span>нет</span>
                            </div>
                            <div class="product_features__item">
                                <p>Тип:</p>
                                <span>жидкий</span>
                            </div>
                            <div class="product_features__item">
                                <p>Аромат:</p>
                                <span>лимон</span>
                            </div>
                            <div class="product_features__item">
                                <p>Для мытья в холодной воде:</p>
                                <span>да</span>
                            </div>
                        </div>
                    </div>
                    <div class="card_main__info-description">
                        <div class="card_title">Описание:</div>
                        <p>{$model->description}</p>
                    </div>
                </div>
            </div>
            <div class="card_order">
                <form action="">
                    <p>Цена:</p>
                    <div class="card_order__price">{$model->vp->first()->price} &#8381;</div>
                    <div class="card_order__calc">
                        <button class="card_order__minus"><img src="/resources/img/minus.svg" alt=""></button>
                        <input type="text" value="1">
                        <button class="card_order__plus"><img src="/resources/img/plus.svg" alt=""></button>
                    </div>
                    <button class="add_to_cart">Добавить в корзину</button>
                    <div class="card_order_available">Доступно: <span>26</span></div>
                </form>
            </div>
        </div>
    </div>
</section>