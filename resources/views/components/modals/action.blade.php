<button type="button" class="btn btn-outline-{{ $containerClass }}" data-bs-toggle="modal" data-bs-target="#{{$value}}">{{ __($title) }}</button>
<div class="modal fade text-start modal-{{$value}}" id="{{$value}}" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    @foreach($options as $option)
    @php
    if (is_string($option)) {
      $option = [
        'title' => ucfirst($option),
        'value' => $option
      ];
    }
    @endphp
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myModalLabel160">{{__($option['title'])}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {{__($option['value'])}}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-{{$value}}" data-bs-dismiss="modal">Accept</button>
      </div>
    </div>
    @endforeach
  </div>
</div>
@error($name)
<span class="invalid-feedback" role="alert">
  <strong>{{ $message }}</strong>
</span>
@enderror
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/components/components-modals.js')) }}"></script>
@endsection