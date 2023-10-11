<aside id="sidebar" class="bg-dark h-100">
	<!-- Sidebar -->
	<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

		<!-- Sidebar - Brand -->
		<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
			<div class="sidebar-brand-icon rotate-n-15">
				<i class="fas fa-motorcycle"></i>
			</div>
			<div class="sidebar-brand-text mx-3">Rottor MX <sup>Dashboard</sup></div>
		</a>

		<!-- Divider -->
		<hr class="sidebar-divider my-0">

		<!-- Nav Item - Dashboard -->
		<li class="nav-item active">
			<a class="nav-link" href="{{ route('home') }}">
				<i class="fas fa-fw fa-tachometer-alt"></i>
				<span>Dashboard</span></a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider">

		<!-- Heading -->
		<div class="sidebar-heading">
			Catálogos
		</div>

		<!-- Nav Item - Pages Collapse Menu -->

		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProducts"
				aria-expanded="true" aria-controls="collapseProducts">
                <i class="fas fa-motorcycle"></i>
				<span>{{ __('product.plural') }}</span>
			</a>
			<div id="collapseProducts" class="collapse" aria-labelledby="headingProducts" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="{{ route('products.index') }}">{{ __('product.list') }}</a>
					<a class="collapse-item" href="{{ route('products.create') }}">{{ __('product.new') }}</a>
				</div>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseModels"
				aria-expanded="true" aria-controls="collapseModels">
				<i class="fas fa-fw fa-cog"></i>
				<span>{{ __('model.plural') }}</span>
			</a>
			<div id="collapseModels" class="collapse" aria-labelledby="headingModels" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="{{ route('models.index') }}">{{ __('model.list') }}</a>
					<a class="collapse-item" href="{{ route('models.create') }}">{{ __('model.new') }}</a>
				</div>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseVersions"
			   aria-expanded="true" aria-controls="collapseVersions">
				<i class="fas fa-fw fa-cog"></i>
				<span>{{ __('version.plural') }}</span>
			</a>
			<div id="collapseVersions" class="collapse" aria-labelledby="headingVersions" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="{{ route('versions.index') }}">{{ __('version.list') }}</a>
					<a class="collapse-item" href="{{ route('versions.create') }}">{{ __('version.new') }}</a>
				</div>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBrands"
				aria-expanded="true" aria-controls="collapseBrands">
				<i class="fas fa-fw fa-cog"></i>
				<span>{{ __('brand.plural') }}</span>
			</a>
			<div id="collapseBrands" class="collapse" aria-labelledby="headingModels" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="{{ route('brands.index') }}">{{ __('brand.list') }}</a>
					<a class="collapse-item" href="{{ route('brands.create') }}">{{ __('brand.new') }}</a>
				</div>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseKms"
				aria-expanded="true" aria-controls="collapseKms">
				<i class="fas fa-fw fa-cog"></i>
				<span>{{ __('km.plural') }}</span>
			</a>
			<div id="collapseKms" class="collapse" aria-labelledby="headingKms" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="{{ route('kms.index') }}">{{ __('km.list') }}</a>
					<a class="collapse-item" href="{{ route('kms.create') }}">{{ __('km.new') }}</a>
				</div>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMotors"
				aria-expanded="true" aria-controls="collapseMotors">
				<i class="fas fa-fw fa-cog"></i>
				<span>{{ __('motor.plural') }}</span>
			</a>
			<div id="collapseMotors" class="collapse" aria-labelledby="headingMotors" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="{{ route('motors.index') }}">{{ __('motor.list') }}</a>
					<a class="collapse-item" href="{{ route('motors.create') }}">{{ __('motor.new') }}</a>
				</div>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFactors"
				aria-expanded="true" aria-controls="collapseFactors">
				<i class="fas fa-fw fa-cog"></i>
				<span>{{ __('factor.plural') }}</span>
			</a>
			<div id="collapseFactors" class="collapse" aria-labelledby="headingMotors" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="{{ route('factors.index') }}">{{ __('factor.list') }}</a>
					<a class="collapse-item" href="{{ route('factors.create') }}">{{ __('factor.new') }}</a>
				</div>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMarkets"
				aria-expanded="true" aria-controls="collapseMarkets">
				<i class="fas fa-fw fa-cog"></i>
				<span>{{ __('market.plural') }}</span>
			</a>
			<div id="collapseMarkets" class="collapse" aria-labelledby="headingMotors" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="{{ route('markets.index') }}">{{ __('market.list') }}</a>
				</div>
			</div>
		</li>

		<!-- Nav Item - Utilities Collapse Menu -->
		<!-- <li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
				aria-expanded="true" aria-controls="collapseUtilities">
				<i class="fas fa-fw fa-wrench"></i>
				<span>Utilities</span>
			</a>
			<div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
				data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<h6 class="collapse-header">Custom Utilities:</h6>
					<a class="collapse-item" href="utilities-color.html">Colors</a>
					<a class="collapse-item" href="utilities-border.html">Borders</a>
					<a class="collapse-item" href="utilities-animation.html">Animations</a>
					<a class="collapse-item" href="utilities-other.html">Other</a>
				</div>
			</div>
		</li> -->

		<!-- Divider -->
		<hr class="sidebar-divider">

		<!-- Heading -->
		<!-- <div class="sidebar-heading">
			Addons
		</div> -->

		<!-- Nav Item - Pages Collapse Menu -->
		<!--<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
				aria-expanded="true" aria-controls="collapsePages">
				<i class="fas fa-fw fa-folder"></i>
				<span>Pages</span>
			</a>
			<div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<h6 class="collapse-header">Login Screens:</h6>
					<a class="collapse-item" href="login.html">Login</a>
					<a class="collapse-item" href="register.html">Register</a>
					<a class="collapse-item" href="forgot-password.html">Forgot Password</a>
					<div class="collapse-divider"></div>
					<h6 class="collapse-header">Other Pages:</h6>
					<a class="collapse-item" href="404.html">404 Page</a>
					<a class="collapse-item" href="blank.html">Blank Page</a>
				</div>
			</div>
		</li>-->

		<!-- Nav Item - Charts -->
		<!--<li class="nav-item">
			<a class="nav-link" href="charts.html">
				<i class="fas fa-fw fa-chart-area"></i>
				<span>Charts</span></a>
		</li>-->

		<!-- Nav Item - Tables -->
		<!--<li class="nav-item">
			<a class="nav-link" href="tables.html">
				<i class="fas fa-fw fa-table"></i>
				<span>Tables</span></a>
		</li>-->

		<!-- Divider -->
		<hr class="sidebar-divider d-none d-md-block">

		<!-- Sidebar Toggler (Sidebar) -->
		<!-- <div class="text-center d-none d-md-inline">
			<button class="rounded-circle border-0" id="sidebarToggle"></button>
		</div>-->

		<!-- Sidebar Message -->
		<!-- <div class="sidebar-card d-none d-lg-flex">
			<img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
			<p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
			<a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
		</div> -->

	</ul>
	<!-- End of Sidebar -->

</aside>
