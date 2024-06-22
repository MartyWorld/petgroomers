@extends('admin.layouts.app')
@section('content')

    <div class="content-page rtl-page" style="margin-left: 0">
        <div class="container-fluid">
                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            @if (\Session::has('successes'))
                                <div class="alert alert-success" style="border-radius:  0">
                                    <ul style="margin: 0; padding-left: 10px">
                                        <li>{!! \Session::get('successes') !!}</li>
                                    </ul>
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger" style="border-radius:  0">
                                    <ul style="margin: 0; padding-left: 10px">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if(session()->has('message'))
                                <div class="alert alert-success" style="border-radius:  0">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <div class="card-header d-flex justify-content-between">
                                <div class="row" style="width: 100%">
                                    <div class="col-6">
                                        <div class="header-title">
                                            <h4 class="card-title">Pet Records</h4>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-primary mt-2" style="float: right" data-toggle="modal" data-target=".bd-example-modal-lg">Add Records</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-striped table-bordered" >
                                        <thead>
                                        <tr>
                                            <th>PetName</th>
                                            <th>Payment Status</th>
                                            <th>Locker Name</th>
                                            <th>Weight</th>
                                            <th>check In</th>
                                            <th>check Out</th>
                                            <th>dueAmount</th>
                                            <th>Description</th>
                                            <th>Instruction</th>
                                            <th>Status</th>
                                            <th>Created_at</th>
                                            <th>Action</th>
{{--                                            <th>Update/Report</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($records as $value)
                                            <tr>
                                                <td>PT#{{$value['id']}}-{{$value['petName']}}</td>
                                                <td>{{$value['paymentStatus']}}</td>
                                                <td>{{$value['locker']['LockerName']}}</td>
                                                <td>{{$value['weight']['planName']}}</td>
                                                <td>{{$value['checkIn']}}</td>
                                                <td>{{$value['checkOut']}}</td>
                                                <td>${{number_format($value['dueAmount'],2,'.',',')}}</td>

                                                <td>{{$value['description']}}</td>
                                                <td>{{$value['instructions']}}</td>
                                                <td>
                                                    <span class="badge  {{$value['status'] == 'checkIn' ? 'badge-success' : 'badge-danger'}}">{{$value['status']}}</span>
                                                </td>
                                                <td>{{date('Y-m-d H:i:s',strtotime($value['created_at']))}}</td>
                                                <td>
                                                    @if($value['status'] == 'checkIn')
                                                        <a href="{{route('updateStatus',['actionType'=>'checkOut','id'=>$value['id']])}}" class="btn btn-success btn-sm" style="margin: 2px">Check Out</a><br>
                                                        <a href="{{route('updateStatus',['actionType'=>'deleted','id'=>$value['id']])}}" class="btn btn-danger btn-sm" style="margin: 2px">Delete</a></td>
                                                @else
                                                    <a href="#" class="btn btn-primary btn-sm" style="margin: 2px">N/A</a><br>
                                                @endif
{{--                                                <td>--}}
{{--                                                    <a href="#" class="btn btn-success btn-sm editReport" id="{{$value['id']}}" style="margin: 2px">Edit</a>--}}
{{--                                                    <a href="#" class="btn btn-primary-dark btn-sm" style="margin: 2px">View</a><br>--}}
{{--                                                </td>--}}
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Pet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="needs-validation" novalidate="" method="POST" action="{{route('addRecords')}}">
                @csrf
                <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="petType">Pet Type</label>
                                <select class="form-control" name="petType" id="petType" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option value="Cat">Cat</option>
                                    <option value="Dog">Dog</option>
                                </select>
                                <div class="invalid-tooltip">
                                    Please select a valid Type.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lockerId">Select Available Locker</label>
                                <select class="form-control" name="lockerId" id="lockerId" required="">
                                    <option selected="" disabled="" value="">Choose...</option>

                                    @foreach($availableLockers as $value)
                                        <option value="{{$value['id']}}">{{$value['LockerName']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">
                                    Please select a valid Type.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="petName">PetName</label>
                                <input type="text" class="form-control" name="petName" id="petName" value="" required="">
                                <div class="valid-tooltip">

                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="days">Duration in Days</label>
                                <input type="number" class="form-control" id="days" name="days" value="" required="">
                                <div class="valid-tooltip">

                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="age">Age</label>
                                <input type="number" class="form-control" id="age" name="age" value="" required="">
                                <div class="valid-tooltip">

                                </div>
                            </div>
{{--                           <div class="col-md-6 mb-3">--}}
{{--                                <label for="weight">Weight in lb</label>--}}
{{--                                <input type="number" class="form-control" id="weight" name="weight" value="" required="">--}}
{{--                                <div class="valid-tooltip">--}}

{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="col-md-6 mb-3">
                                <label for="weight">Weight in lb</label>
                                <select class="form-control" name="weight" id="weight" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    @foreach($pricing as $value)
                                        <option value="{{$value->id}}">{{$value->planName}} ${{$value->price}}.00</option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">
                                    Please select a valid Type.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="paymentStatus">Payment Status</label>
                                <select class="form-control" id="validationTooltip04" name="paymentStatus" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Unpaid</option>
                                </select>
                                <div class="invalid-tooltip">
                                    Please select a valid Status.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="checkInTime">CheckIn Time</label>
                                <input type="datetime-local" class="form-control" id="checkInTime" name="checkInTime" value="" required="">
                                <div class="valid-tooltip">

                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="CheckOut">CheckOut Time</label>
                                <input type="datetime-local" class="form-control" id="CheckOut" name="checkOut" value="" required="">
                                <div class="valid-tooltip">

                                </div>
                            </div>
{{--                            <div class="col-md-6 mb-3" style="visibility: hidden">--}}
{{--                                <label for="dueAmount">TotalDue Amount</label>--}}
{{--                                <input type="number" class="form-control" id="dueAmount" name="dueAmount" value="0" required="">--}}
{{--                                <div class="valid-tooltip">--}}

{{--                                </div>--}}
{{--                            </div>--}}


                            <div class="col-md-6 mb-3"></div>

                            <div class="col-md-6 mb-3">
                                <label for="validationTextarea">Description</label>
                                <textarea class="form-control " name="description" id="validationTextarea" required=""></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Instructions">Instructions</label>
                                <textarea class="form-control " name="instructions" id="Instructions" required=""></textarea>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                </form>

            </div>
        </div>
    </div>
    <div class="modal updateModel" tabindex="-1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Pet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form class="needs-validation" novalidate="" method="POST" action="{{route('addRecords')}}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="col-md-6 mb-3">
                                <label for="petType">Pet Type</label>
                                <select class="form-control" name="petType" id="petType" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option value="Cat">Cat</option>
                                    <option value="Dog">Dog</option>
                                </select>
                                <div class="invalid-tooltip">
                                    Please select a valid Type.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="lockerId">Select Available Locker</label>
                                <select class="form-control" name="lockerId" id="lockerId" required="">
                                    <option selected="" disabled="" value="">Choose...</option>

                                    @foreach($availableLockers as $value)
                                        <option value="{{$value['id']}}">{{$value['LockerName']}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">
                                    Please select a valid Type.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="petName">PetName</label>
                                <input type="text" class="form-control" name="petName" id="petName" value="" required="">
                                <div class="valid-tooltip">

                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="days">Duration in Days</label>
                                <input type="number" class="form-control" id="days" name="days" value="" required="">
                                <div class="valid-tooltip">

                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="age">Age</label>
                                <input type="number" class="form-control" id="age" name="age" value="" required="">
                                <div class="valid-tooltip">

                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="weight">Weight in lb</label>
                                <input type="number" class="form-control" id="weight" name="weight" value="" required="">
                                <div class="valid-tooltip">

                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="weight">Weight in lb</label>
                                <select class="form-control" name="weight" id="weight" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    @foreach($pricing as $value)
                                        <option value="{{$value->id}}">{{$value->planName}}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">
                                    Please select a valid Type.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="checkInTime">CheckIn Time</label>
                                <input type="datetime-local" class="form-control" id="checkInTime" name="checkInTime" value="" required="">
                                <div class="valid-tooltip">

                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="CheckOut">CheckOut Time</label>
                                <input type="datetime-local" class="form-control" id="CheckOut" name="checkOut" value="" required="">
                                <div class="valid-tooltip">

                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="dueAmount">TotalDue Amount</label>
                                <input type="number" class="form-control" id="dueAmount" name="dueAmount" value="" required="">
                                <div class="valid-tooltip">

                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="paymentStatus">Payment Status</label>
                                <select class="form-control" id="validationTooltip04" name="paymentStatus" required="">
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Unpaid</option>
                                </select>
                                <div class="invalid-tooltip">
                                    Please select a valid Status.
                                </div>
                            </div>
                            <div class="col-md-6 mb-3"></div>

                            <div class="col-md-6 mb-3">
                                <label for="validationTextarea">Description</label>
                                <textarea class="form-control " name="description" id="validationTextarea" required=""></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Instructions">Instructions</label>
                                <textarea class="form-control " name="instructions" id="Instructions" required=""></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script>
        $(document).ready(function(){
            $('#datatable').DataTable({
                ordering: true,
                order: [[ 0, "desc" ]],
                aaSorting: [ [0, 'dsc'] ],
                lengthMenu: [[100, 200, 500, 1000], [100, 200, 500, 1000]],
                iDisplayLength: 500,
            });
        });
    </script>
@endpush

