
@extends('layouts.app')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
@foreach($contents as $c)
                <div class="card-body">
                    <form action="{{ url('submit/content/'.$c['id']) }}" method="post" enctype="multipart/form-data" >
                        <div class="form-group">
                            <label>دسته محصول</label>
                            <select name="id_cat" class="form-control form-control-lg">
                                <option>--دسته محصول--</option>
                            </select>
                        </div>

                        <div class="form-group" >
                            <label>* نام</label>
                            <input name="name" type="text" id="name" class="form-control">
                        </div>

                        <label>توضیحات</label>
                        <div class="md-form">
                            <input name="desc" type="text" id="inputIconEx1" class="form-control">
                        </div>

                        <label>حداقل سن</label>
                        <div class="md-form">
                            <input name="low_age" type="text" id="inputIconEx1" class="form-control">
                        </div>

                        <label>حداکثر سن</label>
                        <div class="md-form">
                            <input name="high_age" type="text" id="inputIconEx1" class="form-control">
                        </div>

                        <label>تگ</label>
                        <div class="md-form">
                            <input name="tag" type="text" id="inputIconEx1" class="form-control">
                        </div>

                        <label>سایز</label>
                        <div class="md-form">
                            <input name="size" type="text" id="inputIconEx1" class="form-control">
                        </div>

                        <label>ورژن</label>
                        <div class="md-form">
                            <input name="version" type="text" id="inputIconEx1" class="form-control">
                        </div>


  
                        <label>آپلود تصویر</label>
                        <label style="color: #c61515">حداکثر ۱۳ مگابایت</label>

                        <input type="file" id="fileupload" name="photos[]" data-url=" {{ url('upload/image/'.$c['id']) }}" multiple />
                        <br />
                        <div id="files_list"></div>
                        <p id="loading"></p>
                        <div id="progress">
                            <div class="bar" style="width: 0%;"></div>
                        </div>
                        <input type="hidden" name="file_ids" id="file_ids" value="" />
                        
                        <label>آپلود فایل</label>
                        <label style="color: #c61515">حداکثر ۱۳ مگابایت</label>

                        <input type="file" id="fileupload1" name="photos[]" data-url="{{ url('upload/apk/'.$c['id']) }}" multiple />
                        <br />
                        <div id="files_list1"></div>
                        <p id="loading1"></p>
                        <div id="progress1">
                            <div class="bar" style="width: 0%;"></div>
                        </div>
                        <input type="hidden" name="file_ids1" id="file_ids1" value="" />
                       
                        
                          <input type="hidden" name="content_id" id="id" value="{{$c['id']}}" />
                         
@endforeach
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
    <!--<script src="{{ asset('/js/app3.js') }}"></script>-->
<script src="{{ asset('js/dropdown.js') }}"></script>
</div>
<!-- dropdown -->


<!-- upload -->
<script src="{{ asset('js/vendor/jquery.ui.widget.js')}}"></script>
<script src="{{ asset('js/jquery.iframe-transport.js')}}"></script>
<script src="{{ asset('/js/jquery.fileupload.js')}}"></script>
<script src="{{ asset('js/upload/image.js') }}"></script>
<script src="{{ asset('js/upload/model.js') }}"></script>




@endsection
