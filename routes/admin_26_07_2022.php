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
        Route::get('dashboard','MainController@statics')->name('statics');
      });
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
      Route::resource('notofications','NotoficationsController');
      Route::get('notofications/switch/{id}','NotoficationsController@switch')
                    ->name('notofications.switch');
      // clender
      Route::get('calendar','CalendarController@index')->name('calendar');
      // importData
      Route::post('import-data','ImportDataController@import')->name('importData');
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

});


