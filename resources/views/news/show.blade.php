@extends('app')

@section('content')
<main class="bg-white min-h-screen">
    <!-- Header Banner -->
    <div class="relative h-[400px] w-full overflow-hidden">
        <img src="{{ $article->thumbnail ?? 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80' }}" 
             class="w-full h-full object-cover" alt="{{ $article->title }}">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
        <div class="absolute bottom-0 left-0 w-full p-8 md:p-16">
            <div class="container mx-auto">
                <span class="inline-block px-4 py-1.5 bg-blue-600 text-white text-xs font-bold uppercase tracking-widest rounded mb-6">
                    {{ $article->category->name }}
                </span>
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight max-w-4xl">
                    {{ $article->title }}
                </h1>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-16">
            <!-- Article Content -->
            <div class="lg:col-span-8 flex-grow">
                <div class="flex items-center gap-6 mb-10 pb-10 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author->name) }}&background=EBF4FF&color=1E40AF" 
                             class="w-12 h-12 rounded-full border-2 border-blue-50" alt="Author">
                        <div>
                            <p class="text-sm font-bold text-gray-900">{{ $article->author->name }}</p>
                            <p class="text-xs text-gray-500">Ban Truyền thông</p>
                        </div>
                    </div>
                    <div class="h-8 w-px bg-gray-200 hidden sm:block"></div>
                    <div class="flex flex-wrap items-center gap-6 text-sm text-gray-500 font-medium">
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $article->published_at ? $article->published_at->format('d \t\h\á\n\g m, Y') : $article->created_at->format('d \t\h\á\n\g m, Y') }}
                        </span>
                        <span class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ number_format($article->views) }} lượt xem
                        </span>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="prose prose-lg prose-blue max-w-none text-gray-700 leading-relaxed ck-content">
                    {!! $article->content !!}
                </div>

                <!-- Footer / Share -->
                <div class="mt-16 pt-10 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-6">
                    <div class="flex gap-2">
                        @foreach(explode(' ', $article->title) as $tag)
                            @if(strlen($tag) > 4)
                                <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs rounded-full hover:bg-blue-50 hover:text-blue-600 transition-colors cursor-pointer">
                                    #{{ $tag }}
                                </span>
                            @endif
                            @if($loop->index > 3) @break @endif
                        @endforeach
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-sm font-bold text-gray-400 uppercase tracking-widest">Chia sẻ:</span>
                        <div class="flex gap-2">
                            <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-blue-600 hover:text-white transition-all transform hover:-translate-y-1">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            </a>
                            <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-blue-400 hover:text-white transition-all transform hover:-translate-y-1">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:w-1/3 xl:w-1/4 flex flex-col gap-12">
                <!-- Related News -->
                <div>
                    <h3 class="text-xl font-bold text-gray-900 border-l-4 border-blue-600 pl-4 mb-8">Tin liên quan</h3>
                    <div class="flex flex-col gap-8">
                        @forelse($related as $rel)
                            <a href="{{ route('news.show', $rel->slug) }}" class="group flex gap-4">
                                <div class="w-24 h-24 flex-shrink-0 overflow-hidden rounded-xl bg-gray-100">
                                    <img src="{{ $rel->thumbnail ?? 'https://images.unsplash.com/photo-1541339907198-e08756dedf3f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }}" 
                                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $rel->title }}">
                                </div>
                                <div class="flex flex-col justify-center">
                                    <span class="text-blue-600 text-xs font-bold uppercase tracking-widest mb-1">{{ $rel->category->name }}</span>
                                    <h4 class="text-sm font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-3 leading-snug">
                                        {{ $rel->title }}
                                    </h4>
                                </div>
                            </a>
                        @empty
                            <p class="text-gray-500 italic text-sm">Chưa có tin liên quan.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Call to Action Banner -->
                <div class="bg-blue-600 rounded-3xl p-8 text-white relative overflow-hidden shadow-xl">
                    <div class="relative z-10">
                        <h4 class="text-2xl font-extrabold mb-4">Bạn là Tân sinh viên?</h4>
                        <p class="text-blue-100 text-sm mb-6 leading-relaxed">Đừng bỏ lỡ các thông tin quan trọng về thủ tục nhập học và học bổng năm 2026.</p>
                        <a href="{{ route('tuyen-sinh.thong-tin') }}" class="inline-flex items-center justify-center w-full py-4 bg-white text-blue-700 font-bold rounded-xl hover:bg-gray-50 transition-colors">
                            Xem thông tin ngay
                        </a>
                    </div>
                    <div class="absolute -right-10 -bottom-10 opacity-10">
                         <svg width="200" height="200" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 2L1 21h22L12 2zm0 3.99L19.53 19H4.47L12 5.99z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
    .ck-content blockquote {
        border-left: 4px solid #3b82f6;
        padding-left: 1.5rem;
        font-style: italic;
        color: #4b5563;
        margin: 1.5rem 0;
    }
    .ck-content img {
        border-radius: 1rem;
        margin: 2rem 0;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
    .prose-lg p {
        margin-bottom: 1.5rem;
    }
</style>
@endsection
