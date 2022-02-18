@push('page-scripts')
    <script type="text/javascript">
        function templateResultEmployee(item) {
            if (item.loading) return '{{ __('Loading...') }}';

            var markup =
                '<div class="d-flex justify-content-left align-items-center">' +
                '<div class="avatar-wrapper"><div class="avatar mr-1"><img src="' +
                item.avatar +
                '" /></div></div>' +
                '<div class="d-flex flex-column">' +
                '<a href="javascript:void()" class="user_name text-truncate"><span class="font-weight-bold">#' +
                item.id +
                ' - ' +
                item.full_name +
                '</span></a>';

            if (item.phone) {
                markup += '<small class="emp_post text-muted">' + item.phone + '</small>';
            }
            if (item.email) {
                markup += '<small class="emp_post text-muted">' + item.email + '</small>';
            }

            markup += '</div></div>';

            return markup;
        }
        function templateSelectionEmployee(item) {
            if (item.full_name) {
                return '#' + item.id + ' - ' + item.full_name + (item.phone?' - ' + item.phone:'');
            } else {
                return '#' + item.id + ' - ' + item.text;
            }
        }
    </script>
@endpush
<x-forms.select2
        :name="$name"
        :value="$value"
        :title="$title"
        :placeholder="$placeholder"
        :prefixId="$prefixId"
        :containerClass="$containerClass"
        :wrap="$wrap"
        :class="$class"
        :layout="$layout"
        :col="$col"
        :fill="$fill"
        :disabled="$disabled"
        :multiple="$multiple"
        :remote="route('admin.employees.search', ['role'=>$role])"
        minimumInputLength="1"
        templateResult="templateResultEmployee"
        templateSelection="templateSelectionEmployee"
>
@if(!$slot->isEmpty())
    {!! $slot !!}
@endif
</x-forms.select2>