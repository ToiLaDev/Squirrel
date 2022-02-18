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
        @if(!$slot->isEmpty())
            {!! $slot !!}
        @endif
        @foreach($controls as $name => $control)
            <div class="{{ $control['wrap']??$wrap }}">
            @switch($control['type']??null)
                @case('textarea')
                <x-forms.textarea
                    :name="$name"
                    :fill="$control"
                    :prefixId="$prefixId"
                    :layout="$layout"
                    :col="$col"
                />
                @break
                @case('quill')
                <x-forms.quill
                    :name="$name"
                    :fill="$control"
                    :prefixId="$prefixId"
                    :layout="$layout"
                    :col="$col"
                />
                @break
                @case('image')
                <x-forms.image
                        :name="$name"
                        :fill="$control"
                        :prefixId="$prefixId"
                        :layout="$layout"
                        :col="$col"
                />
                @break
                @case('select')
                <x-forms.select
                        :name="$name"
                        :fill="$control"
                        :prefixId="$prefixId"
                        :layout="$layout"
                        :col="$col"
                />
                @break
                @case('select2')
                <x-forms.select2
                        :name="$name"
                        :fill="$control"
                        :prefixId="$prefixId"
                        :layout="$layout"
                        :col="$col"
                />
                @break
                @case('employee')
                <x-employee.select2
                        :name="$name"
                        :fill="$control"
                        :prefixId="$prefixId"
                        :layout="$layout"
                        :col="$col"
                />
                @break
                @case('role')
                <x-role.select2
                        :name="$name"
                        :fill="$control"
                        :prefixId="$prefixId"
                        :layout="$layout"
                        :col="$col"
                />
                @break
                @case('permission')
                <x-forms.permission
                        :name="$name"
                        :title="$control['title']??'Permission'"
                        :model="$control['model']??null"
                />
                @break
                @default
                <x-forms.input
                    :name="$name"
                    :fill="$control"
                    :prefixId="$prefixId"
                    :layout="$layout"
                    :col="$col"
                />
            @endswitch
            </div>
        @endforeach
        <div class="col-12 mt-2">
            <x-forms.action />
        </div>
    </div>
</form>
