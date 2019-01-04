<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostReport;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $pagination = 10;

    public function indexPosts(){
        $title = 'Post Reports';

        $reports = PostReport::with('post')->paginate($this->pagination);

        return view('reports.index-posts', compact('reports', 'title'));
    }

    public function reviewPostReport(PostReport $report) {
        $title = 'Report '.$report->id . ' review';
        return view('reports.review', compact('report', 'title'));
    }
}
