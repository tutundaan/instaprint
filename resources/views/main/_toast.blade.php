@if ($errors->any())
	<div id="toastsContainerTopRight" class="toasts-top-right fixed mt-4 mr-4">
		<div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
			<div class="toast-header">
				<i class="mr-2 fas fa-exclamation"></i>
				<strong class="mr-auto">Error</strong>
				<button data-dismiss="toast" onclick="$('.toast').hide()" type="button" class="ml-2 mb-1 close" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="toast-body">
		        @foreach ($errors->all() as $error)
		            <p>{{ $error }}</p>
		        @endforeach
			</div>
		</div>
	</div>
@endif

@section('scripts')
<script>
	$(document).ready(function () {
		var toast = $('.toast');

		setTimeout(function() {
			toast.hide();
		}, 5000);
	})
</script>
@endsection