<!DOCTYPE html>
<html>
<head>
<title>Employee Profile</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
.blink_me {
  animation: blinker 1s linear infinite;
}
@keyframes blinker {
  50% {
    opacity: 0;
  }

</style>
</head>
@extends('admin.layouts.main')
@section('content')
<body class="w3-light-grey">

<!-- Page Container -->
<!-- <div class="w3-content w3-margin-top" style="max-width:1400px;"> -->
<div class="w3-margin-top" style="max-width:1400px;">
  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="{{ asset('public/uploads/employee/'.$employee->photo)}}" style="width:100%" alt="Avatar">
                    <div class="w3-display-bottomleft w3-container w3-text-black">
            <h2>{{$employee->employee_name}}</h2>
          </div>
        </div>
        <div class="w3-container">
          <p><i class=" fa-fw w3-margin-right w3-large w3-text-teal"></i>Employee No : {{$employee->emp_no}}</p>
          <p><i class="fa-fw w3-margin-right w3-large w3-text-teal"></i>Location : {{$employee->location}}</p>
          <p><i class="fa-fw w3-margin-right w3-large w3-text-teal"></i> Email : {{$employee->official_email}}</p>
          <p><i class="fa-fw w3-margin-right w3-large w3-text-teal"></i>Phone : {{$employee->phone}}</p>
          <div class="w3-light-grey w3-round-xlarge w3-small">
          </div>
         
        </div>
      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    
       <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"></h2>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Personel Details</b></h5>
          <hr>
          
          <p>Phone :{{$employee->alternative_phone}}</p>
          <p>Email :{{$employee->personel_email}}</p>
          <p>Nationality :{{$employee->nationality}}</p>
          <p>Date of Birth :{{$employee->date_of_birth}}</p>
          <p>Passport :{{$employee->passport_no}}</p>
          <p>Passport issue :{{$employee->passport_issue}}</p>
          <p>Passport exp :{{$employee->passport_exp}}</p>

        </div>
        <div class="w3-container">
          <h5 class="w3-opacity"><b>Job Details</b></h5>
          <hr>
          
          <p>Designation :{{$employee->designation}}</p>
          <p>Reporting Manager :{{$employee->reporting_manager}}</p>
          <p>Date of join :{{$employee->date_of_join}}</p>
          <p>Visa status :{{$employee->visa_status}}</p>
          <p>Visa issue date :{{$employee->visa_issue}}</p>
          <p>Visa issue date :{{$employee->visa_exp}}</p>
          @if($employee->emirates_id)
          <p>Emirates ID :{{$employee->emirates_id}}</p>
          <p>Emirates ID issue :{{$employee->emirates_id_issue}}</p>
          <p>Emirates ID issue :{{$employee->emiratesid_exp}}</p>
          @endif
          @if($employee->labour_card)
          <p>Labour card :{{$employee->labour_card}}</p>
          <p>Labour card :{{$employee->labourcard_issue}}</p>
          @endif

        </div>
        @if($days <= 30)
        <div class="w3-container">
          <div class="blink_me"><p style="color: red;">{{$employee->employee_name}}'s passport will expire in {{$days}}</p></div>
          
        </div>
        @endif
        
      </div>
     <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>
</body>
</html>
@endsection
