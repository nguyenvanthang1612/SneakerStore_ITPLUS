@extends('backend.layouts.app');

@section('title')
    category table
@endsection

@push('js')
    <script>
        function deleteItem(e)
        {
            const confirmDeletePost = confirm('Are you sure ?')
            if (confirmDeletePost)
            {
                axios.delete(`admin/categories/${e.getAttribute('data-id')}`)
                .then(res => location.reload())
                .catch(err => console.err(err))
            }
        }
    </script>
@endpush

@section('content')
    <!--body wrapper start-->
    <div class="wrapper">
              
        <!--Start Page Title-->
         <div class="page-title-box">
              <h4 class="page-title">Data Table</h4>
              <ol class="breadcrumb">
                  <li>
                      <a href="#">Dashboard</a>
                  </li>
                  <li>
                      <a href="#">Table</a>
                  </li>
                  <li class="active">
                      Data Table
                  </li>
              </ol>
              <div class="clearfix"></div>
           </div>
            <!--End Page Title-->          
         
         
             <!--Start row-->
             <div class="row">
                 <div class="col-md-12">
                     <div class="white-box">
                         <h2 class="header-title">Basic example</h2>
                          <div class="table-responsive">
                           <table id="example" class="display table">
                                  <thead>
                                      <tr>
                                          <th>Id</th>
                                          <th>Name</th>
                                          <th>Description</th>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                      <tr>
                                          <th>Id</th>
                                          <th>Name</th>
                                          <th>Description</th>
                                      </tr>
                                  </tfoot>
                                  <tbody>
                                      @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->desc }}</td>
                                        </tr>
                                      @endforeach
                                  </tbody>
                            </table>  
                          </div>
                     </div>
                 </div>
             </div>
             <!--End row-->
      </div>
      <!-- End Wrapper-->
    <!--End main content -->
@endsection

