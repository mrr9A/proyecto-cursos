<x-app title="Cursos:">
    <nav class="mx-4">
        <a href="{{url('curs',[$contenido->leccion->curso_id])}}" class="text-base text-nav-hover font-bold uppercase">{{$leccion->course->nombre}} > </a>
        <a href="{{url('curs',[$contenido->leccion->curso_id])}}" class="text-base text-nav-hover font-bold uppercase"> {{$contenido->leccion->nombre}} ></a>
        <a href="{{route('ver',[$contenido])}}" class="text-base text-nav-hover font-bold uppercase">{{$contenido->nombre}}</a>
    </nav><br>
    <div class="flex">
        <div class="w-full p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white mx-12 text-title uppercase">{{$contenido->nombre}}:</h5>
            <div class="p-2 bg-white border border-gray-200 rounded-lg shadow mx-12 text-center">
                @if(in_array($extension, ['mp4', 'webm']))
                <video src="{{$contenido->media[0]->url}}" controls class="w-full h-96 inline-block object-cover" width="800" height="500"></video>
                @elseif(in_array($extension, ['pdf', 'ogg']))
                <object data="{{$contenido->media[0]->url}}" type="application/pdf" class="w-full h-full inline-block object-cover" style="width: 100%; height: 800px;"></object>
                @else
                <object data="{{$contenido->media[0]->url}}" class="w-96 h-96 inline-block object-cover" width="800" height="500"></object>
                @endif
            </div>
            <div class="p-2  border border-gray-200 rounded-lg shadow mx-12 text-justify">
                <h3 class="text-center font-bold">DESCRIPCIÓN DEL CURSO:</h3><br>
                <p>{{$contenido->descripcion}}</p>
            </div><br>
            @if(count($contenido->examen) > 0 )
            <div class="items-center text-center">
                <a href="{{route('verExamen',$contenido)}}" class="button  text-white text-center capitalize py-2 px-2 rounded-lg tracking-widest font-bold  bg-btn-primary hover:bg-btn-primary-light  w-96 cursor-pointer">
                    Realizar examen
                </a>
            </div>
            @endif
        </div>
        <div class="w-full max-w-md p-4 border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="block p-6 border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                <div class="text-center justify-between px-4 items-center overflow-auto gap-3 mb-5 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    <span class="text-center text-subtitle text-orange-300">
                        LECCIÓN: <span class="text-nav-hover uppercase">{{$contenido->leccion->nombre}}</span>
                    </span>
                </div>
                <h2 class="text-center text-nav-hover">CONTENIDOS DE LA LECCIÓN</h2>
                @foreach($leccion->contenido as $leccCont)
                <div class="pt-5 pb-4 px-5 px-lg-3 px-xl-5">
                    <a href="{{route('ver',[$leccCont])}}" class="{{ $leccCont->id_contenido == $contenido->id_contenido ? 'bg-blue-100' : ''  }}   flex items-center uppercase justify-between w-full p-5 font-medium text-left text-gray-500 border border-gray-400 rounded-2xl focus:ring-8 focus:ring-blue-200 dark:focus:ring-blue-800 dark:text-gray-400  dark:hover:bg-gray-800">
                        {{$leccCont->nombre}}
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 512 512">
                                <g transform="rotate(90 256 256)">
                                    <path fill="#001d47" d="M256 48C141.12 48 48 141.12 48 256s93.12 208 208 208s208-93.12 208-208S370.88 48 256 48Zm-82.33 114.34l105 71a32.5 32.5 0 0 1-37.25 53.26a33.21 33.21 0 0 1-8-8l-71-105a8.13 8.13 0 0 1 11.32-11.32ZM256 432c-97 0-176-78.95-176-176a174.55 174.55 0 0 1 53.87-126.72a14.15 14.15 0 1 1 19.64 20.37A146.53 146.53 0 0 0 108.3 256c0 81.44 66.26 147.7 147.7 147.7S403.7 337.44 403.7 256c0-76.67-58.72-139.88-133.55-147v55a14.15 14.15 0 1 1-28.3 0V94.15A14.15 14.15 0 0 1 256 80c97.05 0 176 79 176 176s-78.95 176-176 176Z" />
                                </g>
                            </svg>
                        </span>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app>

