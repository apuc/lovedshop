{core\App::$breadcrumbs->addItem(['text' => 'Create'])}

<div class="container">

    {if !empty($errors)}
        {foreach from=$errors item=error}
            <div class="alert alert-danger" role="alert">
                {$error}
            </div>
        {/foreach}
    {/if}
<section class="top_nav">
    <div class="container">
        <div class="breadcrumbs">
            <a href="">Главная</a>
        </div>
        <div class="top_nav__title">
            <h1>Оформление заказа</h1>
        </div>
    </div>
</section>

<section class="order">
    <div class="container">
        <form  name="create_form" id="create_form" method="post" action="/testfront/order/{$product[0]->id}" class="order_form">
            <div class="order_form__left">
                <div class="order_info">
                    <div class="order_info__item">
                        <div class="order_info__title">Личные данные</div>
                        <p>Введите ФИО</p>
                        <input type="text" name="fio" id="fio" required="required"/>
                        <p>Email</p>
                        <input type="text" name="email" id="email" required="required"/>
                        <p>Номер телефона</p>
                        <input type="text" name="phone" id="phone" required="required"/>
                        <p>Город</p>
                        <input type="text" name="city" id="city" required="required"/>
                        <p>Адрес</p>
                        <input type="text" name="address" id="address" class="form-control" required="required"/>
                        <p>Комментарий к заказу</p>
                        <textarea type="text" name="comment" id="comment" required="required"></textarea>
                        <p>Колиество товара</p>
                        <input type="number" name="quantity" id="quantity" required="required"/>
                    </div>
                    <div class="order_info__item">
                        <div class="order_info__title">Дата и время получения</div>
                        <p>Укажите дату</p>
                        <input type="date" name="delivery_date" id="delivery_date" required="required"/>
                        <p>Укажите время</p>
                        <input type="text" name="delivery_time" id="delivery_time" required="required"/>
                    </div>
                </div>
            </div>
            <div class="order_form__right">
                <div class="cart_total">
                    <p>Товары</p>
                    <div class="cart_total__price">{$product->vp->first()->price} &#8381;</div>
                    <p>Доставка</p>
                    <div class="cart_total__price">250 &#8381;</div>
                    <p>Итого</p>
                    <div class="cart_total__price">{$product->vp->first()->price + 250} &#8381;</div>
                    <div class="order_payment">
                        <p>Способ оплаты</p>
                        <input type="radio" name="pay" value="0" id="pay1">
                        <label for="pay1">Оплата картой на сайте</label>
                        <input type="radio" name="pay" value="1" id="pay2">
                        <label for="pay2">Оплата при получениие</label>
                    </div>
                    <button type="submit" name="submit" id="submit_button" class="add_to_cart" value="Submit">Оформить заказ</button>
                </div>
            </div>
        </form>
    </div>
</section>