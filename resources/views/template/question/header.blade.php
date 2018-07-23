<div class="container">
    <div class="header">
        <div class="header__logo"><a class="logotype" href="{!! route('main') !!}"></a></div>
        <div class="header__menu">
            @if(!Auth::user())
                <a class="menu_items" href="{!! route('loginUser') !!}">Login</a>
            @else
                <a class="menu_items" href="{!! route('logoutUser') !!}">Logout</a>
            @endif
        </div>
    </div>
</div>