<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<!--begin::Entry-->
<div class="d-flex flex-column-fluid" style="overflow: scroll;">
   <div class="container">
    <table class="table" style="background:#fff">
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
        @foreach($campaings as $c)
        <tr>
          <th scope="row">{{$c->name}}</th>
          <td>{{$c->leadsCount = \App\Contact::where('campaign','LIKE','%'.$c->name.'%')->count()}}</td>
          <td>{{ number_format((!$c->leadsCount  ? 0 : $c->cost / $c->leadsCount),2) }}$</td>
          @php($c->conversion = \App\Contact::where('status_id',8)->where('campaign',$c->name)->count())
          @if($c->conversion > 0)
            @php($c->cpc  = !$c->cpl ? 0 : $c->cost / $c->conversion)
          @endif
          <td>{{$c->conversion}}</td>
          <td>{{$c->cpc}}</td>
          <td>{{ number_format($c->cost,2) }}$</td>
        </tr>
        @endforeach
      </tbody>
    </table>
</div>
</div>
</div>
