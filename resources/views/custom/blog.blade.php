@extends('custom.master')

@section('content')

<section class="section-pad bg-soft">
    <div class="container">
        <div class="row align-items-end g-3 mb-4">
            <div class="col-lg-7">
                <span class="badge badge-soft rounded-pill px-3 py-2 mb-2">
                    <i class="bi bi-newspaper me-1"></i> Blog
                </span>
                <h1 class="fw-bold mb-2">Latest Updates</h1>
                <p class="text-muted mb-0">Read Raj Yog news, product insights, and manufacturing updates.</p>
            </div>
        </div>

        <div class="row g-4">
            @forelse($blogs as $blog)
                <div class="col-md-6 col-lg-4">
                    <article class="product-item h-100">
                        <div class="product-item-body">
                            <div class="small text-muted mb-2">
                                <i class="bi bi-calendar3"></i> {{ $blog->created_at ? $blog->created_at->format('d M Y') : '' }}
                            </div>

                            <h5 class="fw-bold mb-2">{{ $blog->title }}</h5>

                            <p class="text-muted small mb-3">
                                {{ $blog->short_description ?? \Illuminate\Support\Str::limit(strip_tags($blog->description), 120) }}
                            </p>

                            <a href="{{ route('blogs.show', $blog->slug) }}" class="btn btn-sm btn-brand">
                                <i class="bi bi-eye"></i> Read More
                            </a>
                        </div>
                    </article>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-5 bg-white rounded-3 border">
                        <i class="bi bi-newspaper display-5 text-muted"></i>
                        <h5 class="mt-3">No blogs found</h5>
                        <p class="text-muted mb-0">Blogs will appear here once added from admin.</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $blogs->links() }}
        </div>
    </div>
</section>

@endsection
