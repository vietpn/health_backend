<li class="{{ Request::is('profiles*') ? 'active' : '' }}">
    <a href="{!! route('backend.profiles.index') !!}"><i class="fa fa-user"></i><span>Khác hàng</span></a>
</li>

<li class="{{ Request::is('products*') ? 'active' : '' }}">
    <a href="{!! route('backend.products.index') !!}"><i class="fa fa-edit"></i><span>Sản phẩm</span></a>
</li>

<li class="{{ Request::is('orders*') ? 'active' : '' }}">
    <a href="{!! route('backend.orders.index') !!}"><i class="fa fa-shopping-cart"></i><span>Đơn hàng</span></a>
</li>

</li><li class="{{ Request::is('promotions*') ? 'active' : '' }}">
    <a href="{!! route('backend.promotions.index') !!}"><i class="fa fa-gift"></i><span>Khuyến Mại</span></a>
</li>

<li class="{{ Request::is('feedback*') ? 'active' : '' }}">
    <a href="{!! route('backend.feedback.index') !!}"><i class="fa fa-commenting"></i><span>Phẩn hồi</span></a>
</li>

<li class="{{ Request::is('notifications*') ? 'active' : '' }}">
    <a href="{!! route('backend.notifications.index') !!}"><i class="fa fa-bell"></i><span>Thông báo</span></a>
</li>

