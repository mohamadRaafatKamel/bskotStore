<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item"><a href="{{route('admin.dashboard')}}"><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>

            <li class="nav-item">
                <a href=""><i class="la la-cart-arrow-down"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> الطلبات </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">
                        {{App\Models\Orders::where('state','2')->count()}}
                    </span>
                </a>
                <ul class="menu-content">

                    <li><a class="menu-item" href="{{route('admin.order')}}" data-i18n="nav.dash.crypto">
                            طلب قيد التحضير
                        </a></li>
                    <li><a class="menu-item" href="{{route('admin.order.sending')}}" data-i18n="nav.dash.crypto">
                            طلب في طريقه
                        </a></li>
                    <li><a class="menu-item" href="{{route('admin.order.done')}}" data-i18n="nav.dash.crypto">
                            تم تسليم طلب
                        </a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a href=""><i class="la la-automobile"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> المنتجات </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">
                        {{App\Models\Product::count()}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.product')}}"   {{--class="active"--}}
                        data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.product.create')}}" data-i18n="nav.dash.crypto">
                            أضافه جديد </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href=""><i class="la la-barcode"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> كود خصم </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">
                        {{App\Models\PromoCode::count()}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.promocode')}}"   {{--class="active"--}}
                        data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.promocode.create')}}" data-i18n="nav.dash.crypto">
                            أضافه جديد </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href=""><i class="la la-certificate"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> التصنيفات </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">
                        {{App\Models\Category::count()}}
                    </span>
                </a>
                <ul class="menu-content">
                   <li><a class="menu-item" href="{{route('admin.category')}}"   {{--class="active"--}}
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.category.create')}}" data-i18n="nav.dash.crypto">
                             أضافه جديد </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href=""><i class="la la-map-marker"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> المناطق </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">
                        {{App\Models\Area::count()}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.area')}}"   {{--class="active"--}}
                        data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.area.create')}}" data-i18n="nav.dash.crypto">
                            أضافه جديد </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href=""><i class="la la-map-signs"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> الامارات </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">
                        {{App\Models\Emarh::count()}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.emarh')}}"
                        data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.emarh.create')}}" data-i18n="nav.dash.crypto">
                            أضافه جديد </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href=""><i class="la la-user"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> الادمن </span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">
                        {{App\Models\Admin::count()}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('admin.admin')}}"
                           data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.admin.create')}}" data-i18n="nav.dash.crypto">
                            أضافه جديد </a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>
