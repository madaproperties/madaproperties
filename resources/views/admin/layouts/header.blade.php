<html lang="{{app()->getLocale()}}" dir="{{app()->getLocale() == 'en' ? 'ltr' : 'rtl'}}">
	<!--begin::Head-->
	<head><base href="">
		<meta charset="utf-8" />
		<title>MADA -
		@php
		    $url = str_replace(request()->getHost(),'', request()->fullUrl());
		    $url = str_replace('https:///','',$url);
		@endphp

		{{ ucfirst($url) }}
		</title>
		<meta name="description" content="Updates and statistics" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Vendors Styles(used by this page)-->
		<link href="{{ asset('public/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
		<!--end::Page Vendors Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="{{ asset('public/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('public/assets/plugins/custom/prismjs/prismjs.bundle.css')}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('public/assets/css/style.bundle.css?t='.time())}}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('public/css/custom.css?t='.time())}}" rel="stylesheet" type="text/css" />
		@php //Updated by Javed @endphp
		<link href="{{ asset('public/css/developer.css?t='.time())}}" rel="stylesheet" type="text/css" />

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="{{ asset('public/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
		<script src="{{ asset('public/assets/js/pages/crud/forms/editors/ckeditor-classic.js') }}"></script>
		<script src="{{ asset('public/assets/js/pages/crud/forms/widgets/select2.js') }}"></script>
		<script src="{{ asset('public/assets/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>

		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<!--end::Layout Themes-->
		@include('admin.layouts.msgs')
		@stack('css')
		<link rel="shortcut icon" href="{{ asset('public/imgs/mada-logo-blackbg.svg') }}" />
		<style>
		@if(Request::root() == 'https://lmsstaging.madaproperties.com')
		    body {
		     background:#e8afaf;
		    }
		@else
		    body {
		        background:#F2F3F7;
		    }
		@endif

	    .dropdown-toggle::after
	    {
	        margin-top:10px
	    }
		.task.form-group
		{
			margin-bottom: 0
		}
		@media (min-width: 576px){
			.modal-dialog {
				max-width: 700px;
			}
		}
		</style>
		<!--- HUNDEL AR DIRECTION --->
		@if(app()->getLocale() == 'ar')
		<style>
			.flex-row-fluid
			{
				margin-left: unset;
				margin-right:2rem !important
			}
			.t-ar-right
			{
				text-align: right !important
			}
			.d-flex
			{
				text-align: right;
			}
			.icon-2x
			{
				margin-left:8px
			}

			.card-toolbar .btn {
				margin-left:10px
			}
		</style>
		@endif


		<!--- new style -->
		<style>
				.header .header-top , .btn-primary , .topbar .topbar-item,.btn-light-primary,
				.dataTables_wrapper .dataTables_paginate .pagination .page-item.active > .page-link,
				.fc-daygrid-event,
				.btn.btn-success,
				.paginate_button.page-item:hover a
				{
					background: #000 !important
				}
				.btn.btn-success
				{
					border-color:#fff
				}
				.btn-primary , .btn-light-primary,
				.btn.btn-light-primary.dropdown-toggle:after
				{
					border-color:#fff !important;
					color:#ffff
				}
				.btn.btn-light-primary ,.fc-daygrid-event
				{
					color:#fff
				}
				.header-menu .menu-nav > .menu-item.menu-item-here > .menu-link .menu-text, .header-menu .menu-nav > .menu-item.menu-item-active > .menu-link .menu-text,
				.navi .navi-item .navi-link.active .navi-text,
				.navi .navi-item .navi-link.active .navi-icon i,
				.fc-col-header-cell-cushion,
				.fc-daygrid-day-number,
				.nav .show > .nav-link .nav-icon i, .nav .nav-link:hover:not(.disabled) .nav-icon i, .nav .nav-link.active .nav-icon i,
				.nav.nav-tabs .nav-link .nav-text,
				.text-hover-primary:hover,
				.nav.nav-tabs .nav-link .nav-text:hover,
				.nav .show > .nav-link, .nav .nav-link:hover:not(.disabled), .nav .nav-link.active,
				.nav .show > .nav-link .nav-text, .nav .nav-link:hover:not(.disabled) .nav-text, .nav .nav-link.active .nav-text
				{
					color:#000;
				}


				.navi-link:hover span , .navi-link:hover .navi-icon i{
					color:#000 !important
				}

				.fc-daygrid-event-dot,
				.fc-direction-ltr .fc-daygrid-event.fc-event-end, .fc-direction-rtl .fc-daygrid-event.fc-event-start
				{
					border-color: #fff
				}
				.btn.btn-light-primary .svg-icon svg g [fill]
				{
					fill:#fff !important
				}

				.main-logo {
					width: 70%;
					padding: 21px;
					height: 109px;
				}

    .btn.btn-hover-primary:hover:not(.btn-text):not(:disabled):not(.disabled), .btn.btn-hover-primary:focus:not(.btn-text), .btn.btn-hover-primary.focus:not(.btn-text)
    {
        background-color: #000 !important;
         border-color: #fff !important;
    }

    .dataTables_wrapper .dataTable th.sorting_asc, .dataTables_wrapper .dataTable td.sorting_asc
    {
        color:#000 !important;
    }

    @media(max-width: 775px)
    {
        .header-mobile,#kt_header_mobile
        {
            background:#000;
        }
    }
		</style>

	</head>
	
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class=" header-bottom-enabled page-loading">
		<div id="loadingHolder"> 
			<div id="loader"></div>
		</div>
		@if(auth()->id())
			@php
				$user = App\User::where('id',auth()->id())->first();
			@endphp
		@endif
		<!--begin::Main-->
		<!--begin::Header Mobile-->
		<div id="kt_header_mobile" class="header-mobile  header-mobile-fixed">
			<!--begin::Logo-->
			@if(auth()->id())
				@if(userRole() == 'other')
					<a href="{{route('admin.deal.index')}}">
				@else
					<a href="{{route('admin.')}}">
				@endif
				<img alt="Logo" src="{{ asset('public/imgs/mada-logo-blackbg.svg') }}" class="max-h-30px" />
			</a>
			@else
			<a href="{{route('projcets.newweb')}}">
				<img alt="Mada Properties" src="{{ asset('public/imgs/mada-logo-blackbg.svg') }}" class="max-h-30px" />
			</a>
			@endif
			<!--end::Logo-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<button class="btn p-0 burger-icon burger-icon-left ml-4" id="kt_header_mobile_toggle">
					<span></span>
				</button>
				<button class="btn p-0 ml-2" id="kt_header_mobile_topbar_toggle">
					<span class="svg-icon svg-icon-xl">
						<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
							<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
								<polygon points="0 0 24 0 24 24 0 24" />
								<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
								<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
							</g>
						</svg>
						<!--end::Svg Icon-->
					</span>
				</button>
			</div>
			<!--end::Toolbar-->
		</div>
		<!--end::Header Mobile-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Page-->
			<div class="d-flex flex-row flex-column-fluid page">
				<!--begin::Wrapper-->
				<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
					<!--begin::Header-->
					<div id="kt_header" class="header flex-column header-fixed">
						<!--begin::Top-->
						<div class="header-top">
							<!--begin::Container-->
							
							<div class="container">
								<!--begin::Left-->
								<div class="d-none d-lg-flex align-items-center mr-3">
									@if(auth()->id())
									<!--begin::Logo-->
									@if(userRole() == 'other')
										<a href="{{route('admin.deal.index')}}" class="mr-20">
									@else
										<a href="{{route('admin.')}}" class="mr-20">
									@endif
										<img alt="Logo" src="{{ asset('public/imgs/mada-logo-blackbg.svg') }}" class="main-logo" />
									</a>
									<!--end::Logo-->
									@else
									<a href="{{route('projcets.newweb')}}">
										<img alt="Mada Properties" src="{{ asset('public/imgs/mada-logo-blackbg.svg') }}" class="main-logo" />
									</a>
									@endif
								</div>
								<!--end::Left-->
								<!--begin::Topbar-->
								@if(auth()->id())
								<div class="topbar bg-primary">
									@php
										$notoficationCount = App\Notofication::where('user_id',auth()->id())->where('completed','0')->count();
									@endphp

									<!--begin::User id=""-->
									<div class="topbar-item">
										<div
										onclick="window.location = '{{app()->getLocale() == 'en' ? route('lang','ar') : route('lang','en') }}'"
										class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1 ">
												<span class="flaticon2-world" style="margin-right:2px"></span>
												{{ app()->getLocale() == 'en' ? 'ع' : 'en'}}
										</div>
										@if(userRole() != 'other')
										<div
										onclick="window.location = '{{route('admin.notofications.index')}}'"
										class="btn btn-icon btn-hover-transparent-white btn-dropdown btn-lg mr-1 {{ $notoficationCount ? 'pulse pulse-white' : ''}}">
												<span class="flaticon-alert"></span> <span style="margin-left:5px;" class="bg-white badge badge-light">{{$notoficationCount}}</span>
												<span class="pulse-ring"></span>
										</div>
										@endif

										<div
										onclick="window.location = '{{route('admin.account.index')}}'"
										class="btn btn-icon btn-hover-transparent-white w-sm-auto d-flex align-items-center btn-lg px-2" >
											<div class="d-flex flex-column text-right pr-sm-3">
												<span class="text-white opacity-50 font-weight-bold font-size-sm d-none d-sm-inline">{{substr(auth()->user()->name,0,8)}}..</span>
												<span class="text-white font-weight-bolder font-size-sm d-none d-sm-inline">{{auth()->user()->rule}}</span>
											</div>
											<span class="symbol symbol-35">
												<span class="symbol-label font-size-h5 font-weight-bold text-white bg-white-o-30">{{substr(auth()->user()->name,0,1)}}</span>
											</span>
										</div>
									</div>
									<!--end::User-->
								</div>
								@endif
								<!--end::Topbar-->
							</div>
							
							<!--end::Container-->
						</div>
						<!--end::Top-->
						<div class="header-bottom">
							<!--begin::Container-->
							@if(auth()->id())
							<div class="container">
								<!--begin::Header Menu Wrapper-->
								<div class="header-navs header-navs-left" id="kt_header_navs">
									<!--begin::Tab Navs(for tablet and mobile modes)-->
									<ul class="header-tabs p-5 p-lg-0 d-flex d-lg-none nav nav-bold nav-tabs" role="tablist">
										<!--begin::Item-->
										<li class="nav-item mr-2">
											<a href="#" class="nav-link btn btn-clean" data-toggle="tab" data-target="#kt_header_tab_1" role="tab">{{__('site.contacts')}}</a>
										</li>

										<!--end::Item-->
									</ul>
									<!--begin::Tab Navs-->
									<!--begin::Tab Content-->
									<div class="tab-content">
										<!--begin::Tab Pane-->
										<div class="tab-pane py-5 p-lg-0 show active" id="kt_header_tab_1">
											<!--begin::Menu-->
											<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
												<!--begin::Nav-->
												<ul class="menu-nav">
						@can('history-list')
							<li class="menu-item menu-item-active" aria-haspopup="true">
								<a
								href="{{route('admin.history.index')}}"
								class="menu-link {{ active_nav('admin.history') ? 'active' : ''}}">
									<span class="menu-text">{{__('site.history')}}</span>
								</a>
							</li>
						@endcan

      					@if(userRole() == 'admin' OR userRole() == 'manger')
							<li class="menu-item menu-item-active" aria-haspopup="true">
								<a
								href="{{route('admin.statics')}}"
								class="menu-link {{ active_nav('admin.statics') ? 'active' : ''}}">
									<span class="menu-text">{{__('site.statics')}}</span>
								</a>
							</li>
						@endif

						@if(userRole() != 'sales admin' && userRole() != 'other')
						<li class="menu-item menu-item-active" aria-haspopup="true">
							<a
							href="{{route('admin.home')}}?my-contacts=get&filter_status={{ App\Status::where('name_en','new')->first()->id }} "
							class="menu-link {{ active_nav('admin.home') ? 'active' : ''}}">
								<span class="menu-text">{{__('site.my contacts')}}</span>
							</a>
						</li>
						@endif

						@if(userRole() != 'sales' && userRole() != 'other')
						<li class="menu-item menu-item-active" aria-haspopup="true">
							<a href="{{route('admin.home')}}?filter_status={{ App\Status::where('name_en','new')->first()->id }}" class="menu-link {{ active_nav('admin.home') ? 'active' : ''}}">
								<span class="menu-text">{{__('site.contacts')}}</span>
							</a>
						</li>
						@endif

						@can('calendar-list')
						<li class="menu-item menu-item-active" aria-haspopup="true">
							<a href="{{route('admin.calendar')}}" class="menu-link {{ active_nav('calendar') ? 'active' : ''}}">
								<span class="menu-text">{{__('site.calendar')}}</span>
							</a>
						</li>
						@endcan

						@if($user->can('users-report') || $user->can('daily-report') || $user->can('campaign-report') || $user->can('advance-campaign-report') || $user->can('campaign-analytics-report') || $user->can('leaders-report'))
						<li class="menu-item menu-item-active text-dark">
							<a class="menu-link menu-toggle menu-link text-dark dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							{{__('site.reports')}}
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
							@can('users-report')
							<a class="dropdown-item" href="{{route('admin.users-report')}}?type=users">users</a>
							@endcan
							@can('daily-report')
							<a class="dropdown-item" href="{{route('admin.daily-report')}}?type=report">daily report</a>
							@endcan
							@can('campaign-report')
							<a class="dropdown-item" href="{{route('admin.campaign-report')}}?type=campaing">campaign report</a>
							@endcan
							@can('advance-campaign-report-list')
							<a class="dropdown-item" href="{{route('admin.advance-campaign-report.index')}}">Advance campaign report</a>
							@endcan
							@can('campaign-analytics-report')
							<a class="dropdown-item" href="{{route('admin.campaign-analytics-report')}}?type=campaing-analytics">campaign analytics</a>
							@endcan
							@can('leaders-report')
							<a class="dropdown-item" href="{{route('admin.leaders-report')}}?type=leaders">leaders</a>
							@endcan
							</div>
						</li>
						@endif
						@if($user->can('deal-list') || $user->can('deal-project-list') || $user->can('deal-developer-list'))
						<li class="menu-item menu-item-active text-dark">
							<a class="menu-link menu-toggle menu-link text-dark dropdown-toggle" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							{{__('site.deals')}}
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
								@can('deal-list')
								<a class="dropdown-item" href="{{route('admin.deal.index')}}">{{__('site.deals')}}</a>
								@endcan
								@can('deal-project-list')
								<a class="dropdown-item" href="{{route('admin.deal_project.index')}}">{{__('site.deals') .' '. __('site.project')}}</a>
								@endcan
								@can('deal-developer-list')
								<a class="dropdown-item" href="{{route('admin.deal-developer.index')}}">{{__('site.developer')}}</a>
								@endcan
							</div>
						</li>
						@endif
                     
                        @can('cash-list')
						<li class="menu-item menu-item-active" aria-haspopup="true">
							<a href="{{route('admin.cash.index')}}" class="menu-link {{ active_nav('cash') ? 'active' : ''}}">
								<span class="menu-text">{{__('site.cash')}}</span>
							</a>
						</li>
						@endcan

						@can('role-list')
						<li class="menu-item menu-item-active" aria-haspopup="true">
							<a href="{{route('admin.roles.index')}}" class="menu-link {{ active_nav('roles') ? 'active' : ''}}">
								<span class="menu-text">{{__('site.Roles & Permissions')}}</span>
							</a>
						</li>
						@endcan
						

						@if($user->can('project-list') || $user->can('project-name-list') || $user->can('project-developer-list'))
						<li class="menu-item menu-item-active text-dark">
							<a class="menu-link menu-toggle menu-link text-dark dropdown-toggle" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							{{__('site.project')}}
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
								@can('project-list')
								<a class="dropdown-item" href="{{route('admin.project-data.index')}}">{{__('site.project')}}</a>
								@endcan
								@can('project-name-list')
								<a class="dropdown-item" href="{{route('admin.project-name.index')}}">{{__('site.project') .' '. __('site.name')}}</a>
								@endcan
								@can('project-developer-list')
								<a class="dropdown-item" href="{{route('admin.project-developer.index')}}">{{__('site.project') .' '.__('site.developer')}}</a>
								@endcan
								@if(userRole()=='admin' || userRole()=='sales director' ||userRole()=='sales admin uae' || userRole()== 'sales admin saudi' )
								<a class="dropdown-item" href="{{route('projcets.newweb')}}">{{__('site.project availability')}}</a>
								@endif
							</div>
						</li>
						@endif
						@can('database-records-list')
						<li class="menu-item menu-item-active" aria-haspopup="true">
							<a href="{{route('admin.database-records.index')}}" class="menu-link {{ active_nav('database-records') ? 'active' : ''}}">
								<span class="menu-text">{{__('site.database_records')}}</span>
							</a>
						</li>
						@endcan
						@if($user->can('property-list') || $user->can('features-list'))
						<li class="menu-item menu-item-active text-dark">
							<a class="menu-link menu-toggle menu-link text-dark dropdown-toggle" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							{{__('site.property')}}
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
								@can('property-list')
									<a class="dropdown-item" href="{{route('admin.property.index')}}">{{__('site.property')}}</a>
								@endcan
								@can('feature-list')
								<a class="dropdown-item" href="{{route('admin.features.index')}}">{{__('site.features')}}</a>
								@endcan
							</div>
						</li>
						@endif						
							</ul>
							<!--end::Nav-->
						</div>
						<!--end::Menu-->
					</div>
					<!--begin::Tab Pane-->

				</div>
				<!--end::Tab Content-->
			</div>
			@php 
			@enphp
			<!--end::Header Menu Wrapper-->
		</div>
		@endif
		<!--end::Container-->
	</div>
</div>
<!--end::Header-->

