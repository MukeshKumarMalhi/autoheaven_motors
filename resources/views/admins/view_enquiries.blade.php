@extends('layouts.a_app')
@section('title','Enquiries')

@section('content')

    <!-- Page Content -->
        <div class="container-fluid py-3" id="enquiries">
          <!-- table-->
          <div class="card">
              <div class="table-responsive small">
                  <table class="table table-condensed">
                      <thead>
                          <tr>
                              <th><span>Car Detail</span></th>
                              <th><span>Name</span></th>
                              <th><span>Email</span></th>
                              <th><span>Phone</span></th>
                              <th><span>Message</span></th>
                              <th><span>Date</span></th>
                          </tr>
                      </thead>
                      <tbody>
                          <tr>
                            {{ csrf_field() }}
                           <?php if(isset($enquiries) && count($enquiries) > 0){ ?>
                             @foreach($enquiries as $enquiry)
                               <tr class="Enquiry{{$enquiry->id}}">
                                 <td>{{ $enquiry->category_name }} {{ $enquiry->model }} {{ $enquiry->version }} {{ $enquiry->model_year }}</td>
                                 <td>{{ $enquiry->name }}</td>
                                 <td>{{ $enquiry->email }}</td>
                                 <td>{{ $enquiry->phone }}</td>
                                 <td>{{ $enquiry->info_message }}</td>
                                 <td><?php echo date('d M Y',strtotime($enquiry->created_at)); ?></td>
                               </tr>
                             @endforeach
                          <?php }else { ?>
                            <tr>
                              <th id="yet">
                                <h2>Enquiries are not added yet</h2>
                              </th>
                            </tr>
                          <?php } ?>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
          <div style="margin-top: 10px;margin-left: 440px;">
		         <ul class="pagination-for-enquiries justify-content-center">
               {{ $enquiries->links() }}
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
