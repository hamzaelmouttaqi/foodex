@extends('layouts.app', ['activePage' => 'Menuadd', 'titlePage' => __('Ajouter alimentaire')])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-2">

            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title "> <b>Ajouter alimentaires</b></h4>
                    </div>
                    <div class="card-body">
                      <form action="{{ route("alimentaire.store") }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                          <div class="col-md-12 mb-3">
                            <label for="validationCustom18" style="color: black"><strong>Nom alimentaire</strong></label>
                            <div class="input-group">
                              <input type="text" name="titre" class="form-control" id="validationCustom18" placeholder="Nom alimentaire">
                              <div class="valid-feedback">
                                Looks good!
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <label for="validationCustom12" style="color: black"><strong>Description</strong></label>
                            <div class="input-group">
                              <textarea rows="2" id="validationCustom12" name="description" class="form-control" placeholder="Description" required=""></textarea>
                              <div class="invalid-feedback">
                                Please provide a message.
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="validationCustom22" style="color: black"><strong>Categorie</strong></label>
                            <div>
                                <table>
                                  @foreach ($cat as $catali)
                                    @if ($catali->status=='1')
                                      <tr>
                                        <td>
                                          <input  type="checkbox" name="categorie_id" value="{{ $catali->id }}"> {{ $catali->nomCat}} <br>
                                        </td>
                                      </tr>  
                                    @endif
                                  @endforeach
                                </table>
                              <div class="invalid-feedback">
                                Please select a Catagory.
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 mb-3">
                            <label for="validationCustom23" style="color: black"><strong>Size</strong></label>
                            <div >
                              <table>
                                @foreach ($sizes as $size)
                                  <tr>
                                    <td>
                                      <input class="size-enable" type="checkbox" name="{{ $size->id }}" data-id="{{ $size->id }}" value="{{$size->id}}"> {{$size->title}}
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                      <input type="number" class="size-prix form-control" style="border: 0" name="size[{{ $size->id }}]" data-id="{{ $size->id }}" placeholder="  0 DH" disabled>
                                    </td>
                                  </tr>
                                @endforeach 
                              </table>
                              <div class="invalid-feedback">
                                Please select a Currency
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <label for="validationCustom12" style="color: black"><strong>Alimentaire Image</strong></label>
                            <div class="custom-file">
                              <input type="file" name="image" class="custom-file-input" id="validatedCustomFile">
                              <label class="custom-file-label" for="validatedCustomFile">Upload Images...</label>
                              <div class="invalid-feedback">Example invalid custom file feedback</div>
                            </div>
                          </div>
                          <div class="col-md-12 mb-3">
                            <label for="validationCustom24" style="color: black"><strong>Composants</strong></label>
                            <div class="input-group">
                              <table class="table" >
                                <tr>
                                  
                                  @foreach ($category as $category)
                                  <td>
                                  <table height="300px">
                                    <tr height='50px'>
                                      <th valign='top'><label for=""><b>{{ $category->title }}</b></label></th>
                                    </tr>
                                    <tr>
                                      <td valign='top'>
                                      @foreach ($compo as $comp)
                                      @if ($comp->categorie===$category->title)
                                      <input type="checkbox" name="composants[{{ $comp->id }}]" value="{{ $comp->id }}"> {{ $comp->nomComposant }}<br>
                                      @endif
                                     @endforeach
                                      </td>
                                    </tr>
                                  </table>
                                  </td>
                                  @endforeach
                                  </td>
                                </tr>
                              </table> 
                            </div>
                          </div>
                          
                          
                          
                        </div>
        
        
        
                        <button type="submit" class="btn btn-primary " style="float: right" >Ajouter</button>
                      </form>
                        {{-- <form action="{{ route("alimentaire.store") }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                              <label for="titre">titre</label>
                              <input type="text" class="form-control" name="titre" placeholder="Enter titre">
                            </div>
                            <div class="form-group">
                              <label for="categorie">Categories:</label><br>
                            </div>
                            @foreach ($cat as $cat)
                                @if ($cat->status=='1')
                                <input type="radio" name="categorie_id" value="{{ $cat->id }}">{{ $cat->nomCat}} <br>
                                @endif    
                            @endforeach
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                              </div>
                            <div class="input-group">
                              <label for="description"><strong>DESCRIPTION</strong></label>
                              <textarea type="text" class="form-control" name="description" placeholder="description"></textarea>
                            </div>
                                
                                  <table class="table" >
                                    <tr>
                                      
                                      @foreach ($category as $category)
                                      <td>
                                      <table height="300px">
                                        <tr height='50px'>
                                          <th valign='top'><label for=""><b>{{ $category->title }}</b></label></th>
                                        </tr>
                                        <tr>
                                          <td valign='top'>
                                          @foreach ($compo as $comp)
                                          @if ($comp->categorie===$category->title)
                                          <input type="checkbox" name="composants[{{ $comp->id }}]" value="{{ $comp->id }}">{{ $comp->nomComposant }}<br>
                                          @endif
                                         @endforeach
                                          </td>
                                        </tr>
                                      </table>
                                      </td>
                                      @endforeach
                                      </td>
                                    </tr>
                                  </table> --}}
                                      {{-- @foreach ($category as $category)
                                          <label for=""><b>{{ $category->title }}</b></label><br>
                                          @foreach ($compo as $comp)
                                              @if ($comp->categorie===$category->title)
                                              <input type="checkbox" name="composants[{{ $comp->id }}]" value="{{ $comp->id }}">{{ $comp->nomComposant }}<br>
                                              @endif
                                          @endforeach
                                      @endforeach --}}
                                
                                {{-- <label for=""><b>sizes:</b></label>
                                <table>
                                  @foreach ($sizes as $sizes)
                                  <tr>
                                    <td>
                                      <input type="checkbox" class="size-enable"  data-id="{{ $sizes->id }}">
                                    </td>
                                    <td>{{ $sizes->title }}</td>
                                    <td>
                                      <input type="number"
                                      name="sizes[{{ $sizes->id }}]"
                                      class="size-prix form-control"
                                      placeholder="Prix"
                                      disabled
                                      data-id="{{ $sizes->id }}"
                                      >
                                    </td>
                                    
                                  </tr>
                                  @endforeach
                                </table>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                          </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $('document').ready(function () {
            $('.size-enable').on('click', function () {
                let id = $(this).attr('data-id')
                let enabled = $(this).is(":checked")
                $('.size-prix[data-id="' + id + '"]').attr('disabled', !enabled)
                $('.size-prix[data-id="' + id + '"]').val(null)
            })
        }); 
    </script>
@endsection