<script src="{{ asset('vendor/jquery/jquery.js') }}"></script>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('vendor/sweetalert2/sweetalert2.all.js') }}"></script>
<script src="{{ asset('vendor/ztreeview/js/jquery.ztree.all.min.js') }}"></script>
<script src="{{ asset('vendor/inputmask/jquery.inputmask.js') }}"></script>
<script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('vendor/popper/umd/popper.js') }}"></script>

{{-- filepond --}}
<script src="{{ asset('vendor/filePond/filepond.min.js') }}"></script>
<script src="{{ asset('vendor/filePond/filepond.jquery.js') }}"></script>
<link href="{{ asset('vendor/filePond/filepond.css') }}" rel="stylesheet" />
<link href="{{ asset('vendor/filePond/filepond-plugin-image-preview.min.css') }}" rel="stylesheet" />
<script src="{{ asset('vendor/filePond/filepond-plugin-image-preview.min.js') }}"></script>
<script src="{{ asset('vendor/filePond/filepond-plugin-file-validate-size.min.js') }}"></script>
<script src="{{ asset('vendor/filePond/filepond-plugin-file-rename.js') }}"></script>
<script src="{{ asset('vendor/filePond/filepond-plugin-image-resize.js') }}"></script>
<script src="{{ asset('vendor/filePond/filepond-plugin-image-transform.min.js') }}"></script>
<script type='modulo' src="{{ asset('vendor/filePond/locale/pt-br.js') }}"></script>
{{-- <link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet" /> --}}
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>


<script>
    $.fn.filepond.registerPlugin(FilePondPluginImagePreview);
    //$.fn.filepond.registerPlugin(FilePondPluginImageValidateSize);
    $.fn.filepond.registerPlugin(FilePondPluginFileValidateSize);
    //$.fn.filepond.registerPlugin(FilePondPluginFileRename);
    $.fn.filepond.registerPlugin(FilePondPluginImageTransform);
    $.fn.filepond.registerPlugin(FilePondPluginImageResize);

    $.fn.filepond.setDefaults({
        maxFileSize: '3MB',
    });
</script>
<script type="text/javascript">
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "showDuration": "800",
    }
    // @if (Session::has('message'))
    //     toastr.options = {
    //         "closeButton": true,
    //         "progressBar": true,
    //         "showDuration": "800",
    //     }

    //     toastr.success("{{ session('message') }}");
    //     // <div class = "alert alert-success" >
    //     //     {{ session('message') }}
    //     // </div>
    // @endif

    /* erros de validação */
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif    

    @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':

                    toastr.options.timeOut = 10000;
                    toastr.info("{{ Session::get('message') }}");
                    break;
                case 'success':

                    toastr.options.timeOut = 10000;
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'warning':

                    toastr.options.timeOut = 10000;
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                // case 'error':

                //     toastr.options.timeOut = 10000;
                //     toastr.error("{{ Session::get('message') }}");
                //     break;
            }
        @endif

</script>

