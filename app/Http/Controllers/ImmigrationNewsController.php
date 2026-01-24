<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class ImmigrationNewsController extends Controller
{
    /**
     * Display immigration news page
     */
    public function index(Request $request)
    {
        $category = $request->get('category', 'all');
        $search = $request->get('search');
        
        // Get cached news or fetch new ones
        $news = $this->getImmigrationNews($category, $search);
        $categories = $this->getNewsCategories();
        $featuredNews = $this->getFeaturedNews();
        
        return view('web.immigration-news.index', compact('news', 'categories', 'featuredNews', 'category', 'search'));
    }

    /**
     * Show specific news article
     */
    public function show($slug)
    {
        $article = $this->getNewsArticle($slug);
        $relatedNews = $this->getRelatedNews($slug);
        
        if (!$article) {
            abort(404);
        }
        
        return view('web.immigration-news.show', compact('article', 'relatedNews'));
    }

    /**
     * Get immigration news with caching
     */
    private function getImmigrationNews($category = 'all', $search = null)
    {
        $cacheKey = "immigration_news_{$category}_" . md5($search ?? '');
        
        return Cache::remember($cacheKey, 3600, function () use ($category, $search) {
            // Mock data - replace with actual API calls or database queries
            return $this->getMockNewsData($category, $search);
        });
    }

    /**
     * Get news categories
     */
    private function getNewsCategories()
    {
        return [
            'all' => 'All News',
            'uscis' => 'USCIS Updates',
            'visa-bulletins' => 'Visa Bulletins',
            'policy-changes' => 'Policy Changes',
            'processing-times' => 'Processing Times',
            'fees' => 'Fee Updates',
            'embassy' => 'Embassy News',
            'legislation' => 'New Legislation'
        ];
    }

    /**
     * Get featured news
     */
    private function getFeaturedNews()
    {
        return Cache::remember('featured_immigration_news', 7200, function () {
            // Return top 3 featured articles
            return collect($this->getMockNewsData())->take(3);
        });
    }

    /**
     * Get specific news article
     */
    private function getNewsArticle($slug)
    {
        $allNews = $this->getMockNewsData();
        return collect($allNews)->firstWhere('slug', $slug);
    }

    /**
     * Get related news
     */
    private function getRelatedNews($currentSlug)
    {
        $allNews = $this->getMockNewsData();
        return collect($allNews)
            ->where('slug', '!=', $currentSlug)
            ->take(4);
    }

    /**
     * Mock news data - replace with actual data source
     */
    private function getMockNewsData($category = 'all', $search = null)
    {
        $news = [
            [
                'id' => 1,
                'title' => 'USCIS Announces Updated Processing Times for K-1 Fiancé Visas',
                'slug' => 'uscis-updated-processing-times-k1-fiance-visas',
                'excerpt' => 'USCIS has released updated processing times showing improvements in K-1 fiancé visa processing, with current estimates ranging from 8-14 months.',
                'content' => '<p>The U.S. Citizenship and Immigration Services (USCIS) has announced updated processing times for K-1 fiancé visas, showing significant improvements in processing efficiency.</p><p>Current processing times now range from 8-14 months, down from previous estimates of 12-18 months. This improvement comes as a result of increased staffing and streamlined processes.</p><p>Key highlights include:</p><ul><li>Reduced processing times for Form I-129F</li><li>Improved communication with applicants</li><li>Enhanced online case tracking</li></ul>',
                'image' => 'assets/img/news/uscis-processing-times.jpg',
                'category' => 'uscis',
                'author' => 'Immigration News Team',
                'published_at' => '2025-01-15',
                'featured' => true,
                'tags' => ['K-1 Visa', 'Processing Times', 'USCIS']
            ],
            [
                'id' => 2,
                'title' => 'New Fee Structure for Immigration Applications Effective March 2025',
                'slug' => 'new-fee-structure-immigration-applications-march-2025',
                'excerpt' => 'USCIS announces new fee structure for various immigration applications, including changes to K-1 and CR-1 visa fees.',
                'content' => '<p>Starting March 1, 2025, USCIS will implement a new fee structure for various immigration applications. The changes affect multiple visa categories including family-based petitions.</p><p>Key changes include:</p><ul><li>Form I-129F (K-1 Fiancé): $675 (previously $535)</li><li>Form I-130 (CR-1 Spouse): $675 (previously $535)</li><li>Form I-485 (Adjustment of Status): $1,440 (previously $1,225)</li></ul>',
                'image' => 'assets/img/news/fee-changes.jpg',
                'category' => 'fees',
                'author' => 'Legal Updates Team',
                'published_at' => '2025-01-10',
                'featured' => false,
                'tags' => ['Fees', 'USCIS', 'Applications']
            ],
            [
                'id' => 3,
                'title' => 'Manila Embassy Resumes Full Interview Scheduling',
                'slug' => 'manila-embassy-resumes-full-interview-scheduling',
                'excerpt' => 'The U.S. Embassy in Manila announces resumption of full interview scheduling for immigrant visas after temporary reductions.',
                'content' => '<p>The U.S. Embassy in Manila has announced the resumption of full interview scheduling capacity for immigrant visas, including K-1 and CR-1 cases.</p><p>This development comes after several months of reduced capacity due to staffing challenges and facility improvements.</p><p>Applicants can expect:</p><ul><li>Increased interview slots</li><li>Reduced waiting times</li><li>Enhanced safety protocols</li></ul>',
                'image' => 'assets/img/news/manila-embassy.jpg',
                'category' => 'embassy',
                'author' => 'Embassy Relations',
                'published_at' => '2025-01-08',
                'featured' => true,
                'tags' => ['Manila Embassy', 'Interviews', 'Philippines']
            ],
            [
                'id' => 4,
                'title' => 'January 2025 Visa Bulletin: No Changes for Immediate Relatives',
                'slug' => 'january-2025-visa-bulletin-immediate-relatives',
                'excerpt' => 'The Department of State releases the January 2025 Visa Bulletin with current status maintained for immediate relative categories.',
                'content' => '<p>The Department of State has released the January 2025 Visa Bulletin, showing continued current status for all immediate relative categories.</p><p>Key points:</p><ul><li>Immediate relatives remain "Current"</li><li>No backlog for spouses and fiancés of U.S. citizens</li><li>Processing continues normally</li></ul>',
                'image' => 'assets/img/news/visa-bulletin.jpg',
                'category' => 'visa-bulletins',
                'author' => 'Visa Bulletin Team',
                'published_at' => '2025-01-05',
                'featured' => false,
                'tags' => ['Visa Bulletin', 'Immediate Relatives']
            ],
            [
                'id' => 5,
                'title' => 'New Online Portal for Case Status Updates Launched',
                'slug' => 'new-online-portal-case-status-updates',
                'excerpt' => 'USCIS launches enhanced online portal allowing applicants to receive real-time updates on their case status.',
                'content' => '<p>USCIS has launched a new online portal that provides applicants with real-time updates on their immigration case status.</p><p>Features include:</p><ul><li>Real-time notifications</li><li>Document upload capabilities</li><li>Direct messaging with USCIS</li><li>Case timeline tracking</li></ul>',
                'image' => 'assets/img/news/online-portal.jpg',
                'category' => 'uscis',
                'author' => 'Technology Team',
                'published_at' => '2025-01-03',
                'featured' => true,
                'tags' => ['Technology', 'Case Status', 'Online Portal']
            ]
        ];

        // Filter by category
        if ($category !== 'all') {
            $news = array_filter($news, function($item) use ($category) {
                return $item['category'] === $category;
            });
        }

        // Filter by search
        if ($search) {
            $news = array_filter($news, function($item) use ($search) {
                return stripos($item['title'], $search) !== false || 
                       stripos($item['excerpt'], $search) !== false;
            });
        }

        // Sort by date (newest first)
        usort($news, function($a, $b) {
            return strtotime($b['published_at']) - strtotime($a['published_at']);
        });

        return $news;
    }

    /**
     * Search news articles
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        $category = $request->get('category', 'all');
        
        $results = $this->getImmigrationNews($category, $query);
        
        return response()->json([
            'results' => $results,
            'count' => count($results),
            'query' => $query
        ]);
    }
}