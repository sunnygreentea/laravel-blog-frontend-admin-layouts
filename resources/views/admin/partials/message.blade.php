@if (session('success'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
			<div class="alert alert-success" role="alert">
			  {{session('success')}}
			</div>
		</div>
	</div>
</div>
@endif

@if (session('warning'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
			<div class="alert alert-warning" role="alert">
			  {{session('warning')}}
			</div>
		</div>
	</div>
</div>
@endif

@if (session('error'))
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
			<div class="alert alert-danger" role="alert">
			  {{session('error')}}
			</div>
		</div>
	</div>
</div>
@endif
