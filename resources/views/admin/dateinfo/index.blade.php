@extends('admin.layouts.main')
@section('content')
<div class="card-body py-0">
					
					<!--begin::Table-->
					<div class="table-responsive">
						<table class="text-center table table-separate table-head-custom table-checkable table-striped" id="kt_advance_table_widget_1">
							<thead>
								<tr>
									<th>{{__('site.name')}}</th>
									<th>{{__('site.document')}}</th>
									<th>{{__('site.issue date')}}</th>
									<th>{{__('site.Exp date')}}</th>
									<th>{{__('site.days remaining')}}</th>
								</tr>
							</thead>
							<tbody>
							@foreach($employees as $employee)
							 <?php
                              $toDate = \Carbon\Carbon::parse($employee->passport_issue);
                              $fromDate = \Carbon\Carbon::parse($employee->passport_exp);
                              $days = $toDate->diffInDays($fromDate);
                              if($days <= 30){
                               ?>
								<tr>
									<td>
										<span class="text-muted font-weight-bold">{{$employee->employee_name}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">Passport</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$employee->passport_issue}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$employee->passport_exp}}</span>
									</td>
									<td>
									<span class="text-muted font-weight-bold">
                                    <?php   
                                     echo($days);
                                      ?>
                                    </span>
									</td>
								</tr>
							<?php }  ?>
								
							 <?php
                              $toDate = \Carbon\Carbon::parse($employee->visa_issue);
                              $fromDate = \Carbon\Carbon::parse($employee->visa_exp);
                              $days = $toDate->diffInDays($fromDate);
                              if($days <= 30){
                               ?>
								<tr>
									<td>
										<span class="text-muted font-weight-bold">{{$employee->employee_name}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">visa</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$employee->visa_issue}}</span>
									</td>
									<td>
										<span class="text-muted font-weight-bold">{{$employee->visa_exp}}</span>
									</td>
									<td>
									<span class="text-muted font-weight-bold">
                                    <?php   
                                     echo($days);
                                      ?>
                                    </span>
									</td>
								</tr>
							<?php }  ?>
								@endforeach


							
							</tbody>
						
						</table>
						
					</div>
@endsection