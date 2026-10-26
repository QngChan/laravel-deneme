@extends('Pages.Layouts.master')

@section('page-header')
@if ($post)
<header class="masthead" style="background-image: url('{{ asset('tema/assets/img/post-bg.jpg') }}')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="post-heading">
                    <h1>{{ $post->title }}</h1>
                    @if ($post->subtitle)
                        <h2 class="subheading">{{ $post->subtitle }}</h2>
                    @endif
                    <span class="meta">Posted by <a href="#!">{{ $post->author }}</a>
                        @if ($post->published_at)
                            on {{ $post->published_at->format('F j, Y') }}
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </div>
</header>
@endif
@endsection

@section('content')
@if ($post)
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                @foreach (preg_split('/\R\s*\R/', $post->content) as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>
        </div>
    </div>
</article>
@else
<main class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <p>There are no published posts yet.</p>
            </div>
        </div>
    </div>
</main>
@endif
@endsection
