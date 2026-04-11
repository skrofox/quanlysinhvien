<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Thêm bài viết mới') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Left Side: Main Content -->
                    <div class="lg:col-span-2 space-y-6">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="mb-6">
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Tiêu đề bài viết</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors">
                            </div>

                            <div class="mb-6">
                                <label for="summary" class="block text-sm font-medium text-gray-700 mb-2">Tóm tắt ngắn</label>
                                <textarea name="summary" id="summary" rows="3"
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors">{{ old('summary') }}</textarea>
                            </div>

                            <div class="mb-6">
                                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Nội dung chi tiết</label>
                                <div id="editor-container">
                                    <textarea name="content" id="editor" class="hidden">{{ old('content') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Side: Sidebar settings -->
                    <div class="space-y-6">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                            <div class="mb-6">
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Danh mục</label>
                                <select name="category_id" id="category_id" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors">
                                    <option value="">Chọn danh mục</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-6">
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Trạng thái</label>
                                <select name="status" id="status" required
                                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition-colors">
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Công khai</option>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                                </select>
                            </div>

                            <div class="mb-6">
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm font-medium text-gray-700">Đánh dấu là tin nổi bật</span>
                                </label>
                            </div>

                            <div class="mb-6">
                                <label for="thumbnail" class="block text-sm font-medium text-gray-700 mb-2">Hình thu nhỏ (Thumbnail)</label>
                                <input type="file" name="thumbnail" id="thumbnail" accept="image/*"
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors">
                                <p class="mt-2 text-xs text-gray-400">Định dạng: JPG, PNG, GIF. Tối đa 2MB.</p>
                            </div>

                            <div class="pt-6 border-t border-gray-100 flex gap-4">
                                <button type="submit" class="flex-grow inline-flex justify-center items-center px-4 py-3 bg-blue-600 border border-transparent rounded-xl font-bold text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all shadow-lg hover:shadow-xl">
                                    Lưu bài viết
                                </button>
                                <a href="{{ route('admin.news.index') }}" class="inline-flex justify-center items-center px-4 py-3 bg-gray-100 border border-transparent rounded-xl font-bold text-gray-700 uppercase tracking-widest hover:bg-gray-200 transition-all">
                                    Hủy
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: {
                    items: [
                        'heading', '|',
                        'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', '|',
                        'insertTable', 'undo', 'redo'
                    ]
                }
            })
            .then(editor => {
                console.log('Editor was initialized', editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    @endpush

    <style>
        .ck-editor__editable_inline {
            min-height: 400px;
        }
    </style>
</x-app-layout>
