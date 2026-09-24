<aside class="side-blog">
    <div class="inner-side-bar pl-30">
        @if($recentPosts->isNotEmpty())
            <div class="widget widget-recent">
                <h3 class="widget-title">Последние статьи</h3>
                <div class="recent-post-list">
                    @foreach($recentPosts as $recent)
                        <div class="list-recent">
                            @if($recent->imageUrl())
                                <div class="recent-image">
                                    <a href="{{ route('blogs.show', $recent->slug) }}">
                                        <img src="{{ $recent->imageUrl() }}" alt="{{ $recent->title }}">
                                    </a>
                                </div>
                            @endif
                            <div class="recent-info">
                                @if($recent->published_at)
                                    <div class="meta">
                                        <i class="icon-1"></i>
                                        <span>{{ $recent->published_at->format('d.m.Y') }}</span>
                                    </div>
                                @endif
                                <h4 class="title">
                                    <a href="{{ route('blogs.show', $recent->slug) }}">{{ $recent->title }}</a>
                                </h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</aside>
