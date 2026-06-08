@extends('custom.master')

@section('content')

<section class="pd-breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('blogs.index') }}">Blog</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $blog->title }}</li>
            </ol>
        </nav>
    </div>
</section>

<section class="section-pad bg-white">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <article>
                    <span class="badge badge-soft rounded-pill px-3 py-2 mb-3">
                        <i class="bi bi-calendar3 me-1"></i> {{ $blog->created_at ? $blog->created_at->format('d M Y') : 'Blog' }}
                    </span>

                    <h1 class="fw-bold mb-3">{{ $blog->title }}</h1>

                    @if($blog->short_description)
                        <p class="lead text-muted mb-4">{{ $blog->short_description }}</p>
                    @endif

                    <div class="pd-highlights">
                        {!! $blog->description ?? '<p>Blog details will be updated soon.</p>' !!}
                    </div>
                </article>
            </div>

            <div class="col-lg-4">
                <div class="pd-side sticky-lg-top">
                    <div class="pd-side-card">
                        <h6 class="fw-bold mb-3">Related Blogs</h6>

                        @forelse($relatedBlogs as $relatedBlog)
                            <a href="{{ route('blogs.show', $relatedBlog->slug) }}" class="text-decoration-none d-block mb-3">
                                <div class="fw-bold text-dark">{{ $relatedBlog->title }}</div>
                                <div class="small text-muted">{{ $relatedBlog->created_at ? $relatedBlog->created_at->format('d M Y') : '' }}</div>
                            </a>
                        @empty
                            <p class="small text-muted mb-0">More blogs will appear here soon.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
