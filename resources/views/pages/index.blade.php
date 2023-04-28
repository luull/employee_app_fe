@extends('templates.master')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                   <i class="fa fa-plus"></i> pegawai
                  </button>
                  
                <div class="card">
                    <div class="card-body">
                        
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pegawai</th>
                                        <th>Jabatan</th>
                                        <th>Kontrak</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                              {{-- <tbody>
                                <tr>
                                    <td id="display_no"></td>
                                    <td id="display_name"></td>
                                    <td id="display_jabatan"></td>
                                    <td id="display_kontrak"></td>
                                </tr>
                              </tbody> --}}
                                <tbody>
                                    @foreach ($dataPegawai as $i => $dp)
                                    <tr>
                                        <td>{{$i + 1}}</td>
                                        <td>{{$dp['nama']}}</td>
                                        <td>{{$dp['jabatan']['jabatan']}}</td>
                                        <td>{{$dp['kontrak']['kontrak']}}</td>
                                        <td>
                                            <a href="#" onclick="edit({{$dp['id']}})"><i class="fa fa-edit text-dark"></i></a>
                                            <a href="#" onclick="del({{$dp['id']}})"><i class="fa fa-trash text-danger"></i></a>
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
    </div>
    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addModalLabel">Tambah Pegawai</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="my-2">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="my-2">Jabatan</label>
                            <select name="jab_id" class="form-control " id="jab">
                                <option selected>Pilih Jabatan</option>
                                @foreach($dataJabatan as $dj)
                                <option value="{{$dj['id']}}">{{$dj['jabatan']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="my-2">Kontrak</label>
                            <select name="kon_id" class="form-control" id="kon">
                                <option selected>Pilih Kontrak</option>
                            @foreach($dataKontrak as $dj)
                                <option value="{{$dj['id']}}">{{$dj['kontrak']}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-primary" id="add">Tambah</button>
            </div>
          </div>
        </div>
      </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="editModalLabel">Edit Pegawai</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="my-2">Nama</label>
                            <input type="text" class="form-control" name="nama" id="edit_nama">
                            <input type="hidden" class="form-control" name="id" id="edit_id">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="my-2">Jabatan</label>
                            <select name="jab_id" class="form-control" id="edit_jab_id">
                                <option selected value="default">Pilih Jabatan</option>
                                @foreach($dataJabatan as $dj)
                                <option value="{{$dj['id']}}">{{$dj['jabatan']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="my-2">Kontrak</label>
                            <select name="kon_id" class="form-control" id="edit_kon_id">
                                <option selected value="default">Pilih Kontrak</option>
                            @foreach($dataKontrak as $dj)
                                <option value="{{$dj['id']}}">{{$dj['kontrak']}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-primary" id="editproses">Simpan</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="deleteModalLabel">Pemberitahuan</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" class="form-control" name="id" id="edit_id_del">
              <p>Apakah anda yakin ingin menghapus?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <button type="button" class="btn btn-primary" id="hapusproses">Hapus</button>
            </div>
          </div>
        </div>
      </div>
      
      
@endsection
@section('script')
<script>
  $(document).ready(function() {
        $.ajax({
            type:'GET',
            method:'GET',
            url:"http://127.0.0.1:8001/api/pegawai",
            data: '_token = <?php echo csrf_token(); ?>',
            success:function(data){
                if (data.data.length > 0) {
                   var a = 1
                    for(var i = 0; i < data.data.length; i++){

                        $('#display_no').append("<tr><td>" + a++ + "</td></tr>");
                        $('#display_name').append("<tr><td>" + data.data[i].nama + "</td></tr>");
                        $('#display_jabatan').append("<tr><td>" + data.data[i].jabatan.jabatan + "</td></tr>");
                        $('#display_kontrak').append("<tr><td>" + data.data[i].kontrak.kontrak + "</td></tr>");
                    }
                }
            }
        })
    });
    $("#add").click(function(e){
        e.preventDefault();

        names = $("#nama").val();
        jab = $('#jab').find(":selected").val();
        kon = $('#kon').find(":selected").val();
        token = '<?php echo csrf_token() ?>';
        $.ajax({
            type:'POST',
            method:'POST',
            url:"http://127.0.0.1:8001/api/pegawai/add",
            data: {nama:names, jab_id:jab, kon_id:kon,_token:token},
            success:function(data){
                console.log(data.data)
                $('#addModal').modal('toggle');
            }
        })
    })

    function edit(id){
        token = '<?php echo csrf_token() ?>';
        $.ajax({
            type:'POST',
            method:'POST',
            url:"http://127.0.0.1:8001/api/pegawai/find",
            data: {id:id,_token:token},
            success:function(data){
                console.log(data.data.jab_id)
                $("#edit_id").val(data.data.id);
                $("#edit_nama").val(data.data.nama);
                $("#edit_jab_id").val(data.data.jab_id);
                $("#edit_kon_id").val(data.data.kon_id);
                $("#editModal").modal('toggle');
            }
        })
    }
    $("#editproses").click(function(e){
        e.preventDefault();

        names = $("#edit_nama").val();
        jab = $('#edit_jab_id').find(":selected").val();
        kon = $('#edit_kon_id').find(":selected").val();
        id = $("#edit_id").val();
        token = '<?php echo csrf_token() ?>';
        $.ajax({
            type:'PUT',
            method:'PUT',
            url:"http://127.0.0.1:8001/api/pegawai/update/" + id,
            data: {nama:names, jab_id:jab, kon_id:kon,_token:token},
            success:function(data){
                console.log(data.data)
                $('#editModal').modal('toggle');
            }
        })
    })
    function del(id){
        token = '<?php echo csrf_token() ?>';
        $.ajax({
            type:'POST',
            method:'POST',
            url:"http://127.0.0.1:8001/api/pegawai/find",
            data: {id:id,_token:token},
            success:function(data){
                console.log(data.data.id)
                $("#edit_id_del").val(data.data.id);
                $("#deleteModal").modal('toggle');
            }
        })
    }
    $("#hapusproses").click(function(e){
        e.preventDefault();
        id = $("#edit_id_del").val();
        token = '<?php echo csrf_token() ?>';
        $.ajax({
            type:'DELETE',
            method:'DELETE',
            url:"http://127.0.0.1:8001/api/pegawai/delete/" + id,
            data: '_token = <?php echo csrf_token(); ?>',
            success:function(data){
                console.log(data.data)
                $('#deleteModal').modal('toggle');
            }
        })
    })
   
</script>
@endsection