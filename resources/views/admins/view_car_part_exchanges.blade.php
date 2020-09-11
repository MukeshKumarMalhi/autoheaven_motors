@extends('layouts.a_app')
@section('title','Car Part Exchange Enquiries')

@section('content')

    <!-- Page Content -->
        <div class="container-fluid py-3" id="car_part_exchange_enquiries">
          <!-- table-->
          <div class="card">
              <div class="table-responsive small">
                  <table class="table table-condensed">
                      <thead>
                          <tr>
                              <th><span>Car Detail</span></th>
                              <th><span>Vehicle Type</span></th>
                              <th><span>Company</span></th>
                              <th><span>Model</span></th>
                              <th><span>Vehicle Reg</span></th>
                              <th><span>Mileage</span></th>
                              <th><span>Condition</span></th>
                              <th><span>Name</span></th>
                              <th><span>Phone #</span></th>
                              <th><span>Email</span></th>
                              <th><span>Best time to call</span></th>
                              <th><span>Date</span></th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                            {{ csrf_field() }}
                           <?php if(isset($part_exchange_enquiries) && count($part_exchange_enquiries) > 0){ ?>
                             @foreach($part_exchange_enquiries as $part_exchange_enquiry)
                               <tr class="CarParExchnageEnquiry{{$part_exchange_enquiry->id}}">
                                 <td>{{ $part_exchange_enquiry->category_name }} {{ $part_exchange_enquiry->model }} {{ $part_exchange_enquiry->version }} {{ $part_exchange_enquiry->model_year }}</td>
                                 <td>{{ $part_exchange_enquiry->vehicle_type }}</td>
                                 <td>{{ $part_exchange_enquiry->company }}</td>
                                 <td>{{ $part_exchange_enquiry->model }}</td>
                                 <td>{{ $part_exchange_enquiry->vehicle_reg }}</td>
                                 <td>{{ $part_exchange_enquiry->mileage }}</td>
                                 <td>{{ $part_exchange_enquiry->condition }}</td>
                                 <td>{{ $part_exchange_enquiry->full_name }}</td>
                                 <td>{{ $part_exchange_enquiry->phone_number }}</td>
                                 <td>{{ $part_exchange_enquiry->email_address }}</td>
                                 <td>{{ $part_exchange_enquiry->best_time_to_call }}</td>
                                 <td><?php echo date('d M Y',strtotime($part_exchange_enquiry->created_at)); ?></td>
                               </tr>
                             @endforeach
                          <?php }else { ?>
                            <tr>
                              <th id="yet">
                                <h2>Car Part Exchange Enquiries are not added yet</h2>
                              </th>
                            </tr>
                          <?php } ?>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
          <div style="margin-top: 10px;margin-left: 440px;">
		         <ul class="pagination-for-car-part-exchanges-enquiries justify-content-center">
               {{ $part_exchange_enquiries->links() }}
		         </ul>
		      </div>
        </div>

<script type="text/javascript">
  $(document).ready(function(){

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
});
</script>
<style media="screen">
.close{
  font-size: 1.4rem;
}
</style>
@endsection
