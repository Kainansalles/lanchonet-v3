<html lang="pt-br" class="wf-poppins-n3-active wf-poppins-n6-active wf-poppins-n4-active wf-poppins-n5-active wf-roboto-n4-active wf-roboto-n3-active wf-poppins-n7-active wf-roboto-n6-active wf-roboto-n7-active wf-roboto-n5-active wf-active"><!-- begin::Head --><head>
		<meta charset="utf-8">
        <title>{{ config('app.name', 'Laravel') }}</title>
		<meta name="description" content="Lanchonet - 404">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Web font -->
		<script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CRoboto:300,400,500,600,700" media="all"><script>
          WebFont.load({
            google: {"families":["Poppins:300,400,500,600,700","Roboto:300,400,500,600,700"]},
            active: function() {
                sessionStorage.fonts = true;
            }
          });
		</script>
		<!--end::Web font -->
        <!--begin::Base Styles -->
        <link href="{{ asset('css/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<!--end::Base Styles -->
		<link rel="shortcut icon" href="{{ asset('img/oficial-logo-ico.ico') }}" />
	<style type="text/css">span.im-caret {
    -webkit-animation: 1s blink step-end infinite;
    animation: 1s blink step-end infinite;
}

@keyframes blink {
    from, to {
        border-right-color: black;
    }
    50% {
        border-right-color: transparent;
    }
}

@-webkit-keyframes blink {
    from, to {
        border-right-color: black;
    }
    50% {
        border-right-color: transparent;
    }
}

span.im-static {
    color: grey;
}

div.im-colormask {
    display: inline-block;
    border-style: inset;
    border-width: 2px;
    -webkit-appearance: textfield;
    -moz-appearance: textfield;
    appearance: textfield;
}

div.im-colormask > input {
    position: absolute;
    display: inline-block;
    background-color: transparent;
    color: transparent;
    -webkit-appearance: caret;
    -moz-appearance: caret;
    appearance: caret;
    border-style: none;
    left: 0; /*calculated*/
}

div.im-colormask > input:focus {
    outline: none;
}

div.im-colormask > input::-moz-selection{
    background: none;
}

div.im-colormask > input::selection{
    background: none;
}
div.im-colormask > input::-moz-selection{
    background: none;
}

div.im-colormask > div {
    color: black;
    display: inline-block;
    width: 100px; /*calculated*/
}</style><style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style></head>
	<!-- end::Head -->
    <!-- end::Body -->
<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">
        <div class="m-grid__item m-grid__item--fluid m-grid  m-error-1" style="background-image: url( {{ asset('img/bg1.jpg') }} );">
            <div class="m-error_container">
                <span class="m-error_number">
                    <h1>
                        404
                    </h1>
                </span>
                <p class="m-error_desc">
                    OOPS! Alguma coisa está errada
                </p>
            </div>
        </div>
    </div>
    <!-- end:: Page -->
    <!--begin::Base Scripts -->
    <script src="{{ asset('js/vendors.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts.bundle.js') }}" type="text/javascript"></script>
    <!--end::Base Scripts -->
<!-- end::Body -->
</body>
</html>