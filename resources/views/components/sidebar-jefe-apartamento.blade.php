 <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">



     <li class="nav-item">
         <a href="{{ route('admin.curso-inter-semestral.index') }}"
             class="nav-link {{ Route::is('admin.curso-inter-semestral.*') ? 'active' : '' }}">
             <i class="nav-icon fas fa-book-open"></i>
             <p>Curso Inter semestral</p>
         </a>
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
