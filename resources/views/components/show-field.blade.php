@props([
    'label' => '',
    'value' => ''
])
<div class="row mb-2">
    <label class="col-sm-4 fw-medium">{{ $label }}</label>
    <div class="col-sm-8">
        : {{ $value }}
    </div>
</div>