<header class="header header-sticky mb-4">
  <div class="header-row container-fluid d-flex">
    <div class="title">{{ $title }}</div>
    <div class="user-info">
      <div class="user-icon">
        <i class="ri-user-fill"></i>
      </div>
      <div class="user-name">
        {{ auth()->user()->name ?? auth()->guard('web')->user()->name }}
      </div>
    </div>
  </div>
</header>
