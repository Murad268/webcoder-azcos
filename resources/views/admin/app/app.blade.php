<!DOCTYPE html>
<html data-navigation-type="default" data-navbar-horizontal-shape="default" lang="{{TranslateUtility::getLang()}}" dir="ltr">
@include('admin.app.layouts.head')

<body>
  <!-- ===============================================-->
  <!--    Main Content-->
  <!-- ===============================================-->
  <main class="main" id="top">
    <x-admin-header-component />
    <div class="content">
      @yield('content')
      <x-admin-footer-component />
    </div>

  </main><!-- ===============================================-->
  <!--    End of Main Content-->
  <!-- ===============================================-->



  @include('admin.app.layouts.foot')
</body>

</html>
