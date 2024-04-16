@extends("layout")

@section("content")

<div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-primary text-white me-2">
        <i class="mdi mdi-home"></i>
      </span> Gestion des Utilisateur
    </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Dashboard
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Services
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Création
        </li>
      </ul>
    </nav>
  </div>

  <div class="row">
    <div class="col-lg-10 col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body border">
          <h4 class="card-title">Nouvel utilisateur</h4>
          <p class="card-description"> <small><em>Remplissez le formulaire pour créer un nouvel utilisateur</em></small> </p>
    <form class="forms-sample" method="post" action="{{route("user.store")}}" enctype="multipart/form-data">
@csrf

<div class="row">
    <div class="form-group mb-2 col-lg-6">
      <label for="poste">Poste <sup class="text-danger">*</sup></label>
      <input type="text" class="form-control @error('poste') is-invalid @enderror" value="{{old('poste')}}" id="poste" name="poste" placeholder="poste">
      @error('poste')
      <p class="text-danger text-center">{{ $message }}</p>
      @enderror
    </div>
  <div class="form-group mb-2 col-lg-6 ">
      <label for="departement">Ministere</label>
      <select name="ministere" id="ministere" class="form-select @error('ministere') is-invalid @enderror" value="{{old("ministere")}}" required>
        <option value=""> -- Choisir --  </option>
          @foreach ($ministeres as $ministere)
              <option value="{{$ministere->id}}" class="text-capitalize">{{$ministere->nom}}</option>
          @endforeach
      </select>
      @error('departement')
      <p class="text-danger text-center">{{ $message }}</p>
      @enderror
  </div>
</div>


<div class="row">
    <div class="form-group mb-2 col-lg-2">
        <label for="civilite">Civilité <sup class="text-danger">*</sup></label>
        <select name="civilite" id="civilite" class="form-select @error('civilite') is-invalid @enderror" value="{{old("civilite")}}" required>
          <option value=""> --  </option>
          <option value="M." class="text-capitalize">M.</option>
          <option value="Mme." class="text-capitalize">Mme</option>
        </select>
        @error('civilite')
        <p class="text-danger text-center">{{ $message }}</p>
        @enderror
    </div>

            <div class="form-group mb-2 col-lg-4">
              <label for="nom">Nom <sup class="text-danger">*</sup></label>
              <input type="text" class="form-control @error('nom') is-invalid @enderror" value="{{old('nom')}}" id="nom" name="nom" placeholder="nom">
              @error('nom')
              <p class="text-danger text-center">{{ $message }}</p>
              @enderror
            </div>

            <div class="form-group mb-2 col-lg-6">
              <label for="prenom">Prénom(s)</label>
              <input type="text" class="form-control @error('prenom') is-invalid @enderror" value="{{old('prenom')}}" id="prenom" name="prenom" placeholder="prenom">
              @error('prenom')
              <p class="text-danger text-center">{{ $message }}</p>
              @enderror
            </div>

</div>

<div class="row">
            <div class="form-group mb-2 col-md-6">
              <label for="phone">Téléphone <sup class="text-danger">*</sup></label>
              <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{old('phone')}}" id="phone" name="phone" placeholder="phone">
              @error('phone')
              <p class="text-danger text-center">{{ $message }}</p>
              @enderror
            </div>

            <div class="form-group mb-2 col-md-6">
              <label for="email">Email <sup class="text-danger">*</sup></label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" id="email" name="email" placeholder="email">
              @error('email')
              <p class="text-danger text-center">{{ $message }}</p>
              @enderror
            </div>

</div>

<div class="row">
    <div class="form-group mb-2 col-lg-6 ">
        <label for="contrat_type">Type de contrat</label>
        <select onchange="typeChange()" name="contrat_type" id="type" class="form-select @error('contrat_type') is-invalid @enderror" value="{{old("contrat_type")}}" required>
            <option value=""> -- Choisir --  </option>
            <option value="stage"> Stage </option>
            <option value="consultant"> Consultance </option>
          <option value="CDD"> CDD </option>
          <option value="CDI"> CDI </option>
        </select>
        @error('contrat_type')
        <p class="text-danger text-center">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group mb-2 col-3">
        <label for="contrat_start">Date de debut</label>
        <input type="date" class="form-control @error('contrat_start') is-invalid @enderror" value="{{old('contrat_start')}}" id="contrat_start" name="contrat_start">
        @error('contrat_start')
        <p class="text-danger text-center">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group mb-2 col-3" id="contrat_end_group">
        <label for="contrat_end">Date de fin</label>
        <input type="date" class="form-control @error('contrat_end') is-invalid @enderror" value="{{old('contrat_end')}}" id="contrat_end" name="contrat_end">
        @error('contrat_end')
        <p class="text-danger text-center">{{ $message }}</p>
        @enderror
    </div>

</div>

<div class="row">
    <div class="form-group col-12">
        <label for="note">Joindre le contrat</label>
        <input type="file" name="contrat_file" class="form-control">
        @error('note')
        <p class="text-danger text-center">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="row mb-2">
    <div class="form-group col-12">
        <label for="note">Note</label>
        <textarea class="form-control @error('note') is-invalid @enderror" value="{{old('note')}}" id="note" name="note" placeholder="Notes particulières à propos de cet employé"></textarea>
        @error('note')
        <p class="text-danger text-center">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="row">
  <div class="col-6">
    <a class="btn btn-light" href="{{ url()->previous() }}">annuler</a>
  </div>
  <div class="col-6">
    <button type="submit" class="btn btn-primary me-2">Enregistrer</button>
  </div>
</div>
          </form>
        </div>
      </div>
    </div>
    </div>


@endsection


@section("custom_script")

<script>
    $(document).ready(function() {
        console.log("BONJOUR");
    });

    function typeChange(){
        console.log("Log",$("#type").val());
        if($("#type").val()!="CDI"){
            $("#contrat_end_group").fadeIn();
        } else{
            $("#contrat_end").val('');
            $("#contrat_end_group").hide();
        }
    }

</script>

@endsection
