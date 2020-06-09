<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
                    <li><a href="/dashboard" class="{{ 'dashboard' == request()->path() ? 'active' : '' }}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="/guru" class="{{ 'guru' == request()->path() ? 'active' : '' }}"><i class="lnr lnr-users"></i> <span>Guru</span></a></li>
						<!-- buat fungsi if / percabangan untuk menentykan menu sesuai role -->
						@if(auth()->user()->role == 'admin')
						<li><a href="/siswa" class="{{ 'siswa' == request()->path() ? 'active' : '' }}"><i class="lnr lnr-user"></i> <span>Siswa</span></a></li>
						<!-- <li><a href="/guru" class=""><i class="lnr lnr-user"></i> <span>Guru</span></a></li> -->
						<li>
							<a href="#subPages" data-toggle="collapse" class="collapsed"><i class="lnr lnr-pencil"></i> <span>Posts</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse ">
								<ul class="nav">
									<li><a href="/posts" class="lnr lnr-plus-circle"> Add New</a></li>
								</ul>
							</div>
                        </li>

                        @endif
                        <li><a href="/forum"class="{{ 'forum' == request()->path() ? 'active' : '' }}"><i class="lnr lnr-location"></i> <span>Forum</span></a></li>
                        <li><a href="/mapel" class="{{ 'mapel' == request()->path() ? 'active' : '' }}"><i class="fa fa-database"></i> <span>Mata Pelajaran</span></a></li>
                        <li><a href="/pembayaran" class="{{ 'pembayaran' == request()->path() ? 'active' : '' }}"><i class="fa fa-credit-card"></i> <span>Pembayaran</span></a></li>

						<!-- jangan lupa if penutup -->
					</ul>
				</nav>
			</div>
		</div>
