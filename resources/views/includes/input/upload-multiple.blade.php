@if (isset($data->only_view))
    @if (isset($data->$nombre))
        <label for="{{$nombre}}" class="col-lg-{{$label}} control-label">{{$title ?? ucfirst(str_replace('_',' ',$nombre))}}</label>
        @foreach ($data->$nombre as $img)
            @if (file_exists("storage/".$img))
                @if ($img!='' && strpos(mime_content_type("storage/".$img), 'image')!==false)
                    <div class="col-lg-1">
                        <a href="/storage/{{$img}}" data-toggle="lightbox" data-title="">
                            <img src="/storage/{{$img}}" class="{{isset($imgFormat) ? $imgFormat : ''}} elevation-2" height="40">
                        </a>
                    </div>
                @elseif ($img!='')
                    <div class="col-lg-1">
                        <a href='/storage/{{$img}}' target="_blank"><i class="far fa-2x fa-file-pdf"></i></a>
                    </div>
                @endif
            @endif
        @endforeach
    @endif
@else
    <label for="{{$nombre}}" class="col-lg-{{$label}} control-label {{$req==1 ? 'requerido' : ''}}">{{$title ?? ucfirst(str_replace('_',' ',$nombre))}}</label>
    <div class="input-group col-lg-{{$input-1}}">
        <div class="custom-file">
             <!-- accept="image/*" -->
             <input type="file" name="{{$nombre}}[]" id="{{$nombre}}"  class="custom-file-input" {{$req==1 ? 'required' : ''}} {{isset($data->readonly) ? 'disabled' : ''}} {{isset($dis) ? 'disabled' : ''}} multiple>
            <label class="custom-file-label" for="{{$nombre}}Inputfile">Examinar</label>
        </div>
        <!--<div class="input-group-append">
            <span class="input-group-text" id="">Upload</span>
        </div>-->
    </div>
    @if (isset($data))
        @foreach ($data->$nombre as $img)
            @if(file_exists("storage/".$img))
                @if ($img!='' && strpos(mime_content_type("storage/".$img), 'image')!==false)
                    <div class="col-lg-1">
                        <a href="/storage/{{$img}}" data-toggle="lightbox" data-title="">
                            <img src="/storage/{{$img}}" class="{{isset($imgFormat) ? $imgFormat : ''}} elevation-2" height="40">
                        </a>
                    </div>
                @elseif ($img!='')
                    <div class="col-lg-1">
                        <a href='/storage/{{$img}}' target="_blank"><i class="far fa-2x fa-file-pdf"></i></a>
                    </div>
                @endif
            @endif
        @endforeach
    @endif
@endif
