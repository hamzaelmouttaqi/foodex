@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route("alimentaire.store") }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label for="titre">titre</label>
              <input type="text" class="form-control" name="titre" placeholder="Enter titre">
            </div>
            <div class="form-group">
              <label for="description">Categories:</label><br>
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
            <div class="form-group">
              <label for="description">description</label>
              <input type="text" class="form-control" name="description" placeholder="description">
            </div>
                <fieldset>
                      @foreach ($category as $category)
                          <label for=""><b>{{ $category->title }}</b></label><br>
                          @foreach ($compo as $comp)
                              @if ($comp->categorie===$category->title)
                              <input type="checkbox" name="composants[{{ $comp->id }}]" value="{{ $comp->id }}">{{ $comp->nomComposant }}<br>
                              @endif
                          @endforeach
                      @endforeach
                </fieldset>
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
                    </td>
                    
                  </tr>
                  @endforeach
                </table>
            <button type="submit" class="btn btn-primary">Ajouter</button>
          </form>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $('document').ready(function(){
          $('.size-enable').on('click',function(){
            let id = $(this).attr('data-id')
            let enabled = $(this).is(":checked")
            $('.size-prix[data-id="'+ id +'"]').attr('disabled', !enabled)
            $('.size-prix[data-id="'+ id +'"]').val(null)
          })
        })
    </script>
@endsection