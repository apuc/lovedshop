<section class="cart">
    <div class="container">
        <form action="" class="cart_form">
            <div class="cart_form__left">
                <div class="cart_form__delivery">
                    <p>Способ получения</p>
                    <div class="cart_form__delivery-item">
                        <select name="" id="">
                            <option value="">Самовывоз</option>
                        </select>
                    </div>
                    <div class="cart_form__delivery-item">
                        <select name="" id="">
                            <option value="">Высокий - Ленина 26/1</option>
                        </select>
                    </div>
                </div>
                <div class="cart_form__items">
                    <div class="cart_form__items-item">
                        <div class="cart_item__img">
                            <img src="/{$model->photo->first()->photo}" alt="">
                        </div>
                        <div class="cart_item__info">
                            <div class="cart_item__info-code">Код товара: <span>#{$model->id}</span></div>
                            <div class="cart_item__info-title"><a href="">{$model->name}</a></div>
                            <a href="/catalog" class="cart_item__info-delete">Удалить</a>
                        </div>
                        <div class="cart_item__prices">
                            <div class="cart_item__prices-price">
                                {if isset($model->vp->first())}
                                    {$model->vp->first()->price}
                                {else}
                                    100
                                {/if}
                                &#8381;</div>
                            <div class="cart_item__prices-forone">1 шт - <span>
                                    {if isset($model->vp->first())}
                                        {$model->vp->first()->price}
                                    {else}
                                        100
                                    {/if}
                                    &#8381;</span></div>
                        </div>
                        <div class="cart_item__count">
                            <div class="cart_item__count-calc">
                                <button class="card_item__minus"><img src="img/minus.svg" alt=""></button>
                                <input type="text" value="6">
                                <button class="card_item__plus"><img src="img/plus.svg" alt=""></button>
                            </div>
                            <div class="card_item__available">Доступно: <span>
                                    {if isset($model->vp->first())}
                                        {$model->vp->first()->balance}
                                    {else}
                                        4
                                    {/if}
                                </span></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cart_form__right">
                <div class="cart_total">
                    <p>Товары</p>
                    <div class="cart_total__price">
                        {if isset($model->vp->first())}
                            {$model->vp->first()->price}
                        {else}
                            100
                        {/if}
                        &#8381;</div>
                    <p>Доставка</p>
                    <div class="cart_total__price">250 &#8381;</div>
                    <p>Итого</p>
                    <div class="cart_total__price">
                        {if isset($model->vp->first())}
                            {$model->vp->first()->price + 250}
                        {else}
                            350
                        {/if}
                        &#8381;</div>
                    <button class="add_to_cart"><a href="/testfront/order/{$model->id}">Оформить заказ</a>></button>
                </div>
                <a href="/catalog" class="clear_cart">Очистить корзину</a>
            </div>
        </form>
    </div>
</section>
