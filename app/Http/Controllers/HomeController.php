<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Statistic;
use App\Models\Tag;
use App\Services\TextCensor;
use Illuminate\Http\Request;
use App\Services\PostManager;
use App\Models\PostsTag;
use Illuminate\Support\Facades\Config;

class HomeController extends Controller
{
    public function index()
    {
        $postsCount = PostManager::getNewestPublishedPostsCounts();
        $tagsCount = Tag::count();
        $newestPublishedPosts = PostManager::getNewestPublishedPostsWithTags(6);
        $sliderPosts = PostManager::getSliderPosts(5);
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
        if (!$keyword) {
            return response()->json([
                'results' => [],
                'totalPages' => 0,
                'currentPage' => 0,
                'total' => 0,
            ]);
        } else {
            $keyword = trim($keyword);
            $page = $request->input('page');
            $pageSize = $request->input('pageSize');
            $results = Post::search($keyword)->where('published', 1)->paginate($pageSize);
            $resultsItems = [];
            foreach ($results->items() as $key => $result) {
                $resultsItems[$key] = $result;
                $resultsItems[$key]['url'] = route('posts.show', $result->slug);
            }
            return response()->json([
                'results' => $resultsItems,
                'totalPages' => $results->lastPage(),
                'currentPage' => $results->currentPage(),
                'total' => $results->total(),
            ]);
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
        $posts = $query->get();

        // 将文章按月份进行归档
        $archive = [];
        foreach ($posts as $post) {
            $monthYear = $post->published_at->format('F Y');
            $archive[$monthYear][] = $post;
        }
        return view('home.timeline', compact('archive', 'emptyText'));
    }

    public function tag($name = null)
    {
        if ($name) {
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
            return view('home.tag', compact('tagString'));
        }
    }
}
