<div class="col-md-3">
    <div class="products">
        <h4 style="color:white;font-family: 'Lora', serif;">Categories</h4>
        <nav class="productNav">
            <ul>
                @foreach ($categories as $categorie)
                    <li class="nav-item">
                        <div class="lien" id="{{ $categorie->nomCat }}" >
                            <div class="car" style="display: none !important;"></div>
                            <a type="button"  class="nomCat" 
                            data-id="{{ $categorie->nomCat }}"
                            href="#{{ $categorie->nomCat }}"
                            wire:click='getalimentaire({{ $categorie->id }})'
                                style="text-transform: uppercase;width:80%;
                                "><img style="margin-top: -5%" width="100" height="100" src="{{ asset('font/alim/beef_pizza.png') }}" class="img-fluid" alt="">
                                <h5 style="float: right">{{ $categorie->nomCat }}</h5>
                            </a>
                        </div>
                    </li>
                @endforeach
                
                
            </ul>
        </nav>
    </div>
</div>