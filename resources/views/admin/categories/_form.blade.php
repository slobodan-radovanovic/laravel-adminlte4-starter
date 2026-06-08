<div class="mb-3">
    <label for="name" class="form-label">Name</label>

    <input type="text"
           id="name"
           name="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $category->name ?? '') }}"
           required
           autofocus>

    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="slug" class="form-label">Slug</label>

    <input type="text"
           id="slug"
           name="slug"
           class="form-control @error('slug') is-invalid @enderror"
           value="{{ old('slug', $category->slug ?? '') }}">

    <div class="form-text">
        Leave empty to generate automatically from name.
    </div>

    @error('slug')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>

    <textarea id="description"
              name="description"
              rows="4"
              class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description ?? '') }}</textarea>

    @error('description')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-check form-switch mb-3">
    <input type="hidden" name="is_active" value="0">

    <input type="checkbox"
           id="is_active"
           name="is_active"
           value="1"
           class="form-check-input"
        @checked(old('is_active', $category->is_active ?? true))>

    <label for="is_active" class="form-check-label">
        Active
    </label>
</div>
