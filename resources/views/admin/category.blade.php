<!DOCTYPE html>
<html lang="en">
@include('admin.css')
<link rel="stylesheet" href="admin/assets/css/admin_category.css">
<head>
    <title>Yearn Art | Category</title>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
            <h2 class="h2_font">Add Category</h2>
                @if(session()->has('message'))

                <div class='alert alert-success'>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{session()->get('message')}}
                </div>

                @endif
                
                    <form action="{{url('add_category')}}" method="POST">
                    <div class="div_center">
                        @csrf
                        <div class="input-category">
                            <input type="text" name="category" placeholder="Write Category" required="">
                        </div>
                        
                        <div class="btn-add">
                            <input type="submit"  name="submit" value="Add Category">
                        </div>
                        </div>
                    </form>
                
                <table class="center">
                    <tr>
                        <td>Category Name</td>
                        <td>Action</td>
                    </tr>
                    @foreach($data as $data)
                    <tr>

                        <td>{{$data->category_name}}</td>
                        <td>
                            <a onclick="return confirm('Are you sure to delete this?')"class="btn btn-danger" href="{{url('delete_category',$data->id)}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <!-- container-scroller -->

    <!-- scripts:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>

</html>
