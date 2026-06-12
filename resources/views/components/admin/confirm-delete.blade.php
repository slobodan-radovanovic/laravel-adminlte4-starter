@props([
    'id',
    'action',
    'title' => 'Delete Record',
    'message' => 'Are you sure you want to delete this record?',
    'buttonClass' => 'btn btn-sm btn-outline-danger',
    'buttonText' => null,
])

<button type="button"
        class="{{ $buttonClass }}"
        data-bs-toggle="modal"
        data-bs-target="#{{ $id }}">
    @if ($buttonText)
        {{ $buttonText }}
    @else
        <i class="bi bi-trash"></i>
    @endif
</button>

<div class="modal fade"
     id="{{ $id }}"
     tabindex="-1"
     aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST"
              action="{{ $action }}"
              class="modal-content text-start">
            @csrf
            @method('DELETE')

            <div class="modal-header">
                <h5 class="modal-title">{{ $title }}</h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{ $message }}
            </div>

            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                    Cancel
                </button>

                <button type="submit" class="btn btn-danger">
                    Delete
                </button>
            </div>
        </form>
    </div>
</div>
