@inject('roleService', 'App\Services\RoleService')
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
    :datas="$datas"
    :multiple="$multiple"
    :options="$roleService->toSelect()"
/>