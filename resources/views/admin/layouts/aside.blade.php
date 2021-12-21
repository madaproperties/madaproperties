<div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
  <!--begin::Profile Card-->
  <div class="card card-custom card-stretch">
    <!--begin::Body-->
    <div class="card-body pt-4">
      <!--begin::User-->
      <div class="text-center ">
        <div class="text-center">
          <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 ">{{auth()->user()->name}}</a>
          <div class="text-muted">{{auth()->user()->rule}}</div>
        </div>
      </div>
      <!--end::User-->

      <!--begin::Nav-->
      <div class="navi navi-bold navi-hover navi-active navi-link-rounded">

        <div class="navi-item mb-2">
          <a href="{{route('admin.account.index')}}"
          class="navi-link py-4 {{ active_nav('account.index') ? 'active' : ''}}">
          <span class="navi-icon mr-2">
            <span class="svg-icon">
              <i class="fa fa-user"></i>
            </span>
          </span>
            <span class="navi-text font-size-lg">{{__('site.Account Information')}}</span>
          </a>
        </div>

        @if(auth()->user()->rule === 'admin')
        <div class="navi-item mb-2">
          <a href="{{route('admin.accounts.index')}}"
          class="navi-link py-4 {{ active_nav('accounts.index') ? 'active' : ''}}">
            <span class="navi-icon mr-2">
              <span class="svg-icon">
                <i class="fa fa-users"></i>
              </span>
            </span>
            <span class="navi-text font-size-lg">{{__('site.Accounts')}}</span>
          </a>
        </div>

        <div class="navi-item mb-2">
          <a href="{{route('admin.currencies.index')}}"
          class="navi-link py-4 {{ active_nav('currencies.index') ? 'active' : ''}}">
            <span class="navi-icon mr-2">
              <span class="svg-icon">
                <i class="la la-money-bill"></i>
              </span>
            </span>
            <span class="navi-text font-size-lg">{{__('site.Currencies')}}</span>
          </a>
        </div>

        <div class="navi-item mb-2">
          <a href="{{route('admin.notofications.index')}}"
          class="navi-link py-4 {{ active_nav('notofications.index') ? 'active' : ''}}">
            <span class="navi-icon mr-2">
              <span class="svg-icon">
                <span class="flaticon-alert"></span>
              </span>
            </span>
            <span class="navi-text font-size-lg">{{__('site.notofications')}}</span>
          </a>
        </div>

        <div class="navi-item mb-2">
          <a href="{{route('admin.projects.index')}}"
          class="navi-link py-4 {{ active_nav('projects.index') ? 'active' : ''}}">
            <span class="navi-icon mr-2">
              <span class="svg-icon">
                <i class="fa fa-sitemap"></i>
              </span>
            </span>
            <span class="navi-text font-size-lg">{{__('site.Projects')}}</span>
          </a>
        </div>

        <div class="navi-item mb-2">
          <a href="{{route('admin.last-miles.index')}}"
          class="navi-link py-4 {{ active_nav('last-miles.index') ? 'active' : ''}}">
            <span class="navi-icon mr-2">
              <span class="svg-icon">
                <i class="fas fa-location-arrow"></i>
              </span>
            </span>
            <span class="navi-text font-size-lg">{{__('site.Last Miles')}}</span>
          </a>
        </div>
        
        <div class="navi-item mb-2">
          <a href="{{route('admin.campaigns.index')}}"
          class="navi-link py-4 {{ active_nav('campaigns.index') ? 'active' : ''}}">
            <span class="navi-icon mr-2">
              <span class="svg-icon">
                <i class="fas fa-headset"></i>
              </span>
            </span>
            <span class="navi-text font-size-lg">{{__('site.campaign')}}</span>
          </a>
        </div>
        <div class="navi-item mb-2">
          <a href="{{route('admin.sources.index')}}"
          class="navi-link py-4 {{ active_nav('sources.index') ? 'active' : ''}}">
            <span class="navi-icon mr-2">
              <span class="svg-icon">
                <i class="fas fa-align-justify"></i>
              </span>
            </span>
            <span class="navi-text font-size-lg">{{__('site.source')}}</span>
          </a>
        </div>
        <div class="navi-item mb-2">
          <a href="{{route('admin.mediums.index')}}"
          class="navi-link py-4 {{ active_nav('mediums.index') ? 'active' : ''}}">
            <span class="navi-icon mr-2">
              <span class="svg-icon">
                <i class="fab fa-medium"></i>
              </span>
            </span>
            <span class="navi-text font-size-lg">{{__('site.medium')}}</span>
          </a>
        </div>
        <div class="navi-item mb-2">
          <a href="{{route('admin.contents.index')}}"
          class="navi-link py-4 {{ active_nav('contents.index') ? 'active' : ''}}">
            <span class="navi-icon mr-2">
              <span class="svg-icon">
                <i class="fas fa-network-wired"></i>
              </span>
            </span>
            <span class="navi-text font-size-lg">{{__('site.content')}}</span>
          </a>
        </div>
        
        
        
        
        <div class="navi-item mb-2">
          <a href="{{route('admin.status.index')}}"
          class="navi-link py-4 {{ active_nav('status.index') ? 'active' : ''}}">
            <span class="navi-icon mr-2">
              <span class="svg-icon">
                <i class="fas fa-thermometer-three-quarters"></i>
              </span>
            </span>
            <span class="navi-text font-size-lg">{{__('site.Status')}}</span>
          </a>
        </div>
        <div class="navi-item mb-2">
          <a href="{{route('admin.purposetype.index')}}"
          class="navi-link py-4 {{ active_nav('purposetype.index') ? 'active' : ''}}">
            <span class="navi-icon mr-2">
              <span class="svg-icon">
                <i class="fab fa-superpowers"></i>
              </span>
            </span>
            <span class="navi-text font-size-lg">{{__('site.Purpose Types')}}</span>
          </a>
        </div><div class="navi-item mb-2">
          <a href="{{route('admin.settings.index')}}"
          class="navi-link py-4 {{ active_nav('settings') ? 'active' : ''}}">
            <span class="navi-icon mr-2">
              <span class="svg-icon">
                <i class="fa fa-cog"></i>
              </span>
            </span>
            <span class="navi-text font-size-lg">{{__('site.target')}}</span>
          </a>
        </div>
        @endif

        <div class="navi-item mb-2">
          <a  href="{{ route('logout') }}"
          onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"
          class="navi-link py-4">
            <span class="navi-icon mr-2">
              <span class="svg-icon">
               <i class="fas fa-door-open"></i>
              </span>
            </span>
            <span class="navi-text font-size-lg">{{__('site.Sign Out')}}</span>
          </a>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

      </div>
      <!--end::Nav-->
    </div>
    <!--end::Body-->
  </div>
  <!--end::Profile Card-->
</div>
