<!DOCTYPE html>
<html lang="en" >
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css"/>

        <link rel="icon" type="image/x-icon" href="/favicon.ico">

        <title>{{ config('app.name', 'Shot Deck') }}</title>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" /> -->

    </head>
    <body class="flex flex-col">
        <!--[if lte IE 9]>
            <p style="background:#3e1f10;color:#fbf5e7;padding:10px 0;text-align:center;width:100%;font-size:14px;position:fixed;z-index:99999;top:0;left:0;">您使用的IE浏览器版本过低，本站不再支持，
                <a href="//support.microsoft.com/zh-cn/help/17621/internet-explorer-downloads" style="color:#F13C35">升级您的IE浏览器</a>，
            或使用<a href="//www.google.cn/chrome/"  style="color:#F13C35">Google Chrome</a>等高级浏览器，将会得到更好的体验！</p>
        <![endif]-->
        <div id="app" class="">
            <router-view ></router-view>
        </div>
    </body>
</html>