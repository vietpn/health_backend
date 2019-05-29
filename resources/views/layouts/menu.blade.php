<li class="{{ Request::is('profiles*') ? 'active' : '' }}">
    <a href="{!! route('backend.profiles.index') !!}"><i class="fa fa-edit"></i><span>Profiles</span></a>
</li>

</li><li class="{{ Request::is('promotions*') ? 'active' : '' }}">
    <a href="{!! route('backend.promotions.index') !!}"><i class="fa fa-edit"></i><span>Khuyến Mại</span></a>
</li>

