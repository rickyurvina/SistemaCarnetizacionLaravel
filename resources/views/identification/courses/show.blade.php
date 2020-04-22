@extends('identification.layouts.app')
@section('content')
@include('identification.layouts.top-content',['routeText'=>'course.index','btnText'=>'Panel de Control','textTitle'=>'Detalles de la Institución'])
               <div>
                <br/>
                <p>{{__('Name')}}: {{$course->CUR_NOMBRE}}</p>
                <p>{{__('Paralelo')}}: {{$course->CUR_PARALELO}}</p>
                <p>{{__('Institution')}}:  {{$course->institution->INS_NOMBRE}}</p>
                <p>{{__('Created_at')}} {{$course->created_at->format('d/m/Y')}}</p>
                <p>{{__('Updated_at')}}{{$course->updated_at->format('d/m/Y')}}</p>
                   <div class="btn-group btn-group-xs">
                <a href="{{route('course.edit',$course)}}"
                   class="btn btn-info btn-xs">
                    <i class="fa fa-pencil"></i>
                    {{__('Edit')}}
                </a>
                   <a href="#"
                      class="btn btn-danger btn-xs"
                      onclick="document.
                    getElementById('delete-course').
                       submit()"
                   ><i class="fa fa-trash-o"></i>{{_('Delete')}}</a>
                   <form
                       class="d-none"
                       id="delete-course"
                       method="POST"
                       action="{{route('course.destroy',$course)}}">
                       @csrf @method('DELETE')
                   </form>
                   </div>
               </div>
        </div>
    </div>
</div>
@endsection
