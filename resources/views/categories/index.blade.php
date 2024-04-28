@extends('dashboard.master')
@section('title', 'Categories')
@section('nav')
    @include('dashboard.nav')
@endsection
    @section('page', 'Categories')
@section('main')
    @include('dashboard.main')

    <!-- Awal Tabel -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
            <a href="" class="badge badge-sm bg-gradient-primary mb-3 fs-6">Add New Item 
            </a>
              <h6>Categories</h6>
             
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                  </thead>
                  <tbody>
                    @foreach ($categories as $idx => $data)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                            {{$idx + 1 . ". "}}
                        </div>
                      </td>
                      <td>
                        {{$data ->categories}}
                        </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">Edit</span>
                        <span class="badge badge-sm bg-gradient-danger">Delete</span>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <input type="text" id="sts" class="form-control" value="@isset($status){{$status}}@endisset" hidden />
      <input type="text" id="psn" class="form-control" value="@isset($pesan){{$pesan}}@endisset" hidden/>
      <script>
        const body = document.getElementById('master')
        const sts = document.getElementById('sts')
        const psn = document.getElementById('psn')
        function pesan_simpan(){
          if(sts.value === "simpan"){
            swal("Good Job!", psn.value, 'success')
          }
        }

        body.onload = function(){
          pesan_simpan()
        }

      </script>
      <!-- Akhir Table -->