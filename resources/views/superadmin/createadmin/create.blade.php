@extends('layouts.superadmin')
@section('title', "Create New Admin")
@section('superadmin')

    <div class="card o-hidden border-0 shadow-lg my-5">
      <a  class=" btn  btn-success rounde" href="{{url('superadmin/admin')}}">View Users </a>
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        
        <div class="row">
          {{-- <div class="col-lg-5 d-none d-lg-block"></div> --}}
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Add Admin Account!</h1>
                 <h3 class=" text-warning">@include('partial.formerror')</h3>
                </div>
 
     
             {!!Form::open(array('route'=>'admin.store','class'=>'user','id'=>'admin','files'=>true))!!}
              @include('superadmin.createadmin.form')
               
                {!!Form::submit('Register',array('class'=>'btn btn-primary btn-user btn-block'))!!}
               
              <hr>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.html">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {!!Form::close()!!}
                                        
@endsection
