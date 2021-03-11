<div class="navbar-header">
    <a class="navbar-brand" href="index.html"><img src="{{ URL::to('/admin') }}/assets/images/logo_light.png"
            alt=""></a>

    <ul class="nav navbar-nav visible-xs-block">
        <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
    </ul>
</div>

<div class="navbar-collapse collapse" id="navbar-mobile">
    <ul class="nav navbar-nav">
        <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

    </ul>

    <p class="navbar-text"><span class="label bg-success">Online</span></p>

    <ul class="nav navbar-nav navbar-right">

        <li class="dropdown dropdown-user">
            <a class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{ URL::to('/admin') }}/assets/images/placeholder.jpg" alt="">
                <span>Victoria</span>
                <i class="caret"></i>
            </a>

            <ul class="dropdown-menu dropdown-menu-right">
                <li><a href="#"><i class="icon-user-plus"></i> My profile</a></li>
                <li><a href="#"><i class="icon-switch2"></i> Logout</a></li>
            </ul>
        </li>
    </ul>
</div>
