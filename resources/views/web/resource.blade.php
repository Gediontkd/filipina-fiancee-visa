@extends('web.layout.master')
@section('content')
	<section class="breadcrumb-main">
        <div class="container">
			<div class="row">
				<div id="breadcrumb">
				<div class="breadcrumb-txt">
				<h3>Resources</h3>
				</div>
				<div class="row">
					<div class="col">
						<div class="breadcrumb-nav">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Resources</li>
							</ol>
						</nav>
						</div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Modern Resources Hero -->
	<section class="resources-hero ptb-60 bg-light">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<h2 class="section-title-modern" data-aos="fade-up">Immigration Resources</h2>
					<p class="section-subtitle" data-aos="fade-up" data-aos-delay="100">
						Comprehensive guides, FAQs, and helpful information to navigate your immigration journey with confidence.
					</p>
					<!-- Search Bar -->
					<div class="resources-search" data-aos="fade-up" data-aos-delay="200">
						<form action="javascript:void(0)" class="search-form-modern">
							<div class="search-input-group">
								<input type="text" name="search" class="search-input" placeholder="Search guides, FAQs, requirements...">
								<button type="submit" class="search-btn">
									<i class="fas fa-search"></i>
									<span>Search</span>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Quick Links Section -->
	<section class="quick-links ptb-60">
		<div class="container">
			<div class="row">
				<div class="col-12 mb-4">
					<h3 class="text-center section-title-modern" data-aos="fade-up">Popular Resources</h3>
					<p class="text-center section-subtitle" data-aos="fade-up" data-aos-delay="100">
						Quick access to our most requested information
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
					<div class="quick-link-card featured">
						<div class="quick-link-icon">
							<i class="fas fa-balance-scale"></i>
						</div>
						<h4>K-1 vs CR-1 Comparison</h4>
						<p>Understand the differences between fiancé and spouse visas to make the right choice for your situation.</p>
						<a href="{{ route('resource.page', 'fiancee-visa-k-1-vs-spousal-visa-cr-1') }}" class="quick-link-btn">
							Learn More <i class="fas fa-arrow-right ms-2"></i>
						</a>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
					<div class="quick-link-card">
						<div class="quick-link-icon">
							<i class="fas fa-dollar-sign"></i>
						</div>
						<h4>Income Requirements</h4>
						<p>Learn about the financial requirements for sponsoring a fiancé or spouse visa application.</p>
						<a href="{{ route('resource.page', 'income-requirements') }}" class="quick-link-btn">
							Learn More <i class="fas fa-arrow-right ms-2"></i>
						</a>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
					<div class="quick-link-card">
						<div class="quick-link-icon">
							<i class="fas fa-clipboard-list"></i>
						</div>
						<h4>K-1 Requirements</h4>
						<p>Complete list of requirements and documents needed for a successful K-1 fiancée visa application.</p>
						<a href="{{ route('resource.page', 'requirements-for-a-k-1-fiancee-visa') }}" class="quick-link-btn">
							Learn More <i class="fas fa-arrow-right ms-2"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Main Resources Grid -->
	<section class="resources-main bg-light ptb-80">
		<div class="container">
			<div class="row">
				<!-- Resources Categories -->
				<div class="col-lg-8">
					<div class="resources-grid">
						<!-- Immigration Guides -->
						<div class="resource-category" data-aos="fade-up" data-aos-delay="200">
							<div class="category-header">
								<div class="category-icon">
									<i class="fas fa-book-open"></i>
								</div>
								<h3>Immigration Guides</h3>
								<p>Step-by-step guides for various immigration processes</p>
							</div>
							<div class="resource-items">
								<a href="{{ route('resource.page', 'fiancee-visa-k-1-vs-spousal-visa-cr-1') }}" class="resource-item">
									<i class="fas fa-file-alt"></i>
									<span>Fiancee Visa (K-1) vs. Spousal Visa (CR-1)</span>
								</a>
								<a href="{{ route('resource.page', 'income-requirements') }}" class="resource-item">
									<i class="fas fa-file-alt"></i>
									<span>Income Requirements</span>
								</a>
								<a href="{{ route('resource.page', 'requirements-for-a-k-1-fiancee-visa') }}" class="resource-item">
									<i class="fas fa-file-alt"></i>
									<span>Requirements for a K-1 Fiancee Visa</span>
								</a>
								<a href="{{ route('resource.page', 'how-to-get-a-us-tourist-visa-from-the-philippines') }}" class="resource-item">
									<i class="fas fa-file-alt"></i>
									<span>How to get a US Tourist Visa from the Philippines</span>
								</a>
							</div>
						</div>

						<!-- Cultural & Relationship -->
						<div class="resource-category" data-aos="fade-up" data-aos-delay="300">
							<div class="category-header">
								<div class="category-icon">
									<i class="fas fa-heart"></i>
								</div>
								<h3>Cultural & Relationship</h3>
								<p>Understanding Filipino culture and building strong relationships</p>
							</div>
							<div class="resource-items">
								<a href="{{ route('resource.page', 'how-to-get-married-in-the-philippines') }}" class="resource-item">
									<i class="fas fa-file-alt"></i>
									<span>How to get married in the Philippines</span>
								</a>
								<a href="{{ route('resource.page', 'filipino-wedding-traditions') }}" class="resource-item">
									<i class="fas fa-file-alt"></i>
									<span>Filipino Wedding Traditions</span>
								</a>
								<a href="{{ route('resource.page', 'cross-cultural-personal-relationships') }}" class="resource-item">
									<i class="fas fa-file-alt"></i>
									<span>Cross-cultural Personal Relationships</span>
								</a>
								<a href="{{ route('resource.page', 'the-importance-of-family-values-for-filipinos') }}" class="resource-item">
									<i class="fas fa-file-alt"></i>
									<span>The Importance of Family Values for Filipinos</span>
								</a>
							</div>
						</div>

						<!-- Language & Communication -->
						<div class="resource-category" data-aos="fade-up" data-aos-delay="400">
							<div class="category-header">
								<div class="category-icon">
									<i class="fas fa-comments"></i>
								</div>
								<h3>Language & Communication</h3>
								<p>Learn basic Filipino phrases and improve communication</p>
							</div>
							<div class="resource-items">
								<a href="{{ route('resource.page', 'tagalog-phrases') }}" class="resource-item">
									<i class="fas fa-file-alt"></i>
									<span>Tagalog Phrases</span>
								</a>
								<a href="{{ route('resource.page', 'cebuano-phrases') }}" class="resource-item">
									<i class="fas fa-file-alt"></i>
									<span>Cebuano Phrases</span>
								</a>
								<a href="{{ route('resource.page', 'list-of-islands-of-the-philippines') }}" class="resource-item">
									<i class="fas fa-file-alt"></i>
									<span>List of islands of the Philippines</span>
								</a>
							</div>
						</div>

						<!-- Legal & Safety -->
						<div class="resource-category" data-aos="fade-up" data-aos-delay="500">
							<div class="category-header">
								<div class="category-icon">
									<i class="fas fa-shield-alt"></i>
								</div>
								<h3>Legal & Safety</h3>
								<p>Important legal information and safety considerations</p>
							</div>
							<div class="resource-items">
								<a href="{{ route('resource.page', 'internet-dating-romance-scams') }}" class="resource-item">
									<i class="fas fa-file-alt"></i>
									<span>Internet Dating & Romance Scams</span>
								</a>
								<a href="{{ route('resource.page', 'prenuptial-agreement') }}" class="resource-item">
									<i class="fas fa-file-alt"></i>
									<span>Prenuptial Agreement</span>
								</a>
								<a href="{{ route('resource.page', 'the-international-marriage-broker-regulation-act-imbra') }}" class="resource-item">
									<i class="fas fa-file-alt"></i>
									<span>The International Marriage Broker Regulation Act (IMBRA)</span>
								</a>
								<a href="{{ route('resource.page', 'the-u-s-domicile-requirement-for-petitioners-living-outside-the-u-s') }}" class="resource-item">
									<i class="fas fa-file-alt"></i>
									<span>The U.S. Domicile Requirement for Petitioners Living Outside the U.S.</span>
								</a>
							</div>
						</div>
					</div>
				</div>

				<!-- Sidebar -->
				<div class="col-lg-4">
					<div class="resources-sidebar">
						<!-- Help Card -->
						<div class="sidebar-card help-card" data-aos="fade-left" data-aos-delay="200">
							<div class="card-icon">
								<i class="fas fa-headset"></i>
							</div>
							<h4>Need Personal Help?</h4>
							<p>Can't find what you're looking for? Our immigration experts are here to help with personalized guidance.</p>
							<a href="tel:702-426-4503" class="btn btn-primary-gradient w-100 mb-2">
								<i class="fas fa-phone me-2"></i>
								Call 702-426-4503
							</a>
							<a href="{{ route('contactUs') }}" class="btn btn-outline-primary w-100">
								Send Message
							</a>
						</div>

						<!-- Quick Stats -->
						<div class="sidebar-card stats-card" data-aos="fade-left" data-aos-delay="300">
							<h4>Our Track Record</h4>
							<div class="stats-list">
								<div class="stat-item">
									<div class="stat-number">5,000+</div>
									<div class="stat-label">Successful Cases</div>
								</div>
								<div class="stat-item">
									<div class="stat-number">99.2%</div>
									<div class="stat-label">Approval Rate</div>
								</div>
								<div class="stat-item">
									<div class="stat-number">20+</div>
									<div class="stat-label">Years Experience</div>
								</div>
							</div>
						</div>

						<!-- Newsletter -->
						<div class="sidebar-card newsletter-card" data-aos="fade-left" data-aos-delay="400">
							<div class="card-icon">
								<i class="fas fa-envelope"></i>
							</div>
							<h4>Stay Updated</h4>
							<p>Get the latest immigration news and updates delivered to your inbox.</p>
							<form action="{{ route('newsletter') }}" method="POST" class="newsletter-form">
								@csrf
								<div class="input-group">
									<input type="email" name="email" class="form-control" placeholder="Your email address" required>
									<button type="submit" class="btn btn-primary">
										<i class="fas fa-paper-plane"></i>
									</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- FAQ Section -->
	<section class="resources-faq ptb-80" id="faqs">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<h3 class="section-title-modern text-center mb-5" data-aos="fade-up">Frequently Asked Questions</h3>
					<div class="faq-accordion" data-aos="fade-up" data-aos-delay="100">
						<div class="faq-item">
							<h5>Does a K1 visa entitle the foreign fiancee to a green card?</h5>
							<p>No, it does not. The K1 visa is a non-immigrant visa, which allows the holder to stay in the United States on a temporary basis. After the marriage takes place, the alien spouse must contact the USCIS to obtain conditional permanent residence status. The Filipino spouse may apply for removal of the conditional status and become a lawful permanent resident after two years.</p>
						</div>
						
						<div class="faq-item">
							<h5>Can family members of the foreign fiancee be included in the petition?</h5>
							<p>Only the unmarried, minor children (below 21 years old) of the foreign fiancee can be included in the K1 petition and are eligible to apply for a K2 visa. If they are unable to depart with their parent, children who are named in the petition have one year (from the time the parent's K1 visa is issued) to be issued K2 visas.</p>
						</div>
						
						<div class="faq-item">
							<h5>Can my foreign fiancee work in the U.S. with a K1 visa?</h5>
							<p>Yes. When the fiancee enters the United States he/she will be eligible to apply for a work permit after we file an Adjustment of Status for them. This will get them an Employment Authorization card.</p>
						</div>
						
						<div class="faq-item">
							<h5>Can a Permanent Resident use the K1 Visa Procedure?</h5>
							<p>No. Unfortunately, this benefit is only available to U.S. Citizens, you must be a U.S. Citizen to be eligible to file a K1 Visa petition.</p>
						</div>
						
						<div class="faq-item">
							<h5>Can my fiancee get a tourist visa or visitor visa?</h5>
							<p>Securing a US tourist visa is not a simple task. There are a lot of strict conditions and requirements that need to be complied with before the highly coveted B-1/B-2 visa may be issued. The U.S. Embassy in Manila denies the majority of tourist visa applicants. Our advice is to go see your foreign fiancee in person rather than attempting to bring them on a tourist visa.</p>
						</div>
					</div>
					
					<div class="text-center mt-4">
						<a href="{{ route('contactUs') }}" class="btn btn-outline-primary btn-lg">
							Have More Questions? <i class="fas fa-arrow-right ms-2"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

<style>
/* Modern Resources Page Styles */
.resources-hero {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.resources-search {
    max-width: 600px;
    margin: 2rem auto 0;
}

.search-form-modern {
    position: relative;
}

.search-input-group {
    display: flex;
    border-radius: 50px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    background: white;
}

.search-input {
    flex: 1;
    border: none;
    padding: 1.25rem 2rem;
    font-size: 1rem;
    outline: none;
    background: transparent;
}

.search-input::placeholder {
    color: #adb5bd;
}

.search-btn {
    background: var(--primary-gradient);
    border: none;
    padding: 1.25rem 2rem;
    color: white;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.search-btn:hover {
    background: var(--secondary-color);
}

/* Quick Links */
.quick-link-card {
    background: white;
    padding: 2.5rem 2rem;
    border-radius: 20px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
    border-top: 4px solid #e9ecef;
}

.quick-link-card.featured {
    border-top-color: var(--primary-color);
    transform: scale(1.02);
}

.quick-link-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.quick-link-card.featured:hover {
    transform: translateY(-10px) scale(1.02);
}

.quick-link-icon {
    width: 80px;
    height: 80px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 2rem;
}

.quick-link-card h4 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.quick-link-card p {
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 2rem;
}

.quick-link-btn {
    color: var(--primary-color);
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s ease;
}

.quick-link-btn:hover {
    color: var(--secondary-color);
}

/* Resource Categories */
.resources-grid {
    display: flex;
    flex-direction: column;
    gap: 3rem;
}

.resource-category {
    background: white;
    border-radius: 20px;
    padding: 2.5rem;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
}

.category-header {
    display: flex;
    align-items: flex-start;
    gap: 1.5rem;
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 2px solid #f8f9fa;
}

.category-icon {
    width: 70px;
    height: 70px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.8rem;
    flex-shrink: 0;
}

.category-header h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
}

.category-header p {
    color: var(--text-light);
    margin: 0;
}

.resource-items {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1rem;
}

.resource-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.5rem;
    background: #f8f9fa;
    border-radius: 12px;
    text-decoration: none;
    color: var(--text-dark);
    transition: all 0.3s ease;
    border-left: 4px solid transparent;
}

.resource-item:hover {
    background: var(--primary-color);
    color: white;
    border-left-color: var(--secondary-color);
    transform: translateX(5px);
}

.resource-item i {
    color: var(--primary-color);
    font-size: 1.1rem;
    transition: color 0.3s ease;
}

.resource-item:hover i {
    color: white;
}

.resource-item span {
    font-weight: 500;
    line-height: 1.4;
}

/* Sidebar */
.resources-sidebar {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.sidebar-card {
    background: white;
    padding: 2rem;
    border-radius: 20px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
}

.help-card {
    text-align: center;
    border-top: 4px solid var(--primary-color);
}

.help-card .card-icon {
    width: 60px;
    height: 60px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 1.5rem;
}

.help-card h4 {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.help-card p {
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.stats-card {
    border-top: 4px solid var(--success-color);
}

.stats-card h4 {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1.5rem;
    text-align: center;
}

.stats-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.stats-list .stat-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 12px;
}

.stats-list .stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-color);
}

.stats-list .stat-label {
    color: var(--text-light);
    font-weight: 500;
}

.newsletter-card {
    border-top: 4px solid #28a745;
    text-align: center;
}

.newsletter-card .card-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, #28a745, #20c997);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: white;
    font-size: 1.5rem;
}

.newsletter-card h4 {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
}

.newsletter-card p {
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.newsletter-form .input-group {
    display: flex;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.newsletter-form .form-control {
    border: none;
    padding: 0.75rem 1rem;
    flex: 1;
}

.newsletter-form .btn {
    border: none;
    padding: 0.75rem 1rem;
    background: #28a745;
}

/* FAQ Section */
.resources-faq {
    background: #f8f9fa;
}

.faq-item {
    background: white;
    margin-bottom: 1.5rem;
    border-radius: 15px;
    padding: 2rem;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    border-left: 4px solid var(--primary-color);
}

.faq-item h5 {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
    line-height: 1.4;
}

.faq-item p {
    color: var(--text-light);
    line-height: 1.7;
    margin: 0;
}

/* Mobile Responsive */
@media (max-width: 991px) {
    .resources-sidebar {
        margin-top: 3rem;
    }
    
    .category-header {
        flex-direction: column;
        text-align: center;
    }
    
    .resource-items {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 767px) {
    .search-input-group {
        flex-direction: column;
        border-radius: 15px;
    }
    
    .search-btn {
        border-radius: 0 0 15px 15px;
        justify-content: center;
    }
    
    .quick-link-card.featured {
        transform: none;
    }
    
    .quick-link-card.featured:hover {
        transform: translateY(-10px);
    }
    
    .resource-item {
        padding: 1rem;
    }
    
    .stats-list .stat-item {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
}

@media (max-width: 576px) {
    .resource-category {
        padding: 2rem 1.5rem;
    }
    
    .sidebar-card {
        padding: 1.5rem;
    }
    
    .faq-item {
        padding: 1.5rem;
    }
}
</style>

@section('customScript')
<script>
// Initialize AOS animations
AOS.init({
    duration: 800,
    once: true,
    offset: 100
});

// Search functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.querySelector('.search-form-modern');
    const searchInput = document.querySelector('.search-input');
    
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const query = searchInput.value.toLowerCase().trim();
            
            if (query) {
                // Simple search functionality - filter visible resource items
                const resourceItems = document.querySelectorAll('.resource-item');
                let hasResults = false;
                
                resourceItems.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    const category = item.closest('.resource-category');
                    
                    if (text.includes(query)) {
                        item.style.display = 'flex';
                        category.style.display = 'block';
                        hasResults = true;
                        // Highlight the item
                        item.style.background = '#fff3cd';
                        item.style.borderLeftColor = '#ffc107';
                    } else {
                        item.style.display = 'none';
                    }
                });
                
                // Hide empty categories
                document.querySelectorAll('.resource-category').forEach(category => {
                    const visibleItems = category.querySelectorAll('.resource-item[style*="flex"]');
                    if (visibleItems.length === 0) {
                        category.style.display = 'none';
                    }
                });
                
                if (!hasResults) {
                    // Show no results message
                    const noResults = document.createElement('div');
                    noResults.className = 'no-results text-center py-5';
                    noResults.innerHTML = `
                        <h4>No results found for "${query}"</h4>
                        <p>Try searching with different keywords or <a href="${window.location.pathname}">view all resources</a></p>
                    `;
                    document.querySelector('.resources-grid').appendChild(noResults);
                }
            }
        });
        
        // Reset search
        searchInput.addEventListener('input', function() {
            if (this.value === '') {
                // Reset all items
                document.querySelectorAll('.resource-item').forEach(item => {
                    item.style.display = 'flex';
                    item.style.background = '';
                    item.style.borderLeftColor = '';
                });
                document.querySelectorAll('.resource-category').forEach(category => {
                    category.style.display = 'block';
                });
                // Remove no results message
                const noResults = document.querySelector('.no-results');
                if (noResults) {
                    noResults.remove();
                }
            }
        });
    }
    
    // Add hover effects to resource items
    document.querySelectorAll('.resource-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(10px)';
        });
        
        item.addEventListener('mouseleave', function() {
            if (!this.style.background.includes('rgb(255, 243, 205)')) { // Not highlighted by search
                this.style.transform = 'translateX(0)';
            }
        });
    });
    
    // Newsletter form
    const newsletterForm = document.querySelector('.newsletter-form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Add your newsletter subscription logic here
            const email = this.querySelector('input[name="email"]').value;
            if (email) {
                // Show success message
                this.innerHTML = '<div class="text-success"><i class="fas fa-check-circle"></i> Thank you for subscribing!</div>';
            }
        });
    }
});
</script>
@endsection