<!-- Sidebar-left -->
<div id="sidebar-wrapper" class="link-light p-2">
  <button class="menu-press text-left btn btn-danger rounded-0 d-lg-none"><i class="fal fa-bars"></i></button>
    <!-- Menu Button -->
    <a class="navbar-brand mb-3" href="{{ url('admin/dashboard') }}"><img src="{{ asset('web_asset/images/main-logo.png') }}" alt="" class="img-fluid"></a>
    <ul class="list-unstyled fa-ul bs-menu">
        <li class="nav-item"><a href="{{ url('admin/dashboard') }}"><i class="fa-li fal fa-chart-pie-alt text-light"></i><span>Dashboard</span></a></li>
        <li class="nav-item"><a href="{{ url('admin/view_categories') }}"><i class="fa-li fal fa-list text-light"></i><span>Categories(Company)</span></a></li>
        <li class="nav-item"><a href="{{ url('admin/view_cars') }}"><i class="fa-li fal fa-car text-light"></i><span>Cars</span></a></li>
        <li class="nav-item"><a href="{{ url('admin/view_reviews') }}"><i class="fa-li fal fa-star text-light"></i><span>Reviews</span></a></li>
        <li class="nav-item"><a href="{{ url('admin/view_part_exchanges') }}"><i class="fa-li fal fa-exchange text-light"></i><span>Part exchanges</span></a></li>
        <li class="nav-item"><a href="{{ url('admin/view_sell_your_vehicles') }}"><i class="fa-li fal fa-cars text-light"></i><span>Sell your vehicles</span></a></li>
        <li class="nav-item"><a href="{{ url('admin/view_finances') }}"><i class="fa-li fal fa-file-invoice-dollar text-light"></i><span>Finances</span></a></li>
        <li class="nav-item"><a href="{{ url('admin/view_contacts') }}"><i class="fa-li fal fa-id-badge text-light"></i><span>Contacts</span></a></li>
        <li class="nav-item"><a href="{{ url('admin/view_car_finance_enquiries') }}"><i class="fa-li fal fa-receipt"></i><span>Car Finance Enquiries</span></a></li>
        <li class="nav-item"><a href="{{ url('admin/view_car_part_exchange_enquiries') }}"><i class="fa-li fal fa-receipt"></i><span>Car Parts Exchange Enquiries</span></a></li>
    </ul>
</div>
