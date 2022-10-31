<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  <div class="app-brand demo">
    <a href="/" class="app-brand-link menu-text fw-bolder ms-2">
      JABAR-Kost
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">

    @if(Auth::user()->getRoleNames()[0] == 'Super Admin')

        <!-- Dashboard -->
        <li class="menu-item">
        <a href="{{ url('/dashboard') }}" class="menu-link">
            <i class="menu-icon tf-icons bx bx-home-circle"></i>
            <div data-i18n="Analytics">Dashboard</div>
        </a>
        </li>

        <li class="menu-item">
            <a href="{{ url('/token') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Generate Token</div>
            </a>
        </li>

        <!-- Transaksi -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Tagih Kost</span></li>
        <!-- Cards -->

        <li class="menu-item">
            <a href="{{ url('/invoice') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-crown"></i>
                <div data-i18n="Boxicons">Data Pembayaran</div>
            </a>
        </li>

        <!-- Kelola Kost -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Kelola Kost</span></li>
        <!-- Cards -->

        <li class="menu-item">
            <a href="{{ url('/verification') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-crown"></i>
                <div data-i18n="Boxicons">Verifikasi Penyewa</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{ url('/room') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-collection"></i>
                <div data-i18n="Basic">Data Kamar</div>
            </a>
        </li>

    @else
        <!-- Dashboard -->
        <li class="menu-item">
            <a href="{{ url('/dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Pembayaran Kost -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Pembayaran Kost</span></li>
        <!-- Cards -->
        <li class="menu-item">
            <a href="{{ url('/userBill') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Tagihan</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{ url('/userHistory') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Riwayat Tagihan</div>
            </a>
        </li>

        <!-- Data Diri -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Data Diri</span></li>
        <!-- Cards -->
        <li class="menu-item">
            <a href="{{ url('/userProfile') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Profil</div>
            </a>
        </li>

    @endif


  </ul>
</aside>
<!-- / Menu -->
