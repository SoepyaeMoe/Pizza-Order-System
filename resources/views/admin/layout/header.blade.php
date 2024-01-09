<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <form class="form-header" action="" method="POST">
                    {{-- <input class="au-input au-input--xl" type="text" name="search"
                        placeholder="Search for datas &amp; reports..." />
                    <button class="au-btn--submit" type="submit">
                        <i class="zmdi zmdi-search"></i>
                    </button> --}}
                </form>
                <div class="header-button">
                    {{-- <div class="noti-wrap">
                        <div class="noti__item js-item-menu">
                            <i class="zmdi zmdi-notifications"></i>
                            <span class="quantity">3</span>
                            <div class="notifi-dropdown js-dropdown">
                                <div class="notifi__title">
                                    <p>You have 3 Notifications</p>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c1 img-cir img-40">
                                        <i class="zmdi zmdi-email-open"></i>
                                    </div>
                                    <div class="content">
                                        <p>You got a email notification</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c2 img-cir img-40">
                                        <i class="zmdi zmdi-account-box"></i>
                                    </div>
                                    <div class="content">
                                        <p>Your account has been blocked</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__item">
                                    <div class="bg-c3 img-cir img-40">
                                        <i class="zmdi zmdi-file-text"></i>
                                    </div>
                                    <div class="content">
                                        <p>You got a new file</p>
                                        <span class="date">April 12, 2018 06:50</span>
                                    </div>
                                </div>
                                <div class="notifi__footer">
                                    <a href="#">All notifications</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="image">
                                @if (!Auth::user()->image)
                                    <a href="#">
                                        <img
                                            src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random">
                                    </a>
                                @else
                                    <a href="#">
                                        <img src="{{ asset('storage/profile_pic/' . Auth::user()->image) }}"
                                            alt="John Doe" />
                                    </a>
                                @endif
                            </div>
                            <div class="content">
                                <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="image">
                                        @if (!Auth::user()->image)
                                            <a href="#">
                                                <img
                                                    src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=random">
                                            </a>
                                        @else
                                            <a href="#">
                                                <img src="{{ asset('storage/profile_pic/' . Auth::user()->image) }}" />
                                            </a>
                                        @endif
                                    </div>
                                    <div class="content">
                                        <h5 class="name">
                                            <a href="{{ route('admin.profile.detail') }}">{{ Auth::user()->name }}</a>
                                        </h5>
                                        <span class="email">{{ Auth::user()->email }}</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="{{ route('admin.profile.detail') }}" class="a">
                                            <i class="zmdi zmdi-account"></i>Account
                                        </a>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="{{ route('admin.change_password') }}" class="a">
                                            <i class="zmdi zmdi-key"></i>Change Password
                                        </a>
                                    </div>
                                </div>
                                <div class="account-dropdown__footer">
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <span class="a"><i class="zmdi zmdi-power"></i><button
                                                type="submit">Logout</button></span>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
