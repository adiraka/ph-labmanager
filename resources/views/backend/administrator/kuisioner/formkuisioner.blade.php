<div class="header bg-green">
	<h2>Kuisioner <small>tambah kuisioner baru</small></h2>
</div>
<div class="body">
	<form id="f-kuisioner" action="{{ route('adm.posttambahkuisioner') }}" method="POST">
		<input type="hidden" name="_token" value="{{ Session::token() }}" >

		{{-- hal1 --}}
		@include('backend.administrator.kuisioner.k1')

		{{-- hal2 --}}
		@include('backend.administrator.kuisioner.k2')

		{{-- hal3 --}}
		@include('backend.administrator.kuisioner.k3')

		{{-- hal4 --}}
		@include('backend.administrator.kuisioner.k4')

		{{-- hal5 --}}
		@include('backend.administrator.kuisioner.k5')

		{{-- hal6 --}}
		@include('backend.administrator.kuisioner.k6')

		{{-- hal7 --}}
		@include('backend.administrator.kuisioner.k7')

		{{-- hal8 --}}
		@include('backend.administrator.kuisioner.k8')

		{{-- hal9 --}}
		@include('backend.administrator.kuisioner.k9')

		{{-- hal10 --}}
		@include('backend.administrator.kuisioner.k10')

	</form>
</div>