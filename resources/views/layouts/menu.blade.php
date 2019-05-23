<li class="{!! \App\Define\Systems::getActiveMenu(Request::url(), ['configs']) !!}">
    <a href="{!! route('backend.configs.index') !!}"><i class="fa fa-cogs"></i><span>{!! trans('menus.configs') !!}</span></a>
</li>

<li class="{!! \App\Define\Systems::getActiveMenu(Request::url(), ['pages']) !!}">
    <a href="{!! route('backend.pages.index') !!}"><i class="fa fa-edit"></i><span>{!! trans('menus.pages') !!}</span></a>
</li>

<li class="treeview {!! \App\Define\Systems::getActiveMenu(Request::url(), ['categoryItems', 'items', 'profileItemHistories']) !!}">
    <a href="#"><i class="fa fa-shopping-cart"></i> <span>{!! trans('menus.item') !!}</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{{ \App\Define\Systems::getActiveMenu(Request::url(), ['profileItemHistories']) }}">
            <a href="{!! route('backend.profileItemHistories.index') !!}"><i class="fa fa-slideshare"></i><span>{!! trans('menus.ProfileItemHistories') !!}</span></a>
        </li>
        <li class="{{ \App\Define\Systems::getActiveMenu(Request::url(), ['categoryItems']) }}">
            <a href="{!! route('backend.categoryItems.index') !!}"><i class="fa fa-shopping-basket"></i><span>{!! trans('menus.categoryItems') !!}</span></a>
        </li>
        <li class="{{ \App\Define\Systems::getActiveMenu(Request::url(), ['items']) }}">
            <a href="{!! route('backend.items.index') !!}"><i class="fa fa-gears"></i><span>{!! trans('menus.items') !!}</span></a>
        </li>
    </ul>
</li>

<li class="{{ \App\Define\Systems::getActiveMenu(Request::url(), ['pointConfigs']) }}">
    <a href="{!! route('backend.pointConfigs.index') !!}"><i class="fa fa-gear"></i><span>{!! trans('menus.pointConfigs') !!}</span></a>
</li>

<li class="treeview {!! \App\Define\Systems::getActiveMenu(Request::url(), ['posts', 'ngWords']) !!}">
    <a href="#"><i class="fa fa-search-plus"></i> <span>{!! trans('menus.localstream') !!}</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{{ \App\Define\Systems::getActiveMenu(Request::url(), ['posts']) }}">
            <a href="{!! route('backend.posts.index') !!}"><i class="fa fa-newspaper-o"></i><span>{!! trans('menus.post') !!}</span></a>
        </li>
        <li class="{{ \App\Define\Systems::getActiveMenu(Request::url(), ['ngWords']) }}">
            <a href="{!! route('backend.ngWords.index') !!}"><i class="fa fa-file-word-o"></i><span>{!! trans('menus.ngword') !!}</span></a>
        </li>
    </ul>
</li>

<li class="{{ \App\Define\Systems::getActiveMenu(Request::url(), ['messages']) }}">
    <a href="{!! route('backend.messages.index') !!}"><i class="fa fa-wechat"></i><span>{!! trans('menus.chatMessages') !!}</span></a>
</li>

<li class="{{ \App\Define\Systems::getActiveMenu(Request::url(), ['pins']) }}">
    <a href="{!! route('backend.pins.index') !!}"><i class="fa fa-map-pin"></i><span>{!! trans('menus.pins') !!}</span></a>
</li>

<li class="{!! \App\Define\Systems::getActiveMenu(Request::url(), ['iapAndroids']) !!}">
    <a href="{!! route('backend.iapAndroids.index') !!}"><i class="fa fa-android"></i><span>{!! trans('menus.iapAndroids') !!}</span></a>
</li>

<li class="{{ \App\Define\Systems::getActiveMenu(Request::url(), ['iapIos']) }}">
    <a href="{!! route('backend.iapIos.index') !!}"><i class="fa fa-mobile"></i><span>{!! trans('menus.iapIos') !!}</span></a>
</li>

<li class="treeview {!! \App\Define\Systems::getActiveMenu(Request::url(), ['iapAndroidChargings', 'iapIosChargings']) !!}">
    <a href="#"><i class="fa fa-database"></i> <span>{!! trans('menus.report') !!}</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{{ \App\Define\Systems::getActiveMenu(Request::url(), ['iapAndroidChargings']) }}">
            <a href="{!! route('backend.iapAndroidChargings.index') !!}"><i class="fa fa-edit"></i><span>{!! trans('menus.iapAndroidChargings') !!}</span></a>
        </li>
        <li class="{{ \App\Define\Systems::getActiveMenu(Request::url(), ['iapIosChargings']) }}">
            <a href="{!! route('backend.iapIosChargings.index') !!}"><i class="fa fa-edit"></i><span>{!! trans('menus.iapIosChargings') !!}</span></a>
        </li>
    </ul>
</li>

<!-- Business -->
<li class="{!! \App\Define\Systems::getActiveMenu(Request::url(), ['profileBusinesses']) !!}">
    <a href="{!! route('backend.profileBusinesses.index') !!}"><i class="fa fa-shopping-cart"></i><span>{!! trans('menus.business') !!}</span></a>
</li>

<li class="treeview {!! \App\Define\Systems::getActiveMenu(Request::url(), ['profile-reports', 'profile-blocks', 'profile-favorites']) !!}">
    <a href="#"><i class="fa fa-group"></i> <span>{!! trans('menus.profiles') !!}</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{!! \App\Define\Systems::getActiveMenu(Request::url(), ['rankConfigs']) !!}}">
            <a href="{!! route('backend.rankConfigs.index') !!}"><i class="fa fa-edit"></i><span>RankConfigs</span></a>
        </li>
        <li class="{!! \App\Define\Systems::getActiveMenu(Request::url(), ['profiles']) !!}">
            <a href="{!! route('backend.profiles.index') !!}"><i class="fa fa-edit"></i><span>{!! __('menus.member') !!}</span></a>
        </li>
        <li class="{!! \App\Define\Systems::getActiveMenu(Request::url(), ['profile-reports']) !!}">
            <a href="{!! route('backend.profileReports.index') !!}"><i class="fa fa-edit"></i><span>{!! trans('menus.profileReports') !!}</span></a>
        </li>
        <li class="{!! \App\Define\Systems::getActiveMenu(Request::url(), ['profile-blocks']) !!}">
            <a href="{!! route('backend.profileBlocks.index') !!}"><i class="fa fa-edit"></i><span>{!! trans('menus.profileBlocks') !!}</span></a>
        </li>
        <li class="{!! \App\Define\Systems::getActiveMenu(Request::url(), ['profile-favorites']) !!}">
            <a href="{!! route('backend.profileFavorites.index') !!}"><i class="fa fa-edit"></i><span>{!! trans('menus.profileFavorites') !!}</span></a>
        </li>
    </ul>
</li>

<li class="treeview {!! \App\Define\Systems::getActiveMenu(Request::url(), ['roles', 'user']) !!}">
    <a href="#"><i class="fa fa-group"></i> <span>{!! trans('menus.system.management') !!}</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li class="{!! \App\Define\Systems::getActiveMenu(Request::url(), ['roles']) !!}">
            <a href="{{ route('admin.roles.index') }}"><i class="fa fa-user"></i><span>{!! trans('menus.role') !!}</span></a>
        </li>
        <li class="{!! \App\Define\Systems::getActiveMenu(Request::url(), ['user']) !!}">
            <a href="{{ route('admin.user.index') }}"><i class="fa fa-group"></i> <span>{!! trans('menus.user') !!}</span></a>
        </li>
    </ul>
</li>


{{--<li class="{{ Request::is('profileHistories*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('backend.profileHistories.index') !!}"><i class="fa fa-edit"></i><span>ProfileHistories</span></a>--}}
{{--</li>--}}

{{--<li class="{{ Request::is('profilePlusHistories*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('backend.profilePlusHistories.index') !!}"><i class="fa fa-edit"></i><span>ProfilePlusHistories</span></a>--}}
{{--</li>--}}

{{--<li class="{{ Request::is('chargePoints*') ? 'active' : '' }}">--}}
    {{--<a href="{!! route('backend.chargePoints.index') !!}"><i class="fa fa-edit"></i><span>ChargePoints</span></a>--}}
{{--</li>--}}

