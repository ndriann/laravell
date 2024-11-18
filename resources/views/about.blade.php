@extends('layout.admin')
@push('css')
      <!-- Bootstrap CSS -->
    <link href="{{ asset('template/https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css') }}" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <center><h1>Data Pegawai</h1></center>
        <div class="container m-5 ">
          <a href="/tambahpegawai" class="btn btn-success">Tambah Data</a>
          {{-- {{ Session::get('halaman_url') }} --}}
          <div class="row g-3 align-items-center mt-2">
              <div class="col-auto">
                  <form action="/about" method="GET">
                      <input type="search" id="inputPassword6" name="search" class="form-control"
                          aria-describedby="passwordHelpInline">
                  </form>
              </div>
          </div>
          <br>
      <table class="table">
          <thead>
            <tr>
              <th scope="col">id</th>
              <th scope="col">Nama Lengkap</th>
              <th scope="col">Jenis Kelamin</th>
              <th scope="col">No Telp</th>
              <th scope="col">Email</th>
              <th scope="col">Logo</th>
              <th scope="col">Dibuat</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @php
            $no = 1;
        @endphp
        @foreach ($data as $index => $row)
            <tr>
                <th scope="row">{{ $index + $data ->firstItem() }}</th>
                <td>{{ $row->namalengkap }}</td>
              <td>{{ $row->jeniskelamin }}</td>
              <td>0{{ $row->notelpon}}</td>
              <td>{{ $row->email}}</td>
              <td>
                    <img src="{{ asset('fotopegawai/'.$row->logo) }}" alt="" style="width : 50px;">
  
              </td>
              <td>{{ $row->created_at->format('D M Y')}}</td>
              <td>
                <a href="/tampilkandata/{{  $row->id }}" class="btn btn-info">Edit</a>
                <a href="#" class="btn btn-danger delete" data-id="{{ $row->id }}" data-namalengkap="{{ $row->namalengkap }}">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {{ $data->links() }}
        </div>
</div>
      </div><!-- /.container-fluid -->
    </div>
        <div class="row m-5">
            {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
            @endif --}}
            
</div>
 
@endsection

@push('scripts')
    
 <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>
<script>
     $('.delete').click(function(){
            var pegawaiid =$(this).attr('data-id');
            var namalengkap =$(this).attr('data-namalengkap');
          swal({
                        title: "Yakin, Hapus Data?",
                        text: "Kamu akan menghapus data pegawai dengan id "+namalengkap+"",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                      })
                      .then((willDelete) => {
                        if (willDelete) {
                          window.location = "/delete/"+pegawaiid+"",
                          swal("Data berhasil dihapus!", {
                            icon: "success",
                          });
                        } else {
                          swal("Data tidak terhapus");
                        }
            });
        });
                                            
  </script>
  <script>
    @if (Session::has('success'))
    toastr.success("{{ Session::get('success') }}")
    @endif

</script>
@endpush