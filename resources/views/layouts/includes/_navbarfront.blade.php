<div class="container main-menu">
		    	<div class="row align-items-center justify-content-between d-flex">
			      <div id="logo">
			        <a href="/"><img src="{{asset('/frontend')}}/img/logo.png" alt="" title="" /></a>
			      </div>
			      <nav id="nav-menu-container">
			        <ul class="nav-menu">
			          		<li class="nav-item">
                                <a class="nav-link" href="/">{{ __('Home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/contact">{{ __('Kontak Kami') }}</a>
                            </li>
                            @guest
                            <li class="nav-item">
                                <a class="nav-link" href="/register">{{ __('Daftar') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/login">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="/register">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        <li class="menu-has-children"><a href="/dashboard">{{ Auth::user()->name }}</a>
			            <ul>
			              <li><a href="/logout">Logout</a></li>
			            </ul>
			          </li>
                            <!-- <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="/logout"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="/logout" method="get">
                                        @csrf
                                    </form>
                                </div>
                            </li> -->
                        @endguest
			        </ul>
			      </nav><!-- #nav-menu-container -->
		    	</div>
		    </div>
