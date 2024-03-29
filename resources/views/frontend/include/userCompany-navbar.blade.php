<nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url('User/index')}}"><img src="{{ asset('images/Logo LondCap.png')}}" class="img-responsive"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('User/browse-investors')}}">Browse Investors <span class="sr-only">(current)</span></a></li>
                    <li><a href="{{ url('User/index')}}">Browse Companies</a></li>
                    <li><a href="#">Events</a></li>
                    <li><a href="{{url('User/message')}}">Messages</a></li>
                    <li><a href="#">Suggested Investors</a></li>
                    <li><a href="{{ url('User/contact')}}">Contact Us</a></li>
                    <li><a href="#" class="open-button" onclick="openForm()">Login</a></li>
                    <li><a href="{{ url('User/signup')}}">Sign Up</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>