<!-- First you need to extend the CB layout -->
@extends('crudbooster::admin_template')
@push('head')
    <script type="text/javascript"></script>
@endpush
@section('content')
<!-- Your custom  HTML goes here -->
<table id="lapawas" class="display" style="width:100%">
  <thead>
      <tr>
        <th>No</th>
        <th>No. Laporan</th>
        <th>Nama Keg. Pengawasan</th>
        <th>Aktivitas</th>
       </tr>
  </thead>
  <tbody>
    @foreach($result as $row)
      <tr>
        <td></td>
        <td>{{$row->no_lap}}</td>
        <td>{{$row->nama_giat_was}}</td>
        <td>
          <!-- To make sure we have read access, wee need to validate the privilege -->
          @if(CRUDBooster::isUpdate() && $button_edit)
          <a class='btn btn-success btn-sm' href='{{CRUDBooster::mainpath("edit/$row->id")}}'>Edit</a>
          @endif
          
          @if(CRUDBooster::isDelete() && $button_edit)
          <a class='btn btn-success btn-sm' href='{{CRUDBooster::mainpath("delete/$row->id")}}'>Delete</a>
          @endif
        </td>
       </tr>
    @endforeach
  </tbody>
</table>

<!-- ADD A PAGINATION -->
<p>{!! urldecode(str_replace("/?","?",$result->appends(Request::all())->render())) !!}</p>
@endsection