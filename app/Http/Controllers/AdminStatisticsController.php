<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookActivityEvent;
use Illuminate\Support\Facades\DB;

class AdminStatisticsController extends Controller
{
    public function index()
    {
        $totalBooks = Book::count();

        $totalReads = BookActivityEvent::where('event_type', 'read')->count();

        $totalDownloads = BookActivityEvent::where('event_type', 'download')->count();

        $mostReadBooks = Book::query()
            ->withCount(['activityEvents as reads_count' => function ($query) {
                $query->where('event_type', 'read');
            }])
            ->having('reads_count', '>', 0)
            ->orderByDesc('reads_count')
            ->orderBy('title') 
            ->limit(5)
            ->get();

        $mostDownloadedBooks = Book::query()
            ->withCount(['activityEvents as downloads_count' => function ($query) {
                $query->where('event_type', 'download');
            }])
            ->having('downloads_count', '>', 0)
            ->orderByDesc('downloads_count')
            ->orderBy('title')
            ->limit(5)
            ->get();

        return view('admin.statistics.index', compact(
            'totalBooks',
            'totalReads',
            'totalDownloads',
            'mostReadBooks',
            'mostDownloadedBooks'
        ));
    }
}