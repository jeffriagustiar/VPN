@extends('layouts.app')

@section('title')
Paket
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('List Paket') }}</div>

                <div class="card-body">
                    <div class="col-sm-4">
                        <a href="#" class="btn btn-primary" id="addData">Add Data</a>
                    </div><br>
                    <table id="paketTable" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Lama</th>
                                <th>Test</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        {{-- <tbody>
                            <tr></tr>
                        </tbody> --}}
                        <tfoot>
                            <tr>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Lama</th>
                                <th>Test</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modalEdit" id="addDataModal" tabindex="-1" aria-labelledby="addData" aria-hidden="true">
    <div class="modal-dialog modal-m modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addData">Add Data User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="postData" name="postData" class="form-horizontal form" >
  
            <div class="mb-3 row">
              <label class="col-sm-2 control-label">Name</label>
              <div class="col-lg-12">
                <div class="input-group">
                    <input type="hidden" name="id">
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Nama Paket" value="" >
                </div>
              </div>
            </div>

            <div class="mb-3 row">
                <label class="col-sm-2 control-label">Lama</label>
                <div class="col-lg-12">
                  <div class="input-group">
                    <input type="text" class="form-control" id="lama" name="lama" placeholder="Enter Lama" value="" >
                  </div>
                </div>
              </div>

              <div class="mb-3 row">
                  <label class="col-sm-2 control-label">Desc</label>
                  <div class="col-lg-12">
                    <div class="input-group">
                      <input type="text" class="form-control" id="desc" name="desc" placeholder="Enter Desc" value="" >
                    </div>
                  </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 control-label">Test</label>
                    <div class="col-lg-12">
                      <div class="input-group">
                        <input type="text" class="form-control" id="test" name="test" placeholder="Enter Test" value="" >
                      </div>
                    </div>
                  </div>
            
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              {{-- <a class="btn btn-success btn-add" href="#" id="savedata" value="create">Save</a>
              <a class="btn btn-primary btn-edit" href="#" id="savedataedit" value="create">Save</a> --}}
              <button type="submit" class="btn btn-success btn-add" id="savedata" value="create">Save</button>
              <button type="submit" class="btn btn-primary btn-edit" id="savedataedit" value="create">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection

@push('after-script')
<script type="text/javascript">
    $(function (){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var modal = $('.modalEdit')
        var form = $('#postData')

        var paket = $('#paketTable').DataTable({
            processing: true,
            serverside: true,
            ajax: '/get-paket',
            columns: [
                {data: 'nama', name: 'nama'},
                {data: 'desc', name: 'desc'},
                {data: 'lama', name: 'lama'},
                {data: 'test', name: 'test'},
                {data: 'action', name: 'action'},
            ]
        });

        
        $('#addData').click(function (){
            modal.modal('show');
            form.trigger("reset");
            $('#savedataedit').hide();
            $('#savedata').show();
        });

        $('#savedata').click(function (){
            $.ajax({
                data: form.serialize(),
                url: '/add-paket',
                type: "post",
                dataType: 'json',
                success: function(data){
                    form.trigger("reset");
                    modal.modal('hide');
                    paket.ajax.reload();
                },
                error: function(data){
                    console.log('Error : ',data);
                }
            })
        });

        $('body').on('click', '.lookData', function(){
            var id = $(this).data("id");
            modal.modal('show');
            $('#savedataedit').show();
            $('#savedata').hide();

            modal.find('.modal-title').text('Update Data');
            var data= paket.row($(this).parents('tr')).data()

            form.find('input[name="id"]').val(data.id)
            form.find('input[name="nama"]').val(data.nama)
            form.find('input[name="lama"]').val(data.lama)
            form.find('input[name="desc"]').val(data.desc)
            form.find('input[name="test"]').val(data.test)
        });

        $('#savedataedit').click(function(){
            var id = form.find('input[name="id"]').val()
            $.ajax({
                type:"POST",
                data: form.serialize(),
                dataType: 'json',
                url: '/update-paket/'+id,
                success: function(data){
                    form.trigger("reset");
                    modal.modal('hide');
                    paket.ajax.relod();
                },
                error: function(data){
                    console.log('Error : ',data);
                }
            })
        });

        $('body').on('click', '.deleteData', function(){
            var id = $(this).data("id");
            $.ajax({
                type: "DELETE",
                url: '/delete-paket/'+id,
                success : function (data){
                    paket.ajax.reload()
                    console.log("success")
                },
                error: function (data){
                    console.log("Error : ",data);
                }
            })
        });


    })
</script>
@endpush