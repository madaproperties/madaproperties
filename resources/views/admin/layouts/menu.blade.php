

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    @if(userRole() == 'other')
      <a href="{{route('admin.deal.index')}}" class="brand-link">
    @else
      <a href="{{route('admin.')}}" class="brand-link">
    @endif
      <img src="{{ asset('public/imgs/mada-logo-blackbg.svg') }}" alt="Mada Properties">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            @if(userRole() == 'other')
              <a href="{{route('admin.deal.index')}}" class="d-block">
            @else
              <a href="{{route('admin.account.index')}}" class="d-block">
            @endif
            {{auth()->user()->name}}
          </a>
        </div>
      </div>

         
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
						@can('history-list')
              <li class="nav-item">
                <a href="{{route('admin.history.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>{{__('site.history')}}</p>
                </a>
              </li>

						@endcan

   					@if(userRole() == 'admin' OR userRole() == 'manger')
             <li class="nav-item">
								<a href="{{route('admin.statics')}}" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
									<p>{{__('site.statics')}}</p>
								</a>
							</li>
						@endif

						@if(userRole() != 'sales admin' && userRole() != 'other')
             <li class="nav-item">
							<a
							href="{{route('admin.home')}}?my-contacts=get&filter_status={{ App\Status::where('name_en','new')->first()->id }} "
							class="nav-link {{ active_nav('admin.home') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
								<p>{{__('site.my contacts')}}</p>
							</a>
						</li>
						@endif

						@if(userRole() != 'sales' && userRole() != 'other')
             <li class="nav-item">
							<a href="{{route('admin.home')}}?filter_status={{ App\Status::where('name_en','new')->first()->id }}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
								<p>{{__('site.contacts')}}</p>
							</a>
						</li>
						@endif

						@can('calendar-list')
             <li class="nav-item">
							<a href="{{route('admin.calendar')}}" class="nav-link {{ active_nav('calendar') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
								<p>{{__('site.calendar')}}</p>
							</a>
						</li>
						@endcan

						@can('cash-list')
             <li class="nav-item">
							<a href="{{route('admin.cash.index')}}" class="nav-link {{ active_nav('cash') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
								<p>{{__('site.cash')}}</p>
							</a>
						</li>
						@endcan
						@can('database-records-list')
             <li class="nav-item">
							<a href="{{route('admin.database-records.index')}}" class="nav-link {{ active_nav('database-records') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
								<p>{{__('site.database_records')}}</p>
							</a>
						</li>
						@endcan

  					@if($user->can('users-report') || $user->can('daily-report') || $user->can('campaign-report') || $user->can('advance-campaign-report') || $user->can('campaign-analytics-report') || $user->can('leaders-report'))
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  {{__('site.reports')}}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
							  @can('users-report')
                  <li class="nav-item">
                    <a href="{{route('admin.users-report')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>users</p>
                    </a>
                  </li>
                @endcan
                @can('daily-report')
                  <li class="nav-item">
                    <a href="{{route('admin.daily-report')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>daily report</p>
                    </a>
                  </li>
                @endcan
                @can('campaign-report')
                  <li class="nav-item">
                    <a href="{{route('admin.campaign-report')}}?type=campaing" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>campaign report</p>
                    </a>
                  </li>
                @endcan
                @can('advance-campaign-report-list')
                  <li class="nav-item">
                    <a href="{{route('admin.advance-campaign-report.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Advance campaign report</p>
                    </a>
                  </li>
                @endcan
                @can('campaign-analytics-report')
                  <li class="nav-item">
                    <a href="{{route('admin.campaign-analytics-report')}}?type=campaing-analytics" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>campaing analytics</p>
                    </a>
                  </li>
                @endcan
                @can('leaders-report')
                  <li class="nav-item">
                    <a href="{{route('admin.leaders-report')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>leaders</p>
                    </a>
                  </li>
                @endcan
                </ul>
  						</li>
						@endif
						@if($user->can('deal-list') || $user->can('deal-project-list') || $user->can('deal-developer-list'))
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  {{__('site.deals')}}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
								@can('deal-list')
                  <li class="nav-item">
                    <a href="{{route('admin.deal.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('site.deals')}}</p>
                    </a>
                  </li>
                @endcan
								@can('deal-project-list')
                  <li class="nav-item">
                    <a href="{{route('admin.deal_project.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('site.deals') .' '. __('site.project')}}</p>
                    </a>
                  </li>
								@endcan
								@can('deal-developer-list')
                  <li class="nav-item">
                    <a href="{{route('admin.deal-developer.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('site.developer')}}</p>
                    </a>
                  </li>
								@endcan
                </ul>
						</li>
						@endif

						@if($user->can('project-list') || $user->can('project-name-list') || $user->can('project-developer-list'))
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                {{__('site.project')}}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                  @can('project-list')
                    <li class="nav-item">
                      <a href="{{route('admin.project-data.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{__('site.project')}}</p>
                      </a>
                    </li>
                  @endcan
                  @can('project-name-list')
                    <li class="nav-item">
                      <a href="{{route('admin.project-name.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{__('site.project') .' '. __('site.name')}}</p>
                      </a>
                    </li>
                  @endcan
                  @can('project-developer-list')
                    <li class="nav-item">
                      <a href="{{route('admin.project-developer.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{__('site.project') .' '.__('site.developer')}}</p>
                      </a>
                    </li>
                  @endcan
              </ul>
            </li>
						@endif

						@if($user->can('property-list') || $user->can('features-list'))
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                {{__('site.property')}}
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @can('property-list')
                  <li class="nav-item">
                    <a href="{{route('admin.property.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('site.property')}}</p>
                    </a>
                  </li>

  							@endcan
								@can('feature-list')
                  <li class="nav-item">
                    <a href="{{route('admin.features.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('site.features')}}</p>
                    </a>
                  </li>
								@endcan
              </ul>
            </li>
						@endif						
            @can('role-list')
             <li class="nav-item">
							<a href="{{route('admin.roles.index')}}" class="nav-link {{ active_nav('roles') ? 'active' : ''}}">
              <i class="nav-icon fas fa-th"></i>
								<p>{{__('site.Roles & Permissions')}}</p>
							</a>
						</li>
						@endcan

            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}" title="Sign Out" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-door-open"></i>
                <p>Sign Out</p>
              </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
