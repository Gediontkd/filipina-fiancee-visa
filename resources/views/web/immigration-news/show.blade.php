@extends('web.layout.master')

@section('content')
    <!-- Article Header -->
    <section class="article-header ptb-60" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb bg-transparent">
                            <li class="breadcrumb-item">
                                <a href="{{ route('home') }}" class="text-white">Home</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('immigration-news.index') }}" class="text-white">Immigration News</a>
                            </li>
                            <li class="breadcrumb-item active text-white-50" aria-current="page">
                                {{ $article['title'] }}
                            </li>
                        </ol>
                    </nav>
                    
                    <div class="article-meta mb-3">
                        <span class="category category-{{ $article['category'] }}">
                            {{ ucwords(str_replace('-', ' ', $article['category'])) }}
                        </span>
                        <span class="mx-2 text-white">•</span>
                        <span class="text-white">{{ \Carbon\Carbon::parse($article['published_at'])->format('F j, Y') }}</span>
                        <span class="mx-2 text-white">•</span>
                        <span class="text-white">By {{ $article['author'] }}</span>
                    </div>
                    
                    <h1 class="article-title text-white">{{ $article['title'] }}</h1>
                    
                    <div class="article-tags mt-3">
                        @foreach($article['tags'] as $tag)
                        <span class="tag-white">#{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="article-content ptb-60">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Featured Image -->
                    <div class="article-image mb-4">
                        <img src="{{ asset($article['image']) }}" alt="{{ $article['title'] }}" class="img-fluid rounded">
                    </div>

                    <!-- Article Body -->
                    <div class="article-body">
                        <div class="lead mb-4">{{ $article['excerpt'] }}</div>
                        
                        <div class="content">
                            {!! $article['content'] !!}
                        </div>

                        <!-- Social Sharing -->
                        <div class="social-sharing mt-5 pt-4 border-top">
                            <h5>Share this article:</h5>
                            <div class="share-buttons">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                                   target="_blank" class="share-btn facebook">
                                    <i class="fab fa-facebook-f"></i> Facebook
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article['title']) }}" 
                                   target="_blank" class="share-btn twitter">
                                    <i class="fab fa-twitter"></i> Twitter
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" 
                                   target="_blank" class="share-btn linkedin">
                                    <i class="fab fa-linkedin-in"></i> LinkedIn
                                </a>
                                <a href="mailto:?subject={{ urlencode($article['title']) }}&body={{ urlencode($article['excerpt'] . ' Read more: ' . request()->fullUrl()) }}" 
                                   class="share-btn email">
                                    <i class="fas fa-envelope"></i> Email
                                </a>
                            </div>
                        </div>

                        <!-- Call to Action -->
                        <div class="article-cta mt-5 p-4 bg-light rounded">
                            <div class="row align-items-center">
                                <div class="col-md-8">
                                    <h5 class="mb-2">Need Help with Your Immigration Case?</h5>
                                    <p class="mb-0">Our experienced team can guide you through the process. Get a free consultation today.</p>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <a href="{{ route('contactUs') }}" class="btn btn-primary">Get Free Consultation</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="article-sidebar">
                        <!-- Table of Contents (if article is long) -->
                        <div class="toc-widget mb-4">
                            <div class="widget-card">
                                <h5>Quick Links</h5>
                                <ul class="toc-list">
                                    <li><a href="https://www.uscis.gov" target="_blank">USCIS Official Site</a></li>
                                    <li><a href="https://travel.state.gov" target="_blank">State Department</a></li>
                                    <li><a href="{{ route('resource') }}">Visa Resources</a></li>
                                    <li><a href="{{ route('service') }}">Our Services</a></li>
                                    <li><a href="{{ route('contactUs') }}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Related Articles -->
                        @if($relatedNews->count() > 0)
                        <div class="related-widget mb-4">
                            <div class="widget-card">
                                <h5>Related Articles</h5>
                                <div class="related-articles">
                                    @foreach($relatedNews->take(4) as $related)
                                    <article class="related-article">
                                        <div class="related-image">
                                            <img src="{{ asset($related['image']) }}" alt="{{ $related['title'] }}">
                                        </div>
                                        <div class="related-content">
                                            <h6>
                                                <a href="{{ route('immigration-news.show', $related['slug']) }}">
                                                    {{ Str::limit($related['title'], 60) }}
                                                </a>
                                            </h6>
                                            <div class="related-meta">
                                                <span class="date">{{ \Carbon\Carbon::parse($related['published_at'])->format('M j, Y') }}</span>
                                            </div>
                                        </div>
                                    </article>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Newsletter Signup -->
                        <div class="newsletter-widget">
                            <div class="widget-card newsletter-card">
                                <h5>Stay Updated</h5>
                                <p>Subscribe to our newsletter for the latest immigration news and updates.</p>
                                {{ Form::open(['url' => route('newsletter'), 'class' => 'newsletter-form']) }}
                                    <div class="mb-3">
                                        {{ Form::email('email', '', ['class' => 'form-control', 'placeholder' => 'Your email address']) }}
                                    </div>
                                    <div class="mb-3">
                                        {{ Form::submit('Subscribe', ['class' => 'btn btn-primary w-100']) }}
                                    </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related News Section -->
    @if($relatedNews->count() > 0)
    <section class="related-news ptb-60 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-12 mb-4">
                    <h2 class="section-title-modern">You Might Also Like</h2>
                </div>
            </div>
            <div class="row">
                @foreach($relatedNews->take(3) as $related)
                <div class="col-lg-4 col-md-6 mb-4">
                    <article class="news-card">
                        <div class="news-image">
                            <img src="{{ asset($related['image']) }}" alt="{{ $related['title'] }}" class="img-fluid">
                        </div>
                        <div class="news-content">
                            <div class="news-meta">
                                <span class="category category-{{ $related['category'] }}">{{ ucwords(str_replace('-', ' ', $related['category'])) }}</span>
                                <span class="date">{{ \Carbon\Carbon::parse($related['published_at'])->format('M j, Y') }}</span>
                            </div>
                            <h4 class="news-title">
                                <a href="{{ route('immigration-news.show', $related['slug']) }}">{{ $related['title'] }}</a>
                            </h4>
                            <p class="news-excerpt">{{ Str::limit($related['excerpt'], 120) }}</p>
                            <div class="news-footer">
                                <span class="author">By {{ $related['author'] }}</span>
                                <a href="{{ route('immigration-news.show', $related['slug']) }}" class="read-more">Read More</a>
                            </div>
                        </div>
                    </article>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('immigration-news.index') }}" class="btn btn-outline-primary">View All News</a>
            </div>
        </div>
    </section>
    @endif
@endsection

@section('customScript')
<script>
// Smooth scrolling for TOC links
document.addEventListener('DOMContentLoaded', function() {
    const tocLinks = document.querySelectorAll('.toc-list a[href^="#"]');
    
    tocLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>

<style>
/* Article Styles */
.article-header {
    color: white;
}

.breadcrumb {
    margin-bottom: 0;
}

.breadcrumb-item + .breadcrumb-item::before {
    content: '›';
    color: rgba(255, 255, 255, 0.7);
}

.article-title {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1.2;
    margin: 1rem 0;
}

.article-meta {
    font-size: 0.95rem;
}

.category {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
}

.tag-white {
    background: rgba(255, 255, 255, 0.2);
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    margin-right: 0.5rem;
    display: inline-block;
}

.article-image {
    text-align: center;
}

.article-body {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #333;
}

.article-body .lead {
    font-size: 1.25rem;
    font-weight: 400;
    color: #666;
    line-height: 1.6;
}

.article-body .content h2,
.article-body .content h3,
.article-body .content h4 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: #333;
}

.article-body .content p {
    margin-bottom: 1.5rem;
}

.article-body .content ul,
.article-body .content ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.article-body .content li {
    margin-bottom: 0.5rem;
}

/* Social Sharing */
.share-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.share-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
}

.share-btn.facebook {
    background: #1877f2;
    color: white;
}

.share-btn.twitter {
    background: #1da1f2;
    color: white;
}

.share-btn.linkedin {
    background: #0077b5;
    color: white;
}

.share-btn.email {
    background: #666;
    color: white;
}

.share-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    color: white;
}

/* Sidebar */
.article-sidebar {
    position: sticky;
    top: 100px;
}

.widget-card {
    background: white;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.widget-card h5 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: #333;
}

.toc-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.toc-list li {
    margin-bottom: 0.5rem;
}

.toc-list a {
    color: #666;
    text-decoration: none;
    font-size: 0.95rem;
}

.toc-list a:hover {
    color: #667eea;
}

/* Related Articles */
.related-articles {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.related-article {
    display: flex;
    gap: 1rem;
}

.related-image {
    flex-shrink: 0;
    width: 80px;
    height: 60px;
    border-radius: 8px;
    overflow: hidden;
}

.related-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.related-content h6 {
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
    line-height: 1.4;
}

.related-content h6 a {
    color: #333;
    text-decoration: none;
}

.related-content h6 a:hover {
    color: #667eea;
}

.related-meta {
    font-size: 0.8rem;
    color: #666;
}

/* Newsletter Widget */
.newsletter-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.newsletter-card h5,
.newsletter-card p {
    color: white;
}

/* News Cards (for related section) */
.news-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    height: 100%;
}

.news-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.news-image {
    height: 200px;
    overflow: hidden;
}

.news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
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

.date {
    color: #666;
    font-size: 0.9rem;
}

.news-title a {
    color: #333;
    text-decoration: none;
    font-weight: 600;
}

.news-title a:hover {
    color: #667eea;
}

.news-excerpt {
    color: #666;
    line-height: 1.6;
    margin-bottom: 1rem;
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

/* Mobile Responsive */
@media (max-width: 991px) {
    .article-sidebar {
        position: static;
        margin-top: 3rem;
    }
}

@media (max-width: 767px) {
    .article-title {
        font-size: 2rem;
    }
    
    .share-buttons {
        flex-direction: column;
    }
    
    .share-btn {
        justify-content: center;
    }
    
    .related-article {
        flex-direction: column;
    }
    
    .related-image {
        width: 100%;
        height: 120px;
    }
    
    .article-cta .col-md-4 {
        margin-top: 1rem;
    }
}
</style>
@endsection