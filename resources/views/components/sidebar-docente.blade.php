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
                 <a href="{{ route('admin.docente_unit.index') }}"
                     class="nav-link {{ request()->routeIs('docente.*') ? 'active' : '' }}">
                     <i class="nav-icon fas fa-user-tie"></i>
                     <p>Docente</p>
                 </a>
             </li>

             <li class="nav-item">
                 <a href="{{ route('admin.plan_evaluacion_docente.index') }}"
                     class="nav-link {{ Route::is('admin.plan_evaluacion_docente.*') ? 'active' : '' }}">
                     <i class="nav-icon fas fa-seedling"></i>
                     <p>Evaluación académica</p>
                 </a>
             </li>
             <li class="nav-item">
                 <a href="{{ route('admin.temario_docente.index') }}"
                     class="nav-link {{ Route::is('admin.temario_docente.*') ? 'active' : '' }}">
                     <i class="nav-icon fas fa-layer-group"></i>
                     <p>Temario Docente</p>
                 </a>
             </li>

         </ul>
     </li>

     <!-- Menú desplegable Propuestas. -->
     <li
         class="nav-item has-treeview {{ Route::is('admin.propuesta.*') || Route::is('admin.propuesta_tg.*') || Route::is('admin.propuesta_tp.*')
             ? 'menu-open'
             : '' }}">
         <a href="#"
             class="nav-link {{ Route::is('admin.propuesta.*') || Route::is('admin.propuesta_tg.*') || Route::is('admin.propuesta_tp.*')
                 ? 'active'
                 : '' }}">
             <i class="nav-icon fas fa-file-alt"></i>
             <p>
                 Propuestas Académicas
                 <i class="right fas fa-angle-left"></i>
             </p>
         </a>
         <ul class="nav nav-treeview">
             <li class="nav-item">
                 <a href="{{ route('admin.propuesta_tg.index') }}"
                     class="nav-link {{ Route::is('admin.propuesta_tg.*') ? 'active' : '' }}">
                     <i class="nav-icon fas fa-file"></i>
                     <p>Propuesta TG</p>
                 </a>
             </li>
             <li class="nav-item">
                 <a href="{{ route('admin.propuesta_tp.index') }}"
                     class="nav-link {{ Route::is('admin.propuesta_tp.*') ? 'active' : '' }}">
                     <i class="nav-icon fas fa-file"></i>
                     <p>Propuesta TP</p>
                 </a>
             </li>
             <li class="nav-item">
                 <a href="{{ route('admin.servicio_comunitario.index') }}"
                     class="nav-link {{ Route::is('admin.propuesta_tp.*') ? 'active' : '' }}">
                     <i class="nav-icon fas fa-file"></i>
                     <p>Servicio Comunitario</p>
                 </a>
             </li>
         </ul>
     </li>




     <li class="nav-item">
         <a href="{{ route('admin.profile.edit') }}"
             class="nav-link {{ Route::is('admin.profile.edit') ? 'active' : '' }}">
             <i class="nav-icon fas fa-id-card"></i>
             <p>Profile</p>
         </a>
     </li>
 </ul>
