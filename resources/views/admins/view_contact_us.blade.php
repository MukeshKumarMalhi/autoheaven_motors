@extends('layouts.a_app')
@section('title','Contacts')

@section('content')

    <!-- Page Content -->

    <div id="page-content-wrapper">
        <div class="container-fluid py-3" id="contacts">
          <!-- table-->
          <div class="card">
              <div class="card-header bg-blue text-light">
                <div class="row">
                  <div class="col-sm-6">
                    <h4 class="mb-0">Contacts</h4>
                  </div>
                </div>
              </div>
              <div class="table-responsive small">
                  <table class="table table-condensed">
                      <thead>
                          <tr>
                              <th><span>ID</span></th>
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
                           <?php if(isset($contacts) && count($contacts) > 0){ ?>
                             @foreach($contacts as $contact)
                               <tr class="Contact{{$contact->id}}">
                                 <td>{{ $contact->id }}</td>
                                 <td>{{ $contact->name }}</td>
                                 <td>{{ $contact->email }}</td>
                                 <td>{{ $contact->phone }}</td>
                                 <td>{{ $contact->info_message }}</td>
                                 <td><?php echo date('d M Y',strtotime($contact->created_at)); ?></td>
                               </tr>
                             @endforeach
                          <?php }else { ?>
                            <tr>
                              <th id="yet">
                                <h2>Contacts are not added yet</h2>
                              </th>
                            </tr>
                          <?php } ?>
                          </tr>
                      </tbody>
                  </table>
              </div>
          </div>
          <div style="margin-top: 10px;margin-left: 440px;">
		         <ul class="pagination-for-contacts justify-content-center">
               {{ $contacts->links() }}
		         </ul>
		      </div>
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
