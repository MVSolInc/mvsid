@extends('layouts.app')

@section('title')
    Edit Manufacturer
@endsection

@section('content')

<h3 class="mt-3">Edit Manufacturer</h3>
<div class="row ">
    <div class="col-12">
        <div class="card component-card_6">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @if($errors->any())
                            <div style="background-color: #FF4C4C"
                                class="alert alert-danger alert-dismissible fade show text-white font-weight-bold"
                                role="alert">
                                <h4>
                                    Please Remove Following Errors to Proceed
                                </h4>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>
                                        {{$error}}
                                    </li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" style="color: black; outline: none" data-dismiss="alert"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <form method="post" action="{{ action('ManufacturerController@update',$manufacturer->id)}}">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="parent_category">
                                  Name
                                  <sup class="text-danger">
                                    <strong>*</strong>
                                 </sup>
                                </label>
                                <input type="text" class="form-control @error('manufacturer_name') is-invalid @enderror" id="name" placeholder="Please Enter Name" name="manufacturer_name" value="{{$manufacturer->manufacturer_name}}" required>
                                @error('manufacturer_name')
                                    <p class="error-field-msg">
                                        <strong class="text-danger">
                                            {{ $message }}
                                        </strong>
                                    </p>
                                @enderror

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="category_name">
                                  Shop Name
                                     <sup class="text-danger">
                                        <strong>*</strong>
                                     </sup>
                                 </label>
                                <input type="text" class="form-control @error('shop_name') is-invalid @enderror" id="shop_name" placeholder="Please Enter Shop Name" name="shop_name" value="{{$manufacturer->shop_name}}" required>
                                @error('shop_name')
                                    <p class="error-field-msg">
                                        <strong class="text-danger">
                                            {{ $message }}
                                        </strong>
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="address">
                                  Address
                                  <sup class="text-danger">
                                    <strong>*</strong>
                                 </sup>
                                </label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" placeholder="Please Enter Address" name="address" value="{{$manufacturer->address}}" required>
                                @error('address')
                                    <p class="error-field-msg">
                                        <strong class="text-danger">
                                            {{ $message }}
                                        </strong>
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="phone_number">
                                 Phone Number
                                     <sup class="text-danger">
                                        <strong>*</strong>
                                     </sup>
                                 </label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" placeholder="Please Enter Phone Number" name="phone_number" value="{{$manufacturer->phone_number}}" required>
                                @error('phone_number')
                                    <p class="error-field-msg">
                                        <strong class="text-danger">
                                            {{ $message }}
                                        </strong>
                                    </p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-6">
                    <button class="btn btn-primary mt-2 float-right">Update</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
