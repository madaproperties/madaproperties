<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Entry-->
<div class="d-flex flex-column-fluid" style="overflow: scroll;">
   <div class="container">
    <table class="table" style="background:#fff">
        {{$campaings->withQueryString()->links()}}
      <thead>
        <tr>
          <th scope="col">Campaing</th>
          <th scope="col">Leads</th>
          <th scope="col">cpl</th>
          <th scope="col">conversion</th>
          <th scope="col">cpc</th>
          <th scope="col">#Cost</th>
        </tr>
      </thead>
      <tbody>
        @foreach($campaings as $campaing)
        <tr>
          <th scope="row">{{$campaing->name}}</th>
          <td>{{$campaing->leadsCount}}</td>
          <td>{{ number_format($campaing->cpl,2) }}$</td>
          <td>{{$campaing->conversion}}</td>
          <td>{{$campaing->cpc}}</td>
          <td>{{ number_format($campaing->cost,2) }}$</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{$campaings->withQueryString()->links()}}
</div>
</div>
</div>
