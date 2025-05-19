<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       @role('admin|Coordinador')
            <li class="nav-item">
                <a href="{{ route('admin.user.index') }}"
                    class="nav-link {{ Route::is('admin.user.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user"></i>
                    <p>Usuarios
                        <span class="badge badge-info right">{{ $userCount }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.role.index') }}"
                    class="nav-link {{ Route::is('admin.role.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-user-tag"></i>
                    <p>Rol
                        <span class="badge badge-success right">{{ $RoleCount }}</span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.permission.index') }}"
                    class="nav-link {{ Route::is('admin.permission.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-hat-cowboy"></i>
                    <p>Permisos
                        <span class="badge badge-danger right">{{ $PermissionCount }}</span>
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('admin.profesores.index') }}"
                   class="nav-link {{ Route::is('admin.profesores.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                    <p>Lista docente</p>
                </a>
            </li>

            <!-- Menú desplegable Planificación Académica -->
            <li class="nav-item has-treeview {{
                Route::is('admin.horario.index') ||
                Route::is('admin.periodo-academico.*') ||
                Route::is('admin.unidad-curricular.*') ||
                Route::is('admin.unidad-curricular-periodo.*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{
                    Route::is('admin.horario.index') ||
                    Route::is('admin.periodo-academico.*') ||
                    Route::is('admin.unidad-curricular.*') ||
                    Route::is('admin.unidad-curricular-periodo.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-calendar-alt"></i>
                    <p>
                        Planificación Académica
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('admin.horario.index') }}"
                           class="nav-link {{ Route::is('admin.horario.index') ? 'active' : '' }}">
                           <i class="nav-icon fas fa-calendar-day"></i>
                            <p>Horario</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.periodo-academico.index') }}"
                           class="nav-link {{ Route::is('admin.periodo-academico.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-alt"></i>
                            <p>Periodo Académico</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.unidad-curricular.index') }}"
                           class="nav-link {{ Route::is('admin.unidad-curricular.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-book"></i>
                            <p>Unidad Curricular</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.unidad-curricular-periodo.index') }}"
                           class="nav-link {{ Route::is('admin.unidad-curricular-periodo.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-calendar-week"></i>
                            <p>Unidad Curricular x Periodo</p>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Menú desplegable Docente -->
            <li class="nav-item has-treeview {{ 
                request()->routeIs('docente.*') || 
                Route::is('admin.desempeno-docente.*') || 
                Route::is('admin.lineamiento-docente.*') || 
                Route::is('admin.plan_evaluacion_docente.*') || 
                Route::is('admin.temario_docente.*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ 
                    request()->routeIs('docente.*') || 
                    Route::is('admin.desempeno-docente.*') || 
                    Route::is('admin.lineamiento-docente.*') || 
                    Route::is('admin.plan_evaluacion_docente.*') || 
                    Route::is('admin.temario_docente.*') ? 'active' : '' }}">
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
                    <li class="nav-item">
                        <a href="{{ route('admin.lineamiento-docente.index') }}"
                           class="nav-link {{ Route::is('admin.lineamiento-docente.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-location-arrow"></i>
                            <p>Lineamiento Docente</p>
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
            <li class="nav-item has-treeview {{ 
                Route::is('admin.propuesta.*') || 
                Route::is('admin.propuesta_tg.*') || 
                Route::is('admin.propuesta_tp.*') ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ 
                    Route::is('admin.propuesta.*') || 
                    Route::is('admin.propuesta_tg.*') || 
                    Route::is('admin.propuesta_tp.*') ? 'active' : '' }}">
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
            <!-- Resto de los elementos del menú... -->
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
                <a href="{{ route('admin.incidente-estudiantil.index') }}"
                   class="nav-link {{ Route::is('admin.incidente-estudiantil.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-exclamation-circle"></i>
                    <p>Incidentes Académicas</p>
                </a>
            </li>
        @endrole
        <li class="nav-item">
            <a href="{{ route('admin.profile.edit') }}"
                class="nav-link {{ Route::is('admin.profile.edit') ? 'active' : '' }}">
                <i class="nav-icon fas fa-id-card"></i>
                <p>Profile</p>
            </a>
        </li>
    </ul>
</nav>