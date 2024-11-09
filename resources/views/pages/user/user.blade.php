@extends('layout')

@section('titre')
    Liste des utilisateurs 
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="clearfix mb-3">
          <a class="btn btn-primary float-right" href="{{ route('user.create') }}">
              Créer un utilisateur
          </a>
      </div>
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Nom</th>
                    <th>Poste</th>
                    <th>Télephone</th>
                    <th>Email</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                  <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{strtoupper($user->nom)}} {{ucwords($user->prenom)}}</td>
                    <td>{{$user->poste}} <br> <small>{{ $user->ministere?->nom }}</small></td>
                    <td>{{$user->telephone}}</td>
                    <td>{{$user->email}}</td>
                  </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
              </ul>
            </div>
          </div>
          <!-- /.card -->
    </div>
</div>
@endsection
