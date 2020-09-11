<!-- Sidebar-left -->
<div id="sidebar-wrapper" class="link-light p-3">
    <!-- Menu Button -->
    <a class="navbar-brand mb-3" href="{{ url('admin/dashboard') }}"><img src="{{ asset('web_asset/images/main-logo.png') }}" alt="" width="210" class="img-fluid"></a>
    <ul class="list-unstyled fa-ul bs-menu">
        <li class="active"><a href="{{ url('admin/dashboard') }}"><i class="fa-li fal fa-chart-pie-alt text-light"></i>Dashboard</a></li>
        <li class="active"><a href="{{ url('admin/view_categories') }}"><i class="fa-li fal fa-list text-light"></i>Categories(Company)</a></li>
        <li class="active"><a href="{{ url('admin/view_cars') }}"><i class="fa-li fal fa-car text-light"></i>Cars</a></li>
        <li class="active"><a href="{{ url('admin/view_reviews') }}"><i class="fa-li fal fa-star text-light"></i>Reviews</a></li>
        <li class="active"><a href="{{ url('admin/view_part_exchanges') }}"><i class="fa-li fal fa-exchange text-light"></i>Part exchanges</a></li>
        <li class="active"><a href="{{ url('admin/view_sell_your_vehicles') }}"><i class="fa-li fal fa-cars text-light"></i>Sell your vehicles</a></li>
        <li class="active"><a href="{{ url('admin/view_finances') }}"><i class="fa-li fal fa-file-invoice-dollar text-light"></i>Finances</a></li>
        <li class="active"><a href="{{ url('admin/view_contacts') }}"><i class="fa-li fal fa-id-badge text-light"></i>Contacts</a></li>
        <li class="active"><a href="{{ url('admin/view_car_finance_enquiries') }}"><i class="fa-li fal fa-receipt"></i>Car Finance Enquiries</a></li>
        <li class="active"><a href="{{ url('admin/view_car_part_exchange_enquiries') }}"><i class="fa-li fal fa-receipt"></i>Car Parts Exchange Enquiries</a></li>
    </ul>
</div>
