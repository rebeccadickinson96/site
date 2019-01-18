<nav class="navbar navbar-default navbar-static-top blog-masthead">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand nav-link" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">

            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a class="nav-link" href="/login">Login</a></li>
                    <li><a class="nav-link" href="/register">Register</a></li>
                @else
                    @can('manage-reports')
                        <li class="dropdown" id="reportdropdownmenu">
                            <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">
                                Reports <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li>
                                    <a href="{{ route('reports.post-index') }}">All</a>
                                </li>
                            </ul>
                        </li>
                    @endcan
                    <li class="dropdown" id="postdropdownmenu">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">
                            Posts <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a href="/posts">All</a>
                            </li>
                            @can('manage-all-posts')
                                <li>
                                    <a href="/posts/published">Published</a>
                                </li>
                                <li>
                                    <a href="/posts/scheduled">Scheduled</a>
                                </li>
                                <li>
                                    <a href="/posts/drafts">Drafts</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                    @can('manage-all-posts')
                        <li><a class="nav-link" href="/categories">Tags</a></li>
                    @endcan
                    @can('moderate-comments')
                        <li><a class="nav-link" href="/comments">Comments</a></li>
                    @endcan
                    <li class="dropdown" id="userdropdownmenu">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#" id="usernamelogout">
                            <i class="fa fa-user fa-fw"></i> {{ Auth::user()->name }} <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                            class="fa fa-sign-out fa-fw"></i>
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
