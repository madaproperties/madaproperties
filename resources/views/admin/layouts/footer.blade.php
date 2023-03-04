

  <!--end::Footer-->

  </div>

  <!--end::Wrapper-->

  </div>

  <!--end::Page-->

  </div>

  <!--end::Main-->

  <!-- begin::User Panel-->



  <!-- end::User Panel-->







  </div>

  <!--end::Quick Panel-->



  <!--begin::Scrolltop-->

  <div id="kt_scrolltop" class="scrolltop">

  <span class="svg-icon">

  <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->

  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">

  <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">

    <polygon points="0 0 24 0 24 24 0 24" />

    <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />

    <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />

  </g>

  </svg>

  <!--end::Svg Icon-->

  </span>

  </div>

  <!--end::Scrolltop-->

  <!--begin::Demo Panel-->

  <div id="kt_demo_panel" class="offcanvas offcanvas-right p-10">

  <!--begin::Header-->

  <div class="offcanvas-header d-flex align-items-center justify-content-between pb-7">

  <h4 class="font-weight-bold m-0">Select A Demo</h4>

  <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_demo_panel_close">

  <i class="ki ki-close icon-xs text-muted"></i>

  </a>

  </div>

  <!--end::Header-->



  </div>
</div>
</div>

  <!-- Modal -->
  @if(isset($sellers))
  <div class="modal fade" id="assign-leads" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Assign</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="exampleFormControlSelect1">users</label>
            <select class="form-control" id="assigned-seller" name="seller">
              @foreach($sellers as $seller)
              <option value="{{$seller->id}}">{{$seller->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button style="margin: 5px;" class="btn btn-info btn-xs assign-all" data-url="">
          Assign
          </button>
        </div>
      </div>
    </div>
  </div>
  @endif
  <div class="modal fade" id="getPupUpByAjax" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>

  </div>
  <!--end::Demo Panel-->
<div class="modal fade" id="assign-leads" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"></div>

  
  <!--begin::Global Config(global config for global JS scripts)-->

  <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>

  <!--end::Global Config-->

  <!--begin::Global Theme Bundle(used by all pages)-->

  <script src="{{ asset('public/assets/plugins/global/plugins.bundle.js') }}"></script>
  <script src="{{ asset('public/plugins/select2/js/select2.js') }}"></script>

  <script src="{{ asset('public/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>

  <script src="{{ asset('public/assets/js/scripts.bundle.js') }}"></script>

  

  <!--end::Global Theme Bundle-->

  <!--begin::Page Vendors(used by this page)-->

  <script src="{{ asset('public/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>

  <!--end::Page Vendors-->

  <!--begin::Page Scripts(used by this page)-->

  <script src="{{ asset('public/assets/js/pages/widgets.js') }}"></script>

  <!--end::Page Scripts-->

  <script>

  

    $(document).on('submit','.delete-from',function (e){



        return confirm("{{__('site.confirm')}}");

        

    });

    

	@if(!isset($copyEnable))



    document.addEventListener("copy", function(evt){

  // Change the copied text if you want

  evt.clipboardData.setData("text/plain", "");

 

  // Prevent the default copy action

  evt.preventDefault();

}, false);

@endif

    $("form").submit(function(){

      $("#loadingHolder").show();
      setTimeout(function () {
        $("#loadingHolder").hide();
      }, 3000);

    });
  </script>





  @stack('js')



</body>

<!--end::Body-->

</html>

