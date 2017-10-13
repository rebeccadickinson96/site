<div class="col-md-4">
    <div class="blog-sidebar">
        <div class="sidebar-module">
            <h2>Archives</h2>
            <ol class="list-unstyled">
                @foreach($archives as $date)
                    <li>
                        <a href="#">{{ $date['month'] }}</a>
                    </li>
                @endforeach
            </ol>
        </div>

        <div class="sidebar-module">
            <h2>Categories</h2>
            <ol class="list-unstyled">
                @foreach($categories as $cat)
                    <li><a href="">{{$cat->category}}</a></li>
                @endforeach
            </ol>
        </div>
    </div>
</div>