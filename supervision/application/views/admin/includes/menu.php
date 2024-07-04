<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
		<img width="210px" src="<?= base_url(); ?>assets/img/logo/EasiApis.png" alt="Banner Image">
   
    </a>

    <!-- Divider -->
    <!-- <hr class="sidebar-divider my-0"> -->

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= base_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <!-- <hr class="sidebar-divider"> -->

    <!-- Heading -->
    <!-- <div class="sidebar-heading">
    Interface
</div> -->

    
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Services</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                
                <a class="collapse-item" href="">Add service</a>
                <a class="collapse-item" href="">View services</a>
            </div>
        </div>
    </li> -->


    <!-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
        aria-expanded="true" aria-controls="collapseUtilities">
        <i class="fas fa-fw fa-wrench"></i>
        <span>profession</span>
    </a>
    <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
           
            <a class="collapse-item" href="<?= base_url('profession') ?>">profession</a>
        </div>
    </div>
</li> -->

    <!-- <li class="nav-item">
        <a class="nav-link" href="<?= base_url('profession') ?>">
            <i class="fas fa-fw fa-wrench"></i>
            <span>profession</span></a>
    </li> -->


   <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTw" aria-expanded="true" aria-controls="collapseTw">
            <i class="fas fa-fw fa-cog"></i>
            <span>Product</span>
        </a>
        <div id="collapseTw" class="collapse" aria-labelledby="headingTw" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="<?= base_url('product') ?>">Category</a>
            </div>
        </div>
    </li>-->



    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesss" aria-expanded="true" aria-controls="collapsePagess">
            <i class="fa fa-database" aria-hidden="true"></i>
            <span>APIS List</span>
        </a>
        <div id="collapsePagesss" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">APIS:</h6>
                <a class="collapse-item" href="<?= base_url('category') ?>">Category List</a>
				<a class="collapse-item" href="<?= base_url('category/sub_category') ?>">Sub Category List</a>
				<a class="collapse-item" href="<?= base_url('api_list') ?>">Api List</a>
            </div>
        </div>
    </li>





    <!-- Divider -->
    <!-- <hr class="sidebar-divider"> -->

    <!-- Heading -->
	
	<li class="nav-item">
        <a class="nav-link" href="<?= base_url('user/view_subscribed_emails') ?>">
          <i class="fa fa-envelope" aria-hidden="true"></i>
            <span>Email Subscriptions</span></a>
    </li>
	

    <li class="nav-item">
        <a class="nav-link" href="<?= base_url('email_configration/index') ?>">
            <i class="fa fa-envelope" aria-hidden="true"></i>
            <span>Email Configration</span></a>
    </li>



    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagess" aria-expanded="true" aria-controls="collapsePages">
            <i class="fa fa-laptop" aria-hidden="true"></i>
            <span>CMS</span>
        </a>
        <div id="collapsePagess" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">CMS Screens:</h6>
				<a class="collapse-item" href="<?= base_url('cms/banner_images') ?>">Bannar Image</a>
                <a class="collapse-item" href="<?= base_url('cms/static_page_content') ?>">Static Page Content</a>
				<a class="collapse-item" href="<?= base_url('cms/why_choose_us') ?>">Why Choose us</a>
				<a class="collapse-item" href="<?= base_url('cms/seo') ?>">Seo</a>
            </div>
        </div>
    </li>
	
	
	 <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePag" aria-expanded="true" aria-controls="collapsePag">
            <i class="fa fa-cog" aria-hidden="true"></i>
            <span>Settings</span>
        </a>
        <div id="collapsePag" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Settings:</h6>
			    <a class="collapse-item" href="<?= base_url('cms/social_network') ?>">Social Network</a>
                <a class="collapse-item" href="<?= base_url('cms/social_logins') ?>">Social Logins</a>
				<a class="collapse-item" href="<?= base_url('cms/manage_domain') ?>">Contact Address</a>
				<a class="collapse-item" href="<?= base_url('user/auth') ?>">Auth</a>
            </div>
        </div>
    </li>




    <!-- <div class="sidebar-heading">
    admin
</div> -->

    <!-- Nav Item - Pages Collapse Menu -->

    <!--<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fa fa-user" aria-hidden="true"></i>
            <span>Admin</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="<?= base_url('user/admin') ?>">view admin</a>
                <a class="collapse-item" href="<?= base_url('user/login_histoy') ?>">Login History</a>
            </div>
        </div>
    </li>-->
	
	
	

    <!-- Nav Item - Charts -->


    <!-- Nav Item - Tables -->
    <!-- <li class="nav-item">
    <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span></a>
</li> -->

    <!-- Divider -->
    <!-- <hr class="sidebar-divider d-none d-md-block"> -->

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <!-- <div class="sidebar-card d-none d-lg-flex">
    <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
    <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
    <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
</div> -->

</ul>


<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-outline-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-outline-primary" href="<?= base_url() ?>general/logout">Logout</a>
            </div>
        </div>
    </div>
</div>


<script src=" <?= base_url('assets/vendor/jquery/jquery.min.js');?>"></script>