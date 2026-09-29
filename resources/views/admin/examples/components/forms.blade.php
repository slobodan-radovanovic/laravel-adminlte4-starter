@extends('layouts.admin')

@section('title', 'Form Components')

@section('content_header')
    <x-admin.content-header title="Form Components" :breadcrumbs="['Components', 'Forms']" />
@endsection

@section('content')
    @if (session('submitted'))
        <x-admin.card title="Submitted values" icon="bi bi-check2-square" theme="success" outline collapsible>
            <pre class="mb-0 small">{{ json_encode(session('submitted'), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) }}</pre>
        </x-admin.card>
    @endif

    <x-admin.callout theme="info" title="Try it" icon="bi bi-lightbulb">
        Submit the form empty to see validation errors, or fill it in to see the submitted values.
        Every field below is a single Blade component from <code>resources/views/components/admin/form</code>.
    </x-admin.callout>

    <form method="POST" action="{{ route('examples.components.forms.submit') }}" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-lg-6">
                <x-admin.card title="Basic inputs" icon="bi bi-input-cursor-text">
                    <x-admin.form.input name="name" label="Name" required placeholder="Jane Doe" />

                    <x-admin.form.input name="email" type="email" label="Email" required>
                        <x-slot:prepend><i class="bi bi-envelope"></i></x-slot:prepend>
                    </x-admin.form.input>

                    <x-admin.form.input name="website" type="url" label="Website" prepend="https://" append=".com" placeholder="example" help="Input with text addons" />

                    <x-admin.form.input name="password" type="password" label="Password" help="At least 8 characters" />

                    <x-admin.form.textarea name="bio" label="Bio" rows="3" />
                </x-admin.card>

                <x-admin.card title="Selects" icon="bi bi-menu-button-wide">
                    <x-admin.form.select
                        name="country"
                        label="Country (select + options)"
                        required
                        placeholder="Choose a country"
                        :options="['Europe' => ['rs' => 'Serbia', 'de' => 'Germany', 'fr' => 'France'], 'America' => ['us' => 'United States', 'ca' => 'Canada']]"
                    />

                    <x-admin.form.select2
                        name="languages[]"
                        label="Languages (Select2, multiple)"
                        multiple
                        placeholder="Pick languages"
                        :options="['php' => 'PHP', 'js' => 'JavaScript', 'py' => 'Python', 'go' => 'Go', 'rust' => 'Rust']"
                        :selected="['php']"
                    />

                    <x-admin.form.select-tom
                        name="framework"
                        label="Framework (Tom Select)"
                        placeholder="Search a framework"
                        :options="['laravel' => 'Laravel', 'symfony' => 'Symfony', 'rails' => 'Ruby on Rails', 'django' => 'Django']"
                    />

                    <x-admin.form.select-tom
                        name="tags[]"
                        label="Tags (Tom Select, type to create)"
                        multiple
                        create
                        placeholder="Add tags"
                        :options="['admin' => 'admin', 'laravel' => 'laravel']"
                    />
                </x-admin.card>
            </div>

            <div class="col-lg-6">
                <x-admin.card title="Dates, switches and pickers" icon="bi bi-sliders">
                    <x-admin.form.input-date name="birthday" label="Birthday (Flatpickr)" placeholder="YYYY-MM-DD" />

                    <x-admin.form.input-date name="meeting" label="Meeting (date and time)" time placeholder="YYYY-MM-DD HH:MM" />

                    <x-admin.form.date-range name="vacation" label="Vacation (date range)" />

                    <x-admin.form.input-switch name="newsletter" label="Subscribe to the newsletter" checked />

                    <x-admin.form.input-color name="accent" label="Accent color" value="#6f42c1" />

                    <x-admin.form.input-slider name="volume" label="Volume" :value="40" unit="%" />
                </x-admin.card>

                <x-admin.card title="Files and rich text" icon="bi bi-file-earmark-richtext">
                    <x-admin.form.input-file name="avatar" label="Avatar (native file input)" accept="image/*" help="Image up to 2 MB" />

                    <x-admin.form.input-file-drop
                        name="attachments"
                        label="Attachments (Dropzone)"
                        :url="route('examples.components.upload')"
                        accept="image/*,application/pdf"
                        :max-files="3"
                        help="Up to 3 images or PDFs, 5 MB each. Files upload immediately; their paths are submitted with the form."
                    />

                    <x-admin.form.text-editor name="content" label="Content (Quill editor)" placeholder="Write something..." />
                </x-admin.card>

                <x-admin.card title="TinyMCE" icon="bi bi-file-earmark-word">
                    <x-admin.form.text-editor-tinymce
                        name="article"
                        label="Article (TinyMCE)"
                        :value="'<p>TinyMCE is <strong>loaded only on this page</strong>. Try tables, links and the code view.</p>'"
                        help="Self-hosted TinyMCE, GPL-2.0-or-later. Set TINYMCE_LICENSE_KEY for a commercial license."
                    />
                </x-admin.card>
            </div>
        </div>

        <x-admin.card>
            <div class="d-flex flex-wrap gap-2">
                <x-admin.form.button type="submit" label="Submit" icon="bi bi-send" />
                <x-admin.form.button type="reset" label="Reset" theme="secondary" outline icon="bi bi-arrow-counterclockwise" />
                <x-admin.form.button label="Success" theme="success" />
                <x-admin.form.button label="Danger" theme="danger" outline size="sm" />
                <x-admin.form.button icon="bi bi-heart-fill" theme="danger" aria-label="Like" />
                <x-admin.form.button label="Link button" theme="link" :url="route('examples.components.widgets')" />
            </div>
        </x-admin.card>
    </form>
@endsection
