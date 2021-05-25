@extends('layouts.app', ['activePage' => 'Menulist', 'titlePage' => __('Modifier alimetaire')])

@section('content')
    <div class="content">
      <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title "> <b>Modifier alimentaires</b></h4>
            </div>
            <div class="card-body">
              <form action="{{ route("alimentaire.update",$alimentaire->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PUT")
                <div class="form-group">
                  <label for="titre">titre</label>
                  <input type="text" class="form-control" name="titre" placeholder="Enter titre" value="{{ $alimentaire->titre }}">
                </div>
                <div class="form-group">
                  <label for="">Categories:</label><br>
                </div>
                @foreach ($cat as $cat)
                
                @if ($cat->status=='1')
                <input type="radio" name="categorie_id" value="{{ $cat->id }}">{{ $cat->nomCat}} <br>
                @endif   
                    
                @endforeach
                <div class="form-group">
                  <label for="description">description</label>
                  <input type="text" class="form-control" name="description" placeholder="description" value="{{ $alimentaire->description }}">
                </div>
              <fieldset>
                <label >Composants:</label><br>
                  @foreach ($category as $category)
                  <label for=""><b>{{ $category->title }}</b></label><br>
                   @foreach ($compo as $comp)
                      @if ($comp->categorie===$category->title)
                      @foreach ($inter as $inters)
                          @if ($comp->id===$inters)
                           <input type="checkbox" name="composants[]" value="{{ $comp->id }}" checked>{{ $comp->nomComposant }}<br> 
                          @endif
                      @endforeach
                      @foreach ($diff as $diffs)
                      @if ($comp->id===$diffs)
                      <input type="checkbox" name="composants[]" value="{{ $comp->id }}">{{ $comp->nomComposant }}<br> 
                     @endif
                      @endforeach
                      @endif
                  @endforeach 
              @endforeach
              </fieldset>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="image">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                  <label for=""><b>sizes:</b></label>
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
                        <p id="demo"></p>
                      </td>
                      
                    </tr>
                    @endforeach
                  </table>
                <button type="submit" class="btn btn-primary">Modifier</button>
              </form>
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