<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Statistic;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Services\PostService;
use App\Models\PostsTag;
use ProtoneMedia\Splade\Facades\SEO;

class HomeController extends Controller
{
    public function index()
    {
        $postsCount = PostService::getNewestPublishedPostsCounts();
        $tagsCount = Tag::count();
        $newestPublishedPosts = PostService::getNewestPublishedPostsWithTags(6);
        $sliderPosts = PostService::getSliderPosts(6);
        $webMaster = (object)[
            'name' => env('WEBMASTER_NAME'),
            'email' => env('WEBMASTER_EMAIL'),
            'avatar' => env('WEBMASTER_AVATAR'),
        ];
        $totalUV = Statistic::first()->total_uv;
        return view('home.index', compact('newestPublishedPosts', 'sliderPosts', 'postsCount', 'tagsCount', 'webMaster', 'totalUV'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        return view('home.search', compact('keyword'));
    }

    public function searchResult(Request $request)
    {
        $keyword = $request->input('keyword');
        if (!$keyword) {
            return response()->json([
                'results' => [],
                'none_tips' => trans('No results related to :keyword were found', ['keyword' => $keyword]),
                'result_title' => trans('Search results for :keyword', ['keyword' => $keyword]),
                'totalPages' => 0,
                'currentPage' => 0,
                'total' => 0,
            ]);
        } else {
            $keyword = trim($keyword);
            if ($request->has('page') && $request->has('pageSize')) {
                $page = $request->input('page');
                $pageSize = $request->input('pageSize');
                if (config('scout.driver') == 'database') {
                    $results = Post::where('title', 'like', "%{$keyword}%")->orWhere('meta_description', 'like', "%{$keyword}%")->where('published', 1)->paginate($pageSize);
                } else {
                    $results = Post::search($keyword)->where('published', 1)->paginate($pageSize);
                }
                $resultsItems = [];
                foreach ($results->items() as $key => $result) {
                    $resultsItems[$key] = $result;
                    $resultsItems[$key]['url'] = route('posts.show', $result->slug);
                }
                return response()->json([
                    'results' => $resultsItems,
                    'none_tips' => trans('No results related to :keyword were found', ['keyword' => $keyword]),
                    'result_title' => trans('Search results for :keyword', ['keyword' => $keyword]),
                    'totalPages' => $results->lastPage(),
                    'currentPage' => $results->currentPage(),
                    'total' => $results->total(),
                ]);
            } else {
                if (config('scout.driver') == 'database') {
                    $results = Post::where('title', 'like', "%{$keyword}%")->orWhere('meta_description', 'like', "%{$keyword}%")->where('published', 1)->get();
                } else {
                    $results = Post::search($keyword)->where('published', 1)->get();
                }
                $resultsItems = [];
                foreach ($results as $key => $result) {
                    $resultsItems[$key] = $result;
                    $resultsItems[$key]['url'] = route('posts.show', $result->slug);
                }
                return response()->json([
                    'results' => $resultsItems,
                    'none_tips' => trans('No results related to :keyword were found', ['keyword' => $keyword]),
                    'result_title' => trans('Search results for :keyword', ['keyword' => $keyword]),
                ]);
            }
        }
    }

    public function timeline($yearMonth = null)
    {
        $query = Post::orderBy('published_at', 'desc');

        $emptyText = trans('The blogger is too lazy to write any articles!');
        if ($yearMonth) {
            // 解析年份和月份参数
            $year = substr($yearMonth, 0, 4);
            $month = substr($yearMonth, 4);

            // 添加筛选条件：发布日期在指定的年份和月份范围内
            $query->whereYear('published_at', $year)->whereMonth('published_at', $month);
            //判断年月是否大于当前时间
            if ($year > date('Y') || ($year == date('Y') && $month > date('m'))) {
                $emptyText = trans('Future time and space article is still being created, please look forward to!');
            } else {
                $emptyText = trans('In :month :year, the blogger was lazy and did not write any articles!', ['month' => $month, 'year' => $year]);
            }
        }

        // 获取筛选后的文章
        $posts = $query->where('published', '1')->get();

        // 将文章按月份进行归档
        $archive = [];
        foreach ($posts as $post) {
            $monthYear = $post->published_at->format('F Y');
            $archive[$monthYear][] = $post;
        }
        SEO::openGraphType('timeline');
        SEO::openGraphUrl(config('app.url').'/timeline/'.$yearMonth);
        SEO::openGraphTitle(trans('Timeline').' - '.config('splade-seo.title_suffix'));
        return view('home.timeline', compact('archive', 'emptyText'));
    }

    public function getPostsByDate($date = '2022-8-14')
    {
        list($year, $month, $day) = explode('-', $date);
        $posts = Post::whereYear('published_at', $year)->whereMonth('published_at', $month)->whereDay('published_at', $day)->where('published', '1')->get();
        return response()->json([
            'total' => count($posts),
            'results' => $posts,
        ]);
    }

    public function tag($name = null)
    {
        if ($name) {
            SEO::openGraphType('tags');
            SEO::openGraphUrl(config('app.url').'/tag/'.$name);
            SEO::openGraphTitle(trans('Tags'). '：'.$name.' - '.config('splade-seo.title_suffix'));
            $tag = Tag::where('name', $name)->first();
            $emptyText = trans('The blogger is too lazy to write any articles about the :tag tag!', ['tag' => $name]);
            if ($tag) {
                $postIds = PostsTag::where('tag_id', $tag->id)->get();
                $posts = [];
                foreach ($postIds as $postId) {
                    $post = Post::where('ulid', $postId->post_id)->first();
                    if ($post) {
                        $posts[] = $post;
                    }
                }
                return view('home.tag', compact('name', 'posts', 'emptyText'));
            } else {
                return view('home.tag', compact('name', 'emptyText'));
            }
        } else {
            $tags = Tag::all()->pluck('name')->toArray();
            $tagString = implode(',', $tags);
            SEO::openGraphType('tags');
            SEO::openGraphUrl(config('app.url').'/tag/');
            SEO::openGraphTitle(trans('Tags'). ' - '.config('splade-seo.title_suffix'));
            return view('home.tag', compact('tagString'));
        }
    }
}
