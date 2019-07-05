<nav class="navbar navbar-default navbar-dark navbar-expand-lg navbar-static-top blog-masthead">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
                @if (Auth::guest())
                    <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                    <li><a class="nav-link" href="/register">Register</a></li>
                @else
                    @can('manage-reports')
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle nav-link" ref="#" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                Reports
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="{{ route('reports.post-index') }}">All</a>
                            </div>
                        </li>
                    @endcan

                    <li class="nav-item dropdown" >
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false" href="#" id="postdropdownmenu">
                            Posts
                        </a>
                        <div class="dropdown-menu" aria-labelledby="postdropdownmenu">
                            <a class="dropdown-item" href="/posts">All</a>
                            <a class="dropdown-item" href="/posts/published">Published</a>
                            <a class="dropdown-item" href="/posts/scheduled">Scheduled</a>
                            <a class="dropdown-item" href="/posts/drafts">Drafts</a>
                            <a class="dropdown-item" href="/posts/pending">Pending</a>
                            <a class="dropdown-item" href="/posts/declined">Declined</a>
                        </div>
                    </li>
                    @can('manage-all-posts')
                        <li class="nav-item"><a class="nav-link" href="/categories">Tags</a></li>
                    @endcan
                    @can('moderate-comments')
                        <li class="nav-item"><a class="nav-link" href="/comments">Comments</a></li>
                    @endcan
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                        class="fa fa-sign-out fa-fw"></i>
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
