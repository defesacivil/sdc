<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.css') }}">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('vendor/ztreeview/css/zTreeStyle/zTreeStyle.css') }}" />
<link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('vendor/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
{{-- <link href="{{ asset('vendor/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" /> --}}
<style>
    .navbar {
        background-color: #FE9A2E;
        color: white !important;
        text-decoration: none
    }

    .breadcrumb {
        /*background-color: #A9D0F5;*/
    }

    body {
        margin: 0 auto !important;
        min-height: 400px !important;
        /* background-color: #A9D0F5; */
    }

    .back {
        background-color: #e9ecef;
    }

    .imgDisabled {
        opacity: 0.4;
        filter: alpha(opacity=40);
        /* msie */

    }

    @media print {


        * {
            font-size: 10pt;
        }

        /* imagens do relatorio de vistoria */
        div img-rel {
            width: 200px;
        }

        div container .interdicao-text {
            font-size: 9pt;
        }

        
        
        .print {
            display: none;
        }

        .page-break {
            page-break-before: always
        }

    }
</style>

