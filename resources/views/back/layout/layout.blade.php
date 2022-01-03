<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   @include( 'back.common.head' )
<body id="body" class="hold-transition sidebar-mini layout-fixed">
	@if (session()->has('flash_message_success'))
        <div class="alert alert-success alert-dismissible new" role="alert">
            <span><i class="fa fa-check" style="padding-right: 10px;"></i> {{ session('flash_message_success') }} {{Auth::user()->name}} </span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

	@include( 'back.common.header' )

	@yield('contant')

	@include( 'back.common.footer' )

<script>
	window.setTimeout(function() {$(".alert").fadeTo(500, 0).slideUp(500, function(){$(this).remove(); });}, 30000);
</script>	
</body>
</html>