<div class="sidebar sidebar-style-2">			
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <div class="user">
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
                        <span>
                            Hardy Prabowo
                            <span class="user-level">Administrator</span>
                            <span class="caret"></span>
                        </span>
                    </a>
                    <div class="clearfix"></div>

                    <div class="collapse in" id="collapseExample">
                        <ul class="nav">
                            <li>
                                <a href="#profile">
                                    <span class="link-collapse">My Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#edit">
                                    <span class="link-collapse">Edit Profile</span>
                                </a>
                            </li>
                            <li>
                                <a href="#settings">
                                    <span class="link-collapse">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="nav nav-primary">
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Menus</h4>
                </li>
                <li class="nav-item">
                    <a href="{{ route('home') }}">
                        <i class="fas fa-home"></i>
                        <p>Home</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#">
                        <i class="fas fa-luggage-cart"></i>
                        <p>Order Luggage</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#category">
                        <i class="fas fa-list"></i>
                        <p>Master Category</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="category">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="#">
                                    <span class="sub-item">Luggage</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Item</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#data">
                        <i class="fas fa-database"></i>
                        <p>Master Data</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="data">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('location.index') }}">
                                    <span class="sub-item">Location</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#user">
                        <i class="fas fa-users"></i>
                        <p>Master User</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="user">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="components/avatars.html">
                                    <span class="sub-item">Data Users</span>
                                </a>
                            </li>
                            <li>
                                <a href="components/avatars.html">
                                    <span class="sub-item">Access Right</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-toggle="collapse" href="#report">
                        <i class="fas fa-file-alt"></i>
                        <p>Report</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="report">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="components/avatars.html">
                                    <span class="sub-item">Order Report</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>