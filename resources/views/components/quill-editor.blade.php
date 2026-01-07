<div
    x-data="{
        content: @entangle($attributes->wire('model')),
        init() {
            let quill = new Quill(this.$refs.editor, {
                theme: 'snow',
                placeholder: 'Tulis materi di sini...',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ 'header': [1, 2, 3, false] }],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['link', 'code-block'],
                        ['clean']
                    ]
                }
            });

            // Set isi awal (untuk edit)
            quill.root.innerHTML = this.content;

            // Saat user mengetik, update variable Livewire
            quill.on('text-change', () => {
                this.content = quill.root.innerHTML;
            });

            // Menangani update dari luar (misal reset form)
            this.$watch('content', (value) => {
                if (value !== quill.root.innerHTML) {
                    quill.root.innerHTML = value;
                }
            });
        }
    }"
    class="bg-white rounded-md border border-gray-300"
    wire:ignore
>
    <div x-ref="editor" style="min-height: 150px;"></div>

    <style>
        .ql-toolbar { border-radius: 0.375rem 0.375rem 0 0; border-color: transparent; border-bottom: 1px solid #e5e7eb; }
        .ql-container { border-radius: 0 0 0.375rem 0.375rem; border: none; }
    </style>
</div>
