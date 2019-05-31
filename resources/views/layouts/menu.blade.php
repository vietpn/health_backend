<li class="{{ Request::is('profiles*') ? 'active' : '' }}">
    <a href="{!! route('backend.profiles.index') !!}"><i class="fa fa-edit"></i><span>Profiles</span></a>
</li>

<li class="{{ Request::is('products*') ? 'active' : '' }}">
    <a href="{!! route('backend.products.index') !!}"><i class="fa fa-edit"></i><span>Products</span></a>
</li>

<li class="{{ Request::is('orders*') ? 'active' : '' }}">
    <a href="{!! route('backend.orders.index') !!}"><i class="fa fa-edit"></i><span>Orders</span></a>
</li>

</li><li class="{{ Request::is('promotions*') ? 'active' : '' }}">
    <a href="{!! route('backend.promotions.index') !!}"><i class="fa fa-edit"></i><span>Khuyến Mại</span></a>
</li>

<li class="{{ Request::is('feedback*') ? 'active' : '' }}">
    <a href="{!! route('backend.feedback.index') !!}"><i class="fa fa-edit"></i><span>Feedback</span></a>
</li>

