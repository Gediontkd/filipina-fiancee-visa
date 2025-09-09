@extends('web.layout.master')

@section('content')
    @include('web.component.bread-crumb', [
        'title' => 'US Immigration News',
    ])

    <!-- Hero Section -->
    <section class="news-hero ptb-60 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 text-center">
                    <h1 class="hero-title">US Immigration News & Updates</h1>
                    <p class="hero-subtitle">Stay informed with the latest immigration news, policy changes, and important updates that affect your visa journey.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured News Section -->
    @if($featuredNews->count() > 0)
    <section class="featured-news ptb-60">
        <div class="container">
            <div class="row mb-4">
                <div class="col-12">
                    <h2 class="section-title-modern">Featured News</h2>
                </div>
            </div>
            <div class="row">
                @foreach($featuredNews as $featured)
                <div class="col-lg-4 col-md-6 mb-4">
                    <article class="news-card featured-card">
                        <div class="news-image">
                            <img src="{{ asset($featured['image']) }}" alt="{{ $featured['title'] }}" class="img-fluid">
                            <div class="news-badge featured">Featured</div>
                        </div>
                        <div class="news-content">
                            <div class="news-meta">
                                <span class="category category-{{ $featured['category'] }}">{{ ucwords(str_replace('-', ' ', $featured['category'])) }}</span>
                                <span class="date">{{ \Carbon\Carbon::parse($featured['published_at'])->format('M j, Y') }}</span>
                            </div>
                            <h3 class="news-title">
                                <a href="{{ route('immigration-news.show', $featured['slug']) }}">{{ $featured['title'] }}</a>
                            </h3>
                            <p class="news-excerpt">{{ $featured['excerpt'] }}</p>
                            <div class="news-footer">
                                <span class="author">By {{ $featured['author'] }}</span>
                                <a href="{{ route('immigration-news.show', $featured['slug']) }}" class="read-more">Read More</a>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Main News Section -->
    <section class="main-news ptb-60 bg-light">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-lg-3 mb-4">
                    <div class="news-sidebar">
                        <!-- Search -->
                        <div class="search-widget">
                            <h4>Search News</h4>
                            <form action="{{ route('immigration-news.index') }}" method="GET" class="search-form">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Search news..." value="{{ $search }}">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <input type="hidden" name="category" value="{{ $category }}">
                            </form>
                        </div>

                        <!-- Categories -->
                        <div class="categories-widget">
                            <h4>Categories</h4>
                            <ul class="category-list">
                                @foreach($categories as $key => $name)
                                <li>
                                    <a href="{{ route('immigration-news.index', ['category' => $key]) }}" 
                                       class="{{ $category === $key ? 'active' : '' }}">
                                        {{ $name }}
                                        <span class="count">({{ collect($news)->where('category', $key)->count() }})</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Quick Links -->
                        <div class="quick-links-widget">
                            <h4>Quick Links</h4>
                            <ul class="quick-links">
                                <li><a href="https://www.uscis.gov" target="_blank"><i class="fas fa-external-link-alt"></i> USCIS Official Site</a></li>
                                <li><a href="https://travel.state.gov/content/travel/en/us-visas/immigrate.html" target="_blank"><i class="fas fa-external-link-alt"></i> State Department</a></li>
                                <li><a href="https://nvc.state.gov" target="_blank"><i class="fas fa-external-link-alt"></i> National Visa Center</a></li>
                                <li><a href="{{ route('resource') }}"><i class="fas fa-book"></i> Visa Resources</a></li>
                                <li><a href="{{ route('contactUs') }}"><i class="fas fa-phone"></i> Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- News List -->
                <div class="col-lg-9">
                    <div class="news-header">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h2>Latest Immigration News</h2>
                            <div class="view-options">
                                <button class="btn btn-sm btn-outline-primary active" data-view="grid">
                                    <i class="fas fa-th"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-primary" data-view="list">
                                    <i class="fas fa-list"></i>
                                </button>
                            </div>
                        </div>

                        @if($search)
                        <div class="search-results-info">
                            <p>Showing {{ count($news) }} results for "{{ $search }}"</p>
                            <a href="{{ route('immigration-news.index') }}" class="btn btn-sm btn-outline-secondary">Clear Search</a>
                        </div>
                        @endif
                    </div>

                    <div class="news-grid" id="newsGrid">
                        @if(count($news) > 0)
                            @foreach($news as $article)
                            <article class="news-card">
                                <div class="news-image">
                                    <img src="{{ asset($article['image']) }}" alt="{{ $article['title'] }}" class="img-fluid">
                                    @if($article['featured'])
                                    <div class="news-badge featured">Featured</div>
                                    @endif
                                </div>
                                <div class="news-content">
                                    <div class="news-meta">
                                        <span class="category category-{{ $article['category'] }}">{{ ucwords(str_replace('-', ' ', $article['category'])) }}</span>
                                        <span class="date">{{ \Carbon\Carbon::parse($article['published_at'])->format('M j, Y') }}</span>
                                    </div>
                                    <h3 class="news-title">
                                        <a href="{{ route('immigration-news.show', $article['slug']) }}">{{ $article['title'] }}</a>
                                    </h3>
                                    <p class="news-excerpt">{{ $article['excerpt'] }}</p>
                                    <div class="news-tags">
                                        @foreach($article['tags'] as $tag)
                                        <span class="tag">#{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                    <div class="news-footer">
                                        <span class="author">By {{ $article['author'] }}</span>
                                        <a href="{{ route('immigration-news.show', $article['slug']) }}" class="read-more">Read More</a>
                                    </div>
                                </div>
                            </article>
                            @endforeach
                        @else
                            <div class="no-results">
                                <div class="text-center py-5">
                                    <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                                    <h4>No News Found</h4>
                                    <p>No news articles match your current search criteria.</p>
                                    <a href="{{ route('immigration-news.index') }}" class="btn btn-primary">View All News</a>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Newsletter Signup -->
                    <div class="newsletter-signup mt-5">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4>Stay Updated</h4>
                                <p>Get the latest immigration news and updates delivered to your inbox.</p>
                                {{ Form::open(['url' => route('newsletter'), 'class' => 'newsletter-form d-flex gap-2 justify-content-center']) }}
                                    {{ Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Your email address', 'style' => 'max-width: 300px;']) }}
                                    {{ Form::submit('Subscribe', ['class' => 'btn btn-primary']) }}
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('customScript')
<script>
// View toggle functionality
document.addEventListener('DOMContentLoaded', function() {
    const viewButtons = document.querySelectorAll('[data-view]');
    const newsGrid = document.getElementById('newsGrid');
    
    viewButtons.forEach(button => {
        button.addEventListener('click', function() {
            const view = this.dataset.view;
            
            // Update active button
            viewButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Update grid class
            newsGrid.className = view === 'list' ? 'news-list' : 'news-grid';
        });
    });
});
</script>

<style>
/* News Styles */
.news-hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.hero-subtitle {
    font-size: 1.1rem;
    opacity: 0.9;
}

.section-title-modern {
    font-size: 2rem;
    font-weight: 700;
    color: #333;
    margin-bottom: 2rem;
}

/* News Cards */
.news-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
}

.news-list {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.news-list .news-card {
    display: flex;
    align-items: flex-start;
}

.news-list .news-image {
    flex-shrink: 0;
    width: 200px;
    margin-right: 1.5rem;
}

.news-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.news-image {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.news-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: #ff6b6b;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
}

.news-badge.featured {
    background: #ffd700;
    color: #333;
}

.news-content {
    padding: 1.5rem;
}

.news-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.category {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

.category-uscis { background: #e3f2fd; color: #1976d2; }
.category-visa-bulletins { background: #f3e5f5; color: #7b1fa2; }
.category-policy-changes { background: #fff3e0; color: #f57c00; }
.category-processing-times { background: #e8f5e8; color: #388e3c; }
.category-fees { background: #ffebee; color: #d32f2f; }
.category-embassy { background: #f1f8e9; color: #689f38; }
.category-legislation { background: #fce4ec; color: #c2185b; }

.date {
    color: #666;
    font-size: 0.9rem;
}

.news-title {
    margin-bottom: 1rem;
}

.news-title a {
    color: #333;
    text-decoration: none;
    font-size: 1.25rem;
    font-weight: 600;
    line-height: 1.4;
}

.news-title a:hover {
    color: #667eea;
}

.news-excerpt {
    color: #666;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.news-tags {
    margin-bottom: 1rem;
}

.tag {
    display: inline-block;
    background: #f8f9fa;
    color: #666;
    padding: 0.25rem 0.5rem;
    border-radius: 15px;
    font-size: 0.8rem;
    margin-right: 0.5rem;
    margin-bottom: 0.25rem;
}

.news-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1rem;
    border-top: 1px solid #eee;
}

.author {
    color: #666;
    font-size: 0.9rem;
}

.read-more {
    color: #667eea;
    text-decoration: none;
    font-weight: 600;
}

.read-more:hover {
    color: #764ba2;
}

/* Sidebar */
.news-sidebar .search-widget,
.news-sidebar .categories-widget,
.news-sidebar .quick-links-widget {
    background: white;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    margin-bottom: 2rem;
}

.news-sidebar h4 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #333;
}

.search-form .input-group {
    display: flex;
}

.search-form .form-control {
    border-radius: 8px 0 0 8px;
    border: 1px solid #ddd;
}

.search-form .btn {
    border-radius: 0 8px 8px 0;
    border: 1px solid #667eea;
    background: #667eea;
}

.category-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.category-list li {
    margin-bottom: 0.5rem;
}

.category-list a {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #666;
    text-decoration: none;
    padding: 0.5rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.category-list a:hover,
.category-list a.active {
    color: #667eea;
}

.count {
    font-size: 0.8rem;
    color: #999;
}

.quick-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.quick-links li {
    margin-bottom: 0.75rem;
}

.quick-links a {
    color: #666;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.quick-links a:hover {
    color: #667eea;
}

.newsletter-signup {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 12px;
}

.newsletter-signup .card {
    background: transparent;
    border: none;
}

.newsletter-signup .card-body {
    color: white;
}

.search-results-info {
    background: #f8f9fa;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 2rem;
}

.no-results {
    grid-column: 1 / -1;
}

/* Mobile Responsive */
@media (max-width: 767px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .news-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .news-list .news-card {
        flex-direction: column;
    }
    
    .news-list .news-image {
        width: 100%;
        margin-right: 0;
        margin-bottom: 1rem;
    }
    
    .newsletter-form {
        flex-direction: column;
        gap: 1rem !important;
    }
    
    .newsletter-form .form-control {
        max-width: 100% !important;
    }
}
</style>
@endsection