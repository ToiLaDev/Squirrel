@styles('vendor', asset(mix('vendors/css/forms/select/select2.min.css')))
@scripts('vendor', asset(mix('vendors/js/forms/select/select2.full.min.js')))
@push('page-scripts')
    <script type="text/javascript">
        $(function () {
            $('#{{$prefixId}}-{{$name}}').wrap('{!! $wrap !!}').select2({
                @notEmpty($remote)
                ajax: {
                    url: '{{ $remote }}',
                    dataType: 'json',
                    delay: {{ $remoteDelay }},
                    data: function (params) {
                        return {
                            q: params.term, // search term
                            page: params.page
                        };
                    },
                    processResults: function (result, params) {
                        params.page = params.page || 1;

                        return {
                            results: result.data,
                            pagination: {
                                more: result.meta?(params.page * result.meta.per_page < result.meta.total):false
                            }
                        };
                    },
                    cache: true
                },
                @endNotEmpty
                @notEmpty($templateResult)
                templateResult: {{ $templateResult }},
                @endNotEmpty
                @notEmpty($templateSelection)
                templateSelection: {{ $templateSelection }},
                @endNotEmpty
                dropdownAutoWidth: true,
                minimumInputLength: {{ $minimumInputLength }},
                maximumInputLength: {{ $maximumInputLength }},
                @notEmpty($placeholder)
                placeholder: '{{__($placeholder)}}',
                @endNotEmpty
                width: '100%',
                escapeMarkup: function (markup) {
                    return markup;
                }, // let our custom formatter work
                dropdownParent: $('#{{$prefixId}}-{{$name}}').parent(),
                language: {
                    errorLoading: function() {
                        {!! __('select2.errorLoading') !!}
                    },
                    inputTooLong: function(e) {
                        {!! __('select2.inputTooLong') !!}
                    },
                    inputTooShort: function(e) {
                        {!! __('select2.inputTooShort') !!}
                    },
                    loadingMore: function() {
                        {!! __('select2.loadingMore') !!}
                    },
                    maximumSelected: function(e) {
                        {!! __('select2.maximumSelected') !!}
                    },
                    noResults: function() {
                        {!! __('select2.noResults') !!}
                    },
                    searching: function() {
                        {!! __('select2.searching') !!}
                    },
                    removeAllItems: function() {
                        {!! __('select2.removeAllItems') !!}
                    }
                }
            });
        });
    </script>
@endpush
<div class="{{ $containerClass }}">
    @if($layout == 'horizontal')
    <div class="col-sm-{{$col[0]}}">
    @endif
    <label class="form-label" for="{{$prefixId}}-{{$name}}">{{ __($title) }}</label>
    @if($layout == 'horizontal')
    </div>
    <div class="col-sm-{{$col[1]}}">
    @endif
        <select
            id="{{$prefixId}}-{{$name}}"
            name="{{$name}}{{$multiple?'[]':''}}"
            class="select2 form-select {{ $class }} @error($name) is-invalid @enderror"
            @if($disabled)
            disabled
            @endif
            @if($multiple)
            multiple
            @endif
            @if(is_array($datas))
            @foreach($datas as $key => $val)
            data-{{$key}}="{{$val}}"
            @endforeach
            @endif
        >
                @if($slot->isEmpty())
                    @empty($remote)
                        @isset($default)
                            <option value="">{{ __($default) }}</option>
                        @endisset
                        @foreach($options as $option)
                            @php
                                if (is_string($option)) {
                                    $option = [
                                        'title' => ucfirst($option),
                                        'value' => $option
                                    ];
                                }
                            @endphp
                            <option
                                value="{{$option['value']}}"
                                @if($multiple?in_array($option['value'], (array)$value):$value === $option['value'])
                                    selected
                                @endif
                            >{{$option['title']}}</option>
                        @endforeach
                    @endempty
                @else
                    {!! $slot !!}
                @endif
        </select>
    @if($layout == 'horizontal')
    </div>
    @endif
    @error($name)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
