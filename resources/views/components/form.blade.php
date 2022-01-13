@push('page-scripts')
    <script type="text/javascript">
        $(function () {
            let {{$prefixId}}manualReset = false;

            $('#{{$prefixId}}-form').on('reset', function (e) {
                if({{$prefixId}}manualReset) {
                    {{$prefixId}}manualReset = false;
                    return;
                }
                e.preventDefault();
                confirmAction(function () {
                    {{$prefixId}}manualReset = true;
                    $(e.currentTarget).trigger('reset');
                    e.currentTarget.dispatchEvent(new Event('resetForm'));
                });
            });
        });
    </script>
@endpush
<form
    id="{{$prefixId}}-form"
    class="{{$class}}"
    @isset($action)
    action="{{$action}}"
    @endisset
    method="{{$method}}"
>
    @if(in_array($method, ['POST', 'PUT', 'DELETE']))
    @csrf
    @method($method)
    @endif
    <div class="row">
        @foreach($controls as $control)
            @isset($control['type'])
            @switch($control['type'])
                @case('textarea')
                <x-forms.textarea
                    :fill="$control"
                    :prefixId="$prefixId"
                    :layout="$layout"
                    :col="$col"
                />
                @break
                @case('quill')
                <x-forms.quill
                    :fill="$control"
                    :prefixId="$prefixId"
                    :layout="$layout"
                    :col="$col"
                />
                @break
                @default
                <x-forms.input
                    :fill="$control"
                    :prefixId="$prefixId"
                    :layout="$layout"
                    :col="$col"
                />
            @endswitch
            @else
                <x-forms.input
                    :fill="$control"
                    :prefixId="$prefixId"
                    :layout="$layout"
                    :col="$col"
                />
            @endisset
        @endforeach
        <div class="col-12 mt-50">
            <x-forms.action />
        </div>
    </div>
</form>
