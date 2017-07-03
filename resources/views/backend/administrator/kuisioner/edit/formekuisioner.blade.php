<div class="header bg-green">
	<h2>Kuisioner <small>edit kuisioner</small></h2>
</div>
<div class="body">
	<form id="f-kuisioner" action="{{ route('adm.postupdatekuisioner') }}" method="POST">
		<input type="hidden" name="_token" value="{{ Session::token() }}" >
		<input type="hidden" name="_id" value="{{ $ans->id }}" >

		{{-- hal1 --}}
		@include('backend.administrator.kuisioner.edit.k1')

		{{-- hal2 --}}
		@include('backend.administrator.kuisioner.edit.k2')

		{{-- hal3 --}}
		@include('backend.administrator.kuisioner.edit.k3')

		{{-- hal4 --}}
		@include('backend.administrator.kuisioner.edit.k4')

		{{-- hal5 --}}
		@include('backend.administrator.kuisioner.edit.k5')

		{{-- hal6 --}}
		@include('backend.administrator.kuisioner.edit.k6')

		{{-- hal7 --}}
		@include('backend.administrator.kuisioner.edit.k7')

		{{-- hal8 --}}
		@include('backend.administrator.kuisioner.edit.k8')

		{{-- hal9 --}}
		@include('backend.administrator.kuisioner.edit.k9')

		{{-- hal10 --}}
		@include('backend.administrator.kuisioner.edit.k10')

	</form>
</div>