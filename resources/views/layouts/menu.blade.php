<li class="{!! \App\Define\Systems::getActiveMenu(Request::url(), ['configs']) !!}">
    <a href="{!! route('backend.configs.index') !!}"><i class="fa fa-cogs"></i><span>Configs</span></a>
</li><li class="{{ Request::is('promotions*') ? 'active' : '' }}">
    <a href="{!! route('backend.promotions.index') !!}"><i class="fa fa-edit"></i><span>Khuyến Mại</span></a>
</li>

