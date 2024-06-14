@extends('layout')

@section('titre')
    Liste des Agencess 
@endsection

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
              {{-- <h3 class="card-title">Bordered Table</h3> --}}

            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 10px">#</th>
                    <th>Nom</th>
                    <th>Notes</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($ministeres as $ministere)
                  <tr>
                    <td>{{$loop->index+1}}</td>
                    <td>{{$ministere->nom}} </td>
                    <td>{{$ministere->description}}</td>
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
