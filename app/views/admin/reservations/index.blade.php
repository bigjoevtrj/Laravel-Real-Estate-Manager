@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Reservations <a class="add-button" href="{{ URL::to('admin/clients/view/'.$user->id) }}">Back To Account</a></h3>
              <style type="text/css">.DTTT_button { display: none !important; }</style>
            </div>
            <div class="panel-body">
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="xdatatable" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Property(Model Number)</th>
                            <th>Client Name</th>
                            <th>Mobile</th>
                            <th>Terms</th>
                            <th>Unit Type</th>
                            <th>Created At</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservations as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>
                                @if(is_object($p->property))
                                {{ $p->property->model_number }}
                                @endif
                            </td>

                            <td>
                                @if(is_object($p->user))
                                {{ $p->user->first_name }} {{ $p->user->last_name }}
                                @endif
                            </td>
                            <td>
                                @if(is_object($p->user))
                                {{ $p->user->mobile }}
                                @endif
                            </td>


                            <td>{{ ucwords($p->terms) }}</td>
                            <td>{{ ucwords($p->unit_type) }}</td>
                            <td>{{ $p->created_at->format("j F Y") }}</td>
                            <td>
                                <a href="{{ URL::to('admin/clients/reservation') }}/{{ $p->id }}" class="btntable pull-left">View Information</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop
