<button type="button" class="btn btn-outline-{{$name}}" data-bs-toggle="modal" data-bs-target="#{{$value}}">{{$title}}</button>
<div class="modal fade text-start" id="{{$value}}" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel1">Basic Modal</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h5>Check First Paragraph</h5>
        <p>
          Oat cake ice cream candy chocolate cake chocolate cake cotton candy dragée apple pie. Brownie
          carrot cake candy canes bonbon fruitcake topping halvah. Cake sweet roll cake cheesecake cookie
          chocolate cake liquorice.
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Accept</button>
      </div>
    </div>
  </div>
</div>
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/components/components-modals.js')) }}"></script>
@endsection
<!-- <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#backdrop">{{ __('Disabled Backdrop') }}</button>
<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#animation">{{ __('Disabled Animation') }}</button>
<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#primary">{{ __('Primary') }}</button>
<button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#secondary">{{ __('Secondary') }}</button>
<button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#success">{{ __('Success') }}</button>
<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#danger">{{ __('Danger') }}</button>
<button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#warning">{{ __('Warning') }}</button>
<button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#info">{{ __('Info') }}</button>
<button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#dark">{{ __('Dark') }}</button> -->

