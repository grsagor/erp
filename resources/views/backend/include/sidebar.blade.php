<div id="layoutSidenav_nav">

    <div class="user_profile">
        <img class="profile-image"
            src="{{ Auth::user()->profile_image ? asset(Auth::user()->profile_image) : asset('assets/utils/images/no-img.jpg') }}"
            alt="">

        <div class="profile-title">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</div>
        <div class="profile-description">{{ Auth::user()->roles->name }}</div>
    </div>

    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">

            <div class="nav">
                {{-- @if (Helper::hasRight('setting.view'))
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#settingNav"
                        aria-expanded="@if (Route::is('admin.setting.general') || Route::is('admin.setting.static.content') || Route::is('admin.setting.legal.content') || Route::is('admin.contact') || Route::is('admin.resource')) true @else false @endif"
                        aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div> Setup
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse @if (Route::is('admin.setting.general') || Route::is('admin.setting.static.content') || Route::is('admin.setting.legal.content') || Route::is('admin.contact') || Route::is('admin.resource')) show @endif" id="settingNav"
                        aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav down">
                            @if (Helper::hasRight('setting.general'))
                                <a class="nav-link {{ Route::is('admin.setting.general') ? 'active' : '' }}"
                                    href="{{ route('admin.setting.general') }}"><i
                                        class="fa-solid fa-angles-right ikon"></i> General Setting </a>
                            @endif

                            @if (Helper::hasRight('setting.static-content'))
                                <a class="nav-link {{ Route::is('admin.setting.static.content') ? 'active' : '' }}"
                                    href="{{ route('admin.setting.static.content') }}"><i
                                        class="fa-solid fa-angles-right ikon"></i> Static Content</a>
                            @endif

                            @if (Helper::hasRight('setting.legal-content'))
                                <a class="nav-link {{ Route::is('admin.setting.legal.content') ? 'active' : '' }}"
                                    href="{{ route('admin.setting.legal.content') }}"><i
                                        class="fa-solid fa-angles-right ikon"></i> Legal Content</a>
                            @endif
                        </nav>
                    </div>
                @endif --}}


                {{-- admin  --}}
                {{-- @if (Helper::hasRight('setting.view'))
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#setupNav"
                        aria-expanded="@if (Route::is('admin.role') || Route::is('admin.role.create') || Route::is('admin.role.edit') || Route::is('admin.role.right') || Route::is('admin.partner') || Route::is('admin.partner.product') || Route::is('admin.user')) true @else false @endif" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user-shield"></i></div> Administration
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse @if (Route::is('admin.role') || Route::is('admin.role.create') || Route::is('admin.role.edit') || Route::is('admin.role.right') || Route::is('admin.partner') || Route::is('admin.partner.product') || Route::is('admin.user')) show @endif" id="setupNav" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav down">
                            @if (Helper::hasRight('role.view'))
                                <a class="nav-link {{ Route::is('admin.role') || Route::is('admin.role.create') || Route::is('admin.role.edit') ? 'active' : '' }}"
                                    href="{{ route('admin.role') }}"><i class="fa-solid fa-angles-right ikon"></i> Role Management</a>
                            @endif
                            @if (Helper::hasRight('right.view'))
                                <a class="nav-link {{ Route::is('admin.role.right') ? 'active' : '' }}"
                                    href="{{ route('admin.role.right') }}"><i class="fa-solid fa-angles-right ikon"></i> Right Management</a>
                            @endif
                            @if (Helper::hasRight('partner.view'))
                                <a class="nav-link {{ Route::is('admin.partner') ? 'active' : '' }}"
                                    href="{{ route('admin.partner') }}"><i class="fa-solid fa-angles-right ikon"></i> Partner Management
                                </a>
                            @endif

                            @if (Helper::hasRight('user.view'))
                                <a class="nav-link {{ Route::is('admin.user') ? 'active' : '' }}"
                                    href="{{ route('admin.user') }}"><i class="fa-solid fa-angles-right ikon"></i> User Management
                                </a>
                            @endif
                        </nav>
                    </div>
                @endif --}}


                @if (Helper::hasRight('dashboard.view'))
                    <a class="nav-link {{ Route::is('admin.index') ? 'active' : '' }}"
                        href="{{ route('admin.index') }}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div> Dashboard
                    </a>
                @endif

                @if (Helper::hasRight('hr.view'))
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#hrNav"
                        aria-expanded="@if (Route::is('admin.employee.index') || Route::is('admin.salary.index') || Route::is('admin.attendance.index')) true @else false @endif"
                        aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div> HR Management
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse @if (Route::is('admin.employee.index') || Route::is('admin.salary.index') || Route::is('admin.attendance.index')) show @endif" id="hrNav"
                        aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav down">
                            @if (Helper::hasRight('employee.view'))
                                <a class="nav-link {{ Route::is('admin.employee.index') ? 'active' : '' }}"
                                    href="{{ route('admin.employee.index') }}"><i
                                        class="fa-solid fa-angles-right ikon"></i> Employee Management </a>
                            @endif
                            @if (Helper::hasRight('attendance.view'))
                                <a class="nav-link {{ Route::is('admin.attendance.index') ? 'active' : '' }}"
                                    href="{{ route('admin.attendance.index') }}"><i
                                        class="fa-solid fa-angles-right ikon"></i> Attendance Management </a>
                            @endif
                            @if (Helper::hasRight('attendance.view'))
                                <a class="nav-link {{ Route::is('admin.salary.index') ? 'active' : '' }}"
                                    href="{{ route('admin.salary.index') }}"><i
                                        class="fa-solid fa-angles-right ikon"></i> Salary Management </a>
                            @endif
                        </nav>
                    </div>
                @endif
                @if (Helper::hasRight('hr.view'))
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#salesnorderNav"
                        aria-expanded="@if (Route::is('admin.customer.index') || Route::is('admin.customer.index')) true @else false @endif"
                        aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div> Customer & Order
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse @if (Route::is('admin.customer.index') || Route::is('admin.order.index')) show @endif" id="salesnorderNav"
                        aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav down">
                            @if (Helper::hasRight('customer.view'))
                                <a class="nav-link {{ Route::is('admin.customer.index') ? 'active' : '' }}"
                                    href="{{ route('admin.customer.index') }}"><i
                                        class="fa-solid fa-angles-right ikon"></i> Customer Management </a>
                            @endif
                            @if (Helper::hasRight('order.view'))
                                <a class="nav-link {{ Route::is('admin.order.index') ? 'active' : '' }}"
                                    href="{{ route('admin.order.index') }}"><i
                                        class="fa-solid fa-angles-right ikon"></i> Order Management </a>
                            @endif
                        </nav>
                    </div>
                @endif
                @if (Helper::hasRight('hr.view'))
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#rawMaterialsNav"
                        aria-expanded="@if (Route::is('admin.typeofrawmaterials.index') || Route::is('admin.typeofrawmaterials.index')) true @else false @endif"
                        aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div> Raw Materials
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse @if (Route::is('admin.typeofrawmaterials.index') || Route::is('admin.rawmaterialsimporthistory.index')) show @endif" id="rawMaterialsNav"
                        aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav down">
                            @if (Helper::hasRight('typeofrawmaterials.view'))
                                <a class="nav-link {{ Route::is('admin.typeofrawmaterials.index') ? 'active' : '' }}"
                                    href="{{ route('admin.typeofrawmaterials.index') }}"><i
                                        class="fa-solid fa-angles-right ikon"></i> Material Type Management </a>
                            @endif
                            @if (Helper::hasRight('typeofrawmaterials.view'))
                                <a class="nav-link {{ Route::is('admin.rawmaterialsimporthistory.index') ? 'active' : '' }}"
                                    href="{{ route('admin.rawmaterialsimporthistory.index') }}"><i
                                        class="fa-solid fa-angles-right ikon"></i> Material Management </a>
                            @endif
                        </nav>
                    </div>
                @endif

                @if (Helper::hasRight('hr.view'))
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse"
                        data-bs-target="#productNav"
                        aria-expanded="@if (Route::is('admin.products.index') || Route::is('admin.producttype.index')) true @else false @endif"
                        aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-gear"></i></div> Products
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse @if (Route::is('admin.products.index') || Route::is('admin.producttype.index')) show @endif" id="productNav"
                        aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav down">
                            @if (Helper::hasRight('typeofrawmaterials.view'))
                                <a class="nav-link {{ Route::is('admin.products.index') ? 'active' : '' }}"
                                    href="{{ route('admin.products.index') }}"><i
                                        class="fa-solid fa-angles-right ikon"></i> Product Management </a>
                            @endif
                            @if (Helper::hasRight('typeofrawmaterials.view'))
                                <a class="nav-link {{ Route::is('admin.producttype.index') ? 'active' : '' }}"
                                    href="{{ route('admin.producttype.index') }}"><i
                                        class="fa-solid fa-angles-right ikon"></i> Product Type Management </a>
                            @endif
                        </nav>
                    </div>
                @endif
            </div>
        </div>
    </nav>
</div>
