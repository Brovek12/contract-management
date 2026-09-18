<div id="kt_aside" 
     class="bg-white border aside border-right-1" 
     data-kt-drawer="true" 
     data-kt-drawer-name="aside"
     data-kt-drawer-activate="{default: true, lg: false}" 
     data-kt-drawer-overlay="true"
     data-kt-drawer-width="{default:'200px', '300px': '250px'}" 
     data-kt-drawer-direction="start"
     data-kt-drawer-toggle="#kt_aside_mobile_toggle">

    <!--begin::Aside Toolbar-->
    <div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">

        <!--begin::Aside user-->
        <div class="py-5 aside-user d-flex align-items-sm-center justify-content-center" style="border: none;">

            <!--begin::Symbol-->
            <div class="symbol symbol-35px symbol-circle">
                @if (Auth::user()->foto)

                    <img src="{{ asset(Auth::user()->foto) }}"
                         alt="User foto"
                         class="symbol-label" />

                @else

                    @php
                        $user = Auth::user();
                        $nameParts = explode(' ', $user->name);

                        $initials = strtoupper(
                            substr($nameParts[0], 0, 1) .
                            (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : '')
                        );
                    @endphp

                    <div class="symbol-label fs-2 fw-semibold bg-primary text-inverse-danger">
                        {{ $initials }}
                    </div>

                @endif
            </div>
            <!--end::Symbol-->


            <!--begin::Wrapper-->
            <div class="flex-wrap aside-user-info flex-row-fluid ms-5">

                <!--begin::Section-->
                <div class="d-flex">

                    <!--begin::Info-->
                    <div class="flex-grow-1 me-2">

                        <!--begin::Username-->
                        <a href="#"
                           class="text-gray-700 text-hover-primary fs-8 fw-bold">
                            {{ Auth::user()->name }}
                        </a>
                        <!--end::Username-->


                        <!--begin::Description-->
                        <span class="mb-1 text-gray-600 fw-semibold d-block fs-8">
    {{ auth()->user()->getRoleNames()->first() }}
</span>
                        <!--end::Description-->

                    </div>
                    <!--end::Info-->


                    <!--begin::User menu-->
                    <div class="me-n2">

                        <!--begin::Action-->
                        <a href="#"
                           class="btn btn-icon btn-sm btn-active-color-primary mt-n2"
                           data-kt-menu-trigger="click"
                           data-kt-menu-placement="bottom-start"
                           data-kt-menu-overflow="true">

                            <i class="ki-duotone ki-entrance-right text-muted fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>

                        </a>
                        <!--end::Action-->


                        <!--begin::User account menu-->
                        <div class="py-4 menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold fs-6 w-275px"
                             data-kt-menu="true">

                            <!--begin::Menu item-->
                            <div class="px-5 menu-item">

                                <a href="{{ route('logout') }}"
                                   class="px-5 menu-link"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">

                                    Sign Out

                                </a>

                                <form id="logout-form"
                                      action="{{ route('logout') }}"
                                      method="POST"
                                      style="display: none;">

                                    @csrf

                                </form>

                            </div>
                            <!--end::Menu item-->

                        </div>
                        <!--end::User account menu-->

                    </div>
                    <!--end::User menu-->

                </div>
                <!--end::Section-->

            </div>
            <!--end::Wrapper-->

        </div>
        <!--end::Aside user-->

    </div>
    <!--end::Aside Toolbar-->


    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">

        <!--begin::Aside Menu-->
        <div class="mx-3 my-5 hover-scroll-overlay-y my-lg-5"
             id="kt_aside_menu_wrapper"
             data-kt-scroll="true"
             data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}"
             data-kt-scroll-wrappers="#kt_aside_menu"
             data-kt-scroll-offset="5px">

            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                 id="#kt_aside_menu"
                 data-kt-menu="true">


                {{-- ========================================================= --}}
                {{-- DASHBOARD --}}
                {{-- ========================================================= --}}

                @can('read-dashboard')

                    <!--begin:Menu item - Dashboard-->
                    <div class="menu-item">

                        <a class="menu-link text-hover-primary"
                           href="{{ route('dashboard') }}">

                            <span class="menu-icon">

                                <i class="{{ Route::is('dashboard') ? 'text-primary' : 'text-gray-700' }} ki-duotone ki-element-11 fs-2">

                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>

                                </i>

                            </span>

                            <span class="{{ Route::is('dashboard') ? 'text-primary' : 'text-gray-700' }} text-hover-primary menu-title">
                                Dashboard
                            </span>

                        </a>

                    </div>
                    <!--end:Menu item-->

                @endcan


                {{-- ========================================================= --}}
                {{-- MENU UTAMA --}}
                {{-- ========================================================= --}}

                <div class="pt-5 menu-item">

                    <div class="menu-content">

                        <span class="menu-heading fw-bold text-uppercase fs-7">
                            Menu Utama
                        </span>

                    </div>


                    {{-- ===================================================== --}}
                    {{-- SOP --}}
                    {{-- ===================================================== --}}

                    @can('read-ss')

                        <!--begin:Menu item - SOP-->
                        <div class="menu-item">

                            <a class="menu-link text-hover-primary"
                               href="{{ route('sop.index') }}">

                                <span class="menu-icon">

                                    <i class="{{ Route::is('sop*') ? 'text-primary' : 'text-gray-700' }} fa fa-syringe fs-2"></i>

                                </span>

                                <span class="{{ Route::is('sop*') ? 'text-primary' : 'text-gray-700' }} text-hover-primary menu-title">
                                    SOP
                                </span>

                            </a>

                        </div>
                        <!--end:Menu item-->

                    @endcan
                  @can('read-my-contracts')
    <div class="menu-item">

        <a class="menu-link text-hover-primary"
           href="{{ route('employee.contracts.index') }}">

            <span class="menu-icon">
                <i class="{{ Route::is('employee.contracts.*') ? 'text-primary' : 'text-gray-700' }} fa fa-file-contract fs-2"></i>
            </span>

            <span class="{{ Route::is('employee.contracts.*') ? 'text-primary' : 'text-gray-700' }} text-hover-primary menu-title">
                Contract
            </span>

        </a>

    </div>
@endcan

                    {{-- ===================================================== --}}
                    {{-- PROJECT --}}
                    {{-- ===================================================== --}}

                    @can('read-projects')

                        <!--begin:Menu item - Project-->
                        <div data-kt-menu-trigger="click"
                             class="menu-item menu-accordion">

                            <span class="menu-link text-hover-primary">

                                <span class="menu-icon">

                                    <i class="{{ Route::is('projects*') ? 'text-primary' : 'text-gray-700' }} fa fa-project-diagram fs-2"></i>

                                </span>

                                <span class="{{ Route::is('projects*') ? 'text-primary' : 'text-gray-700' }} text-hover-primary menu-title">
                                    Project
                                </span>

                                <span class="menu-arrow"></span>

                            </span>


                            <div class="menu-sub menu-sub-accordion">

                                @can('read-projects')

                                    <div class="menu-item">

                                        <a class="menu-link text-hover-primary"
                                           href="{{ route('projects.index') }}">

                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>

                                            <span class="{{ Route::is('projects.index') ? 'text-primary' : 'text-gray-700' }} text-hover-primary menu-title">
                                                List Project
                                            </span>

                                        </a>

                                    </div>

                                @endcan

                            </div>

                        </div>
                        <!--end:Menu item-->

                    @endcan
                    



                    {{-- ===================================================== --}}
                    {{-- HRD --}}
                    {{-- ===================================================== --}}
                    @can('read-users')
                    <div data-kt-menu-trigger="click"
                         class="menu-item menu-accordion">

                        <span class="menu-link text-hover-primary">

                            <span class="menu-icon">

                                <i class="{{ Route::is('employees*') || Route::is('contracts*') ? 'text-primary' : 'text-gray-700' }} fa fa-users fs-2"></i>

                            </span>

                            <span class="{{ Route::is('employees*') || Route::is('contracts*') ? 'text-primary' : 'text-gray-700' }} text-hover-primary menu-title">
                                HRD
                            </span>

                            <span class="menu-arrow"></span>

                        </span>


                        <div class="menu-sub menu-sub-accordion">
                            @endcan


                            {{-- ================================================= --}}
                            {{-- LIST KONTRAK --}}
                            {{-- ================================================= --}}

                            @can('read-contracts')

                                <div class="menu-item">

                                    <a class="menu-link text-hover-primary"
                                       href="{{ route('contracts.index') }}">

                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>

                                        <span class="{{ Route::is('contracts*') ? 'text-primary' : 'text-gray-700' }} text-hover-primary menu-title">
                                            List Kontrak
                                        </span>

                                    </a>

                                </div>

                            @endcan


                            {{-- ================================================= --}}
                            {{-- MY CONTRACT - EMPLOYEE --}}
                            {{-- ================================================= --}}

                            @can('read-my-contracts')

                                <div class="menu-item">

                                    {{-- <a class="menu-link text-hover-primary"
                                       href="{{ route('employee.contracts.index') }}">

                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>

                                        <span class="{{ Route::is('employee.contracts*') ? 'text-primary' : 'text-gray-700' }} text-hover-primary menu-title">
                                            Kontrak Saya
                                        </span>

                                    </a> --}}

                                </div>

                            @endcan

                        </div>

                    </div>
                    <!--end:Menu item - HRD-->

                </div>
                <!--end:Menu item - Menu Utama-->


                {{-- ========================================================= --}}
                {{-- KONFIGURASI --}}
                {{-- ========================================================= --}}

                <div class="pt-5 menu-item">

                    <div class="menu-content">

                        <span class="menu-heading fw-bold text-uppercase fs-7">
                            Konfigurasi
                        </span>

                    </div>

                </div>
                <!--end:Menu item - Konfigurasi-->


                {{-- ========================================================= --}}
                {{-- PENGGUNA --}}
                {{-- ========================================================= --}}

                @can('read-users')

                    <!--begin:Menu item - Pengguna-->
                    <div class="menu-item">

                        <a class="menu-link text-hover-primary"
                           href="{{ route('user.index') }}">

                            <span class="menu-icon">

                                <i class="{{ Route::is('user*') ? 'text-primary' : 'text-gray-700' }} fa fa-user-shield fs-2"></i>

                            </span>

                            <span class="{{ Route::is('user*') ? 'text-primary' : 'text-gray-700' }} text-hover-primary menu-title">
                                Pengguna
                            </span>

                        </a>

                    </div>
                    <!--end:Menu item-->

                @endcan


                {{-- ========================================================= --}}
                {{-- JABATAN & HAK AKSES --}}
                {{-- ========================================================= --}}

                @can('read-roles')

                    <!--begin:Menu item - Jabatan & Hak Akses-->
                    <div class="menu-item">

                        <a class="menu-link text-hover-primary"
                           href="{{ route('role.index') }}">

                            <span class="menu-icon">

                                <i class="{{ Route::is('role*') ? 'text-primary' : 'text-gray-700' }} fa fa-lock-open fs-2"></i>

                            </span>

                            <span class="{{ Route::is('role*') ? 'text-primary' : 'text-gray-700' }} text-hover-primary menu-title">
                                Jabatan & Hak Akses
                            </span>

                        </a>

                    </div>
                    <!--end:Menu item-->

                @endcan


            </div>
            <!--end::Menu-->

        </div>
        <!--end::Aside Menu-->

    </div>
    <!--end::Aside menu-->

</div>