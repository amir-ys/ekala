<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu"> داشبرد </li>
                <li>
                    <a href="{{ route('panel.dashboard') }}" class="waves-effect">
                        <i class="bx bx-home-circle"></i>
                        <span key="t-dashboards">داشبرد</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('panel.brands.index') }}" class="waves-effect">
                        <i class="bx bx-palette"></i>
                        <span key="t-brand">برندها</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts"> کاربران و سطوح دسترسی </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="{{ route('panel.users.index') }}"
                               key="t-vertical"> کاربران </a>
                        </li>

                        <li>
                            <a href="{{ route('panel.permissions.index') }}"
                               key="t-vertical"> مجوز ها (permissions)</a>
                        </li>

                        <li>
                            <a href="{{ route('panel.roles.index') }}"
                               key="t-vertical"> نقش های کاربری </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="bx bx-layout"></i>
                        <span key="t-layouts"> محصول </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="{{ route('panel.products.index') }}"
                               key="t-vertical">  محصولات  </a>
                        </li>
                        <li>
                            <a href="{{ route('panel.categories.index') }}"
                               key="t-vertical"> دسته بندی ها </a>
                        </li>
                        <li>
                            <a href="{{ route('panel.attributes.index') }}"
                               key="t-vertical"> ویژگی ها </a>
                        </li>
                        <li>
                            <a href="{{ route('panel.tags.index') }}"
                               key="t-vertical"> برچسب ها  </a>
                        </li>
                        <li>
                            <a href="{{ route('panel.comments.index') }}"
                               key="t-vertical"> کامنت ها  </a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="{{ route('panel.banners.index') }}" class="waves-effect">
                        <i class="bx bx-slider"></i>
                        <span key="t-banner">بنرها</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('panel.coupons.index') }}" class="waves-effect">
                        <i class="bx bx-slider"></i>
                        <span key="t-banner">کد تخفیف </span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('panel.orders.index') }}" class="waves-effect">
                        <i class="bx bx-slider"></i>
                        <span key="t-banner">سفارشات  </span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
