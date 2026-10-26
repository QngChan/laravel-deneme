@extends('Pages.Layouts.master')

@section('page-header')
<header class="masthead" style="background-image: url('{{ asset('tema/assets/img/home-bg.jpg') }}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h1>Clean Blog</h1>
                    <span class="subheading">A Blog Theme by Start Bootstrap</span>
                </div>
            </div>
        </div>
    </div>
</header>
@endsection

@section('content')
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            @forelse ($posts as $post)
                <div class="post-preview">
                    <a href="{{ route('posts.show', $post) }}">
                        <h2 class="post-title">{{ $post->title }}</h2>
                        @if ($post->subtitle)
                            <h3 class="post-subtitle">{{ $post->subtitle }}</h3>
                        @endif
                    </a>
                    <p class="post-meta">Posted by <a href="#!">{{ $post->author }}</a>
                        @if ($post->published_at)
                            on {{ $post->published_at->format('F j, Y') }}
                        @endif
                    </p>
                </div>
                @if (!$loop->last)
                    <hr class="my-4">
                @endif
            @empty
                <p class="text-center">There are no published posts yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
