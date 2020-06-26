<!DOCTYPE html>
<html lang="en">

{include file="{$workspace_dir}/modules/product/assets/resources.tpl"}
<head>
    {$smarty.capture.meta}
    <title>{$title}</title>
    {$meta}
    {*    <title>{$smarty.capture.title}</title>*}
    {$smarty.capture.css}
    {$smarty.capture.js_head}
    {$jsHead}
</head>
<body>
<header>
    <div class="container">
        <div class="header_nav">
            <div class="header_logo">
                <a href="" class="header_logo__title">ЛЮБИМЫЙ</a>
                <a href="" class="header_logo__subtitle">сеть магазинов</a>
            </div>
            <div class="header_cart">
                <div class="minicart">
                    <a href=""><img src="/resources/img/cart.svg" alt=""></a>
                    <p>0</p>
                </div>
            </div>
        </div>
    </div>
</header>

{$content}

<footer>
    <div class="container">
        <div class="footer_copyright">© 2020 loved.ru</div>
    </div>
</footer>


{$smarty.capture.js_body}
{$jsEndBody}
</body>
</html>