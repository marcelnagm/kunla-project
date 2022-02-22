 @foreach($candidates as $candidate)
                        <div class="container-fluid row" >
                            <div class="col-8 result-item">
                                <h4>{{$candidate->role()}}</h4>
                            <div>
                                <b>Pretensão Salarial:
                                    <span class="ex2">R$<?php echo number_format($candidate->payment,2)?></span>    
                            </b>
                            </div>
                            <div>                               
                            <b>Local: 
                                <span class="ex2">
                                @if($candidate->move_out)
                                 Disponivel para mudança
                                @else
                                {{$candidate->city}} - {{$candidate->state()->UF}} 
                                @endif
                            </span>
                            </b>
                            </div>
                            </div>
                            <div class="col-4">
                                <a class="btn-change text-decoration-none btn-lgx" href="/detail/{{$candidate->gid}}">Ver detalhes</a>
                            </div>                                                        
                        </div>
                        <hr>
                        @endforeach