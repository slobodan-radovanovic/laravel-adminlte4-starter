@props([
    'id',
    'heads' => [],
    'config' => [],
    'striped' => true,
    'hoverable' => true,
    'bordered' => true,
    'compact' => false,
])

{{--
    Table enhanced with DataTables (search, sorting, paging). Put the <tr> rows in the slot.
    heads: ['Name', 'Email', ['label' => 'Actions', 'class' => 'text-end', 'sortable' => false]]
--}}
@php
    $columns = collect($heads)->map(fn ($head) => is_array($head) ? $head : ['label' => $head]);

    $config = array_merge([
        'columnDefs' => $columns
            ->map(fn ($head, $index) => ($head['sortable'] ?? true) ? null : ['targets' => $index, 'orderable' => false, 'searchable' => false])
            ->filter()
            ->values()
            ->all(),
    ], $config);

    $classes = collect([
        'table align-middle w-100',
        $striped ? 'table-striped' : null,
        $hoverable ? 'table-hover' : null,
        $bordered ? 'table-bordered' : null,
        $compact ? 'table-sm' : null,
    ])->filter()->implode(' ');
@endphp

@push('plugins')
    datatables
@endpush

<table id="{{ $id }}" data-admin-datatable="{{ json_encode($config) }}" {{ $attributes->merge(['class' => $classes]) }}>
    @if ($columns->isNotEmpty())
        <thead>
        <tr>
            @foreach ($columns as $head)
                <th @if (isset($head['class'])) class="{{ $head['class'] }}" @endif
                    @if (isset($head['width'])) style="width: {{ $head['width'] }}" @endif>
                    {{ $head['label'] ?? '' }}
                </th>
            @endforeach
        </tr>
        </thead>
    @endif

    <tbody>
    {{ $slot }}
    </tbody>
</table>
