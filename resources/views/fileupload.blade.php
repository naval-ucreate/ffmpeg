<!DOCTYPE html>
<html>
<body>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
<style>
.form_style{
    width: 400px;
    text-align: center;
    display: inline-block;
    border: solid 1px;
    padding: 39px;
}

</style>
<div class="container">
<div class="row">
        <div class="col-md-12 text-center">

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
        </div>
        @endif


        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
        </div>
        @endif


        @if ($message = Session::get('warning'))
        <div class="alert alert-warning alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
        </div>
        @endif


        @if ($message = Session::get('info'))
        <div class="alert alert-info alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <strong>{{ $message }}</strong>
        </div>
        @endif


        @if ($errors->any())
        <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert">×</button>	
        Please check the form below for errors
        </div>
        @endif

        <form action="{{ route('file_upload') }}" method="post" enctype="multipart/form-data" class="form_style">
        {{ csrf_field() }}
            <div class="form-group">
            <label for="Scale Size">Scale Size:</label>
                <select name='scale_size'>
                   <?php for($scale_size=100;$scale_size<1100;$scale_size+=100) { ?>
                    <option value="{{$scale_size}}">{{$scale_size}}</option>
                   <?php }  ?>
                </select>
            </div>
            <div class="form-group">
            <label for="email">Upload Image:</label>
            <input type="file" class="form-control" id="file_upload" name="file_upload">
            </div>       
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>    
        </div>        
    </div>
            @if ($image_data = Session::get('image_data'))
            <p>Input Image:</p>
            <img src="images/{{ $image_data['input_image'] }}">
            <br/>
            <p>Output Image</p>
            <img src="images/{{ $image_data['output_image'] }}">
            @endif
</div>
</body>
</html>