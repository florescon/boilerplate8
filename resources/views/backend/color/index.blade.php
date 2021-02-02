@extends('backend.layouts.app')

@section('title', __('Color'))

@section('content')

    <livewire:backend.color-table />

@endsection


@push('after-scripts')

	<script type="text/javascript">
	  Livewire.on("colorStore", () => {
	      $("#exampleModal").modal("hide");
	  });
	</script>


	<script type="text/javascript">
	  Livewire.on("colorUpdate", () => {
	      $("#updateModal").modal("hide");
	  });
	</script>



  <script>
    $(function () {
      // Basic instantiation:
      $('#demo-input').colorpicker();
      
      // Example using an event, to change the color of the #demo div background:
      $('#demo-input').on('colorpickerChange', function(event) {
        $('#demo').css('background-color', event.color.toString());
      });
    });
  </script>

  
@endpush
