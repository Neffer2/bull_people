<aside id="leftsidebar" class="sidebar">
    <div class="menu">
        <div class="slimScrollDiv">
            <div class="user-info">
                <div class="image">
                    <img src="{{ asset('img/profiles/'.Auth::user()->avatar) }}" width="48" height="48" alt="User">
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
                    <div class="email">{{ Auth::user()->email }}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right">
                            {{-- <li><a href="javascript:void(0);" class=" waves-effect waves-block"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block"><i class="material-icons">group</i>Followers</a></li>
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block"><i class="material-icons">shopping_cart</i>Sales</a></li>
                            <li><a href="javascript:void(0);" class=" waves-effect waves-block"><i class="material-icons">favorite</i>Likes</a></li> --}}
                            {{-- <li role="seperator" class="divider"></li> --}}
                            <li> 
                                <a href="/mi-perfil" class=" waves-effect waves-block">
                                    <i class="material-icons">person</i>Mi perf&iacute;l
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" onclick="submit()" class=" waves-effect waves-block">
                                    <i class="material-icons">input</i>Cerrar sesión
                                </a> 
                                <form id="log_out" action="{{ route('logout') }}" method="POST">
                                @csrf
                                </form>
                            </li> 
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="list">
                <li class="header">Menú</li>
                <li class="active">
                    <a href="/dashboard" class=" waves-effect waves-block">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="">
                    <a href="/hoja_vida" class=" waves-effect waves-block">
                        <i class="material-icons">contact_mail</i>
                        <span>Hoja de vida</span>
                    </a>
                </li> 
                <li class="">
                    <a href="/induccion" class=" waves-effect waves-block">
                        <i class="material-icons">school</i>
                        <span>Inducci&oacute;n</span>
                    </a>
                </li>
                <li class="">
                    <a href="/requisiciones" class=" waves-effect waves-block">
                        <i class="material-icons">chrome_reader_mode</i>
                        <span>Requisiciones</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="slimScrollBar" style="background: rgba(0, 0, 0, 0.5); width: 4px; position: absolute; top: 153.352px; opacity: 0.4; display: none; border-radius: 0px; z-index: 99; right: 1px; height: 129.472px;"></div><div class="slimScrollRail" style="width: 4px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
    </div>
    <!-- #Menu -->
    <div class="legal">
        <div class="copyright">
            &copy; 2022 <a href="javascript:void(0);">BullMarketing</a>.
        </div>
    </div>
    <script>
        function submit (){
            let form = document.getElementById("log_out");
            form.submit();
        }
    </script>
</aside>