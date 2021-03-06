@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ ucwords($agent->first_name) }} {{ ucwords($agent->last_name) }}'s Commissions
                    <a class="add-button" href="{{ URL::to('admin/agents') }}">Back To Agents</a>
                    <a class="add-button" href="{{ URL::to('admin/give_commission/'.$agent->id) }}" style="margin-right:10px;">Modify Commission</a>
                    <a class="add-button" href="{{ URL::to('admin/give_commission/'.$agent->id) }}" style="margin-right:10px;">Current Earnings: {{ number_format($agent->earnings,2) }}</a>
                </h3>
                <style type="text/css">.DTTT_button { display: none !important; }</style>
            </div>
            <div class="panel-body">
                @include('layouts.notifications')
                <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="xdatatable" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Model Number</th>
                        <th>Client</th>
                        <th>Created</th>
                        <th>Amount</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($commissions as $commission)
                    <tr>
                        <td>{{ $commission->id }}</td>
                        <td>
                            @if($commission->property)
                            {{ strtoupper($commission->property->model_number) }}
                            @endif
                        </td>
                        <td>
                            @if($commission->user)
                            {{ ucwords($commission->user->first_name) }} {{ ucwords($commission->user->last_name) }}
                            @endif
                        </td>
                        <td>{{ $commission->created_at->format("F j,Y") }}</td>
                        <td>{{ number_format($commission->amount,2) }}</td>
                        <td>
                            {{ $commission->action }}
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
