<div>
   
<div class="row">
    <div class="col-md-12">
        @foreach ($alimentaires as $alimentaire)
      <form wire:submit.prevent="addToCart({{ $alimentaire->id }})" method="POST" class="form-vertical">
        @csrf
        <div wire:ignore class="modal fade" id="ali_{{ $alimentaire->id }}" tabindex="-1" 
            aria-labelledby="ModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-body">
                <table width=100% border="0" style="font-family: 'Lora', serif;">
                    <tr width=100%>
                        <th colspan="2" style="padding-left: 20px;padding-bottom:20px">
                           <h4 style="text-transform: uppercase">{{ $alimentaire->titre }}</h4>
                           
                        </th>
                        <td align=right valign=top>
                               <i class="fas fa-times-circle fa-lg" style="cursor: pointer" data-bs-dismiss="modal" 
                               aria-label="Close">
                                </i>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="titre" style="padding-left: 50px;padding-bottom:10px">
                            <h4>
                                Size :
                            </h4>
                        </td>
                    </tr>
                    @foreach ($alimentaire->sizes as $size)
                        <tr height=30px>
                            <td align="center" style="padding-left: 50px;">
                            <input class="form-check-input" value="{{ $size->pivot->prix }}|{{ $size->title }}" type="radio"
                             wire:model="size.{{ $alimentaire->id }}">
                            </td>
                            <td style="padding-left: 50px;">
                                <label class="form-check-label" style="text-transform: uppercase"
                                 for="flexRadioDefault1">
                                    {{ $size->title }}
                                </label>
                            </td>
                            <td>
                                {{ $size->pivot->prix }} DH
                            </td>
                        </tr>
                    @endforeach
                     <tr >
                        <td colspan="3" class="titre" style="padding-left: 50px;padding-top:20px">
                            <h4>
                                COMPOSANTS : 
                            </h4>
                        </td>
                    </tr>
                    <tr height=20px></tr>
                    @php
                              
                        $camp=DB::table('composants')->select('id')->pluck('id')->toArray();
                        $comp=DB::table('alimentaire_composant')->select('composant_id')->where('alimentaire_id', $alimentaire->id )->pluck('composant_id')->toArray();
                        $diff=array_merge(array_diff($camp,$comp)); 
                        $inter=array_merge(array_intersect($camp,$comp));
                    
                                  
                     @endphp
                    <tr>
                        <td colspan="3" style="padding-left: 70px;">
                            
                             <div class="row">
                                @foreach ($compos as $compo) 
                                      @foreach ((array)$inter as $inters)
                                            @if ($compo->id==$inters)
                                            <div class="col-md-4">
                                                <input type="checkbox"
                                                 wire:model="composants_.{{ $alimentaire->id }}.{{ $compo->id }}"
                                                  value="{{ $compo->nomComposant }}"
                                                  > 
                                                  <label style="margin-left:20px;
                                                  margin-bottom:20px;
                                                  text-transform: uppercase">
                                                    {{ $compo->nomComposant }}
                                                  </label>
                                                  
                                            </div>
                                            @endif  
                                                                 
                                    @endforeach                 
                                    
                                 @endforeach  
                             </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="titre" style="padding-left: 50px;padding-bottom:30px">
                            <h6>
                                SPECIAL REQUEST ? 
                            </h6>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" align="center">
                            <a style="text-decoration: none; color:rgb(255, 136, 0)" 
                            data-bs-toggle="collapse" href="#ajoute" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                <i class="fas fa-plus"></i>ADD YOUR FAVOURITE SUPPLEMENT AND COMPOSANTS
                            </a>
                        </td>
                    </tr>
                    <tr width=100% class="collapse multi-collapse" id="ajoute">
                        <td style="padding-left:50px" >     
                            <a class="composant btn" data-id="{{ $alimentaire->id }}"
                             style="color: black;font-weight: 900;
                                background-color: #ffff;box-shadow: none"
                                  for="composants" >Composants Payants</a>
                                
                                <div id="com_{{ $alimentaire->id }}" style="display: none">
                                <table width="100%">
                                    @foreach ($compos as $compo)
                                    <tr align=center>
                                        <td>
                                        <input type="checkbox" wire:model="ingredient_.{{ $alimentaire->id }}.{{ $compo->id }}"
                                         value="{{ $compo->nomComposant }}" >
                                        </td>
                                        <td>
                                            {{ $compo->nomComposant }}
                                          </td>
                                          <td>
                                            {{ $compo->prix }} DH
                                          </td>
                                          <td>
                                            <input type="number" min="1" max="5"
                                             wire:model="quantites.{{ $alimentaire->id }}.{{ $compo->nomComposant }}">
                                          </td>
                                    </tr>
                                    @endforeach
                                </table>   
                                </div>          
                        </td>  
                        <td align="center" colspan="2">        
                        
                            <a class="supplement btn" data-id="{{ $alimentaire->id }}" style="background-color: #ffff;box-shadow: none;
                                color: black;font-weight: 900" for="supplement"><b>Supplements</b></a>
                              <div id="supp_{{ $alimentaire->id }}" style="display: none">
                                <table width="100%">
                                  @foreach ($supplements as $supp)
                                  <tr>
                                    <td>
                                      <input type="checkbox" wire:model="supplement.{{ $alimentaire->id }}.{{ $supp->titre }}" 
                                      value="{{ $supp->titre }}">
                                    </td>
                                    <td>
                                      {{ $supp->titre }} 
                                    </td>
                                    <td>
                                      {{ $supp->prix }} DH
                                    </td>
                                  
                                  @endforeach
                                </tr>
                                </table>
                               
                              </div>
                                    
                                
                        </td>
                    </tr>
                    <tr height=20px></tr>
                    <tr height=20px >
                        <td colspan="2" class="titre" style="padding-left: 90px">
                            <h5>
                                QUANTITE
                            </h5>
                        </td>
                        <td align="center" style="padding-top: 30px">
                            <fieldset>
                                <input type="button" wire:click='decrease({{ $alimentaire->id }})' value="-" class="decrease" />
                                <input type="text" wire:model='quantite.{{ $alimentaire->id }}'
                                 class="quantite_{{ $alimentaire->id }}" value=""/>
                                <input type="button" wire:click='increase({{ $alimentaire->id }})' value="+" class="increase" />
                            </fieldset>
                        </td>
                    </tr>
                    <tr height=40px>
                        <td colspan="3" align=center>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-plus"></i>
                                ADD TO MY ORDER
                            </button>
                        </td>            
                    </tr>      
                </table>
                
              </div>
            </div>
          </div>
        </div>
      </form>
      @endforeach
    </div>
</div>

</div>