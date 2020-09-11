@extends('layouts.a_app')
@section('title','Dashboard')
@section('content')
    <!-- Page Content -->
      <div class="container-fluid py-3">
              <h3>Latest Cars for Sell</h3>
              <!-- table-->
              <div class="table-responsive border-bottom rounded mb-5">
                  <table class="table bs-table" id="userTable">
                      <thead>
                          <tr>
                            <th><span>Vehicle Type</span></th>
                            <th><span>Company</span></th>
                            <th><span>Model</span></th>
                            <th><span>Mileage</span></th>
                            <th><span>Name</span></th>
                            <th><span>Phone #</span></th>
                            <th><span>Email</span></th>
                            <th><span>Date</span></th>
                            <th class="text-right"><span><a href="{{ url('admin/view_sell_your_vehicles') }}" class="btn btn-danger">View all</a></span></th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr>
                          {{ csrf_field() }}
                         <?php if(isset($sell_your_vehicles) && count($sell_your_vehicles) > 0){ ?>
                           @foreach($sell_your_vehicles as $vehicles)
                             <tr class="SellYourVehicle{{$vehicles->id}}">
                               <td>{{ $vehicles->vehicle_type }}</td>
                               <td>{{ $vehicles->company }}</td>
                               <td>{{ $vehicles->model }}</td>
                               <td>{{ $vehicles->mileage }}</td>
                               <td>{{ $vehicles->full_name }}</td>
                               <td>{{ $vehicles->phone_number }}</td>
                               <td>{{ $vehicles->email_address }}</td>
                               <td><?php echo date('d M Y',strtotime($vehicles->created_at)); ?></td>
                             </tr>
                           @endforeach
                        <?php }else { ?>
                          <tr>
                            <th id="yet">
                              <h2>Sell your vehicles are not added yet</h2>
                            </th>
                          </tr>
                        <?php } ?>
                        </tr>
                      </tbody>
                  </table>
              </div>

              <h3>Latest Reviews</h3>
              <!-- table danger-->
              <div class="table-responsive border-bottom rounded mb-5">
                  <table class="table bs-table bs-table-danger" id="userTable">
                      <thead>
                          <tr>
                            <th><span>Rating</span></th>
                            <th><span>Title</span></th>
                            <th><span>Review</span></th>
                            <th><span>Name</span></th>
                            <th><span>Date</span></th>
                            <th class="text-right"><span><a href="{{ url('admin/view_reviews') }}" class="btn bg-white" style="color: #d90000;">View all</a></span></th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr>
                          {{ csrf_field() }}
                         <?php if(isset($reviews) && count($reviews) > 0){ ?>
                           @foreach($reviews as $review)
                             <tr class="Review{{$review->id}}">
                               <td>
                                 <div class="star-rating text-danger" title="100%" style="display: inline-block;margin:0px;padding:0px">
                                   <div class="back-stars">
                                     <?php
                                       $empty = 5 - $review->rating_number;
                                       for ($i=0; $i < $review->rating_number; $i++) { ?>
                                       <i class="fas fa-star" aria-hidden="true"></i>
                                     <?php
                                       }
                                       for ($j=0; $j < $empty; $j++) { ?>
                                       <i class="far fa-star" aria-hidden="true"></i>
                                     <?php
                                       }
                                     ?>
                                   </div>
                                 </div>
                               </td>
                               <td>{{ $review->rating_title }}</td>
                               <td>{{ $review->rating_desc }}</td>
                               <td>{{ $review->full_name }}</td>
                               <td><?php echo date('d M Y',strtotime($review->created_at)); ?></td>
                             </tr>
                           @endforeach
                        <?php }else { ?>
                          <tr>
                            <th id="yet">
                              <h2>Reviews are not added yet</h2>
                            </th>
                          </tr>
                        <?php } ?>
                        </tr>
                      </tbody>
                  </table>
              </div>

              <h3>Latest Car Enquiries</h3>
              <!-- table dark-->
              <div class="table-responsive border-bottom rounded mb-5">
                  <table class="table bs-table bs-table-dark" id="userTable">
                      <thead>
                          <tr>
                            <th><span>Car Detail</span></th>
                            <th><span>Name</span></th>
                            <th><span>Email</span></th>
                            <th><span>Phone</span></th>
                            <th><span>Message</span></th>
                            <th><span>Date</span></th>
                            <th class="text-right"><span><a href="{{ url('admin/view_car_finance_enquiries') }}" class="btn bg-white">View all</a></span></th>
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

              <h3>Latest Contacts</h3>
              <!-- table dark-->
              <div class="table-responsive border-bottom rounded mb-5">
                  <table class="table bs-table" id="userTable">
                      <thead>
                          <tr>
                            <th><span>Name</span></th>
                            <th><span>Email</span></th>
                            <th><span>Phone</span></th>
                            <th><span>Message</span></th>
                            <th><span>Date</span></th>
                            <th class="text-right"><span><a href="{{ url('admin/view_contacts') }}" class="btn btn-dark">View all</a></span></th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr>
                          {{ csrf_field() }}
                         <?php if(isset($contacts) && count($contacts) > 0){ ?>
                           @foreach($contacts as $contact)
                             <tr class="Contact{{$contact->id}}">
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
@endsection
