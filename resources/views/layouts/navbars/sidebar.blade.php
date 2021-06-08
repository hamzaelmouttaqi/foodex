<div class="sidebar" data-color="orange" data-background-color="white" >
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="{{ route('home') }}" class="simple-text logo-normal">
      {{ __('FOODEX') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      
     
      
      

      <li class="nav-item {{ ($activePage == 'Commandelist' || $activePage == 'Commandeadd' ) ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#commande" aria-expanded="false">
          <i class="material-icons">shopping_cart</i>

          <p>{{ __('Commandes') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="panel-collapse collapse {{ ($activePage == 'Commandelist' || $activePage == 'Commandeadd' ) ? 'show' : 'in' }}" id="commande">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'Commandelist' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('commande.index') }}">
                <i class="material-icons">format_list_bulleted</i>
                <span class="sidebar-normal">{{ __('Commande list') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'Commandeadd' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('commande.create') }}">
                <i class="material-icons">add</i>
                <span class="sidebar-normal"> {{ __('Ajouter commande') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
     
      <li class="nav-item {{ ($activePage == 'client-liste' || $activePage == 'avis') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#laravelclient" aria-expanded="false">
          <i class="material-icons">group</i>
          <p>{{ __('Clients') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="panel-collapse collapse {{ ($activePage == 'client-liste' || $activePage == 'avis') ? 'show' : 'in' }}" id="laravelclient">
           <ul class="nav">
            <li class="nav-item{{ $activePage == 'client-liste' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('clients.index') }}">
                <i class="material-icons">
                  groups
                </i>
                <span class="sidebar-normal">{{ __('Clients liste') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'Avis' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('Avis.index') }}">
                <i class="material-icons">
                  rate_review
                </i>
                <span class="sidebar-normal"> {{ __('Avis') }} </span>
              </a>
            </li>
           </ul>
          </div>
      </li>
      <li class="nav-item {{ ($activePage == 'alimentaire' || $activePage == 'composants' ||
       $activePage == 'supplements'
      ) ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" data-target="#laravelArticle" aria-expanded="false">
          <i class="material-icons">storefont</i>
          <p>{{ __('Articles') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="panel-collapse collapse {{ ($activePage == 'alimentaire' || $activePage == 'composants' ||
        $activePage == 'supplements'
       ) ? 'show' : 'in' }}" id="laravelArticle">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'alimentaire' ? ' active' : '' }}">
              <a class="nav-link" data-toggle="collapse" data-target="#alimentaire" aria-expanded="false">
                <i class="material-icons">lunch_dining</i>
                <p>{{ __('Alimentaires') }}
                  <b class="caret"></b>
                </p>
              </a>
              <div class="panel-collapse collapse {{ $activePage == 'alimentaire' ? 'show' : 'in' }}" id="alimentaire">
                <ul class="nav">
                  <li class="nav-item{{ $activePage == 'categorie' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('categorie.index') }}">
                      <span class="sidebar-mini">-</span>
                      <span class="sidebar-normal"> {{ __('Categorie Alimentaire') }} </span>
                    </a>
                  </li>
                  <li class="nav-item{{ $activePage == 'Menulist' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('alimentaire.index') }}">
                      <i class="material-icons">format_list_bulleted</i>
                      <span class="sidebar-normal">{{ __('Menu list') }} </span>
                    </a>
                  </li>
                  <li class="nav-item{{ $activePage == 'Menucatalogue' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('alimentaire.catalogue') }}">
                      <i class="material-icons">apps</i>
                      <span class="sidebar-normal"> {{ __('Menu catalogue') }} </span>
                    </a>
                  </li>
                  
                  <li class="nav-item{{ $activePage == 'Menuadd' ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('alimentaire.create') }}">
                      <i class="material-icons">add</i>
                      <span class="sidebar-normal"> {{ __('Ajouter alimentaire') }} </span>
                    </a>
                  </li>
                </ul>
              </div>
        </li>
        <li class="nav-item{{ $activePage == 'composants' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('composants.index') }}">
                <span class="sidebar-mini"><i class="material-icons">local_grocery_store</i></span>
                <span class="sidebar-normal"> {{ __('Composants') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'supplement' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('supplement.index') }}">
                <span class="sidebar-mini"><i class="material-icons">wine_bar</i></span>
                <span class="sidebar-normal">{{ __('Supplements') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'Livreur' ) ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#livraison" aria-expanded="false">
          <i class="material-icons">moped</i>

          <p>{{ __('Livraisons') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="panel-collapse collapse {{ $activePage == 'Livreur' ? 'show' : 'in' }}" id="livraison">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'Livreur' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('livreur.index') }}">
                <i class="material-icons">perm_identity</i>
                <span class="sidebar-normal">{{ __('Livreur') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'Livraison' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('livraison.index') }}">
                <i class="material-icons">add_location</i>
                <span class="sidebar-normal">{{ __('Livraison') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'Parametre' ) ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('parametre.index') }}" >
          <i class="material-icons">
            manage_accounts
          </i>

          <p>{{ __('Parametre') }}
            
          </p>
        </a>
      </li>
    </ul>
  </div>
</div>
