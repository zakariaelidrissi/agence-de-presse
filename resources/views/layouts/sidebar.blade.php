
@if (auth()->user()->is_admin)
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">NAZA</div>
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
            Gestion
        </div>

        <!-- Nav Item - Responsaples -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('gestion.responsables') }}">
                <i class="fas fa-user-tie"></i>
                <span>Les responsables</span></a>
        </li>

        <!-- Nav Item - collaborateurs -->
        <li class="nav-item">
            <a class="nav-link " href="{{ route('gestion.collaborateurs') }}">
                <i class="fas fa-users"></i>
                <span>Collaborateurs</span></a>
        </li>
        
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Paiement
        </div>

        <!-- Nav Item - Responsaples -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('paiement.responsables') }}">
                <i class="fas fa-user-tie"></i>
                <span>Les responsables</span></a>
        </li>

        <!-- Nav Item - collaborateurs -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                aria-expanded="true" aria-controls="collapseThree">
                <i class="fas fa-users"></i>
                <span>collaborateurs</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('paiement.collaborateurs.employes') }}">Salariés de l'entreprise</a>
                    <a class="collapse-item" href="{{ route('paiement.collaborateurs.independants') }}">Indépendants</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Messages -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.message') }}">
                <i class="fas fa-envelope-open-text"></i>
                <span>Messages</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>    
@endif

@if (auth()->user()->compitance == 'responsable')
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('\\') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">NAZA</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item mt-3 active">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Articles -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                aria-expanded="true" aria-controls="collapseThree">
                <i class="far fa-newspaper"></i>
                <span>Les Articles</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('articles.public') }}">Publiés</a>
                    {{-- <a class="collapse-item" href="/articles.public">Publiés</a> --}}
                    <a class="collapse-item" href="{{ route('articles.new') }}">Nouvaux</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">


        <!-- Nav Item - Messages -->
        <li class="nav-item">
            <a class="nav-link" href="">
                <i class="fas fa-envelope-open-text"></i>
                <span>Messages</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - collaborateurs -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-users"></i>
                <span>collaborateurs</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ route('collaborateurs.salaries') }}">Salariés de l'entreprise</a>
                    <a class="collapse-item" href="{{ route('collaborateurs.indep') }}">Indépendants</a>
                </div>
            </div>
        </li>
        
        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
@endif

@if (auth()->user()->compitance == 'redacteur')
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
            <div class="sidebar-brand-icon rotate-n-15">
                <i class="fas fa-laugh-wink"></i>
            </div>
            <div class="sidebar-brand-text mx-3">NAZA</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item mt-3 active">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">


        <!-- Nav Item  -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('red.all.articles') }}">
                <i class="far fa-newspaper"></i>
                <span>Les Articles publiés</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">


        <!-- Nav Item -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('red.new.articles') }}">
                <i class="fas fa-file-medical"></i>
                <span>Les Nouvaux articles</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
@endif
