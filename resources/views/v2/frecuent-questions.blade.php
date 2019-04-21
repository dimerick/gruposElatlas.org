@extends('v2/template')

@section('title')
    Preguntas Frecuentes
@endsection

@section('css')
    <link href="{{ asset('assets/css/lightbox.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/v2/css/map.css') }}" rel="stylesheet">
@endsection

@section('content')

    <section id="about">
        <h3>¿Que es elatlas y que tiene que ver con la geografía?</h3>
        <p>Es una plataforma pública global, la cual está orientada a hacer relevante la geografía para los procesos sociales, en temas como: Alimentos y agricultura, Medio ambiente, Arte y Cultura, Cuidado y Protección animal, Deportes y Recreación, Derechos Humanos, Desarrollo Comunitario, Educación, Hábitat y Vivienda, Salud entre otros.</p>
        <p>El Atlas es un espacio para la conexión geográfica. En El Atlas: </p>
        <ul>
            <li>Diferentes procesos sociales pueden conectarse localmente, regionalmente y a través del mundo.</li>
            <li>Los procesos sociales  pueden conectarse con recursos geográficos, incluyendo la generación de mapas y la articulación a proyectos de investigación.</li>
            <li>Los procesos sociales pueden contribuir a una base de datos publica – global relevante para la transformación social.</li>
        </ul>
        <br>
        <h3>¿Quiénes Pueden Participar?</h3>
        <p>El Atlas está abierto a cualquier grupo, colectivo, ONGs, cooperativas, asambleas y otras formas de articulación de personas trabajando para la transformación pacifica de la sociedad.</p>
        <br>

        <h3>¿Cómo puedes participar en El Atlas?</h3>
        <p>Cualquier grupo puede unirse al El Atlas creando un perfil ingresando a nuestro website, www.elatlas.org. Opción registrarse, una vez tu grupo se registre, pueden compartir y registrar sus actividades y conectarte con otros grupos que están haciendo un trabajo similar. El Atlas es un medio de colaboración y cooperación para el flujo de ideas, recursos y conocimientos. <b>¡Por favor ayúdanos a crecer!</b>
        </p>
        <br>
        <h3>¿Qué es nuestra galería?</h3>
        <p>Es una exposición de los proyectos colaborativos que El Atlas ha contribuido a fomentar. Si quieres que hacer un aporte a nuestra galería, nos puedes contactar al correo electrónico <b>info@elatlas.org</b>, para informarte los detalles de esta iniciativa.</p>
        <br>
    </section>

@endsection

@section('scripts')
    <script src="{{ asset('assets/v2/js/map.js') }}"></script>
@endsection