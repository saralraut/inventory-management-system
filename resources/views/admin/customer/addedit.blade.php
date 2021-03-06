@extends('admin.includes.admin_design')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <div class="d-flex align-items-center justify-content-between">
                </div>
                <a href="{{ route('customer.index') }}"
                    class="btn btn-primary btn-sm d-flex align-items-center justify-content-between ml-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="ml-2">Back</span>
                </a>
            </div>
        </div>
        @include('admin.includes._message')
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body" id="dropzone">
                    <h5 class="font-weight-bold mb-3">Customer Information</h5>
                    <form class=" row g-3" method="post" action="{{ route('customer.store') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id" name="id" value="">
                        <div class="col-md-6 mb-3">
                            <label for="fname" class="form-label font-weight-bold text-muted text-uppercase">First
                                Name</label>
                            <input type="text" class="form-control" id="fname" name="fname"
                                value="{{ isset($detail) ? $detail->firstname : old('fname') }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lname" class="form-label font-weight-bold text-muted text-uppercase">Last
                                Name</label>
                            <input type="text" class="form-control" id="lname" name="lname"
                                value="{{ isset($detail) ? $detail->lastname : '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label font-weight-bold text-muted text-uppercase">E-Mail</label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ isset($detail) ? $detail->email : '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone_number" class="form-label font-weight-bold text-muted text-uppercase">Phone
                                Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                value="{{ isset($detail) ? $detail->phone_number : '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="address"
                                class="form-label font-weight-bold text-muted text-uppercase">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ isset($detail) ? $detail->address : '' }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="group" class="form-label font-weight-bold text-muted text-uppercase">Group</label>
                            <select id="group" class="form-select form-control choicesjs" name="group">
                                @if (request()->id) {
                                    <option value="{{ isset($detail) ? $detail->group_id : '' }}">
                                        {{ isset($detail) ? $detail->group->name : '' }}</option>
                                    @foreach ($group as $val)
                                        <option value="{{ $val['id'] }}">{{ $val['name'] }}</option>
                                    @endforeach
                                    }
                                @else {
                                    <option value="">Select</option>
                                    @foreach ($group as $val)
                                        <option value="{{ $val['id'] }}">{{ $val['name'] }}</option>
                                    @endforeach
                                    }
                                @endif
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <button type="submit" class="btn btn-primary" id="submitForm">
                                @if (request()->id)
                                    Edit Customer Detail
                                @else
                                    Create Customer
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
