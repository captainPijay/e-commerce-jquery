@include('back_office.layouts.modal_konfirmasi')
<div class="sidebar pb-3" id="sidebar" style="overflow-y: auto;">
  <div class="sidebar-header container-fluid">
    <div class="text-wrapper">
      <div class="title mb-0">Aplikasi Digdaya</div>
      <div class="title">Soal Test Fullstack</div>
    </div>
  </div>
  <ul class="sidebar-nav" data-coreui="navigation" data-simplebar>
    <li class="nav-title active">MAIN MENU</li>
    @can('user')
    <li class="nav-item {{ request()->is("back-office/dashboard/*") || Request::is('back-office/dashboard') ? 'selected-list': '' }}">
        <a class="nav-link" href="/back-office/dashboard">
            <span class="{{ Request::is('back-office/dashboard') ? 'active-link': 'death-link' }}"><i class="ri-home-smile-2-line iconSidebarList"></i>Dashboard</span>
        </a>
    </li>
    <li class="nav-item {{ request()->is("back-office/products/*") || Request::is('back-office/products') ? 'selected-list': '' }}">
        <a class="nav-link" href="/back-office/products">
            <span class="{{ Request::is('back-office/products') ? 'active-link': 'death-link' }}"><i class="ri-home-smile-2-line iconSidebarList"></i>Products</span>
        </a>
    </li>
    @endcan

    @can('customer')
    <li class="nav-item {{ request()->is("front-office/orders/*") || Request::is('front-office/orders') ? 'selected-list': '' }}">
        <a class="nav-link" href="/front-office/orders">
            <span class="{{ Request::is('front-office/orders') ? 'active-link': 'death-link' }}"><i class="ri-home-smile-2-line iconSidebarList"></i>Pesan Produk</span>
        </a>
    </li>
    @endcan
    <li class="nav-item">
      <div>
        <button onclick="formKonfirmasi()" class="nav-link btn-logout">
          <span class="death-link"><i class="ri-logout-box-line iconSidebarList"></i>Logout</span>
        </button>
      </div>
    </li>
  </ul>
  <div class="wrapperButtonLogout w-100 px-3"></div>
</div>
<script>
    function formKonfirmasi() {
        $('#formKonfirmasi').attr('action', "{{ route('logout') }}");
        $('#ModalKonfirmasi').modal('show');
    }
</script>
