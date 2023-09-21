@extends('templates.template')
@section('content')
<script>
    var programacoes = {{ Js::from($programacoes) }};
</script>

<script src="{{url('js/programacao.js')}}">

</script>


<section class="schedule section-padding" id="section_4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-12">
                <h2 class="mb-5 text-center">Nossa <u class="text-info">Programação</u></h2>
                <div class="tab-content mt-5" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-DayOne" role="tabpanel" aria-labelledby="nav-DayOne-tab">
                        <div class="row border-bottom pb-5 mb-5">                                 
                            <div class="row border-bottom pb-5 mb-5" id="programacoes">     
                                                 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection