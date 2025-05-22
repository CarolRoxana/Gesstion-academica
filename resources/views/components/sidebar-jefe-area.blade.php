 <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
     <!-- Menú desplegable Docente -->
     <li
         class="nav-item has-treeview {{ request()->routeIs('docente.*') ||
         Route::is('admin.desempeno-docente.*') ||
         Route::is('admin.lineamiento-docente.*') ||
         Route::is('admin.plan_evaluacion_docente.*') ||
         Route::is('admin.temario_docente.*')
             ? 'menu-open'
             : '' }}">
         <a href="#"
             class="nav-link {{ request()->routeIs('docente.*') ||
             Route::is('admin.desempeno-docente.*') ||
             Route::is('admin.lineamiento-docente.*') ||
             Route::is('admin.plan_evaluacion_docente.*') ||
             Route::is('admin.temario_docente.*')
                 ? 'active'
                 : '' }}">
             <i class="nav-icon fas fa-user-tie"></i>
             <p>
                 Gestión Docente
                 <i class="right fas fa-angle-left"></i>
             </p>
         </a>
         <ul class="nav nav-treeview">


             <li class="nav-item">
                 <a href="{{ route('admin.docente.index') }}"
                     class="nav-link {{ request()->routeIs('docente.*') ? 'active' : '' }}">
                     <i class="nav-icon fas fa-user-tie"></i>
                     <p>Docente</p>
                 </a>
             </li>
             <li class="nav-item">
                 <a href="{{ route('admin.desempeno-docente.index') }}"
                     class="nav-link {{ Route::is('admin.desempeno-docente.*') ? 'active' : '' }}">
                     <i class="nav-icon fas fa-feather"></i>
                     <p>Desempeño Docente</p>
                 </a>
             </li>







         </ul>
     </li>






     <li class="nav-item">
         <a href="{{ route('admin.talento_humano.index') }}"
             class="nav-link {{ Route::is('admin.talento_humano.*') ? 'active' : '' }}">
             <i class="nav-icon fas fa-users"></i>
             <p>Talento Humano</p>
         </a>
     </li>






     <li class="nav-item">
         <a href="{{ route('admin.profile.edit') }}"
             class="nav-link {{ Route::is('admin.profile.edit') ? 'active' : '' }}">
             <i class="nav-icon fas fa-id-card"></i>
             <p>Profile</p>
         </a>
     </li>
 </ul>
