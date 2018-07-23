<ul class="dashboard__menu">
    <li class="dashboard_items" data-sidebar="1" ><a class="dashboard_links" href="{{route('dashboard' , array('id'=>$doctor->id))}}">Dashboard<span>View customer requests</span></a></li>
    <li class="dashboard_items" data-sidebar="2" ><a class="dashboard_links" href="{{route('orders' , array('id'=>$doctor->id))}}">My Orders<span>Manage your orders</span></a></li>
    <li class="dashboard_items" data-sidebar="3"><a class="dashboard_links" href="{{route('account' , array('id'=>$doctor->id))}}">Account<span>Settings, transactions, and more</span></a></li>
</ul>