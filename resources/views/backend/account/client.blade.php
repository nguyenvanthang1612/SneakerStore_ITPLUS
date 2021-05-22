@extends('backend.layouts.app')

@section('title')
    Client Management
@endsection

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
                      <a href="#">Account</a>
                  </li>
                  <li class="active">
                      Client Management
                  </li>
              </ol>
              <div class="clearfix"></div>
           </div>
            <!--End Page Title-->          
         
         
             <!--Start row-->
             <div class="row">
                 <div class="col-md-12">
                     <div class="white-box">
                         <h2 class="header-title">Admin Management</h2>
                          <div class="table-responsive">
                           <table id="example" class="display table">
                                  <thead>
                                      <tr>
                                          <th>Id</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Password</th>
                                          <th>Telephone</th>
                                          <th>Avatar</th>
                                      </tr>
                                  </thead>
                                  <tfoot>
                                      <tr>
                                          <th>Id</th>
                                          <th>Name</th>
                                          <th>Email</th>
                                          <th>Password</th>
                                          <th>Telephone</th>
                                          <th>Avatar</th>
                                      </tr>
                                  </tfoot>
                                  <tbody>
                                      @foreach ($accounts as $account)
                                        <tr>
                                            <td>{{ $account->id }}</td>
                                            <td>{{ $account->user_name }}</td>
                                            <td>{{ $account->email }}</td>
                                            <td>{{ $account->password }}</td>
                                            <td>{{ $account->telephone }}</td>
                                            <td>{{ $account->avatar }}</td>
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

