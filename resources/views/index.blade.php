@extends('layouts.app')

@section('content')
    <div class="container-fluid bg-dark">
       <div class="row">
           <div class="container-fluid bg-light m-4 p-4 mx-auto col-11 rounded position-relative">
               <h4 class="font-weight-bolder text-uppercase position-fixed">Calendar</h4>
               <hr>
               <div class="row m-4">
                   <div class="col-5 position-relative">
                       <div class="position-fixed">
                           <create-event></create-event>
                       </div>

                   </div>
                   <div class="col-7 position-relative">
                       <div class="position-relative">
                           <events></events>
                       </div>
                   </div>
               </div>

           </div>
       </div>
    </div>
@endsection
