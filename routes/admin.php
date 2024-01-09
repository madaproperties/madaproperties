<?php

use App\Status;

// Admin Protected Area
Route::group(['prefix' => '','as' => 'admin.','middleware' => ['auth','lang']], function (){
      // account
      Route::resource('account','AccountController');
      /*********** Manger Onley *****************************/
      // accounts
      Route::group(['middleware' => 'manger'], function (){
        Route::resource('accounts','AccountsController');
        Route::resource('projects','ProjectsController');
        Route::resource('last-miles','LastMileConversionController');
        Route::resource('status','StatusController');
        Route::resource('currencies','CurrencyController');
        Route::resource('purposetype','PurposeTypeController');
        Route::resource('campaigns','CampaignsController');
        Route::resource('sources','SourcesController');
        Route::resource('mediums','MediumsController');
        Route::resource('contents','ContentsController');
        Route::resource('secondary','SecondaryController');
        //
         Route::resource('employee','EmployeeController');
        Route::resource('leave','LeaveController');
        Route::resource('dateinfo','DateinfoController');
        Route::resource('employeeleave','EmployeeLeaveController');
        Route::get('dashboard','MainController@statics')->name('statics');
        Route::resource('madaboard','MadaboardController'); //added byb fazal 18-06-23
        Route::post('accounts/getDetailsByAjax','AccountsController@getDetailsByAjax')->name('accounts.getDetailsByAjax');

        Route::get('commercial-leads/detail/{id}','CommercialController@detail')->name('commercial-leads.detail');
        Route::resource('commercial-leads','CommercialController');
        
      });
      Route::post('commercial-leads/multiple-assign','CommercialController@multiple_assign')
      ->name('commercial-leads.multiple-assign');
      Route::post('commercial-leads/multiple-delete','CommercialController@multiple_delete')
      ->name('commercial-leads.multiple-delete');


      /********* End Mnager Only ***************************/
      Route::resource('contact','ContactController');
      Route::post('contact/multiple-assign','ContactController@multiple_assign')
      ->name('contacts.multiple-assign');

      Route::post('get-cities','ContactController@getCities')->name('get.cities');
      // TasksDashboardPage
      Route::resource('tasks','TasksController');
      // NotesDashboardPage
      Route::resource('note','NotesController');
      // logs , admin.getlog
      Route::resource('logs','LogsController');
      Route::post('logs/get','LogsController@get_log')->name('getlog');
      // meeting
      // Route::resource('meeting','MeetingsController');
      // notofications


      // CommercialTasksDashboardPage
      Route::resource('commercial_tasks','CommercialTasksController');
      // CommercialNotesDashboardPage
      Route::resource('commercial_note','CommercialNotesController');
      // CommercialLogsController , admin.getlog
      Route::resource('commercial_logs','CommercialLogsController');
      Route::resource('requirements','CommercialRequirementsController');
      Route::post('commercial_logs/get','CommercialLogsController@get_log')->name('getlog');      
      Route::get('getDistricts', 'CommercialController@getDistricts')->name('requirements.getDistricts');


      Route::resource('notofications','NotoficationsController');
      Route::get('notofications/switch/{id}','NotoficationsController@switch')
                    ->name('notofications.switch');
      // clender
      Route::get('calendar','CalendarController@index')->name('calendar');
      // importData
      Route::post('import-data','ImportDataController@import')->name('importData');
      // importData
      Route::post('import-commercial-leads-data','ImportCommercialLeadsController@import')->name('importCommercialLeadsData');
      // settings
      Route::resource('settings','SettingsController');
      // Admin/ReportController
      Route::get('reports','ReportController@index')->name('reports');

      // overview
      Route::resource('overview','OverviewController');
      // mainDashboardPage

      Route::post('get-projects','ProjectsController@getProjects')
                        ->name('get.projects');


      Route::get('home', "MainController@index")->name('home');


      Route::get('/', function (){
          if(auth()->user()->rule == 'admin')
          {
            return redirect(route('admin.statics'));
          }else{
              $newStatus = Status::where('name_en','new')->first();
              return redirect(route('admin.home') .'?filter_status='.$newStatus->id);
          }
      });

      //Added by Javed
      Route::post('contact/multiple-delete','ContactController@multiple_delete')
      ->name('contacts.multiple-delete');

      // overview
      Route::resource('deal','DealController');
      // mainDashboardPage
      Route::get('deal/print/{id}','DealController@print')
                        ->name('deal.print');
      Route::get('deal/printBill/{id}','DealController@printBill')
                        ->name('deal.printBill');

      Route::resource('deal_project','DealProjectController');
      Route::post('get-dealprojects','DealProjectController@getDealProjects')
                        ->name('get.dealprojects');

      Route::get('advanceExport','DealController@advanceExport')->name('deal.advanceExport');

      Route::resource('cash','CashController');

      Route::resource('deal-developer','DealDeveloperController');
      Route::post('get-dealdevelopers','DealDeveloperController@getDealDevelopers')
                        ->name('get.dealdevelopers');

      Route::resource('roles', RoleController::class);        
      
      Route::get('exportDataDeals','DealController@exportDataDeals')->name('deal.exportDataDeals');
      Route::get('exportDataDeveloper','DealDeveloperController@exportDataDeveloper')->name('deal-developer.exportDataDeveloper');
      Route::get('exportDataDealProject','DealProjectController@exportDataDealProject')->name('deal-project.exportDataDealProject');
      Route::get('exportDataCash','CashController@exportDataCash')->name('cash.exportDataCash');
      Route::get('exportDataContact','MainController@exportDataContact')->name('contact.exportDataContact');

      //Added by javed on 24-05-2022
      Route::resource('project-data', ProjectDataController::class);        

      Route::get('users-report','ReportController@reportUsers')->name('users-report');
      Route::get('daily-report','ReportController@reportDaily')->name('daily-report');
      Route::get('campaign-report','ReportController@reportCampaing')->name('campaign-report');
      Route::get('campaign-analytics-report','ReportController@reportCampaingAnalytics')->name('campaign-analytics-report');
      Route::get('leaders-report','ReportController@reportLeaders')->name('leaders-report');



      Route::resource('advance-campaign-report', AdvanceCampaignReportController::class);        


      Route::resource('project-name', ProjectNameController::class);        
      Route::resource('project-developer', ProjectDeveloperController::class);        

      Route::get('exportProjectData','ProjectDataController@exportProjectData')->name('project-data.exportProjectData');

      Route::get('update-old-date','CalendarController@updateOldDate')->name('update-old-date');

      Route::post('storeReportAdvanceCampaing','ReportController@storeReportAdvanceCampaing')->name('storeReportAdvanceCampaing');

      Route::resource('database-records', DatabaseRecordsController::class);        
      Route::get('exportDatabaseRecords','DatabaseRecordsController@exportDatabaseRecords')->name('database-records.exportDatabaseRecords');
      Route::post('database/multiple-assign','DatabaseRecordsController@multiple_assign')->name('database.multiple-assign');
      // NotesDashboardPage
      Route::resource('database-note','DatabaseNotesController');
      
      Route::resource('history','HistoryController');

      Route::get('report-getUsers','ReportController@getUsers')->name('report.getUsers');

      // importData
      Route::post('project-import-data','ProjectDataController@import')->name('projectImportData');
      Route::post('database-import-data','DatabaseRecordsController@import')->name('databaseImportData');
      
      // importData
      Route::resource('property','PropertyController');


      Route::post('image/upload/store','PropertyController@imageStore')->name('property.imageStore');
      Route::post('image/delete','PropertyController@imageDestroy')->name('property.imageDestroy');      
      Route::get('image/get-project-image','PropertyController@getPropertyImages')->name('property.getPropertyImages');      

      Route::post('document/upload/store','PropertyController@documentStore')->name('property.documentStore');
      Route::post('document/delete','PropertyController@documentDestroy')->name('property.documentDestroy');      

      Route::post('property/save-features','PropertyController@saveFeatures')->name('property.saveFeatures');
      Route::post('property/save-portals','PropertyController@savePortals')->name('property.savePortals');
      // added by fazl
       Route::post('fetch-project', 'ReportController@fetchProject')->name('fetch-project');
      Route::post('fetch-agent', 'ReportController@fetchAgent')->name('fetch-agent');
      // end
      Route::resource('features','FeaturesController');
      // added by fazal
      Route::get('secondaryprojects','SecondaryController@index')->name('secondary-project.index');
      Route::get('secondaryprojectscreate','SecondaryController@create')->name('secondary-create');
      Route::post('fetch-district', 'SecondaryController@fetchDistrict')->name('fetch-project');
      Route::post('secondary/upload/store','SecondaryController@imageStore')->name('secondary.imageStore');
      Route::post('delete-floorplan', 'SecondaryController@deleteFloorplan')->name('delete-floorplan');
      Route::post('delete-images', 'SecondaryController@deleteImages')->name('delete-images');
      Route::get('getSubCommunityUrl', 'PropertyController@getSubCommunityUrl')->name('property.getSubCommunityUrl');
      
      //added by fazal
      Route::post('fetch-city', 'DatabaseRecordsController@fetchCity')->name('fetch-city');
      Route::post('databasefetch-district', 'DatabaseRecordsController@fetchDistrict')->name('databasefetch-project');
      Route::post('databasefetch-subcommunity', 'DatabaseRecordsController@fetchCommunity')->name('databasefetch-subcommunity'); 

       
    Route::post('property.imgreorder', 'PropertyController@imgReorder')->name('property.imgreorder'); 
       Route::resource('bookings','BookingsController');
    
      Route::post('floor-plan/upload/store','PropertyController@floorPlanStore')->name('property.floorPlanStore');
      Route::post('floor-plan/delete','PropertyController@floorPlanDestroy')->name('property.floorPlanDestroy');      
      
        //added by fazal 16/05/23
        Route::post('contactsfetch-community', 'ContactController@fetchCommunities')->name('contactsfetch-community');
        Route::post('contactsfetch-subcommunity', 'ContactController@fetchSubCommunities')->name('contactsfetch-subcommunity');
        Route::post('contactsfetch-zone', 'ContactController@fetchZones')->name('contactsfetch-zone');
        Route::post('contactsfetch-district', 'ContactController@fetchDistricts')->name('contactsfetch-district');
        //End      
        
    //Added by fazal 24-05-23
    Route::post('fetch-campaign', 'ReportController@fetchCampaign')->name('fetch-campaign');
    //End      
        
       // added by fazal 29-03
      Route::get('employee/employeedetails/{employee_id}','EmployeeController@employeeDetails')->name('employee.empdetails');
      
      Route::get('employee/employeeleave','EmployeeController@update')->name('employee.leaveshow');
      Route::get('hr/notification','EmployeeController@Notification')->name('hr.notification');
      Route::post('change-status', 'EmployeeController@changeStatus')->name('change-status');
      Route::get('exportEmployeeRecords','EmployeeController@exportEmployeeData')->name('employee.exportRecords');
      Route::post('emp-import-data','EmployeeController@import')->name('emp-importData');
      

      Route::post('deal-document-upload', 'DealDocumentsController@upload')->name('deal-document-upload');
      Route::get('deal-project-list', 'DealDocumentsListController@index')->name('deal-project-list');
      Route::get('deals-list/{project_id}', 'DealDocumentsListController@dealsList')->name('deals-list');
      Route::get('deal-documents-list/{deal_id}', 'DealDocumentsListController@dealDocumentsList')->name('deal-documents-list');
      
      Route::get('property-availability', 'PropertyAvailabilityController@index')->name('property-availability');

      Route::resource('lead-pool','LeadPoolController');
      Route::post('lead-pool/multiple-assign','LeadPoolController@multiple_assign')->name('leadpool.multiple-assign');

      Route::post('deal/getDocumentByAjax','DealController@getDocumentByAjax')->name('deal.getDocumentByAjax');
      
      Route::get('userStatusReport','ReportExportController@index')->name('report.userStatusReport');

});


