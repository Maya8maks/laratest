<ul class="dashboard__menu">    <li class="dashboard_items"><a class="dashboard_links" href="#">Quick<span>Receive answer within 24 hours</span></a></li>    <li class="dashboard_items"><a class="dashboard_links" href="#">Safe<span>Authorized Healthcare Professionals</span></a></li>    <li class="dashboard_items"><a class="dashboard_links" href="#">Cheap<span>Only 6 USD</span></a></li>    @if(!Auth::check())    <li class="dashboard_items "><a class="dashboard_links" href="/registration">Account<span>Settings, transactions, and more</span></a></li>    @endif</ul>