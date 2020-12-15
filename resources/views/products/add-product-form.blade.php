@extends('layouts.app')
@section('css')
<style>
    #barcode-scanner canvas.drawingBuffer,
    #barcode-scanner video.drawingBuffer {
        display: none;
    }

    #barcode-scanner canvas,
    #barcode-scanner video {
        width: 100%;
        height: auto;
    }

    #results {
        margin-left:9px ;
        border: 1px solid;
        width: 100%
    }
    #results img{
        width: 100%;
    }
    #my_camera, #my_camera video{
        width: 250px !important;
        height: 250px !important;
    }
    #camera_upload{
        width: 70%;
    }
</style>
@endsection

@section('title')
    Add Product
@endsection

@section('content')

<h3 class="mt-3">Add Product</h3>
<div class="row ">
    <div class="col-12">
        <div class="card component-card_6">
            @if(Session::has('info'))
                <div style="background-color: #727CF5"
                    class="alert alert-primary alert-dismissible fade show  text-white font-weight-bold" role="alert">
                    {{ Session::get('info') }}
                    <button type="button" class="close" style="color: black; outline: none" data-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
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
                                    @foreach($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" style="color: black; outline: none"
                                    data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
                <form method="post" action="{{ url('/product-store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Select Category</label>
                                <select
                                    class="form-control basic {{ $errors->has('cat_id') ? 'is-invalid': '' }}"
                                    name="cat_id" onchange="onCatSelect(this)" id="cat_id">
                                    <option value="" selected disabled hidden>Choose Category</option>
                                    @foreach($categories as $cat)
                                        <option
                                            {{ old('cat_id')=="$cat->id"?'selected':'' }}
                                            value="{{ $cat->id }}">
                                            {{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('cat_id'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('cat_id') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Select Sub Category</label>
                                <select
                                    class="form-control basic {{ $errors->has('sub_cat_id') ? 'is-invalid': '' }}"
                                    name="sub_cat_id" id="sub_cat_id">
                                    <option value="" selected disabled hidden>Choose Sub Category</option>
                                    {{-- @foreach($categories as $cat)
                                        <option {{ old('sub_cat_id')=="$cat->id"?'selected':'' }}
                                    value="{{ $cat->id }}">
                                    {{ $cat->name }}</option>
                                    @endforeach--}}
                                </select>
                                @if($errors->has('sub_cat_id'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('sub_cat_id') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Select Manufacturer</label>
                                <select name="manuf_id"
                                    class="form-control basic {{ $errors->has('manuf_id') ? 'is-invalid': '' }}">
                                    <option value="">Choose Manufacturer</option>
                                    @foreach($manuf as $item)
                                        <option
                                            {{ old('manuf_id')=="$item->id"?'selected':'' }}
                                            value="{{ $item->id }}">
                                            {{ $item->manufacturer_name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('manuf_id'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('manuf_id') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Select Vendor</label>
                                <select name="vendor_id"
                                    class="form-control basic {{ $errors->has('vendor_id') ? 'is-invalid': '' }}">
                                    <option value="">Choose Vendor</option>
                                    @foreach($vendors as $item)
                                        <option
                                            {{ old('vendor_id')=="$item->id"?'selected':'' }}
                                            value="{{ $item->id }}">
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('vendor_id'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('vendor_id') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Select Store</label>
                                <select name="store_id"
                                    class="form-control basic {{ $errors->has('store_id') ? 'is-invalid': '' }}">
                                    <option value="">Choose Store</option>
                                    @foreach($stores as $item)
                                        <option
                                            {{ old('store_id')=="$item->id"?'selected':'' }}
                                            value="{{ $item->id }}">
                                            {{ $item->store_name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('store_id'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('store_id') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">
                                    Product Code
                                </label>
                                <input type="text"
                                    class="form-control {{ $errors->has('product_code')? 'is-invalid' : '' }}"
                                    id="exampleFormControlInput1" placeholder="Please Enter Product Code" name="product_code"
                                    value="{{ old('product_code') }}">
                                @if($errors->has('product_code'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('product_code') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">
                                    Product Name
                                    <sup class="text-danger">
                                        <strong>*</strong>
                                    </sup>
                                </label>
                                <input required type="text"
                                    class="form-control {{ $errors->has('product_name')? 'is-invalid' : '' }}"
                                    id="exampleFormControlInput1" placeholder="Add Product Name" name="product_name"
                                    value="{{ old('product_name') }}">
                                @if($errors->has('product_name'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('product_name') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">
                                    Product Name 2
                                </label>
                                <input type="text"
                                    class="form-control {{ $errors->has('product_name2')? 'is-invalid' : '' }}"
                                    id="exampleFormControlInput1" placeholder="Add Second Product Name"
                                    name="product_name2" value="{{ old('product_name2') }}">
                                @if($errors->has('product_name2'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('product_name2') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">
                                    Product Barcode
                                    <sup class="text-danger">
                                        <strong>*</strong>
                                    </sup>
                                </label>
                                <input required type="text"
                                    class="form-control {{ $errors->has('barcode')? 'is-invalid' : '' }}"
                                    id="exampleFormControlInput1" placeholder="Barcode" name="barcode"
                                    value="{{ decrypt($barcode) }}">
                                @if($errors->has('barcode'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('barcode') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">
                                    Box Barcode
                                </label>
                                <input type="text"
                                    class="form-control {{ $errors->has('box_barcode')? 'is-invalid' : '' }}"
                                    id="exampleFormControlInput1" placeholder="Box Barcode" name="box_barcode"
                                    value="{{ old('box_barcode') }}">
                                @if($errors->has('box_barcode'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('box_barcode') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Retail Price</label>
                                    <sup class="text-danger">
                                        <strong>*</strong>
                                    </sup>
                                <input required type="text" class="form-control {{$errors->has('retail_price')?'is-invalid':''}}" id="exampleFormControlInput1" placeholder="Add Retail Price" name="retail_price" value="{{old('retail_price')}}">
                                @if($errors->has('retail_price'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('retail_price') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Sale Price</label>
                                <sup class="text-danger">
                                    <strong>*</strong>
                                </sup>
                                <input required name="sale_price" type="text" class="form-control {{$errors->has('sale_price')?'is-invalid':''}}" id="exampleFormControlInput1" placeholder="Add Sale Price" value="{{old('sale_price')}}">
                                @if($errors->has('sale_price'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('sale_price') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Quantity</label>
                                <sup class="text-danger">
                                    <strong>*</strong>
                                </sup>
                                <input required type="number" class="form-control {{ $errors->has('quantity') ? 'is-invalid': ''}}" id="exampleFormControlInput1" placeholder="Add Quantitiy" name="quantity" min="0" value="{{old('quantity')}}">
                                @if($errors->has('quantity'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('quantity') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Size</label>
                                <input type="text"
                                    class="form-control {{ $errors->has('size') ? 'is-invalid': '' }}"
                                    id="exampleFormControlInput1" placeholder="Please Enter Size" name="size"
                                    value="{{ old('size') }}">
                                @if($errors->has('size'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('size') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Cost</label>
                                <input type="text"
                                    class="form-control {{ $errors->has('cost') ? 'is-invalid': '' }}"
                                    id="exampleFormControlInput1" placeholder="Please Enter Cost" name="cost"
                                    value="{{ old('cost') }}">
                                @if($errors->has('cost'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('cost') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Box Cost</label>
                                <input type="text"
                                    class="form-control {{ $errors->has('box_cost') ? 'is-invalid': '' }}"
                                    id="exampleFormControlInput1" placeholder="Please Enter Box Cost" name="box_cost"
                                    value="{{ old('box_cost') }}">
                                @if($errors->has('box_cost'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('box_cost') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Item Cent Per Box</label>
                                <input type="text"
                                    class="form-control {{ $errors->has('item_cnt_per_cost') ? 'is-invalid': '' }}"
                                    id="exampleFormControlInput1" placeholder="Please Enter Item Cent Per Box"
                                    name="item_cnt_per_cost" value="{{ old('item_cnt_per_cost') }}">
                                @if($errors->has('item_cnt_per_cost'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('item_cnt_per_cost') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Deposit Amount</label>
                                <input type="text"
                                    class="form-control {{ $errors->has('deposit_amount') ? 'is-invalid': '' }}"
                                    id="exampleFormControlInput1" placeholder="Please Enter Deposit Amount"
                                    name="deposit_amount" value="{{ old('deposit_amount') }}">
                                @if($errors->has('deposit_amount'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('deposit_amount') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Minimum Stock</label>
                                <input type="text"
                                    class="form-control {{ $errors->has('minimum_stock') ? 'is-invalid': '' }}"
                                    id="exampleFormControlInput1" placeholder="Please Enter Minimum Stock"
                                    name="minimum_stock" value="{{ old('minimum_stock') }}">
                                @if($errors->has('minimum_stock'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('minimum_stock') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Liquore Price</label>
                                <input type="text"
                                    class="form-control {{ $errors->has('liquore_price') ? 'is-invalid': '' }}"
                                    id="exampleFormControlInput1" placeholder="Please Enter Liquore Price"
                                    name="liquore_price" value="{{ old('liquore_price') }}">
                                @if($errors->has('liquore_price'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('liquore_price') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Description</label>
                                <input type="text"
                                    class="form-control {{ $errors->has('description') ? 'is-invalid': '' }}"
                                    id="exampleFormControlInput1" placeholder="Please Enter Description"
                                    name="description" value="{{ old('description') }}">
                                @if($errors->has('description'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('description') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Age Check</label>

                                {{-- <div class="n-chk">
                                    <label class="new-control new-radio radio-primary">
                                        <input type="radio" class="new-control-input" value="1" name="age_check"
                                            {{ old('age_check') == "1"?'checked':'' }}>
                                        <span class="new-control-indicator"></span>Yes
                                    </label>
                                </div>

                                <div class="n-chk">
                                    <label class="new-control new-radio radio-danger">
                                        <input type="radio" class="new-control-input" value="0" name="age_check"
                                            {{ old('age_check') == "0"?'checked':'' }}>
                                        <span class="new-control-indicator"></span>No
                                    </label>
                                </div> --}}

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="age_check1" name="age_check" class="custom-control-input" value="1" {{old('age_check') == "1"?'checked':''}}>
                                    <label class="custom-control-label" for="age_check1">Yes</label>
                                    </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="age_check2" name="age_check" class="custom-control-input" value="0" {{old('age_check') == "0"?'checked':''}}>
                                    <label class="custom-control-label" for="age_check2">No</label>
                                </div>

                                @if($errors->has('age_check'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('age_check') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Scale Product</label>
                                {{-- <div class="n-chk">
                                    <label class="new-control new-radio radio-primary">
                                        <input type="radio" class="new-control-input" value="1" name="scale_product"
                                            {{ old('scale_product') == "1"?'checked':'' }}>
                                        <span class="new-control-indicator"></span>Yes
                                    </label>
                                </div>

                                <div class="n-chk">
                                    <label class="new-control new-radio radio-danger">
                                        <input type="radio" class="new-control-input" value="0" name="scale_product"
                                            {{ old('scale_product') == "0"?'checked':'' }}>
                                        <span class="new-control-indicator"></span>No
                                    </label>
                                </div> --}}

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="scale_product1" name="scale_product" class="custom-control-input" value="1" {{old('scale_product') == "1"?'checked':''}}>
                                    <label class="custom-control-label" for="scale_product1">Yes</label>
                                    </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="scale_product2" name="scale_product" class="custom-control-input" value="0" {{old('scale_product') == "0"?'checked':''}}>
                                    <label class="custom-control-label" for="scale_product2">No</label>
                                </div>

                                @if($errors->has('scale_product'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('scale_product') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Food Stamp</label>

                                {{-- <div class="n-chk">
                                    <label class="new-control new-radio radio-primary">
                                        <input type="radio" class="new-control-input" value="1" name="food_stamp"
                                            {{ old('food_stamp') == "1"?'checked':'' }}>
                                        <span class="new-control-indicator"></span>Yes
                                    </label>
                                </div>

                                <div class="n-chk">
                                    <label class="new-control new-radio radio-danger">
                                        <input type="radio" class="new-control-input" value="0" name="food_stamp"
                                            {{ old('food_stamp') == "0"?'checked':'' }}>
                                        <span class="new-control-indicator"></span>No
                                    </label>
                                </div> --}}

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="food_stamp1" name="food_stamp" class="custom-control-input" value="1" {{old('food_stamp') == "1"?'checked':''}}>
                                    <label class="custom-control-label" for="food_stamp1">Yes</label>
                                    </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="food_stamp2" name="food_stamp" class="custom-control-input" value="0" {{old('food_stamp') == "0"?'checked':''}}>
                                    <label class="custom-control-label" for="food_stamp2">No</label>
                                </div>

                                @if($errors->has('food_stamp'))
                                    <span class="text-danger">
                                        <small
                                            class="font-weight-bold">{{ $errors->first('food_stamp') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="custom-control custom-radio custom-control-inline ">
                                    <input type="radio" id="customRadioInline1" name="customRadioInline1"
                                        class="custom-control-input ml-1">
                                    <label class="custom-control-label" for="customRadioInline1">Upload From
                                        Internet</label>
                                </div>



                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadioInline2" name="customRadioInline1"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="customRadioInline2">Upload From Device</label>
                                </div>

                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="cam_img" name="customRadioInline1"
                                        class="custom-control-input">
                                    <label class="custom-control-label" for="cam_img">Capture Image</label>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div id="internet_img_upload">
                        <div class="form-row">
                            <div class="col-sm-6">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label for="search">Search Image</label>
                                            <input type="text" class="form-control" id="search" name="product_image"
                                                placeholder="Search Image">
                                            <input type="hidden" id="img_src_val" name="image_name">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <a class="btn btn-primary mt-4" id="search_image">Search</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-row">
                                    <div class=" img col-sm-3  ">
                                        <img id="p_image0"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="img col-sm-3 ml-1">
                                        <img id="p_image1"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="img col-sm-3 ml-1">
                                        <img id="p_image2"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <div class="form-row">
                                    <div class="col-sm-3 img">
                                        <img id="p_image3"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image4"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image5"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                        <a class="btn btn-primary btn-sm float-right" id="img_btn1">More Images </a>
                            </div>
                        </div>

                    <div id="img_row2" >

                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <div class="form-row">
                                    <div class="col-sm-3 img">
                                        <img id="p_image6"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image7"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image8"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <div class="form-row">
                                    <div class="col-sm-3 img">
                                        <img id="p_image9"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image10"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image11"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                        <a class="btn btn-primary btn-sm float-right" id="img_btn2">More Images </a>
                            </div>
                        </div>

                    </div>

                    <div id="img_row3" >

                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <div class="form-row">
                                    <div class="col-sm-3 img">
                                        <img id="p_image12"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image13"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image14"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <div class="form-row">
                                    <div class="col-sm-3 img">
                                        <img id="p_image15"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image16"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image17"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                        <a class="btn btn-primary btn-sm float-right" id="img_btn3">More Images </a>
                            </div>
                        </div>

                    </div>

                    <div id="img_row4" >

                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <div class="form-row">
                                    <div class="col-sm-3 img">
                                        <img id="p_image18"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image19"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image20"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <div class="form-row">
                                    <div class="col-sm-3 img">
                                        <img id="p_image21"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image22"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image23"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                        <a class="btn btn-primary btn-sm float-right" id="img_btn4">More Images </a>
                            </div>
                        </div>

                    </div>

                    <div id="img_row5" >

                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <div class="form-row">
                                    <div class="col-sm-3 img">
                                        <img id="p_image24"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image25"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image26"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <div class="form-row">
                                    <div class="col-sm-3 img">
                                        <img id="p_image27"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image28"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                    <div class="col-sm-3 ml-1 img">
                                        <img id="p_image29"
                                            src="{{ asset('dashboard_assets/images/profile-17.jpg') }}"
                                            height="100px" width="100px">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    </div>

                    <div class="row" id="img_upload">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="custom-file-container" data-upload-id="myFirstImage">
                                    <label>Upload (Single File) <a href="javascript:void(0)"
                                            class="custom-file-container__image-clear" title="Clear Image">x</a></label>
                                    <label class="custom-file-container__custom-file">
                                        <input type="file" accept="image/*" name="device_image" capture="camera"
                                            class="custom-file-container__custom-file__custom-file-input" />
                                        <!-- <input type="file" class="custom-file-container__custom-file__custom-file-input" accept="image/*"> -->
                                        <span class="custom-file-container__custom-file__custom-file-control"></span>
                                    </label>
                                    <div class="custom-file-container__image-preview"></div>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div id="camera_upload" class="mb-3">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div id="my_camera"></div>
                                <br />
                                <input type=button class="btn btn-primary float-right" value="Take Snapshot" onClick="take_snapshot()">
                                <input type="hidden" name="image" class="image-tag">
                            </div>

                        </div>
                        <div class="form-row mt-3">
                            <div class="col-md-6">
                                <div id="results" class="">Your captured image will appear here...</div>
                            </div>

                        </div>
                    </div>


            </div>

            <div class="form-row mt-2 ">
                <div class="col-sm-6 ">
                    <button class="btn btn-primary float-right">Submit</button>
                </div>
            </div>

            </form>
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')
<script>
    $(function () {
        $("input[name=product_name]").change(function () {
            $("#search").val($(this).val());
        });

    });
    Webcam.set({
        width: 490,
        height: 390,
        image_format: 'jpeg',
        jpeg_quality: 90,


    });
    Webcam.set('constraints',{
        facingMode: "environment"
    });

    // Webcam.set('constraints',{
    //     facingMode: "environment"
    // });
    // var constraints = {
    //     audio: true,
    //     video: {
    //         facingMode: 'environment'
    //     }
    // }

    var ss = $(".basic").select2({
        tags: true,
    });

    $("#img_row2").hide();
    $("#img_row3").hide();
    $("#img_row4").hide();
    $("#img_row5").hide();

    $("#customRadioInline1").attr('checked', 'checked');

    $("#img_upload").hide();
    $("#camera_upload").hide();

    $("#customRadioInline1").click(function () {
        $("#img_upload").hide();
        $("#internet_img_upload").show();
        $("#camera_upload").hide();
    });
    $("#customRadioInline2").click(function () {
        $("#img_upload").show();
        $("#internet_img_upload").hide();
        $("#camera_upload").hide();

    });

    $("#cam_img").click(function () {
        $("#img_upload").hide();
        $("#internet_img_upload").hide();
        $("#camera_upload").show();
        Webcam.attach('#my_camera');

    });

    function take_snapshot() {
        Webcam.snap(function (data_uri) {
            $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
            var img_src = data_uri;
            let message = img_src;
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/store-image',
                type: 'POST',
                data: {
                    message: message,
                    _token: _token
                },
                success: function (data) {
                    $("#img_src_val").val(data);

                }
            });

        });
    }


    var firstUpload = new FileUploadWithPreview('myFirstImage')

    $("#search_image").click(function () {
        var search = $("#search").val();
        $.ajax({
            url: '/get-image/' + search,
            type: 'GET',
            success: function (data) {
                console.log(data);
                if (data == "Failed") {
                    alert("No Image Found");
                } else {
                    for (var i = 0; i < 30; i++) {
                        var img_src = data[i]["link"];
                        $("#p_image" + i + "").attr('src', img_src);
                    }

                    $("div.img").click(function () {
                        var src = $(this).find('img').attr('src');

                        $.ajax({
                            url: '/download-image',
                            type: 'GET',
                            data: {
                                src: src
                            },
                            success: function (data) {

                                $("#img_src_val").val(data);
                                swal({
                                    title: 'Success!',
                                    text: "Image is Selected!",
                                    type: 'success',
                                    padding: '2em'
                                });
                            }
                        });

                    });
                }

            }
        });
    });

    $("#img_btn1").click(function(){
      $(this).hide();
      $("#img_row2").show();

    });
    $("#img_btn2").click(function(){
      $(this).hide();
      $("#img_row3").show();

    });
    $("#img_btn3").click(function(){
      $(this).hide();
      $("#img_row4").show();

    });
    $("#img_btn4").click(function(){
      $(this).hide();
      $("#img_row5").show();

    });

    $(function () {
        var value = $('#cat_id').children(":selected").val();
        console.log(value);
        if (value != "") {
            $.ajax({
                url: '/get-sub-categories/' + value,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#sub_cat_id').empty();
                    $('#sub_cat_id').append('<option selected >Select Sub Category</option>');
                    $.each(data, function (key, value) {
                        $('#sub_cat_id').append(
                            '<option "{{ old("sub_cat_id")=='+value.id+'?"selected":"" }}" value="' +
                            value.id + '">' + value.name + '</option>');
                    });
                }
            });
        }
    });

    function onCatSelect(id) {
        var cat = $(id).val();
        // console.log(cat);
        $.ajax({
            url: '/get-sub-categories/' + cat,
            type: 'GET',
            dataType: 'json',
            success: function (data) {
                $('#sub_cat_id').empty();
                $('#sub_cat_id').append('<option selected disabled>Select Sub Category</option>');
                $.each(data, function (key, value) {
                    // console.log(value.area_name);
                    // $('#sub_cat_id').append('<option value="'+value.id+'">'+ value.name +'</option>');

                    $('#sub_cat_id').append(
                        '<option "{{ old("sub_cat_id")=='+value.id+'?"selected":"" }}" value="' +
                        value.id + '">' + value.name + '</option>');

                });
                // $('#cat_id').append('<option value="Other">Other</option>');
            }
        });
    }

</script>
@endsection
