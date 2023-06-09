@if (isset($data->only_view))
    @if(isset($data->nombre))
        <label for="{{$nombre}}" class="col-lg-{{$label}} control-label" >{{$title ?? ucfirst(str_replace('_',' ',$nombre))}}</label>
        <div class="col-lg-{{$input}}">{{isset($data->$nombre) ? date('d-m-Y H:i',strtotime($data->$nombre)) : ''}}</div>
    @endif
@else
    <label for="{{$nombre}}" class="col-lg-{{$label}} control-label {{$req==1 ? 'requerido' : ''}}">{{$title ?? ucfirst(str_replace('_',' ',$nombre))}}</label>
    <div class="input-group date col-lg-{{$input}}" id="date-{{$nombre}}" data-date="{{old($nombre, $data->$nombre ?? '')!='' ? (date('d-m-Y H:i',strtotime(old($nombre, $data->$nombre ?? '')))) : ''}}" data-date-format="dd-mm-yyyy hh:ii" data-link-field="dtp_input1">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
        </div>
        <input type="text" name="{{$nombre}}" id="{{$nombre}}" class="form-control" value="{{old($nombre, $data->$nombre ?? '')!='' ? (date('d-m-Y H:i',strtotime(old($nombre, $data->$nombre ?? '')))) : ''}}" {{$req==1 ? 'required' : ''}} {{isset($data->readonly) ? 'readonly' : ''}} {{isset($dis) ? 'disabled' : ''}}>            
        <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
    </div>
@endif