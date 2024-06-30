<!DOCTYPE html>
<html lang="{{TranslateUtility::getLang()}}" data-bs-theme="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />


    <x-meta-component/>
    @include('client.app.layouts.head')
</head>

<body>
    <x-client-header-component />



    @yield('content')

    <x-front-footer-component />

</body>
@include('client.app.layouts.foot')

</html>
