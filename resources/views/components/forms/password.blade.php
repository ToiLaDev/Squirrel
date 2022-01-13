@if($random)
    @push('page-scripts')
        <script type="text/javascript">
            $(function () {
                $('#{{$prefixId}}-{{$name}}-random').on('click', function (e) {
                    const input = $(this).prev();
                    const charSet = '{!! $randomCharset !!}';
                    let randomString = '';
                    for (let i = 0; i < {{$randomLength}}; i++) {
                        let randomPoz = Math.floor(Math.random() * charSet.length);
                        randomString += charSet.substring(randomPoz,randomPoz+1);
                    }
                    confirmAction(function () {
                        input.val(randomString);
                    }, randomString, '{{__('Use random string')}}')
                });
            });
        </script>
    @endpush
@endif
<div class="{{ $containerClass }}">
    @if($layout == 'horizontal')
    <div class="col-sm-{{$col[0]}}">
    @endif
    <label class="form-label" for="{{$prefixId}}-{{$name}}">
        {{ __($title) }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    @if($layout == 'horizontal')
    </div>
    <div class="col-sm-{{$col[1]}}">
    @endif
    <div class="input-group form-password-toggle">
        <input
            type="password"
            id="{{$prefixId}}-{{$name}}"
            name="{{$name}}"
            class="form-control @error($name) is-invalid @enderror"
            @isset($placeholder)
            placeholder="{{ $placeholder }}"
            @endisset
            value="{{ old($name, $value) }}"
            @if($disabled)
            disabled
            @endif
            autocomplete="new-password"
            @if($required)
                required
            @endif
        />
        @if($random)
        <button class="btn btn-outline-primary" id="{{$prefixId}}-{{$name}}-random" type="button"><i data-feather="zap"></i></button>
        @endif
        <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
    </div>
    @if($layout == 'horizontal')
    </div>
    @endif
    @error($name)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
