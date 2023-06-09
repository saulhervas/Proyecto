@if ($item["submenu"] == [])
    <li class="nav-item {{getMenuActivo($item["url"])}}">
        <a href="{{url($item['url'])}}" class="nav-link {{getMenuActivo($item["url"])}}">
          <i class="nav-icon fas {{$item["icono"]}}"></i>
            <p>{{$item["nombre"]}}
                {{-- @if($item["url"] == 'habitacion' && $disponibles > 0)
                    <span class="badge badge-warning right">{{$disponibles}}</span>
                @endif --}}
            </p>
        </a>
    </li>
@else
    <li class="nav-item has-treeview ">
        <a href="javascript:;" class="nav-link {{getMenuActivo($item["url"])}}">
          <i class="nav-icon fas fa {{$item["icono"]}}"></i> <p>{{$item["nombre"]}} <i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav-treeview">
            @foreach ($item["submenu"] as $submenu)
                @include("theme.$theme.menu-item", ["item" => $submenu])
            @endforeach
        </ul>
    </li>
@endif
