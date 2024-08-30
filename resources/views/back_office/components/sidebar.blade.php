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
    <li class="nav-item {{ request()->is("back-office/pegawai/*") || Request::is('back-office/pegawai') ? 'selected-list': '' }}">
      <a class="nav-link" href="/back-office/pegawai">
        <span class="{{ Request::is('back-office/pegawai') ? 'active-link': 'death-link' }}"><i class="ri-id-card-line iconSidebarList"></i>Pegawai</span>
      </a>
    </li>
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
