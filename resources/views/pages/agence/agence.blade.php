@extends('layout')

@section('titre')
    Liste des Agencess 
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Nom</th>
                    <th>taux</th>
                    <th>Contact</th>
                    <th>description</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($agences as $agence)
                  <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$agence->nom}} </td>
                    <td>{{$agence->taux}} %</td>
                    <td>{{$agence->telephone}} <br>{{$agence->email}} </td>
                    <td>{{$agence->description}}</td>
                  </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
    </div>
</div>
@endsection
