
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    {!!Form::text('firstname',null,array('required','class'=>'form-control form-control-user','placeholder'=>"First Name"))!!}
                    
                  </div>
                  <div class="col-sm-6">
                    {!!Form::text('lastname',null,array('required','class'=>'form-control form-control-user','placeholder'=>"Last Name"))!!}
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     {!!Form::label('gender',"Select Gender")!!}
                    {!!Form::select('gender',$gender,null,array('required','class'=>'form-control','id'=>'gender'))!!}
                    
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     {!!Form::label('role',"Select Role")!!}
                    {!!Form::select('roles',$roles,null,array('required','class'=>'form-control','id'=>'role'))!!}
                    
                  </div>
                  
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    {!!Form::label('status',"Select Status")!!}
                    {!!Form::select('status',$status,null,array('required','class'=>'form-control','status'))!!}
                    
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                     {!!Form::label('photo',"Select Photo")!!}
                    {!!Form::file('photo', null,array('required','class'=>'form-control','image'))!!}
                    
                  </div>
                  
                </div>
                  <div class="form-group">
                   {!!Form::tel('phone',null,array('required','class'=>'form-control form-control-user','placeholder'=>"Your Phone"))!!}
                </div>
                <div class="form-group">
                   {!!Form::email('email',null,array('required','class'=>'form-control form-control-user','placeholder'=>"Your Email"))!!}
                </div>
              
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                   {!!Form::password('password',array('required','class'=>'form-control form-control-user','placeholder'=>"Your Pasword"))!!}
                  </div>
                  <div class="col-sm-6">
                    {!!Form::password('repassword',array('required','class'=>'form-control form-control-user','placeholder'=>"Retype Pasword"))!!}
                  </div>
                </div>
               
           