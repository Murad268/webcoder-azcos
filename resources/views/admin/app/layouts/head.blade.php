<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title>AZCOSMETICS GROUP MMC | admin panel</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    @yield('links')
    <link rel="icon" type="image/x-icon" href="https://azcosmetics.coder.az/storage/images/settings/6667ee86c0c67.svg">
    <meta name="theme-color" content="#ffffff">
    <script src="{{asset('admin/assets/vendors/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/config.js')}}"></script>

    <!-- ===============================================-->
    <!--    Stylesheets-->
    <!-- ===============================================-->


    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="{{asset('admin/assets/vendors/simplebar/simplebar.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/css/theme.min.css')}}" type="text/css" rel="stylesheet" id="style-default">
    <link href="{{asset('admin/assets/css/user.min.css')}}" type="text/css" rel="stylesheet" id="user-style-default">
    <!-- <script>
        var phoenixIsRTL = window.config.config.phoenixIsRTL;
        if (phoenixIsRTL) {
            var linkDefault = document.getElementById('style-default');
            var userLinkDefault = document.getElementById('user-style-default');
            linkDefault.setAttribute('disabled', true);
            userLinkDefault.setAttribute('disabled', true);
            document.querySelector('html').setAttribute('dir', 'rtl');
        } else {
            var linkRTL = document.getElementById('style-rtl');
            var userLinkRTL = document.getElementById('user-style-rtl');
            linkRTL.setAttribute('disabled', true);
            userLinkRTL.setAttribute('disabled', true);
        }
    </script> -->
    <link href="{{asset('admin/assets/vendors/leaflet/leaflet.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/vendors/leaflet.markercluster/MarkerCluster.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/vendors/leaflet.markercluster/MarkerCluster.Default.css')}}" rel="stylesheet">
</head>