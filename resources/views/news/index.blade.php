@extends('app')

@section('content')
<main class="bg-gray-50 py-16 min-h-screen">
    <div class="container mx-auto px-4">
        <!-- Breadcrumb & Title -->
        <div class="mb-12">
            <nav class="flex mb-4 text-sm text-gray-500" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ route('home') }}" class="hover:text-blue-600 transition-colors">Trang chủ</a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 text-gray-400 mx-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium text-gray-900">Tin tức & Sự kiện</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 border-l-8 border-blue-600 pl-6 leading-tight">
                Tin tức & Sự kiện
            </h1>
        </div>

        <!-- Categories Filter -->
        <div class="flex flex-wrap gap-3 mb-10 pb-6 border-b border-gray-200">
            <a href="{{ route('news.index') }}" 
               class="px-6 py-2.5 rounded-full font-bold transition-all {{ !request('category') ? 'bg-blue-600 text-white shadow-lg' : 'bg-white text-gray-600 hover:bg-gray-100' }}">
                Tất cả
            </a>
            @foreach($categories as $category)
                <a href="{{ route('news.index', ['category' => $category->slug]) }}" 
                   class="px-6 py-2.5 rounded-full font-bold transition-all {{ request('category') == $category->slug ? 'bg-blue-600 text-white shadow-lg' : 'bg-white text-gray-600 hover:bg-gray-100' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        @if($news->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($news as $article)
                    <article class="group bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden border border-gray-100 flex flex-col h-full">
                        <div class="relative overflow-hidden h-64">
                            <img src="{{ $article->thumbnail ?? 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                                 alt="{{ $article->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute top-4 left-4">
                                <span class="bg-blue-600 text-white text-xs font-bold uppercase tracking-wider px-3 py-1.5 rounded shadow-lg">
                                    {{ $article->category->name }}
                                </span>
                            </div>
                        </div>
                        <div class="p-6 flex-grow flex flex-col">
                            <div class="flex items-center gap-4 text-xs text-gray-500 font-medium mb-3">
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ $article->published_at ? $article->published_at->format('d/m/Y') : $article->created_at->format('d/m/Y') }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ number_format($article->views) }} lượt xem
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors line-clamp-2 leading-tight">
                                <a href="{{ route('news.show', $article->slug) }}">{{ $article->title }}</a>
                            </h3>
                            <p class="text-gray-600 text-sm line-clamp-3 mb-6 flex-grow">
                                {{ $article->summary }}
                            </p>
                            <div class="pt-4 border-t border-gray-50 flex items-center justify-between">
                                <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Đọc tiếp</span>
                                <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center group-hover:bg-blue-600 group-hover:text-white transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('news.show', $article->slug) }}" class="absolute inset-0 z-10"></a>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-16 flex justify-center">
                {{ $news->links() }}
            </div>
        @else
            <div class="text-center py-20 bg-white rounded-3xl shadow-sm border border-dashed border-gray-300">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H14"></path>
                </svg>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Chưa có bài viết nào</h3>
                <p class="text-gray-500">Chúng tôi sẽ sớm cập nhật tin tức mới nhất.</p>
            </div>
        @endif
    </div>
</main>
@endsection
