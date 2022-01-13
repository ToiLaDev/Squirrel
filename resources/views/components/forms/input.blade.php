@if(!empty($slug) || !empty($same))
    @scripts('vendor', asset('js/scripts/toUri.js'))
    @push('page-scripts')
        <script type="text/javascript">
            $(function () {
                $('#{{$prefixId}}-{{$name}}').on('change', function () {
                    const inputValue = $(this).val();
                    @isset($same)
                    $('#{{$prefixId}}-{{$same}}').val(inputValue);
                    @endisset
                    @isset($slug)
                    $('#{{$prefixId}}-{{$slug}}').val(toUri(inputValue));
                    @endisset
                });
            });
        </script>
    @endpush
@endif
@if(in_array($type, ['date', 'datetime']))
    @styles('vendor', asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')))
    @styles('page', [
        asset(mix('css/base/plugins/forms/pickers/form-pickadate.css')),
        asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css'))
    ])
    @scripts('vendor', asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')))
    @push('page-scripts')
        <script type="text/javascript">
            $(function () {
                $('#{{$prefixId}}-{{$name}}').flatpickr({
                    @if($type == 'datetime')
                    enableTime: true,
                    @elseif($type == 'time')
                    enableTime: true,
                    noCalendar: true,
                    @endif
                    onReady: function (selectedDates, dateStr, instance) {
                        if (instance.isMobile) {
                            $(instance.mobileInput).attr('step', null);
                        }
                    }
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
    @isset($icon)
    <div class="input-group input-group-merge">
        <span class="input-group-text">
            <x-icon :icon="$icon" />
        </span>
    @endisset
        <input
            type="{{$type}}"
            id="{{$prefixId}}-{{$name}}"
            name="{{$name}}"
            class="form-control @error($name) is-invalid @enderror @if(in_array($type, ['date', 'datetime'])) flatpickr @endif"
            @isset($placeholder)
            placeholder="{{ $placeholder }}"
            @endisset
            value="{{ old($name, $value) }}"
            @if($disabled)
            disabled
            @endif
            @if($type=='password')
            autocomplete="new-password"
            @endif
            @if($required)
                required
            @endif
        />
    @isset($icon)
    </div>
    @endisset
    @if($layout == 'horizontal')
    </div>
    @endif
    @error($name)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
