@if(session()->has('flash_message'))
    <script type="text/javascript">
        swal({
            title: "{{ session('flash_message.title') }}",
            text: "{{ session('flash_message.message') }}",
            type: "{{ session('flash_message.level') }}",
            timer: 1700,
            showConfirmButton: false
        });
    </script>
@endif

@if(session()->has('flash_message_overlay'))
    <script type="text/javascript">
        swal({
            title: "{{session('flash_message_overlay.title')}}",
            text: "{{session('flash_message_overlay.message')}}",
            type: "{{session('flash_message_overlay.level')}}",
            confirmButtonText: 'OKay'
        });
    </script>
@endif

@if(session()->has('flash_message_confirm'))
    <script type="text/javascript">
        swal({
            title: "{{ session('flash_message_confirm.title') }}",
            text: "{{ session('flash_message_confirm.message') }}",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "确认",
            cancelButtonText: "取消",
            closeOnConfirm: false
        },
        function(){
            document.passwordReset.submit();
            swal({
                "{{ session('flash_message_confirm.confirmTitle') }}",
                "{{ session('flash_message_confirm.confirmMessage') }}",
                "success"
            });
        });
    </script>
@endif