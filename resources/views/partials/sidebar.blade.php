<div class="col-md-4">
    <div class="blog-sidebar">
        <div class="sidebar-module">
            <h2>Archives</h2>
            <ol class="list-unstyled">
                @foreach($archives as $date)
                    <li>
                        <a href="/?month={{ $date['month'] }}&year={{ $date['year'] }}">{{ $date['month'].' '. $date['year'].' ('. $date['published'].')'}}</a>
                    </li>
                @endforeach
            </ol>
        </div>

        <div class="sidebar-module">
            <h2>Categories</h2>
            <ol class="list-unstyled">
                @foreach($categories as $cat)
                    <li><a href="/tag/{{ $cat->category }}">{{$cat->category .' ('.$cat->posts()->count().')'}}</a></li>
                @endforeach
                    <li><a href="/tag/uncategorized"> No tags ({{ $uncategorized }})</a></li>
            </ol>
        </div>
    </div>
</div>