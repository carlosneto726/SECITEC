@extends('templates.template')
@section('content')


<section class="schedule section-padding" id="section_4">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-12 col-12">
                            <h2 class="mb-5 text-center">Nossa <u class="text-info">Programação</u></h2>

                          
                            <div class="tab-content mt-5" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-DayOne" role="tabpanel" aria-labelledby="nav-DayOne-tab">
                                    <div class="row border-bottom pb-5 mb-5">
                                       


                                    <!--somente para visualizar-->
                                    <div class="col-lg-8 col-12 mt-3 mt-lg-0">
                                            
                                        
                                            <h4 class="mb-2">titulo</h4>

                                            <p>descricao</p>

                                            <div class="d-flex align-items-center mt-4">
                                                <div class="avatar-group d-flex">
                                                    <img src='...' class="img-fluid avatar-image" class="img-fluid avatar-image" alt="">

                                                    <div class="ms-3">
                                                    nomePalestrante
                                                        <p class="speakers-text mb-0">titulo</p>
                                                    </div>
                                                </div>
                                            
                                                
                                                <span class="mx-3 mx-lg-5">
                                                    <i class="bi-clock me-2"></i>
                                                    Intervalo de horario que vai acontecer
                                                </span>

                                                <span class="mx-1 mx-lg-5">
                                                    <i class="bi-layout-sidebar me-2"></i>
                                                    Local
                                                </span>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row border-bottom pb-5 mb-5">
                                    
                                    <!--
                                     @foreach ($programacoes as $dados) 
                                    //view da função esta retornando nada 
                                        <div class="col-lg-8 col-12 mt-3 mt-lg-0">
                                            
                                        
                                            <h4 class="mb-2">{{ $dados["titulo"]; }}</h4>

                                            <p>{{ $dados["descricao"]; }}</p>

                                            <div class="d-flex align-items-center mt-4">
                                                <div class="avatar-group d-flex">
                                                    <img src='{{ $dados["url_p"]; }}' class="img-fluid avatar-image" class="img-fluid avatar-image" alt="">

                                                    <div class="ms-3">
                                                    {{ $dados["palestrante"]; }}
                                                        <p class="speakers-text mb-0">{{ $dados["titulacao"]; }}</p>
                                                    </div>
                                                </div>
                                               <?php
                                               /*
                                                
                                                $horai = new DateTime($dados["horarioI"]);
                                                $hora_formatadai = $horai->format('h:i A');
                                                $horaf = new DateTime($dados["horarioF"]);
                                                $hora_formatadaf = $horaf->format('h:i A')?>
                                                <span class="mx-3 mx-lg-5">
                                                    <i class="bi-clock me-2"></i>
                                                    <?= $hora_formatadai; ?> - <?= $hora_formatadaf; ?> 
                                                </span>

                                                <span class="mx-1 mx-lg-5">
                                                    <i class="bi-layout-sidebar me-2"></i>
                                                    <?= $dados["local"]; ?>
                                                </span>
                                                */
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row border-bottom pb-5 mb-5">
                                    
                                    @endforeach
                                
                                -->



                            </div>
                        </div>

                    </div>
                </div>
            </section>

@endsection